<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Server extends Model
{
    protected $fillable = ['user_id', 'uuid', 'name', 'ip', 'port', 'memory', 'cpu', 'disk', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}