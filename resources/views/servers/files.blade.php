@extends('servers.layout')

@section('panel_content')
<div class="flex-1 p-6 flex flex-col h-full overflow-hidden">
    <div class="bg-zinc-950 rounded-xl border border-white/5 flex flex-col h-full overflow-hidden shadow-inner">
        
        <!-- File Path Navigation (Breadcrumbs) -->
        <div class="bg-zinc-900 border-b border-white/5 px-4 py-3 flex items-center justify-between gap-4">
            <div class="flex items-center gap-2 overflow-x-auto custom-scrollbar whitespace-nowrap">
                <a href="{{ route('servers.files', ['server' => $server->id, 'dir' => '/']) }}" class="text-indigo-400 hover:text-white font-mono text-sm transition-colors font-bold">/home/container</a>
                @if($directory !== '/')
                    @foreach(explode('/', trim($directory, '/')) as $index => $segment)
                        <span class="text-zinc-600 font-mono">/</span>
                        <span class="text-zinc-300 font-mono text-sm">{{ $segment }}</span>
                    @endforeach
                @endif
            </div>
            
            <!-- Quick Actions -->
            <div class="flex items-center gap-2">
                <button class="p-1.5 text-zinc-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors" title="Create File">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </button>
                <button class="p-1.5 text-zinc-400 hover:text-white hover:bg-white/5 rounded-lg transition-colors" title="Upload">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                </button>
            </div>
        </div>

        <!-- File List -->
        <div class="flex-1 overflow-y-auto custom-scrollbar">
            <table class="w-full text-left text-sm font-mono">
                <thead class="bg-white/[0.02] text-zinc-500 text-xs uppercase tracking-widest sticky top-0 backdrop-blur-md z-10">
                    <tr>
                        <th class="px-6 py-3 font-medium">Name</th>
                        <th class="px-6 py-3 font-medium w-32">Size</th>
                        <th class="px-6 py-3 font-medium text-right w-48">Modified</th>
                        <th class="px-4 py-3 w-10"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 text-zinc-300">
                    
                    <!-- Go Back Directory -->
                    @if($directory !== '/')
                        <tr class="hover:bg-white/5 transition-colors group cursor-pointer" onclick="window.location.href='{{ route('servers.files', ['server' => $server->id, 'dir' => dirname($directory) == '\\' ? '/' : dirname($directory)]) }}'">
                            <td class="px-6 py-3 flex items-center gap-3 text-indigo-400 group-hover:text-indigo-300">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path></svg>
                                <span class="font-bold">..</span>
                            </td>
                            <td class="px-6 py-3">--</td>
                            <td class="px-6 py-3 text-right">--</td>
                            <td></td>
                        </tr>
                    @endif

                    <!-- Loop Pterodactyl Files -->
                    @forelse($files as $file)
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3">
                                    @if($file['attributes']['is_file'])
                                        <!-- FILE: Click to Edit -->
                                        <svg class="w-5 h-5 text-zinc-500 group-hover:text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
<a href="{{ route('servers.files.edit', ['server' => $server->id, 'file' => ($directory == '/' ? '' : $directory . '/') . $file['attributes']['name']]) }}" class="group-hover:text-white transition-colors cursor-pointer hover:underline decoration-white/20 underline-offset-4">
    {{ $file['attributes']['name'] }}
</a>                                            {{ $file['attributes']['name'] }}
                                        </a>
                                    @else
                                        <!-- FOLDER: Click to Navigate -->
                                        <svg class="w-5 h-5 text-indigo-500 group-hover:text-indigo-400" fill="currentColor" viewBox="0 0 20 20"><path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path></svg>
                                        <a href="{{ route('servers.files', ['server' => $server->id, 'dir' => ($directory == '/' ? '' : $directory . '/') . $file['attributes']['name']]) }}" class="text-indigo-400 hover:text-white transition-colors cursor-pointer font-bold">
                                            {{ $file['attributes']['name'] }}
                                        </a>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-3 text-zinc-500 text-xs">
                                {{ $file['attributes']['is_file'] ? round($file['attributes']['size'] / 1024, 2) . ' KB' : '-' }}
                            </td>
                            <td class="px-6 py-3 text-right text-zinc-500 text-xs">
                                {{ \Carbon\Carbon::parse($file['attributes']['modified_at'])->format('M d, H:i') }}
                            </td>
                            <td class="px-4 py-3 text-right">
                                <button class="text-zinc-600 hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" /></svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-20 text-center text-zinc-600">
                                <div class="flex flex-col items-center">
                                    <svg class="w-10 h-10 mb-3 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"></path></svg>
                                    <span>Empty Directory</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection