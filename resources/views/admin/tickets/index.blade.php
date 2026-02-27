@extends('layouts.app')
@section('title', 'Help Desk')

@section('content')
<div class="animate-fade">
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h1 class="text-2xl font-extrabold text-white tracking-tight">Help Desk</h1>
            <p class="text-gray-400 mt-1 font-medium">Manage incoming support requests.</p>
        </div>
        <a href="{{ route('admin.index') }}" class="px-4 py-2 bg-zinc-900 border border-white/10 text-zinc-300 hover:text-white rounded-lg text-sm font-bold">&larr; Back</a>
    </div>

    <div class="bg-zinc-900 border border-white/5 rounded-xl overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-white/5 text-zinc-400">
                <tr>
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">User</th>
                    <th class="px-6 py-3">Subject</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($tickets as $ticket)
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-6 py-4 font-mono text-zinc-500">#{{ $ticket->id }}</td>
                    <td class="px-6 py-4 text-white font-medium">{{ $ticket->user->name }}</td>
                    <td class="px-6 py-4 text-zinc-300">{{ Str::limit($ticket->subject, 40) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded text-xs font-bold uppercase 
                            {{ $ticket->status == 'open' ? 'bg-emerald-500/10 text-emerald-400' : ($ticket->status == 'closed' ? 'bg-zinc-800 text-zinc-500' : 'bg-amber-500/10 text-amber-400') }}">
                            {{ $ticket->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="text-indigo-400 hover:text-white font-bold">Manage &rarr;</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">{{ $tickets->links() }}</div>
    </div>
</div>
@endsection