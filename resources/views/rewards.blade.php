@extends('layouts.app')
@section('title', 'Reward Hub')

@section('content')
<div class="animate-fade">
    
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-white tracking-tight">Reward Hub</h1>
        <p class="text-sm text-zinc-400 mt-1">Complete tasks and claim your daily supply drops to earn V-Coins.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- MAIN FEATURE: Daily Drop -->
        <div class="lg:col-span-2">
            <div class="relative bg-zinc-900 border border-white/5 rounded-3xl p-8 overflow-hidden shadow-2xl group transition-all duration-500 {{ $canClaim ? 'hover:border-emerald-500/50' : '' }}">
                
                <!-- Dynamic Glow based on Status -->
                <div class="absolute top-0 right-0 w-96 h-96 rounded-full blur-[100px] pointer-events-none transition-all duration-1000 
                    {{ $canClaim ? 'bg-emerald-500/20 group-hover:bg-emerald-500/30' : 'bg-zinc-800/50' }}"></div>

                <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
                    <!-- Supply Crate Icon -->
                    <div class="w-32 h-32 flex-shrink-0 rounded-2xl flex items-center justify-center border-2 shadow-inner transition-all duration-500
                        {{ $canClaim ? 'bg-emerald-500/10 border-emerald-500/30 text-emerald-400 animate-pulse shadow-[0_0_30px_rgba(16,185,129,0.2)]' : 'bg-zinc-950 border-zinc-800 text-zinc-600' }}">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>

                    <div class="flex-1 text-center md:text-left">
                        <div class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[10px] font-black uppercase tracking-widest mb-3 border 
                            {{ $canClaim ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : 'bg-zinc-800 text-zinc-400 border-zinc-700' }}">
                            {{ $canClaim ? 'Ready to Open' : 'Charging...' }}
                        </div>
                        
                        <h2 class="text-3xl font-bold text-white mb-2">Daily Supply Drop</h2>
                        <p class="text-sm text-zinc-400 mb-6">Open your daily crate to receive a random amount of V-Coins (50 - 150). Resets every 24 hours.</p>

                        @if($canClaim)
                            <form action="{{ route('rewards.claim') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full md:w-auto px-8 py-3.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold tracking-widest rounded-xl transition-all shadow-[0_0_20px_rgba(16,185,129,0.3)] hover:shadow-[0_0_30px_rgba(16,185,129,0.5)] active:scale-95 flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg>
                                    UNLOCK CRATE
                                </button>
                            </form>
                        @else
                            <div class="inline-flex items-center justify-center w-full md:w-auto px-8 py-3.5 bg-zinc-950 border border-zinc-800 text-zinc-500 font-mono font-bold rounded-xl cursor-not-allowed">
                                <svg class="w-4 h-4 mr-2 animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                NEXT DROP IN: <span class="ml-2 text-indigo-400">{{ $timeLeft }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- SIDEBAR: Quests -->
        <div class="space-y-4">
            <h3 class="text-sm font-semibold text-white px-1">One-Time Quests</h3>
            
            <!-- Quest 1 -->
            <div class="bg-zinc-900 border border-white/5 rounded-2xl p-5 flex items-center justify-between group hover:border-indigo-500/30 transition-colors">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-[#5865F2]/10 text-[#5865F2] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515..."></path></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-white group-hover:text-indigo-400 transition-colors">Link Discord</h4>
                        <p class="text-xs text-emerald-400 font-bold mt-0.5">+150 Coins</p>
                    </div>
                </div>
                <button class="px-3 py-1.5 bg-zinc-800 hover:bg-zinc-700 text-xs font-semibold text-white rounded-lg transition-colors">START</button>
            </div>

            <!-- Quest 2 -->
            <div class="bg-zinc-900 border border-white/5 rounded-2xl p-5 flex items-center justify-between group hover:border-indigo-500/30 transition-colors">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-red-500/10 text-red-500 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-white group-hover:text-indigo-400 transition-colors">Subscribe YT</h4>
                        <p class="text-xs text-emerald-400 font-bold mt-0.5">+50 Coins</p>
                    </div>
                </div>
                <button class="px-3 py-1.5 bg-zinc-800 hover:bg-zinc-700 text-xs font-semibold text-white rounded-lg transition-colors">START</button>
            </div>
            
            <p class="text-[10px] text-zinc-500 text-center mt-4 uppercase tracking-widest">More quests coming soon</p>
        </div>
    </div>
</div>
@endsection