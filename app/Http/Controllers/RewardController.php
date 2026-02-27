<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\ActivityLog;

class RewardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Calculate time remaining for next claim (24 hours)
        $canClaim = true;
        $timeLeft = '00:00:00';

        if ($user->last_daily_claim) {
            $nextClaimTime = $user->last_daily_claim->addHours(24);
            if (now()->lessThan($nextClaimTime)) {
                $canClaim = false;
                $timeLeft = $nextClaimTime->diff(now())->format('%H:%I:%S');
            }
        }

        return view('rewards', compact('canClaim', 'timeLeft', 'user'));
    }

public function claimDaily()
{
    $user = \App\Models\User::where('id', Auth::id())->first();

    // STRICT CHECK: Today's date comparison
    if ($user->last_daily_claim && \Carbon\Carbon::parse($user->last_daily_claim)->isToday()) {
        return back()->with('error', 'Drop already claimed today. Return tomorrow, Commander.');
    }

    // ATOMIC TRANSACTION: Prevents duplicate claims from spam clicking
    try {
        \Illuminate\Support\Facades\DB::transaction(function () use ($user) {
            // Re-fetch with lock
            $lockedUser = \App\Models\User::where('id', $user->id)->lockForUpdate()->first();
            
            if ($lockedUser->last_daily_claim && \Carbon\Carbon::parse($lockedUser->last_daily_claim)->isToday()) {
                throw new \Exception("Duplicate attempt detected.");
            }

            $reward = rand(50, 150);
            $lockedUser->increment('coins', $reward);
            $lockedUser->update(['last_daily_claim' => now()]);
            $lockedUser->gainXp(100); // Give 100 XP for claiming daily


            \App\Models\ActivityLog::record($lockedUser->id, 'Daily Drop', "Found {$reward} coins in a supply drop.", 'success');
        });
    } catch (\Exception $e) {
        return back()->with('error', 'Processing error. Try again.');
    }

    return back()->with('success', 'Supply drop successfully decrypted!');
}
}