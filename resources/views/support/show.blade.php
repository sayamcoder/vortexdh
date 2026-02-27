@extends('layouts.app')
@section('title', '#' . $ticket->id)

@section('content')
<div class="max-w-4xl mx-auto animate-fade">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-xl font-bold text-white">{{ $ticket->subject }}</h1>
            <p class="text-sm text-zinc-400">Ticket #{{ $ticket->id }} • Priority: {{ ucfirst($ticket->priority) }}</p>
        </div>
        <span class="px-3 py-1 rounded-lg text-xs font-bold uppercase border 
            {{ $ticket->status == 'open' ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : ($ticket->status == 'closed' ? 'bg-zinc-800 text-zinc-400 border-zinc-700' : 'bg-amber-500/10 text-amber-400 border-amber-500/20') }}">
            {{ $ticket->status }}
        </span>
    </div>

    <div class="space-y-6 mb-8">
        @foreach($ticket->messages as $msg)
        <div class="flex gap-4 {{ $msg->user_id === Auth::id() ? 'flex-row-reverse' : '' }}">
            <div class="w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center text-sm font-bold border border-white/5
                {{ $msg->user->is_admin ? 'bg-red-500/10 text-red-500' : 'bg-zinc-800 text-zinc-400' }}">
                {{ substr($msg->user->name, 0, 1) }}
            </div>
            <div class="max-w-2xl p-4 rounded-2xl border 
                {{ $msg->user_id === Auth::id() ? 'bg-indigo-600/10 border-indigo-500/20 text-indigo-100' : ($msg->user->is_admin ? 'bg-red-500/5 border-red-500/10 text-zinc-300' : 'bg-zinc-900 border-white/5 text-zinc-300') }}">
                <div class="flex justify-between items-center mb-2 gap-4">
                    <span class="text-xs font-bold {{ $msg->user->is_admin ? 'text-red-400' : 'text-zinc-400' }}">{{ $msg->user->name }} {{ $msg->user->is_admin ? '(Staff)' : '' }}</span>
                    <span class="text-[10px] text-zinc-600">{{ $msg->created_at->format('M d, H:i') }}</span>
                </div>
                <p class="text-sm leading-relaxed whitespace-pre-wrap">{{ $msg->message }}</p>
            </div>
        </div>
        @endforeach
    </div>

    @if($ticket->status !== 'closed')
    <form action="{{ route('support.reply', $ticket->id) }}" method="POST" class="bg-zinc-900 border border-white/5 rounded-xl p-4">
        @csrf
        <textarea name="message" rows="3" class="w-full bg-zinc-950 border border-zinc-800 rounded-lg p-3 text-white focus:border-indigo-500 mb-3" placeholder="Type your reply..."></textarea>
        <button type="submit" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold rounded-lg transition-colors">Send Reply</button>
    </form>
    @else
    <div class="text-center p-4 bg-zinc-900/50 rounded-xl border border-white/5 text-zinc-500 text-sm">
        This ticket is closed. Please open a new one for further assistance.
    </div>
    @endif
</div>
@endsection