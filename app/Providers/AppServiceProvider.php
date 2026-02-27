<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event; // Add this if missing
use Illuminate\Auth\Events\Registered; // Add this if missing

class AppServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard'; // <--- THIS IS THE FIX

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        //
    }
}