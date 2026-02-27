@extends('layouts.app')
@section('title', 'Manage Ticket #' . $ticket->id)

@section('content')
<div class="max-w-4xl mx-auto animate-fade">
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('admin.tickets') }}" class="text-zinc-500 hover:text-white text-sm">&larr; Back to List</a>
        @if($ticket->status !== 'closed')
            <form action="{{ route('admin.tickets.close', $ticket->id) }}" method="POST">
                @csrf
                <button class="px-4 py-2 bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/20 rounded-lg text-xs font-bold transition-colors">Close Ticket</button>
            </form>
        @endif
    </div>

    <!-- Use same message loop as user view, but flipped logic for colors if you want -->
    <div class="space-y-6 mb-8">
        @foreach($ticket->messages as $msg)
        <div class="flex gap-4 {{ $msg->user->is_admin ? 'flex-row-reverse' : '' }}">
            <div class="w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center text-sm font-bold border border-white/5
                {{ $msg->user->is_admin ? 'bg-red-500/10 text-red-500' : 'bg-zinc-800 text-zinc-400' }}">
                {{ substr($msg->user->name, 0, 1) }}
            </div>
            <div class="max-w-2xl p-4 rounded-2xl border 
                {{ $msg->user->is_admin ? 'bg-red-500/5 border-red-500/10 text-zinc-300' : 'bg-zinc-900 border-white/5 text-zinc-300' }}">
                <div class="flex justify-between items-center mb-2 gap-4">
                    <span class="text-xs font-bold {{ $msg->user->is_admin ? 'text-red-400' : 'text-zinc-400' }}">{{ $msg->user->name }}</span>
                    <span class="text-[10px] text-zinc-600">{{ $msg->created_at->format('M d, H:i') }}</span>
                </div>
                <p class="text-sm leading-relaxed">{{ $msg->message }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Admin Reply Form -->
    <form action="{{ route('admin.tickets.reply', $ticket->id) }}" method="POST" class="bg-zinc-900 border border-white/5 rounded-xl p-4 border-l-4 border-l-red-500">
        @csrf
        <div class="flex justify-between mb-2"><span class="text-xs font-bold text-red-400 uppercase">Staff Reply</span></div>
        <textarea name="message" rows="3" class="w-full bg-zinc-950 border border-zinc-800 rounded-lg p-3 text-white focus:border-red-500 mb-3" placeholder="Reply to user..."></textarea>
        <button type="submit" class="px-6 py-2 bg-red-600 hover:bg-red-500 text-white text-sm font-bold rounded-lg transition-colors">Send Reply</button>
    </form>
</div>
@endsection