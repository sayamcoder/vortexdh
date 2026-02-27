<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Server;
use App\Services\WingsApiService;
use App\Api\V1\Controllers\SystemHealthController;


Route::prefix('v1')->group(function () {
    
    // System Health Check Endpoint
    Route::get('/health', [SystemHealthController::class, 'ping']);
    
    // Yahan aage chalkar hum aapki API keys ka middleware lagayenge
    // Route::middleware('auth:sanctum')->group(function() { ... });
});

Route::middleware('auth:sanctum')->group(function () {
    
    // Get Live Stats
    Route::get('/servers/{server}/stats', function (Server $server, WingsApiService $wings) {
        if (request()->user()->id !== $server->user_id) abort(403);

        $response = $wings->getServerStats($server->uuid);
        
        if ($response->successful()) {
            return response()->json($response->json('attributes'));
        }
        return response()->json(['state' => 'offline', 'cpu_absolute' => 0, 'memory_bytes' => 0], 200);
    });

    // Send Power Action (Start/Stop)
    Route::post('/servers/{server}/power', function (Request $request, Server $server, WingsApiService $wings) {
        if (request()->user()->id !== $server->user_id) abort(403);
        
        $request->validate(['action' => 'required|in:start,stop,restart,kill']);
        $response = $wings->sendPowerAction($server->uuid, $request->action);

        if ($response->successful()) {
            return response()->json(['message' => 'Command sent']);
        }
        return response()->json(['error' => 'Failed to send command'], 500);
    });
});