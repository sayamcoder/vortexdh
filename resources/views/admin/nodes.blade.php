@extends('layouts.app')
@section('title', 'Infrastructure Status')

@section('content')
<div class="animate-fade">
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h1 class="text-2xl font-semibold text-white tracking-tight">Infrastructure</h1>
            <p class="text-sm text-zinc-400 mt-1">Live telemetry from connected Pterodactyl nodes.</p>
        </div>
        <a href="{{ env('PTERODACTYL_URL') }}/admin/nodes/new" target="_blank" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold rounded-lg transition-colors flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add Node (via Panel)
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($nodes as $node)
        <div class="bg-zinc-900 border border-white/5 rounded-2xl p-6 relative overflow-hidden group hover:border-indigo-500/30 transition-all">
            
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 rounded-full {{ $node['attributes']['maintenance_mode'] ? 'bg-amber-500' : 'bg-emerald-500' }} animate-pulse shadow-[0_0_10px_currentColor]"></div>
                    <div>
                        <h3 class="text-lg font-bold text-white">{{ $node['attributes']['name'] }}</h3>
                        <p class="text-xs text-zinc-500">{{ $node['attributes']['fqdn'] }}</p>
                    </div>
                </div>
                <span class="text-xs font-mono text-zinc-500 bg-zinc-950 px-2 py-1 rounded border border-white/5">ID: {{ $node['attributes']['id'] }}</span>
            </div>

            <div class="space-y-6 relative z-10">
                <!-- Memory -->
                <div>
                    <div class="flex justify-between text-xs font-bold text-zinc-400 mb-2 uppercase tracking-wide">
                        <span>Memory Allocation</span>
                        <span class="text-white">{{ $node['attributes']['allocated_resources']['memory'] }} / {{ $node['attributes']['memory'] }} MB</span>
                    </div>
                    @php $memPct = ($node['attributes']['allocated_resources']['memory'] / $node['attributes']['memory']) * 100; @endphp
                    <div class="w-full bg-black/50 rounded-full h-2 overflow-hidden">
                        <div class="bg-blue-500 h-full rounded-full transition-all duration-1000" style="width: {{ $memPct }}%"></div>
                    </div>
                </div>

                <!-- Disk -->
                <div>
                    <div class="flex justify-between text-xs font-bold text-zinc-400 mb-2 uppercase tracking-wide">
                        <span>Disk Allocation</span>
                        <span class="text-white">{{ $node['attributes']['allocated_resources']['disk'] }} / {{ $node['attributes']['disk'] }} MB</span>
                    </div>
                    @php $diskPct = ($node['attributes']['allocated_resources']['disk'] / $node['attributes']['disk']) * 100; @endphp
                    <div class="w-full bg-black/50 rounded-full h-2 overflow-hidden">
                        <div class="bg-emerald-500 h-full rounded-full transition-all duration-1000" style="width: {{ $diskPct }}%"></div>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 pt-4 border-t border-white/5 flex justify-between items-center text-xs">
                <span class="text-zinc-500 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Location ID: {{ $node['attributes']['location_id'] }}
                </span>
                <a href="{{ env('PTERODACTYL_URL') }}/admin/nodes/view/{{ $node['attributes']['id'] }}" target="_blank" class="text-indigo-400 hover:text-white transition-colors font-bold uppercase">Manage &rarr;</a>
            </div>
        </div>
        @empty
        <div class="col-span-2 text-center py-12 text-zinc-500">No nodes connected to Pterodactyl.</div>
        @endforelse
    </div>
</div>
@endsection