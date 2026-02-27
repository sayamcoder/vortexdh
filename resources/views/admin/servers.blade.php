@extends('layouts.app')
@section('title', 'Fleet Monitor')

@section('content')
<div class="animate-fade-in-up">
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h2 class="text-2xl font-extrabold text-white tracking-tight">Fleet Monitor</h2>
            <p class="text-gray-400 mt-1 font-medium">Live status and termination control for all active instances.</p>
        </div>
        <a href="{{ route('admin.index') }}" class="px-4 py-2 bg-gray-900 border border-gray-700 text-gray-300 hover:text-white rounded-lg text-sm font-bold transition-colors">
            &larr; Return to Base
        </a>
    </div>

    <div class="bg-gray-900 border border-gray-800 rounded-3xl shadow-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-black/40 border-b border-gray-800 text-[10px] uppercase tracking-[0.2em] text-gray-500 font-mono">
                        <th class="px-6 py-5">Instance</th>
                        <th class="px-6 py-5">Owner</th>
                        <th class="px-6 py-5">Allocated Specs</th>
                        <th class="px-6 py-5">Connection Hash</th>
                        <th class="px-6 py-5 text-right">Termination</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800/50">
                    @forelse($servers as $server)
                    <tr class="hover:bg-vortex-purple/5 transition-colors group">
                        
                        <!-- Instance -->
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-gray-800 border border-gray-700 flex items-center justify-center text-gray-500 mr-3 shadow-md group-hover:text-white group-hover:border-gray-500 transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                </div>
                                <div>
                                    <p class="text-white font-bold text-sm tracking-wide">{{ $server->name }}</p>
                                    <p class="text-[10px] text-gray-500 font-mono uppercase tracking-widest">{{ Str::limit($server->uuid, 8) }}</p>
                                </div>
                            </div>
                        </td>

                        <!-- Owner -->
                        <td class="px-6 py-4">
                            @if($server->user)
                                <div class="flex items-center">
                                    <div class="w-6 h-6 rounded-full bg-indigo-600 flex items-center justify-center text-[10px] text-white font-bold mr-2 ring-2 ring-gray-900">
                                        {{ substr($server->user->name, 0, 1) }}
                                    </div>
                                    <span class="text-sm font-medium text-gray-300">{{ $server->user->name }}</span>
                                </div>
                            @else
                                <span class="px-2 py-1 bg-red-900/20 text-red-500 text-[10px] font-black uppercase tracking-widest rounded">Orphaned</span>
                            @endif
                        </td>

                        <!-- Specs -->
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <span class="px-2 py-1 bg-black/40 border border-gray-700 rounded text-xs font-mono text-gray-300">
                                    <span class="text-vortex-purple font-bold">R:</span> {{ $server->memory }}
                                </span>
                                <span class="px-2 py-1 bg-black/40 border border-gray-700 rounded text-xs font-mono text-gray-300">
                                    <span class="text-blue-500 font-bold">C:</span> {{ $server->cpu }}
                                </span>
                                <span class="px-2 py-1 bg-black/40 border border-gray-700 rounded text-xs font-mono text-gray-300">
                                    <span class="text-green-500 font-bold">D:</span> {{ $server->disk }}
                                </span>
                            </div>
                        </td>

                        <!-- Connection -->
                        <td class="px-6 py-4">
                             <code class="text-xs text-green-400 font-mono">
                                 {{ $server->ip }}:<span class="text-white">{{ $server->port }}</span>
                             </code>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('admin.servers.delete', $server) }}" method="POST" onsubmit="return confirm('WARNING: TERMINATING INSTANCE. This cannot be undone. Confirm?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="group/del relative p-2 rounded-lg hover:bg-red-500/20 transition-colors" title="Terminate Instance">
                                    <svg class="w-5 h-5 text-gray-600 group-hover/del:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center text-gray-500 font-mono uppercase tracking-widest">
                            // No Active Signals Detected //
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-4 border-t border-gray-800 bg-black/20">
            {{ $servers->links() }}
        </div>
    </div>
</div>
@endsection