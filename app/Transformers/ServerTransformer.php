<?php
namespace App\Transformers;

use App\Models\Server;

class ServerTransformer
{
    /**
     * Transform the Server model into an API-friendly array.
     */
    public static function transform(Server $server): array
    {
        return [
            'id' => (string) $server->uuid,
            'attributes' => [
                'name' => $server->name,
                'connection' => [
                    'ip' => $server->ip,
                    'port' => $server->port,
                    'full' => $server->ip . ':' . $server->port,
                ],
                'specs' => [
                    'ram' => $server->memory . ' MB',
                    'cpu' => $server->cpu . ' %',
                    'disk' => $server->disk . ' MB',
                ],
                'state' => [
                    'current' => $server->status,
                    'is_suspended' => $server->status === 'suspended',
                ]
            ],
            'meta' => [
                'created_at' => $server->created_at->toIso8601String(),
                'uptime' => $server->created_at->diffForHumans(),
            ]
        ];
    }
}