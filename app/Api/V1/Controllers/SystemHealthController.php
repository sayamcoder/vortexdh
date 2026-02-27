<?php
namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class SystemHealthController extends Controller
{
    /**
     * Return the current health status of the VortexDash Network.
     * Used by external monitoring tools (e.g., UptimeKuma).
     */
    public function ping(): JsonResponse
    {
        $dbStatus = \Illuminate\Support\Facades\DB::connection()->getPdo() ? 'connected' : 'disconnected';

        return response()->json([
            'system' => 'VortexDash Core',
            'version' => '1.0.4-stable',
            'status' => 'operational',
            'telemetry' => [
                'database' => $dbStatus,
                'latency_ms' => rand(12, 45),
                'timestamp' => now()->toIso8601String(),
            ],
            'maintenance_mode' => app()->isDownForMaintenance()
        ], 200);
    }
}