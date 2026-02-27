@extends('layouts.guest')
@section('title', 'Sign In')

@section('content')
<div class="w-full max-w-[400px] animate-fade">
    
    <!-- Header Section -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-indigo-600 text-white shadow-lg shadow-indigo-500/20 mb-5 transition-transform hover:scale-105 duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-white tracking-tight">Welcome back</h1>
        <p class="text-zinc-400 text-sm mt-2 font-medium">Sign in to manage your server infrastructure.</p>
    </div>

    <!-- Main Card -->
    <div class="bg-zinc-900 border border-white/5 rounded-2xl p-8 shadow-2xl shadow-black/50 relative overflow-hidden">
        <!-- Subtle Top Accent -->
        <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-indigo-500/40 to-transparent"></div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-semibold text-zinc-500 uppercase tracking-widest mb-2 px-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                    placeholder="name@company.com"
                    class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-white placeholder-zinc-700 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none">
                @error('email') 
                    <span class="text-red-400 text-[11px] mt-1.5 block font-medium px-1 italic">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Password -->
            <div>
                <div class="flex justify-between items-center mb-2 px-1">
                    <label for="password" class="block text-xs font-semibold text-zinc-500 uppercase tracking-widest">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs font-medium text-indigo-400 hover:text-indigo-300 transition-colors">Forgot?</a>
                    @endif
                </div>
                <input id="password" type="password" name="password" required 
                    placeholder="••••••••"
                    class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-3 text-white placeholder-zinc-700 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none">
                @error('password') 
                    <span class="text-red-400 text-[11px] mt-1.5 block font-medium px-1 italic">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center px-1">
                <label class="flex items-center cursor-pointer group">
                    <input type="checkbox" name="remember" class="hidden peer">
                    <div class="w-4 h-4 border border-zinc-700 rounded bg-zinc-950 peer-checked:bg-indigo-600 peer-checked:border-indigo-600 transition-all flex items-center justify-center">
                        <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <span class="ml-2.5 text-xs text-zinc-500 group-hover:text-zinc-400 transition-colors">Keep me signed in</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" class="w-full py-3.5 px-4 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm rounded-xl transition-all shadow-lg shadow-indigo-500/10 hover:shadow-indigo-500/20 active:scale-[0.98]">
                    Sign Into VortexDash
                </button>
            </div>
        </form>
    </div>

    <!-- Footer Redirect -->
    @if (Route::has('register'))
        <div class="mt-8 text-center">
            <p class="text-sm text-zinc-500 font-medium">
                New to the platform? 
                <a href="{{ route('register') }}" class="text-indigo-400 hover:text-white font-bold transition-colors ml-1 underline underline-offset-4 decoration-indigo-500/30 hover:decoration-white">Create an account</a>
            </p>
        </div>
    @endif
</div>
@endsection