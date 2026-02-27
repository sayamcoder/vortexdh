@extends('layouts.app')
@section('title', 'Transaction History')

@section('content')
<div class="animate-fade">
    
    <div class="mb-8 flex items-end justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-white tracking-tight">Transactions</h1>
            <p class="text-sm text-zinc-400 mt-1">History of resource purchases and coin activity.</p>
        </div>
        <div class="flex items-center px-4 py-2 bg-zinc-900 border border-white/5 rounded-lg">
            <span class="text-xs text-zinc-500 mr-2">Wallet Balance</span>
            <span class="text-sm font-bold text-white">{{ number_format(Auth::user()->coins) }} Coins</span>
        </div>
    </div>

    <!-- Transaction Table -->
    <div class="bg-zinc-900 border border-white/5 rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/[0.02] border-b border-white/5 text-xs font-medium text-zinc-500 uppercase tracking-wider">
                        <th class="px-6 py-4">Transaction ID</th>
                        <th class="px-6 py-4">Description</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($transactions as $txn)
                    <tr class="group hover:bg-white/[0.02] transition-colors">
                        <td class="px-6 py-4">
                            <span class="font-mono text-xs text-zinc-400">#TRX-{{ $txn->id + 10000 }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-lg bg-zinc-800 flex items-center justify-center mr-3 text-zinc-400 border border-white/5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm text-zinc-200 font-medium">{{ $txn->action }}</p>
                                    <p class="text-xs text-zinc-500">{{ Str::limit($txn->description, 30) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-zinc-400">{{ $txn->created_at->format('M d, Y') }}</p>
                            <p class="text-xs text-zinc-600">{{ $txn->created_at->format('h:i A') }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                Completed
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="text-sm font-bold text-white">- {{ preg_replace('/[^0-9]/', '', $txn->description) ?? 'N/A' }}</span>
                            <span class="text-xs text-zinc-500 ml-1">Coins</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-zinc-500 text-sm">
                            No transaction history available.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($transactions->hasPages())
        <div class="px-6 py-4 border-t border-white/5">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>
</div>
@endsection