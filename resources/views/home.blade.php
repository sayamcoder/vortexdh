@extends('layouts.app')
@section('title', 'Instance Manager')

@section('content')
    <!-- Page Header Section -->
    <div class="mb-10 animate-fade-in-up">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">Instance Manager</h2>
        <p class="text-gray-400 mt-2 font-medium">Monitor and control your active deployments.</p>
    </div>

    <!-- Global Resource Allocation Limit Bars -->
    <div class="bg-vortex-card/50 border border-gray-800 rounded-2xl p-6 mb-10 animate-fade-in-up" style="animation-delay: 0.1s;">
        <div class="flex justify-between items-end mb-6">
            <h3 class="text-sm font-black text-gray-500 uppercase tracking-widest">Global Resource Allocation</h3>
            <a href="{{ route('shop') }}" class="text-xs font-bold text-vortex-purple hover:text-white transition-colors uppercase tracking-widest flex items-center">
                Upgrade Limits <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8">
            <!-- RAM Limit -->
            @php $ramPct = min(100, ($user->usedRam() / max(1, $user->max_ram)) * 100); @endphp
            <div>
                <div class="flex justify-between text-xs font-bold mb-2">
                    <span class="text-gray-400">Memory</span>
                    <span class="text-white">{{ $user->usedRam() }} / {{ $user->max_ram }} MB</span>
                </div>
                <div class="w-full bg-gray-900 rounded-full h-2 border border-gray-800 overflow-hidden">
                    <div class="h-full rounded-full bg-gradient-to-r from-vortex-purple to-indigo-500 shadow-[0_0_10px_rgba(139,92,246,0.5)] transition-all duration-1000" style="width: {{ $ramPct }}%"></div>
                </div>
            </div>

            <!-- CPU Limit -->
            @php $cpuPct = min(100, ($user->usedCpu() / max(1, $user->max_cpu)) * 100); @endphp
            <div>
                <div class="flex justify-between text-xs font-bold mb-2">
                    <span class="text-gray-400">CPU Threads</span>
                    <span class="text-white">{{ $user->usedCpu() }}% / {{ $user->max_cpu }}%</span>
                </div>
                <div class="w-full bg-gray-900 rounded-full h-2 border border-gray-800 overflow-hidden">
                    <div class="h-full rounded-full bg-gradient-to-r from-blue-500 to-cyan-400 shadow-[0_0_10px_rgba(59,130,246,0.5)] transition-all duration-1000" style="width: {{ $cpuPct }}%"></div>
                </div>
            </div>

            <!-- Disk Limit -->
            @php $diskPct = min(100, ($user->usedDisk() / max(1, $user->max_disk)) * 100); @endphp
            <div>
                <div class="flex justify-between text-xs font-bold mb-2">
                    <span class="text-gray-400">Storage Limit</span>
                    <span class="text-white">{{ $user->usedDisk() }} / {{ $user->max_disk }} MB</span>
                </div>
                <div class="w-full bg-gray-900 rounded-full h-2 border border-gray-800 overflow-hidden">
                    <div class="h-full rounded-full bg-gradient-to-r from-green-500 to-emerald-400 shadow-[0_0_10px_rgba(16,185,129,0.5)] transition-all duration-1000" style="width: {{ $diskPct }}%"></div>
                </div>
            </div>

            <!-- Server Slots Limit -->
            @php $slotPct = min(100, ($user->usedServers() / max(1, $user->max_servers)) * 100); @endphp
            <div>
                <div class="flex justify-between text-xs font-bold mb-2">
                    <span class="text-gray-400">Instance Slots</span>
                    <span class="text-white">{{ $user->usedServers() }} / {{ $user->max_servers }}</span>
                </div>
                <div class="w-full bg-gray-900 rounded-full h-2 border border-gray-800 overflow-hidden">
                    <div class="h-full rounded-full bg-gradient-to-r from-yellow-500 to-orange-400 shadow-[0_0_10px_rgba(234,179,8,0.5)] transition-all duration-1000" style="width: {{ $slotPct }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Server Grid -->
    <div class="animate-fade-in-up" style="animation-delay: 0.2s;">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-white">Active Instances</h3>
            <a href="{{ route('servers.create') }}" class="px-4 py-2 bg-vortex-purple/10 hover:bg-vortex-purple/20 text-vortex-purple font-bold rounded-lg border border-vortex-purple/50 transition-colors text-sm flex items-center shadow-[0_0_15px_rgba(139,92,246,0.15)] hover:shadow-[0_0_20px_rgba(139,92,246,0.3)]">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Deploy New
            </a>
        </div>

        @if($servers->isEmpty())
            <!-- Empty State UI -->
            <div class="bg-vortex-card border border-gray-800 border-dashed rounded-2xl p-16 text-center hover:border-gray-600 transition-colors">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-900 border border-gray-800 mb-6 shadow-inner">
                    <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-white mb-2 tracking-wide">No instances detected.</h2>
                <p class="text-gray-500 max-w-md mx-auto mb-8 font-medium">Your fleet is currently empty. Utilize your available resource allocation to deploy a new server instance.</p>
                <a href="{{ route('servers.create') }}" class="inline-block px-8 py-3 bg-gradient-to-r from-vortex-purple to-indigo-600 hover:from-vortex-purple-hover hover:to-indigo-500 text-white font-black tracking-widest rounded-xl shadow-lg transition-all hover:scale-105">
                    INITIALIZE DEPLOYMENT
                </a>
            </div>
        @else
            <!-- Server Card Grid (Rendered by Vue) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach($servers as $server)
                    <server-card :initial-server="{{ json_encode($server) }}"></server-card>
                @endforeach
            </div>
        @endif
    </div>
@endsection