@extends('layouts.app')
@section('title', 'Help Center')

@section('content')
<div class="animate-fade space-y-10">
    
    <!-- Hero / Search Section -->
    <div class="relative bg-zinc-900/50 border border-white/5 rounded-[2rem] p-10 overflow-hidden text-center shadow-2xl">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-indigo-500/10 rounded-full blur-[120px] pointer-events-none"></div>
        
        <div class="relative z-10 max-w-2xl mx-auto">
            <span class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.3em] mb-4 block">Knowledge Base</span>
            <h1 class="text-4xl font-bold text-white tracking-tight mb-4">How can we assist you today?</h1>
            <p class="text-zinc-400 mb-10 text-sm leading-relaxed font-medium">Search our detailed documentation protocols or initiate a secure uplink with our technical engineering team directly.</p>
            
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-zinc-600 group-focus-within:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" class="block w-full pl-14 pr-6 py-4.5 bg-zinc-950/80 border border-white/10 rounded-2xl text-white placeholder-zinc-600 focus:ring-2 focus:ring-indigo-500/40 focus:border-indigo-500 transition-all outline-none text-sm" placeholder="Ask a question (e.g. 'Reset server password')...">
            </div>
        </div>
    </div>

    <!-- Support Access Points -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Community -->
        <a href="https://discord.gg/yourinvite" target="_blank" class="block p-8 bg-zinc-900 border border-white/5 rounded-3xl hover:border-indigo-500/30 hover:bg-white/[0.02] transition-all duration-300 group relative overflow-hidden">
            <div class="w-12 h-12 bg-indigo-500/10 rounded-xl flex items-center justify-center text-indigo-400 mb-6 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M20.317 4.37a19.791 19.791 0 0 0-4.885-1.515..."></path></svg>
            </div>
            <h3 class="text-white font-bold text-lg mb-2 uppercase tracking-wide">Community Discord</h3>
            <p class="text-sm text-zinc-500 leading-relaxed">Engage with 5,000+ commanders. Get real-time help from community veterans and staff.</p>
        </a>

        <!-- Technical - NOW FUNCTIONAL -->
        <a href="{{ route('support.create') }}" class="block p-8 bg-zinc-900 border border-white/5 rounded-3xl hover:border-emerald-500/30 hover:bg-white/[0.02] transition-all duration-300 group relative overflow-hidden">
            <div class="w-12 h-12 bg-emerald-500/10 rounded-xl flex items-center justify-center text-emerald-400 mb-6 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
            </div>
            <h3 class="text-white font-bold text-lg mb-2 uppercase tracking-wide">Technical Uplink</h3>
            <p class="text-sm text-zinc-500 leading-relaxed">Report server instability, node connection errors, or backend bugs to our engineering team.</p>
            <div class="mt-6 flex items-center text-xs font-bold text-emerald-500 gap-2">
                OPEN NEW TICKET <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </div>
        </a>

        <!-- Billing -->
        <a href="{{ route('support.create') }}" class="block p-8 bg-zinc-900 border border-white/5 rounded-3xl hover:border-amber-500/30 hover:bg-white/[0.02] transition-all duration-300 group relative overflow-hidden">
            <div class="w-12 h-12 bg-amber-500/10 rounded-xl flex items-center justify-center text-amber-400 mb-6 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
            </div>
            <h3 class="text-white font-bold text-lg mb-2 uppercase tracking-wide">Billing Support</h3>
            <p class="text-sm text-zinc-500 leading-relaxed">Issues with V-Coin transactions, limit refunds, or account economy errors.</p>
        </a>
    </div>

    <!-- FAQ & Status Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-4">
            <h2 class="text-xl font-bold text-white tracking-tight px-1 mb-6">Standard FAQ Protocols</h2>
            
            <div class="bg-zinc-900 border border-white/5 rounded-3xl p-6 hover:bg-white/[0.01] transition-colors group">
                <h3 class="text-sm font-bold text-zinc-100 group-hover:text-indigo-400 transition-colors">How do I deploy an instance?</h3>
                <p class="text-sm text-zinc-500 mt-2 leading-relaxed">Navigate to the 'Deploy' protocol, allocate your desired CPU/RAM within your global limits, and click 'Initialize'. Servers go live in <30 seconds.</p>
            </div>

            <div class="bg-zinc-900 border border-white/5 rounded-3xl p-6 hover:bg-white/[0.01] transition-colors group">
                <h3 class="text-sm font-bold text-zinc-100 group-hover:text-indigo-400 transition-colors">What happens if my server runs out of V-Coins?</h3>
                <p class="text-sm text-zinc-500 mt-2 leading-relaxed">Server resources are tied to global account limits. V-Coins are only used for purchasing permanent limit upgrades in the Store.</p>
            </div>
        </div>

        <!-- System Status Widget -->
        <div class="bg-zinc-900 border border-white/5 rounded-[2rem] p-8 shadow-xl">
            <h3 class="text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] mb-8">Network Status</h3>
            
            <div class="space-y-6">
                <div class="flex items-center justify-between border-b border-white/5 pb-4">
                    <span class="text-sm font-medium text-zinc-300">VortexDash Core</span>
                    <span class="flex items-center text-[10px] font-black text-emerald-400 uppercase tracking-widest">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2 shadow-[0_0_8px_#10b981] animate-pulse"></span> Optimal
                    </span>
                </div>
                <div class="flex items-center justify-between border-b border-white/5 pb-4">
                    <span class="text-sm font-medium text-zinc-300">Primary Node Cluster</span>
                    <span class="flex items-center text-[10px] font-black text-emerald-400 uppercase tracking-widest">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2 shadow-[0_0_8px_#10b981]"></span> Online
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-zinc-300">Billing Engine</span>
                    <span class="flex items-center text-[10px] font-black text-emerald-400 uppercase tracking-widest">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2 shadow-[0_0_8px_#10b981]"></span> Active
                    </span>
                </div>
            </div>
            
            <div class="mt-10 pt-6 border-t border-white/5 text-center">
                <a href="#" class="text-[10px] font-black text-zinc-500 hover:text-white transition-colors uppercase tracking-[0.2em]">Detailed Analytics &rarr;</a>
            </div>
        </div>
    </div>
</div>
@endsection