@extends('layouts.app')
@section('title', 'Add Funds')

@section('content')
<div class="max-w-5xl mx-auto animate-fade">
    <div class="mb-10">
        <h1 class="text-2xl font-bold text-white tracking-tight">Add Funds</h1>
        <p class="text-zinc-400 mt-1">Top up your wallet with V-Coins to keep your servers running.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Pack 1 -->
        <div class="bg-zinc-900 border border-white/5 rounded-2xl p-8 text-center hover:border-indigo-500/30 transition-all group shadow-xl">
            <h3 class="text-zinc-400 font-bold uppercase tracking-widest text-xs mb-4">Starter Pack</h3>
            <div class="text-4xl font-black text-white mb-2">500 <span class="text-sm text-zinc-500">Coins</span></div>
            <p class="text-zinc-500 text-sm mb-8">Perfect for a single small instance.</p>
            <div class="text-2xl font-bold text-white mb-6">$5.00</div>
            <button class="w-full py-3 bg-zinc-800 hover:bg-indigo-600 text-white font-bold rounded-xl transition-all uppercase tracking-widest text-xs">Purchase Pack</button>
        </div>

        <!-- Pack 2 (Most Popular) -->
        <div class="bg-zinc-900 border-2 border-indigo-600 rounded-2xl p-8 text-center relative shadow-[0_0_40px_rgba(79,70,229,0.1)] group">
            <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-indigo-600 text-white text-[10px] font-black px-3 py-1 rounded-full">MOST POPULAR</div>
            <h3 class="text-indigo-400 font-bold uppercase tracking-widest text-xs mb-4">Commander Pack</h3>
            <div class="text-4xl font-black text-white mb-2">2,500 <span class="text-sm text-zinc-500">Coins</span></div>
            <p class="text-zinc-500 text-sm mb-8">Deploy a high-performance network.</p>
            <div class="text-2xl font-bold text-white mb-6">$20.00</div>
            <button class="w-full py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-xl transition-all uppercase tracking-widest text-xs shadow-lg shadow-indigo-600/30">Purchase Pack</button>
        </div>

        <!-- Pack 3 -->
        <div class="bg-zinc-900 border border-white/5 rounded-2xl p-8 text-center hover:border-amber-500/30 transition-all group shadow-xl">
            <h3 class="text-zinc-400 font-bold uppercase tracking-widest text-xs mb-4">Enterprise Pack</h3>
            <div class="text-4xl font-black text-white mb-2">10,000 <span class="text-sm text-zinc-500">Coins</span></div>
            <p class="text-zinc-500 text-sm mb-8">Total infrastructure control.</p>
            <div class="text-2xl font-bold text-white mb-6">$75.00</div>
            <button class="w-full py-3 bg-zinc-800 hover:bg-amber-600 text-white font-bold rounded-xl transition-all uppercase tracking-widest text-xs">Purchase Pack</button>
        </div>
    </div>
    
    <div class="mt-12 bg-zinc-900/50 border border-dashed border-zinc-800 p-8 rounded-2xl text-center">
        <p class="text-zinc-500 text-sm">Need a custom amount? <a href="{{ route('support') }}" class="text-indigo-400 font-bold hover:underline">Contact our sales team</a> for volume discounts.</p>
    </div>
</div>
@endsection