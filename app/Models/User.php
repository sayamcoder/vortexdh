<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Server;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
protected $fillable = [
        'name',
        'email',
        'password',
        'pterodactyl_id', // <--- ADD THIS LINE
        'coins',
        'max_servers',
        'max_ram',
        'max_cpu',
        'max_disk',
        'referral_code', 'referrer_id', 'referral_earnings',
        'has_panel_access',

    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_daily_claim' => 'datetime', // Add this so Laravel knows it's a date
    ];

    // Calculate used resources
    public function usedRam() { return $this->servers()->sum('memory'); }
    public function usedCpu() { return $this->servers()->sum('cpu'); }
    public function usedDisk() { return $this->servers()->sum('disk'); }
    public function usedServers() { return $this->servers()->count(); }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function servers()
    {
        return $this->hasMany(Server::class);
    }

    protected static function boot()
    {
        parent::boot();
        // Auto-generate referral code on creation
        static::creating(function ($user) {
            $user->referral_code = 'VD-' . strtoupper(Str::random(8));
        });
    }

    public function referrals()
    {    
        return $this->hasMany(User::class, 'referrer_id');
    }

    public function xpForNextLevel() {
        return $this->level * 500; // Each level requires 500 more XP
    }

    public function xpProgress() {
        return ($this->xp / $this->xpForNextLevel()) * 100;
    }

    // Call this whenever they do something "cool"
    public function gainXp($amount) {
        $this->increment('xp', $amount);
        if ($this->xp >= $this->xpForNextLevel()) {
            $this->decrement('xp', $this->xpForNextLevel());
            $this->increment('level');
            \App\Models\ActivityLog::record($this->id, 'Level Up!', "Promoted to Level {$this->level}", 'success');
        }
    }
}
