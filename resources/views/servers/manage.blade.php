@extends('layouts.app')
@section('title', 'Manage ' . $server->name)

@section('content')
<div class="animate-fade h-full flex flex-col min-h-[80vh]">
    
    <!-- Top Header Navigation -->
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <a href="{{ route('dashboard') }}" class="text-zinc-500 hover:text-white transition-colors bg-zinc-900 p-1.5 rounded-lg border border-white/5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h1 class="text-2xl font-bold text-white tracking-tight">{{ $server->name }}</h1>
                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 shadow-[0_0_10px_rgba(99,102,241,0.2)]">
                    {{ $server->ip }}:{{ $server->port }}
                </span>
            </div>
            <p class="text-xs text-zinc-500 ml-11 font-mono uppercase tracking-widest">UUID: {{ substr($server->uuid, 0, 8) }}</p>
        </div>
        
        <!-- Power Controls (Uses Vue component logic visually, but kept simple here for HTML) -->
        <div class="flex items-center gap-2 bg-zinc-900 border border-white/5 p-1.5 rounded-xl">
            <button onclick="alert('Power actions are synced via Vue on Dashboard. Coming soon to this page.')" class="px-4 py-2 bg-emerald-500/10 text-emerald-400 hover:bg-emerald-500/20 text-xs font-bold uppercase tracking-widest rounded-lg border border-emerald-500/20 transition-colors">Start</button>
            <button class="px-4 py-2 bg-zinc-800 text-white hover:bg-zinc-700 text-xs font-bold uppercase tracking-widest rounded-lg transition-colors border border-transparent">Restart</button>
            <button class="px-4 py-2 bg-red-500/10 text-red-400 hover:bg-red-500/20 text-xs font-bold uppercase tracking-widest rounded-lg border border-red-500/20 transition-colors">Stop</button>
        </div>
    </div>

    <!-- The In-Built Panel Interface -->
    <div class="flex-1 bg-zinc-900/50 border border-white/5 rounded-2xl overflow-hidden flex flex-col md:flex-row shadow-2xl">
        
        <!-- Sidebar Tabs -->
        <div class="w-full md:w-64 bg-zinc-950/80 backdrop-blur-md border-r border-white/5 p-4 flex flex-col gap-2">
            <a href="{{ route('servers.manage', $server->id) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors border {{ $tab == 'console' ? 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20 shadow-inner' : 'text-zinc-400 hover:text-white hover:bg-white/5 border-transparent' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Terminal
            </a>
            
            <a href="{{ route('servers.files', $server->id) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors border {{ $tab == 'files' ? 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20 shadow-inner' : 'text-zinc-400 hover:text-white hover:bg-white/5 border-transparent' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                File Manager
            </a>

            <!-- NEW: Databases Tab -->
            <a href="{{ route('servers.databases', $server->id) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors border {{ $tab == 'databases' ? 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20 shadow-inner' : 'text-zinc-400 hover:text-white hover:bg-white/5 border-transparent' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                Databases
            </a>

            <!-- NEW: Schedules Tab -->
            <a href="{{ route('servers.schedules', $server->id) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors border {{ $tab == 'schedules' ? 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20 shadow-inner' : 'text-zinc-400 hover:text-white hover:bg-white/5 border-transparent' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Schedules
            </a>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col p-6">
            
            @if($tab == 'console')
                <!-- TERMINAL VIEW -->
                <div class="flex-1 bg-[#09090b] rounded-xl border border-white/5 flex flex-col overflow-hidden shadow-inner relative">
                    <div class="bg-zinc-900 border-b border-white/5 px-4 py-3 flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                        <div class="w-3 h-3 rounded-full bg-amber-500/80"></div>
                        <div class="w-3 h-3 rounded-full bg-emerald-500/80"></div>
                        <span class="ml-4 text-[10px] text-zinc-500 font-mono tracking-widest">root@{{ substr($server->uuid, 0, 8) }}:~#</span>
                    </div>
                    
                    <div class="flex-1 p-5 overflow-y-auto font-mono text-sm leading-relaxed text-zinc-300">
                        <p class="text-indigo-400 mb-2">Pterodactyl WebSocket Proxy Connection Established.</p>
                        <p class="text-zinc-500">[Info] Live console streaming requires WebSockets. We are showing mock data for UI visualization.</p>
                        <br>
                        <p class="text-zinc-300">Starting server...</p>
                        <p class="text-zinc-300">Loading libraries, please wait...</p>
                        <p class="text-emerald-400 font-bold">Done (2.124s)! For help, type "help"</p>
                    </div>

                    <div class="bg-zinc-950 border-t border-white/5 p-3 flex items-center gap-3">
                        <span class="text-indigo-500 font-black">></span>
                        <input type="text" class="flex-1 bg-transparent border-none text-white text-sm font-mono focus:ring-0 outline-none placeholder-zinc-700" placeholder="Type a command...">
                        <button class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2 rounded-lg text-xs font-bold uppercase tracking-widest transition-colors">Send</button>
                    </div>
                </div>

            @elseif($tab == 'files')
                <!-- FILE MANAGER VIEW -->
                <div class="bg-zinc-950 rounded-xl border border-white/5 flex flex-col h-full overflow-hidden shadow-inner">
                    
                    <!-- File Path Navigation -->
                    <div class="bg-zinc-900 border-b border-white/5 px-4 py-3 flex items-center gap-2 overflow-x-auto custom-scrollbar">
                        <a href="{{ route('servers.files', ['server' => $server->id, 'dir' => '/']) }}" class="text-indigo-400 hover:text-white font-mono text-sm transition-colors">/home/container</a>
                        @if($directory !== '/')
                            <span class="text-zinc-600 font-mono">/</span>
                            <span class="text-zinc-300 font-mono text-sm">{{ trim($directory, '/') }}</span>
                        @endif
                    </div>

                    <!-- File List -->
                    <div class="flex-1 overflow-y-auto custom-scrollbar">
                        <table class="w-full text-left text-sm font-mono">
                            <thead class="bg-white/[0.02] text-zinc-500 text-xs uppercase tracking-widest sticky top-0">
                                <tr>
                                    <th class="px-6 py-3 font-medium">Name</th>
                                    <th class="px-6 py-3 font-medium">Size</th>
                                    <th class="px-6 py-3 font-medium text-right">Modified</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5 text-zinc-300">
                                <!-- Go Back Directory -->
                                @if($directory !== '/')
                                    <tr class="hover:bg-white/5 transition-colors group cursor-pointer" onclick="window.history.back()">
                                        <td class="px-6 py-3 flex items-center gap-3 text-indigo-400 group-hover:text-indigo-300">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path></svg>
                                            ..
                                        </td>
                                        <td class="px-6 py-3">--</td>
                                        <td class="px-6 py-3 text-right">--</td>
                                    </tr>
                                @endif

                                            @elseif($tab == 'databases')
                <!-- Mount Vue Component -->
                <server-databases :initial-databases="{{ json_encode($databases) }}"></server-databases>
            @elseif($tab == 'schedules')
                <!-- Mount Vue Component -->
                <server-schedules :initial-schedules="{{ json_encode($schedules) }}"></server-schedules>
            @endif

                                <!-- Loop Pterodactyl Files -->
                                @forelse($files as $file)
                                    <tr class="hover:bg-white/5 transition-colors group">
                                        <td class="px-6 py-3 flex items-center gap-3">
                                            @if($file['attributes']['is_file'])
                                                <svg class="w-5 h-5 text-zinc-500 group-hover:text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                                <span class="group-hover:text-white transition-colors">{{ $file['attributes']['name'] }}</span>
                                            @else
                                                <svg class="w-5 h-5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path></svg>
                                                <a href="{{ route('servers.files', ['server' => $server->id, 'dir' => $directory === '/' ? '/' . $file['attributes']['name'] : $directory . '/' . $file['attributes']['name']]) }}" class="text-indigo-400 hover:text-white transition-colors">
                                                    {{ $file['attributes']['name'] }}
                                                </a>
                                            @endif
                                        </td>
                                        <td class="px-6 py-3 text-zinc-500">{{ $file['attributes']['is_file'] ? round($file['attributes']['size'] / 1024, 2) . ' KB' : '--' }}</td>
                                        <td class="px-6 py-3 text-right text-zinc-500">{{ \Carbon\Carbon::parse($file['attributes']['modified_at'])->format('M d, H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center text-zinc-600">Directory is empty or Pterodactyl node is unreachable.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection