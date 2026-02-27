<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;
use App\Services\PterodactylService;

class DeploymentController extends Controller
{
    public function create()
    {
        return view('servers.create', ['user' => Auth::user()]);
    }

    public function store(Request $request, PterodactylService $ptero)
    {
        $user = Auth::user();

        // 1. SAFETY CHECK: Ensure user is linked to Pterodactyl
        if (!$user->pterodactyl_id) {
            return back()->with('error', 'CRITICAL: Your account is not linked to a Pterodactyl ID. Please contact support or re-register.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'memory' => 'required|integer|min:512',
            'cpu' => 'required|integer|min:50',
            'disk' => 'required|integer|min:1024',
        ]);

        // 2. Check Local Resource Limits
        if ($user->usedServers() >= $user->max_servers) return back()->with('error', 'Server slot limit reached.');
        if ($user->usedRam() + $request->memory > $user->max_ram) return back()->with('error', 'Not enough RAM available.');
        if ($user->usedCpu() + $request->cpu > $user->max_cpu) return back()->with('error', 'Not enough CPU available.');
        if ($user->usedDisk() + $request->disk > $user->max_disk) return back()->with('error', 'Not enough Disk available.');

        // 3. Prepare Auto-Deploy Data for Pterodactyl
        $serverData = [
            'name' => $request->name,
            'user' => (int) $user->pterodactyl_id, // Forces integer
            'egg' => (int) env('PTERODACTYL_EGG_ID', 1), // Default Minecraft Paper Egg is usually 1 or 15
            'docker_image' => 'ghcr.io/pterodactyl/yolks:java_17',
            'startup' => 'java -Xms128M -Xmx{{SERVER_MEMORY}}M -jar server.jar',
            'environment' => [
                'SERVER_JARFILE' => 'server.jar',
                'VANILLA_VERSION' => 'latest',
                'SPONGE_VERSION' => 'latest',    // <--- THIS FIXES YOUR ERROR
            ],
            'limits' => [
                'memory' => (int) $request->memory,
                'swap' => 0, // 0 is recommended for Minecraft
                'disk' => (int) $request->disk,
                'io' => 500,
                'cpu' => (int) $request->cpu,
            ],
            'feature_limits' => [
                'databases' => 0,
                'backups' => 1,
                'allocations' => 0,
            ],
            // PRODUCTION FIX: Use 'deploy' for automatic port allocation
            'deploy' => [
                'locations' => [(int) env('PTERODACTYL_LOCATION_ID', 1)], // Uses Location 1
                'dedicated_ip' => false,
                'port_range' => [], // Empty array means use any available port
            ],
        ];

        // 4. Call Pterodactyl API
        $response = $ptero->createServer($serverData);

        if ($response->failed()) {
            // Log the error for debugging
            \Log::error('Pterodactyl Deployment Failed: ', $response->json());
            $errorMsg = $response->json()['errors'][0]['detail'] ?? 'Unknown Panel Error. Check Laravel Logs.';
            return back()->with('error', 'Deployment Failed: ' . $errorMsg);
        }

        $pteroServer = $response->json()['attributes'];

        // 5. Create Local Database Record
        $user->servers()->create([
            'uuid' => $pteroServer['uuid'], // Real UUID from panel
            'name' => $request->name,
            'ip' => 'Deploying...', // Will be updated later
            'port' => 0, 
            'memory' => $request->memory,
            'cpu' => $request->cpu,
            'disk' => $request->disk,
            'status' => 'installing'
        ]);

        // 6. Log the Activity successfully!
        ActivityLog::record($user->id, 'Instance Deployed', "Deployed server '{$request->name}'", 'success');

        return redirect()->route('dashboard')->with('success', 'Instance deployed to network successfully!');
    }

    public function destroy(\App\Models\Server $server, PterodactylService $ptero)
    {
        $user = Auth::user();

        // Security: Ensure the user actually owns this server
        if ($server->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        // 1. Delete from Pterodactyl Panel
        // Note: Pterodactyl Application API requires internal ID, but some wings accept UUID.
        // We added a generic delete method to PterodactylService earlier.
        $response = $ptero->deleteServer($server->uuid);

        if ($response->failed() && $response->status() !== 404) {
            return back()->with('error', 'Failed to delete server from the Node. Please contact support.');
        }

        // 2. Delete from Local Database
        $serverName = $server->name;
        $server->delete();

        // 3. Log it
        \App\Models\ActivityLog::record($user->id, 'Instance Terminated', "Destroyed server '{$serverName}'. Resources refunded.", 'danger');

        return back()->with('success', 'Server terminated. Resources have been refunded to your account.');
    }
}