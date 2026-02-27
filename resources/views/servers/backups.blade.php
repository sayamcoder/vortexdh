@extends('servers.layout')
@section('panel_content')
<div class="flex-1 p-6 overflow-y-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-bold text-white">Backups</h2>
        <form action="{{ route('servers.backups.create', $server->id) }}" method="POST">
            @csrf
            <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-lg transition-colors">Create Backup</button>
        </form>
    </div>
    
    <div class="bg-zinc-950 border border-white/5 rounded-xl overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-white/5 text-zinc-400">
                <tr>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Size</th>
                    <th class="px-6 py-3 text-right">Created</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($backups as $backup)
                <tr>
                    <td class="px-6 py-4 text-white font-medium">{{ $backup['attributes']['name'] }}</td>
                    <td class="px-6 py-4 text-zinc-400">{{ round($backup['attributes']['bytes'] / 1024 / 1024, 2) }} MB</td>
                    <td class="px-6 py-4 text-right text-zinc-500">{{ \Carbon\Carbon::parse($backup['attributes']['created_at'])->diffForHumans() }}</td>
                </tr>
                @empty
                <tr><td colspan="3" class="px-6 py-12 text-center text-zinc-500">No backups available.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection