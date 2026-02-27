@extends('layouts.app')
@section('title', 'Affiliate Program')

@section('content')
<div class="max-w-5xl mx-auto animate-fade">
    
    <!-- Hero Banner -->
    <div class="relative bg-gradient-to-r from-indigo-900/30 to-zinc-900 border border-indigo-500/20 rounded-2xl p-8 mb-8 overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h1 class="text-2xl font-bold text-white mb-2">Invite Friends, Earn Coins</h1>
                <p class="text-zinc-400 max-w-lg">Share your unique referral link. When a new commander registers using your link, you both receive <strong>250 V-Coins</strong> instantly.</p>
            </div>
            
            <!-- Link Copy Box -->
            <div class="w-full md:w-auto bg-black/30 backdrop-blur-sm border border-white/10 rounded-xl p-2 flex items-center">
                <code class="px-4 text-indigo-300 font-mono text-sm" id="ref-link">{{ url('/register?ref=' . $user->referral_code) }}</code>
                <button onclick="navigator.clipboard.writeText(document.getElementById('ref-link').innerText); alert('Link Copied!');" class="ml-3 px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-lg transition-colors shadow-lg">
                    COPY
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <!-- Total Referred -->
        <div class="bg-zinc-900 border border-white/5 rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-zinc-400">Total Referred</h3>
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <p class="text-3xl font-bold text-white">{{ $referredUsers->count() }}</p>
        </div>

        <!-- Total Earnings -->
        <div class="bg-zinc-900 border border-white/5 rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-zinc-400">Lifetime Earnings</h3>
                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <p class="text-3xl font-bold text-white">{{ number_format($user->referral_earnings) }} <span class="text-sm font-normal text-zinc-500">Coins</span></p>
        </div>

        <!-- Status -->
        <div class="bg-zinc-900 border border-white/5 rounded-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-zinc-400">Affiliate Status</h3>
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="flex items-center">
                <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-sm font-bold">Active</span>
            </div>
        </div>
    </div>

    <!-- Referral List -->
    <div class="bg-zinc-900 border border-white/5 rounded-xl overflow-hidden">
        <div class="px-6 py-4 border-b border-white/5">
            <h3 class="font-medium text-white">Recent Referrals</h3>
        </div>
        <div class="divide-y divide-white/5">
            @forelse($referredUsers as $referral)
            <div class="flex items-center justify-between px-6 py-4 hover:bg-white/[0.02] transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-zinc-800 flex items-center justify-center text-zinc-500 text-xs font-bold border border-zinc-700">
                        {{ substr($referral->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-medium text-zinc-200">{{ $referral->name }}</p>
                        <p class="text-xs text-zinc-500">Joined {{ $referral->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <span class="text-emerald-400 text-sm font-bold">+250 Coins</span>
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-zinc-500 text-sm">
                You haven't referred anyone yet. Share your link to get started!
            </div>
            @endforelse
        </div>
    </div>

</div>
@endsection