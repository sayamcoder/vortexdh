<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PterodactylService;

class ServerManagerController extends Controller
{
    // Security Check Helper
    private function checkAccess(Server $server)
    {
        $user = Auth::user();
        if ($server->user_id !== $user->id) { abort(403, 'Unauthorized access.'); }
        if (!$user->has_panel_access) { abort(403, 'Panel access disabled by admin.'); }
    }

    public function console(Server $server, PterodactylService $ptero)
    {
        $this->checkAccess($server);
        $tab = 'console';
        
        // Get WS Credentials
        $wsResponse = $ptero->getWebsocket($server->uuid);
        $websocket = $wsResponse->successful() ? $wsResponse->json('data') : null;

        return view('servers.console', compact('server', 'tab', 'websocket'));
    }

    public function files(Request $request, Server $server, PterodactylService $ptero)
    {
        $this->checkAccess($server);
        $directory = $request->query('dir', '/');
        $response = $ptero->listFiles($server->uuid, $directory);
        $files = $response->successful() ? $response->json('data') : [];

        return view('servers.files', compact('server', 'files', 'directory'));
    }

    // --- DATABASES (Update) ---
    public function databases(Server $server, PterodactylService $ptero) {
        $this->checkAccess($server);
        $response = $ptero->getDatabases($server->uuid);
        $databases = $response->successful() ? $response->json('data') : [];
        return view('servers.databases', compact('server', 'databases'));
    }

    public function storeDatabase(Request $request, Server $server, PterodactylService $ptero) {
        $this->checkAccess($server);
        $request->validate(['database' => 'required|string|max:48|regex:/^[a-zA-Z0-9_]+$/', 'remote' => 'required|string']);
        
        $response = $ptero->createDatabase($server->uuid, [
            'database' => $request->database,
            'remote' => $request->remote
        ]);

        if ($response->failed()) return back()->with('error', 'Failed to create database.');
        return back()->with('success', 'Database created successfully.');
    }

    // --- SCHEDULES (Update) ---
    public function schedules(Server $server, PterodactylService $ptero) {
        $this->checkAccess($server);
        $response = $ptero->getSchedules($server->uuid);
        $schedules = $response->successful() ? $response->json('data') : [];
        return view('servers.schedules', compact('server', 'schedules'));
    }

    // --- NEW PAGES ---

    public function network(Server $server, PterodactylService $ptero) {
        $this->checkAccess($server);
        $response = $ptero->getAllocations($server->uuid);
        $allocations = $response->successful() ? $response->json('data') : [];
        return view('servers.network', compact('server', 'allocations'));
    }

    public function users(Server $server, PterodactylService $ptero) {
        $this->checkAccess($server);
        $response = $ptero->getUsers($server->uuid);
        $users = $response->successful() ? $response->json('data') : [];
        return view('servers.users', compact('server', 'users'));
    }

    public function backups(Server $server, PterodactylService $ptero) {
        $this->checkAccess($server);
        $response = $ptero->getBackups($server->uuid);
        $backups = $response->successful() ? $response->json('data') : [];
        return view('servers.backups', compact('server', 'backups'));
    }
    
    public function storeBackup(Server $server, PterodactylService $ptero) {
        $this->checkAccess($server);
        $ptero->createBackup($server->uuid);
        return back()->with('success', 'Backup generation started.');
    }

    public function startup(Server $server, PterodactylService $ptero) {
        $this->checkAccess($server);
        $response = $ptero->getStartup($server->uuid);
        $variables = $response->successful() ? $response->json('data') : [];
        return view('servers.startup', compact('server', 'variables'));
    }

    public function settings(Server $server) {
        $this->checkAccess($server);
        return view('servers.settings', compact('server'));
    }

        // Show Editor
    public function editFile(Request $request, Server $server, PterodactylService $ptero)
    {
        $this->checkAccess($server);
        $file = $request->query('file');
        
        $response = $ptero->getFileContent($server->uuid, $file);
        $content = $response->successful() ? $response->body() : '';

        return view('servers.editor', compact('server', 'file', 'content'));
    }

    // Save File
    public function saveFile(Request $request, Server $server, PterodactylService $ptero)
    {
        $this->checkAccess($server);
        $file = $request->input('file');
        $content = $request->input('content');

        $response = $ptero->writeFile($server->uuid, $file, $content);

        if ($response->successful()) {
            return back()->with('success', 'File saved successfully.');
        }
        return back()->with('error', 'Failed to save file.');
    }

    // Show Console
}