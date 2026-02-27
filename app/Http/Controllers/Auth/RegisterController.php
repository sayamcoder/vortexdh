<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use App\Services\PterodactylService;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Override the default register method to include Pterodactyl API logic
     */
    public function showRegistrationForm(Request $request)
    {
        if ($request->has('ref')) {
            session(['referrer_code' => $request->query('ref')]);
        }
        return view('auth.register');
    }

    public function register(Request $request, PterodactylService $ptero)
    {
        $this->validator($request->all())->validate();

        // 1. Pterodactyl Logic
        $nameParts = explode(' ', $request->name, 2);
        $cleanUsername = preg_replace('/[^a-zA-Z0-9]/', '', strtolower($request->name)) . rand(10,99);

        $response = $ptero->createUser(
            $request->email,
            $cleanUsername,
            $nameParts[0],
            $nameParts[1] ?? 'User',
            $request->password
        );

        if ($response->failed()) {
            return back()->withInput()->withErrors(['email' => 'Panel Error: ' . ($response->json()['errors'][0]['detail'] ?? 'Connection Failed')]);
        }

        $pteroData = $response->json()['attributes'];

        // 2. REFERRAL LOGIC (The Fix)
        $referrerId = null;
        $startingCoins = 500; // Standard start

        // Check session or request for ref code
        $refCode = session('referrer_code') ?? $request->input('ref');
        
        if ($refCode) {
            $referrer = User::where('referral_code', $refCode)->first();
            if ($referrer) {
                $referrerId = $referrer->id;
                
                // Reward the Referrer (e.g. 250 coins)
                $referrer->increment('coins', 250);
                $referrer->increment('referral_earnings', 250);
                \App\Models\ActivityLog::record($referrer->id, 'Referral Bonus', 'Earned 250 coins for referring a new user.', 'success');
                
                // Reward the New User (Bonus 250 coins)
                $startingCoins += 250; 
            }
        }

        // 3. Create Local User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'pterodactyl_id' => $pteroData['id'],
            'coins' => $startingCoins, // 500 + Bonus if referred
            'referrer_id' => $referrerId,
            'max_servers' => 1,
            'max_ram' => 2048,
            'max_cpu' => 100,
            'max_disk' => 10240,
        ]);

        // Log welcome
        \App\Models\ActivityLog::record($user->id, 'Account Created', 'Welcome to VortexDash.', 'success');

        event(new Registered($user));
        $this->guard()->login($user);

        return redirect($this->redirectPath());
    }
}