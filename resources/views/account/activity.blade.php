@extends('layouts.app')
@section('title', 'Audit Log')

@section('content')
<div class="max-w-5xl mx-auto animate-fade">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-white tracking-tight">Audit Log</h1>
        <p class="text-sm text-zinc-400 mt-1">A complete history of actions performed on your account.</p>
    </div>

    <div class="bg-zinc-900 border border-white/5 rounded-xl overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-white/5 text-zinc-400">
                <tr>
                    <th class="px-6 py-3">Action</th>
                    <th class="px-6 py-3">Description</th>
                    <th class="px-6 py-3 text-right">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($logs as $log)
                <tr class="hover:bg-white/[0.02]">
                    <td class="px-6 py-4 font-medium text-white">{{ $log->action }}</td>
                    <td class="px-6 py-4 text-zinc-400">{{ $log->description }}</td>
                    <td class="px-6 py-4 text-right text-zinc-500 font-mono">{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
                @empty
                <tr><td colspan="3" class="px-6 py-12 text-center text-zinc-500">No logs recorded.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-white/5">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection