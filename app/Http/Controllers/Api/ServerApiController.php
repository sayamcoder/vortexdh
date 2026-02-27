<?php

namespace App\Http\Controllers\Api;

use App\Models\Server;
use Illuminate\Http\Request;
use App\Services\PterodactylService; // Changed import
use App\Http\Controllers\Controller;

class ServerApiController extends Controller
{
    protected PterodactylService $ptero;

    public function __construct(PterodactylService $pteroService)
    {
        $this->ptero = $pteroService;
    }

    public function stats(Server $server)
    {
        // Fetch stats from Pterodactyl Panel, not Wings directly
        $response = $this->ptero->getServerStats($server->uuid);

        if ($response->successful()) {
            return response()->json($response->json('attributes.resources') + ['state' => $response->json('attributes.current_state')]);
        }

        if ($response->status() === 404 || $response->status() === 403) {
             $server->update(['status' => 'offline']);
             return response()->json(['state' => 'offline', 'cpu_absolute' => 0, 'memory_bytes' => 0]);
        }

        return response()->json(['error' => 'Could not fetch stats'], 500);
    }

    public function power(Request $request, Server $server)
    {
        $validated = $request->validate([
            'action' => 'required|in:start,stop,restart,kill',
        ]);

        // Send power signal to Pterodactyl Panel
        $response = $this->ptero->sendPowerAction($server->uuid, $validated['action']);

        if ($response->successful()) {
            $statusMap = ['start' => 'starting', 'stop' => 'stopping', 'restart' => 'restarting'];
            $server->update(['status' => $statusMap[$validated['action']] ?? 'stopping']);
            return response()->json(['message' => 'Power action sent successfully.']);
        }

        return response()->json(['error' => 'Failed to send power action.', 'details' => $response->json()], $response->status());
    }
}