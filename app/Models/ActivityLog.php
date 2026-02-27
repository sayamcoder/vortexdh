<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = ['user_id', 'action', 'description', 'type'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    // Helper to create logs easily
    public static function record($user_id, $action, $desc, $type = 'info') {
        self::create([
            'user_id' => $user_id,
            'action' => $action,
            'description' => $desc,
            'type' => $type
        ]);
    }
}