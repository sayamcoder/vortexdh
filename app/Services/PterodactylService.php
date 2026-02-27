<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class PterodactylService
{
    private $url;
    private $key;

    public function __construct()
    {
        $this->url = rtrim(env('PTERODACTYL_URL'), '/');
        // NOTE: For Application API (admin stuff like creating users/servers) we use the ptla_ key
        // We will use the same key, but Pterodactyl requires Client API keys (ptlc_) for power actions usually.
        // HOWEVER, as an admin, the Application API can also send power states if formulated correctly,
        // or we can use the specific Client endpoint if we impersonate the user. 
        // For simplicity, we'll try the Client API using an admin Client Key or User's Client Key if needed.
        
        $this->key = env('PTERODACTYL_API_KEY');
    }

    /**
     * Get the base HTTP client for Application API (Admin tasks)
     */
    private function getAppClient()
    {
        return Http::withToken($this->key)
            ->acceptJson()
            ->asJson()
            ->timeout(10);
    }

    /**
     * Get the base HTTP client for Client API (User tasks like Start/Stop)
     */
    private function getClientApi()
    {
        // NOTE: To control servers, you technically need a CLIENT API key (ptlc_...) 
        // of an admin or the server owner.
        // If you are using an Application key (ptla_), this endpoint will likely fail.
        // As a workaround for admin panels, you can generate an admin Client API key.
        return Http::withToken(env('PTERODACTYL_CLIENT_KEY', $this->key))
            ->acceptJson()
            ->asJson()
            ->timeout(10);
    }

    // --- Application API Methods (Create/Delete) ---

    public function createUser($email, $username, $firstName, $lastName, $password)
    {
        return $this->getAppClient()->post($this->url . '/api/application/users', [
            'email' => $email,
            'username' => $username,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'password' => $password,
            'language' => 'en'
        ]);
    }

    public function createServer($data)
    {
        return $this->getAppClient()->post($this->url . '/api/application/servers', $data);
    }

    public function deleteServer($serverUuid)
    {
        // To delete via Application API, you usually need the integer ID, not UUID.
        // But some panel forks accept UUID here. We will fetch the ID first to be safe.
        $serverLookup = $this->getAppClient()->get($this->url . '/api/application/servers/external/' . $serverUuid);
        if($serverLookup->successful()){
            $internalId = $serverLookup->json('attributes.id');
            return $this->getAppClient()->delete($this->url . '/api/application/servers/' . $internalId);
        }
        
        // Fallback
        return $this->getAppClient()->delete($this->url . '/api/application/servers/' . $serverUuid);
    }

    // --- Client API Methods (Power/Stats) ---

    public function getServerStats($serverUuid)
    {
        // Client API uses the UUID (technically the short UUID/Identifier)
        $identifier = substr($serverUuid, 0, 8);
        return $this->getClientApi()->get($this->url . '/api/client/servers/' . $identifier . '/resources');
    }

    public function sendPowerAction($serverUuid, $action)
    {
        // action can be: 'start', 'stop', 'restart', 'kill'
        $identifier = substr($serverUuid, 0, 8);
        return $this->getClientApi()->post($this->url . '/api/client/servers/' . $identifier . '/power', [
            'signal' => $action,
        ]);
    }
        // --- FILE MANAGER API METHODS ---

    public function listFiles($serverUuid, $directory = '/')
    {
        $identifier = substr($serverUuid, 0, 8); // Ptero client API needs the 8-char identifier
        return $this->getClientApi()->get($this->url . '/api/client/servers/' . $identifier . '/files/list', [
            'directory' => $directory
        ]);
    }

    public function getFileContent($serverUuid, $file)
    {
        $identifier = substr($serverUuid, 0, 8);
        return $this->getClientApi()->get($this->url . '/api/client/servers/' . $identifier . '/files/contents', [
            'file' => $file
        ]);
    }

    public function getDatabases($serverUuid)
    {
        $identifier = substr($serverUuid, 0, 8);
        return $this->getClientApi()->get($this->url . '/api/client/servers/' . $identifier . '/databases');
    }

    // --- SCHEDULES API METHODS ---
    public function getSchedules($serverUuid)
    {
        $identifier = substr($serverUuid, 0, 8);
        return $this->getClientApi()->get($this->url . '/api/client/servers/' . $identifier . '/schedules');
    }
    // --- DATABASES ---
    public function createDatabase($serverUuid, $data) {
        $identifier = substr($serverUuid, 0, 8);
        return $this->getClientApi()->post($this->url . "/api/client/servers/{$identifier}/databases", $data);
    }

    // --- SCHEDULES ---
    public function createSchedule($serverUuid, $data) {
        $identifier = substr($serverUuid, 0, 8);
        return $this->getClientApi()->post($this->url . "/api/client/servers/{$identifier}/schedules", $data);
    }

    // --- NETWORK (ALLOCATIONS) ---
    public function getAllocations($serverUuid) {
        $identifier = substr($serverUuid, 0, 8);
        return $this->getClientApi()->get($this->url . "/api/client/servers/{$identifier}/network/allocations");
    }

    // --- USERS (SUBUSERS) ---
    public function getUsers($serverUuid) {
        $identifier = substr($serverUuid, 0, 8);
        return $this->getClientApi()->get($this->url . "/api/client/servers/{$identifier}/users");
    }

    // --- BACKUPS ---
    public function getBackups($serverUuid) {
        $identifier = substr($serverUuid, 0, 8);
        return $this->getClientApi()->get($this->url . "/api/client/servers/{$identifier}/backups");
    }
    
    public function createBackup($serverUuid) {
        $identifier = substr($serverUuid, 0, 8);
        return $this->getClientApi()->post($this->url . "/api/client/servers/{$identifier}/backups");
    }

    // --- STARTUP ---
    public function getStartup($serverUuid) {
        $identifier = substr($serverUuid, 0, 8);
        return $this->getClientApi()->get($this->url . "/api/client/servers/{$identifier}/startup");
    }

    public function writeFile($serverUuid, $file, $content)
    {
        $identifier = substr($serverUuid, 0, 8);
        return $this->getClientApi()->post($this->url . '/api/client/servers/' . $identifier . '/files/write', [
            'file' => $file,
        ], $content); // Content is sent as raw body
    }

    public function getWebsocket($serverUuid)
    {
        $identifier = substr($serverUuid, 0, 8);
        return $this->getClientApi()->get($this->url . '/api/client/servers/' . $identifier . '/websocket');
    }

    public function getNodes()
    {
        // Use App Client (Admin Key)
        return $this->getAppClient()->get($this->url . '/api/application/nodes?include=location,servers');
    }
    
    public function getNode($id)
    {
        return $this->getAppClient()->get($this->url . '/api/application/nodes/' . $id . '?include=allocations');
    }
}