@extends('layouts.app')
@section('title', 'Deploy Instance')

@section('content')
<div class="max-w-3xl mx-auto animate-fade">
    
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-white tracking-tight">Deploy Server</h1>
        <p class="text-sm text-zinc-400 mt-1">Configure resources and initialize a new instance.</p>
    </div>

    <form action="{{ route('servers.store') }}" method="POST" class="bg-zinc-900 border border-white/5 rounded-xl p-6 md:p-8 shadow-sm">
        @csrf

        <!-- Server Name -->
        <div class="mb-8">
            <label class="block text-sm font-medium text-zinc-300 mb-2">Server Name</label>
            <div class="relative">
                <input type="text" name="name" required 
                    class="w-full bg-zinc-950 border border-zinc-800 text-zinc-100 text-sm rounded-lg focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 block w-full p-2.5 transition-all placeholder-zinc-600" 
                    placeholder="e.g. Production-01">
            </div>
        </div>

        <div class="space-y-8">
            <div class="flex items-center justify-between pb-4 border-b border-white/5">
                <h3 class="text-sm font-medium text-zinc-200">Resource Allocation</h3>
                <span class="text-xs text-zinc-500">Adjust limits based on your plan</span>
            </div>

            <!-- RAM Slider -->
            <div class="group">
                <div class="flex justify-between items-center mb-3">
                    <label class="text-sm font-medium text-zinc-400 group-hover:text-indigo-400 transition-colors">Memory (RAM)</label>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-zinc-500">Max: {{ $user->max_ram - $user->usedRam() }} MB</span>
                        <span class="bg-zinc-800 text-white text-xs font-mono py-1 px-2 rounded border border-white/5" id="ram-val">1024 MB</span>
                    </div>
                </div>
                <input type="range" name="memory" min="512" max="{{ $user->max_ram - $user->usedRam() }}" step="512" value="1024" 
                    class="w-full h-1.5 bg-zinc-800 rounded-lg appearance-none cursor-pointer accent-indigo-500 hover:accent-indigo-400 transition-all"
                    oninput="document.getElementById('ram-val').innerText = this.value + ' MB'">
            </div>

            <!-- CPU Slider -->
            <div class="group">
                <div class="flex justify-between items-center mb-3">
                    <label class="text-sm font-medium text-zinc-400 group-hover:text-indigo-400 transition-colors">CPU Allocation</label>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-zinc-500">Max: {{ $user->max_cpu - $user->usedCpu() }}%</span>
                        <span class="bg-zinc-800 text-white text-xs font-mono py-1 px-2 rounded border border-white/5" id="cpu-val">100 %</span>
                    </div>
                </div>
                <input type="range" name="cpu" min="50" max="{{ $user->max_cpu - $user->usedCpu() }}" step="50" value="100" 
                    class="w-full h-1.5 bg-zinc-800 rounded-lg appearance-none cursor-pointer accent-indigo-500 hover:accent-indigo-400 transition-all"
                    oninput="document.getElementById('cpu-val').innerText = this.value + ' %'">
            </div>

            <!-- Disk Slider -->
            <div class="group">
                <div class="flex justify-between items-center mb-3">
                    <label class="text-sm font-medium text-zinc-400 group-hover:text-indigo-400 transition-colors">Storage (NVMe)</label>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-zinc-500">Max: {{ $user->max_disk - $user->usedDisk() }} MB</span>
                        <span class="bg-zinc-800 text-white text-xs font-mono py-1 px-2 rounded border border-white/5" id="disk-val">5120 MB</span>
                    </div>
                </div>
                <input type="range" name="disk" min="1024" max="{{ $user->max_disk - $user->usedDisk() }}" step="1024" value="5120" 
                    class="w-full h-1.5 bg-zinc-800 rounded-lg appearance-none cursor-pointer accent-indigo-500 hover:accent-indigo-400 transition-all"
                    oninput="document.getElementById('disk-val').innerText = this.value + ' MB'">
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-10 pt-6 border-t border-white/5 flex justify-end">
            <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg transition-all shadow-lg shadow-indigo-500/20">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                Deploy Instance
            </button>
        </div>
    </form>
</div>
@endsection