@extends('servers.layout')
@section('panel_content')
<div class="flex-1 p-6 overflow-y-auto">
    <h2 class="text-lg font-bold text-white mb-6">Startup Configuration</h2>
    
    <div class="bg-zinc-950 border border-white/5 rounded-xl p-6 mb-6">
        <h3 class="text-sm font-bold text-zinc-300 mb-4 uppercase tracking-widest">Docker Image</h3>
        <div class="flex items-center gap-3 p-3 bg-zinc-900 rounded-lg border border-white/5">
            <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
            <code class="text-sm text-zinc-400 font-mono">{{ $server->image ?? 'ghcr.io/pterodactyl/yolks:java_17' }}</code>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4">
        @foreach($variables as $var)
        <div class="bg-zinc-950 border border-white/5 rounded-xl p-5 hover:border-indigo-500/20 transition-colors">
            <div class="flex justify-between mb-2">
                <label class="text-xs font-bold text-indigo-400 uppercase tracking-wide">{{ $var['attributes']['name'] }}</label>
                <span class="text-[10px] text-zinc-600 font-mono">{{ $var['attributes']['env_variable'] }}</span>
            </div>
            <input type="text" value="{{ $var['attributes']['server_value'] }}" class="w-full bg-zinc-900 border border-zinc-800 rounded-lg p-2.5 text-white font-mono text-sm focus:outline-none focus:border-indigo-500 transition-colors">
            <p class="text-xs text-zinc-500 mt-2 leading-relaxed">{{ $var['attributes']['description'] }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection