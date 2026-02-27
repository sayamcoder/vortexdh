@extends('layouts.app')
@section('title', 'Manage ' . $server->name)

@section('content')
<div class="animate-fade h-full flex flex-col min-h-[80vh]">
    
    <!-- Top Header Navigation -->
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <a href="{{ route('dashboard') }}" class="text-zinc-500 hover:text-white transition-colors bg-zinc-900 p-1.5 rounded-lg border border-white/5 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h1 class="text-2xl font-bold text-white tracking-tight">{{ $server->name }}</h1>
                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 shadow-[0_0_10px_rgba(99,102,241,0.2)]">
                    {{ $server->ip }}:{{ $server->port }}
                </span>
            </div>
            <p class="text-xs text-zinc-500 ml-11 font-mono uppercase tracking-widest">UUID: {{ substr($server->uuid, 0, 8) }}</p>
        </div>
        
        <!-- Power Controls (Visual only in layout, controlled via Vue in dashboard) -->
        <div class="flex items-center gap-2 bg-zinc-900 border border-white/5 p-1.5 rounded-xl">
            <button onclick="alert('Power actions are synced via Vue on Dashboard. Coming soon to this page.')" class="px-4 py-2 bg-emerald-500/10 text-emerald-400 hover:bg-emerald-500/20 text-xs font-bold uppercase tracking-widest rounded-lg border border-emerald-500/20 transition-colors">Start</button>
            <button class="px-4 py-2 bg-zinc-800 text-white hover:bg-zinc-700 text-xs font-bold uppercase tracking-widest rounded-lg transition-colors border border-transparent">Restart</button>
            <button class="px-4 py-2 bg-red-500/10 text-red-400 hover:bg-red-500/20 text-xs font-bold uppercase tracking-widest rounded-lg border border-red-500/20 transition-colors">Stop</button>
        </div>
    </div>

    <!-- The In-Built Panel Interface -->
    <div class="flex-1 bg-zinc-900/50 border border-white/5 rounded-2xl overflow-hidden flex flex-col md:flex-row shadow-2xl">
        
        <!-- Sidebar Tabs -->
        <div class="w-full md:w-64 bg-zinc-950/80 backdrop-blur-md border-r border-white/5 p-4 flex flex-col gap-2 z-10">
            <a href="{{ route('servers.manage', $server->id) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors border {{ request()->routeIs('servers.manage') ? 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20 shadow-inner' : 'text-zinc-400 hover:text-white hover:bg-white/5 border-transparent' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Terminal
            </a>
            
            <a href="{{ route('servers.files', $server->id) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors border {{ request()->routeIs('servers.files') ? 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20 shadow-inner' : 'text-zinc-400 hover:text-white hover:bg-white/5 border-transparent' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                File Manager
            </a>

            <a href="{{ route('servers.databases', $server->id) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors border {{ request()->routeIs('servers.databases') ? 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20 shadow-inner' : 'text-zinc-400 hover:text-white hover:bg-white/5 border-transparent' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                Databases
            </a>

            <a href="{{ route('servers.schedules', $server->id) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors border {{ request()->routeIs('servers.schedules') ? 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20 shadow-inner' : 'text-zinc-400 hover:text-white hover:bg-white/5 border-transparent' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Schedules
            </a>
            <div class="h-px bg-white/5 my-2 mx-4"></div>

<a href="{{ route('servers.network', $server->id) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors border {{ request()->routeIs('servers.network') ? 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20' : 'text-zinc-400 hover:text-white hover:bg-white/5 border-transparent' }}">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
    Network
</a>

<a href="{{ route('servers.users', $server->id) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors border {{ request()->routeIs('servers.users') ? 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20' : 'text-zinc-400 hover:text-white hover:bg-white/5 border-transparent' }}">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
    Users
</a>

<a href="{{ route('servers.backups', $server->id) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors border {{ request()->routeIs('servers.backups') ? 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20' : 'text-zinc-400 hover:text-white hover:bg-white/5 border-transparent' }}">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
    Backups
</a>

<a href="{{ route('servers.startup', $server->id) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors border {{ request()->routeIs('servers.startup') ? 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20' : 'text-zinc-400 hover:text-white hover:bg-white/5 border-transparent' }}">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
    Startup
</a>

<a href="{{ route('servers.settings', $server->id) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors border {{ request()->routeIs('servers.settings') ? 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20' : 'text-zinc-400 hover:text-white hover:bg-white/5 border-transparent' }}">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
    Settings
</a>
<a href="#" onclick="alert('Subdomain Manager is currently under maintenance.')" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-zinc-400 hover:text-white hover:bg-white/5 border-transparent transition-colors">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
    Subdomains
    <span class="ml-auto text-[9px] bg-indigo-500 text-white px-1.5 py-0.5 rounded font-bold">PRO</span>
</a>
        </div>

        <!-- Main Content Area -->
        <div id="app" class="flex-1 flex flex-col bg-zinc-900/30 overflow-hidden relative">
            @yield('panel_content')
        </div>

    </div>
</div>
@endsection