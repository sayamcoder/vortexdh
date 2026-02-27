<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = ['code', 'reward', 'max_uses'];

    public function users() {
        return $this->belongsToMany(User::class, 'voucher_user')->withTimestamps();
    }
}