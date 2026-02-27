@extends('servers.layout')
@section('panel_content')
<div class="flex-1 p-6 overflow-y-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-bold text-white">Subusers</h2>
            <p class="text-sm text-zinc-400">Grant other users access to this server.</p>
        </div>
        <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-lg transition-colors">Add User</button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse($users as $subuser)
        <div class="bg-zinc-950 border border-white/5 rounded-xl p-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-zinc-800 flex items-center justify-center text-zinc-400">
                    {{ substr($subuser['attributes']['email'], 0, 1) }}
                </div>
                <div>
                    <h3 class="text-white font-medium text-sm">{{ $subuser['attributes']['email'] }}</h3>
                    <p class="text-xs text-zinc-500">{{ $subuser['attributes']['uuid'] }}</p>
                </div>
            </div>
            <button class="text-zinc-500 hover:text-red-400 transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
        </div>
        @empty
        <div class="col-span-2 text-center py-12 border border-dashed border-zinc-800 rounded-xl">
            <p class="text-zinc-500 text-sm">No subusers assigned to this server.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection