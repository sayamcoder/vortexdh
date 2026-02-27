@extends('servers.layout')
@section('panel_content')
<div class="flex-1 p-6 overflow-y-auto">
    <h2 class="text-lg font-bold text-white mb-6">Server Settings</h2>
    
    <div class="bg-zinc-950 border border-white/5 rounded-xl p-6 mb-6">
        <h3 class="text-sm font-bold text-white mb-4">SFTP Details</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="text-xs text-zinc-500">Connection Address</label>
                <input value="{{ $server->ip }}:{{ $server->port }}" readonly class="w-full bg-zinc-900 border border-zinc-800 rounded p-2 text-sm text-zinc-300 font-mono mt-1">
            </div>
            <div>
                <label class="text-xs text-zinc-500">Username</label>
                <input value="{{ Auth::user()->name }}.{{ substr($server->uuid, 0, 8) }}" readonly class="w-full bg-zinc-900 border border-zinc-800 rounded p-2 text-sm text-zinc-300 font-mono mt-1">
            </div>
        </div>
    </div>

    <div class="bg-red-500/5 border border-red-500/20 rounded-xl p-6">
        <h3 class="text-sm font-bold text-red-400 mb-2">Danger Zone</h3>
        <p class="text-xs text-red-400/70 mb-4">Reinstalling will wipe all server files. This cannot be undone.</p>
        <button class="px-4 py-2 bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/20 rounded-lg text-xs font-bold transition-colors">Reinstall Server</button>
    </div>
</div>
@endsection