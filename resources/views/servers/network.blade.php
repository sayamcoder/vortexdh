@extends('servers.layout')
@section('panel_content')
<div class="flex-1 p-6 overflow-y-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-bold text-white">Network</h2>
            <p class="text-sm text-zinc-400">Manage ports and connection allocations.</p>
        </div>
        <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-lg transition-colors">Create Allocation</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($allocations as $alloc)
        <div class="bg-zinc-950 border {{ $alloc['attributes']['is_default'] ? 'border-emerald-500/30' : 'border-white/5' }} rounded-xl p-5 relative overflow-hidden group hover:border-indigo-500/30 transition-colors">
            @if($alloc['attributes']['is_default'])
                <div class="absolute top-0 right-0 bg-emerald-500/10 text-emerald-400 text-[10px] font-bold px-2 py-1 rounded-bl-lg border-b border-l border-emerald-500/20">PRIMARY</div>
            @endif
            
            <div class="flex items-center gap-3 mb-2">
                <svg class="w-5 h-5 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                <span class="text-zinc-400 text-xs font-mono uppercase">Address</span>
            </div>
            <h3 class="text-white font-mono text-lg tracking-wide">{{ $alloc['attributes']['ip'] }}</h3>
            <p class="text-indigo-400 font-bold font-mono text-2xl mt-1">{{ $alloc['attributes']['port'] }}</p>
            
            @if(!$alloc['attributes']['is_default'])
                <div class="mt-4 pt-4 border-t border-white/5 flex gap-2">
                    <button class="text-xs text-zinc-400 hover:text-white transition-colors">Make Primary</button>
                    <button class="text-xs text-red-400 hover:text-red-300 ml-auto transition-colors">Delete</button>
                </div>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection