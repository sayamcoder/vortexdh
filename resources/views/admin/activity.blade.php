@extends('layouts.app')
@section('title', 'Global Audit Log')

@section('content')
<div class="animate-fade">
    
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h1 class="text-2xl font-semibold text-white tracking-tight">Global Audit Log</h1>
            <p class="text-sm text-zinc-400 mt-1">Real-time telemetry of all user actions across the network.</p>
        </div>
        <a href="{{ route('admin.index') }}" class="px-4 py-2 bg-zinc-900 border border-white/10 text-zinc-300 hover:text-white rounded-lg text-sm font-medium transition-colors">
            &larr; Back
        </a>
    </div>

    <div class="bg-zinc-900 border border-white/5 rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/[0.02] border-b border-white/5 text-xs font-medium text-zinc-500 uppercase tracking-wider">
                        <th class="px-6 py-4">User Identity</th>
                        <th class="px-6 py-4">Action Type</th>
                        <th class="px-6 py-4">Details</th>
                        <th class="px-6 py-4 text-right">Timestamp</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($logs as $log)
                    <tr class="group hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4">
                            @if($log->user)
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-zinc-800 flex items-center justify-center text-xs font-bold text-zinc-400 border border-white/5">
                                        {{ substr($log->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-sm text-white font-medium">{{ $log->user->name }}</p>
                                        <p class="text-xs text-zinc-500">{{ $log->user->email }}</p>
                                    </div>
                                </div>
                            @else
                                <span class="text-zinc-500 text-xs font-mono uppercase">SYSTEM_KERNEL</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border
                                @if($log->type == 'success') bg-emerald-500/10 text-emerald-400 border-emerald-500/20
                                @elseif($log->type == 'warning') bg-amber-500/10 text-amber-400 border-amber-500/20
                                @elseif($log->type == 'danger') bg-red-500/10 text-red-400 border-red-500/20
                                @else bg-indigo-500/10 text-indigo-400 border-indigo-500/20 @endif">
                                {{ $log->action }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-zinc-300 font-mono">{{ $log->description }}</p>
                        </td>
                        <td class="px-6 py-4 text-right text-xs text-zinc-500 font-mono">
                            {{ $log->created_at->format('Y-m-d H:i:s') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-white/5">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection