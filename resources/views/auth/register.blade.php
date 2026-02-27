@extends('layouts.guest')
@section('title', 'Register')

@section('content')
<div class="w-full max-w-md w-[400px] animate-fade-in-up">
    <!-- Logo -->
    <div class="text-center mb-8">
        <h2 class="text-4xl font-extrabold text-white tracking-wider">Vortex<span class="text-vortex-purple">Dash</span></h2>
        <p class="text-gray-400 mt-2 font-medium">Initialize your command center.</p>
    </div>

    <!-- Glassmorphism Card -->
    <div class="bg-vortex-card/80 backdrop-blur-xl rounded-2xl shadow-2xl border border-gray-700/50 p-8 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-blue-500 to-transparent opacity-50"></div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Username -->
            <div class="group">
                <label for="name" class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1.5 group-focus-within:text-vortex-purple transition-colors">Username</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full bg-gray-900/50 border border-gray-700 rounded-lg px-4 py-2.5 text-white placeholder-gray-600 focus:outline-none focus:border-vortex-purple focus:ring-1 focus:ring-vortex-purple transition-all duration-300">
                @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div class="group">
                <label for="email" class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1.5 group-focus-within:text-vortex-purple transition-colors">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="w-full bg-gray-900/50 border border-gray-700 rounded-lg px-4 py-2.5 text-white placeholder-gray-600 focus:outline-none focus:border-vortex-purple focus:ring-1 focus:ring-vortex-purple transition-all duration-300">
                @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div class="group">
                <label for="password" class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1.5 group-focus-within:text-vortex-purple transition-colors">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full bg-gray-900/50 border border-gray-700 rounded-lg px-4 py-2.5 text-white placeholder-gray-600 focus:outline-none focus:border-vortex-purple focus:ring-1 focus:ring-vortex-purple transition-all duration-300">
                @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Confirm Password -->
            <div class="group">
                <label for="password_confirmation" class="block text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1.5 group-focus-within:text-vortex-purple transition-colors">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="w-full bg-gray-900/50 border border-gray-700 rounded-lg px-4 py-2.5 text-white placeholder-gray-600 focus:outline-none focus:border-vortex-purple focus:ring-1 focus:ring-vortex-purple transition-all duration-300">
            </div>

            <button type="submit" class="w-full relative group overflow-hidden rounded-lg p-[1px] mt-4">
                <span class="absolute inset-0 bg-gradient-to-r from-blue-600 to-vortex-purple rounded-lg opacity-70 group-hover:opacity-100 transition-opacity duration-300"></span>
                <div class="relative flex items-center justify-center px-4 py-3 bg-vortex-card rounded-lg transition-all duration-300 group-hover:bg-opacity-0">
                    <span class="font-bold text-white tracking-wide">CREATE INSTANCE</span>
                </div>
            </button>
        </form>
    </div>

    <p class="mt-8 text-center text-sm text-gray-500 animate-fade-in-up" style="animation-delay: 0.2s;">
        Already in the network? 
        <a href="{{ route('login') }}" class="font-bold text-vortex-purple hover:text-white transition-colors relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[1px] after:bg-white hover:after:w-full after:transition-all after:duration-300">Sign in</a>
    </p>
</div>
@endsection