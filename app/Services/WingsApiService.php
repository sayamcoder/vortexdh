<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class WingsApiService
{
    private function getClient()
    {
        return Http::withToken(env('WINGS_TOKEN'))
            ->baseUrl(env('WINGS_URL'))
            ->acceptJson()
            ->timeout(5);
    }

    public function getServerStats(string $uuid)
    {
        return $this->getClient()->get("/api/servers/{$uuid}/resources");
    }

    public function sendPowerAction(string $uuid, string $action)
    {
        // action can be: 'start', 'stop', 'restart', 'kill'
        return $this->getClient()->post("/api/servers/{$uuid}/power", [
            'signal' => $action,
        ]);
    }
    
    // Added for future use if you connect to Pterodactyl Application API
    public function deleteServer(string $uuid)
    {
        return $this->getClient()->delete("/api/servers/{$uuid}");
    }
}