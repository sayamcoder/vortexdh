@extends('servers.layout')
@section('panel_content')
<div class="flex-1 flex flex-col h-full overflow-hidden">
    <!-- Editor Header -->
    <div class="bg-zinc-900 border-b border-white/5 px-4 py-3 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ route('servers.files', $server->id) }}" class="text-zinc-500 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <span class="text-sm font-mono text-indigo-400">{{ $file }}</span>
        </div>
        <div class="flex items-center gap-2">
            <button onclick="document.getElementById('saveForm').submit()" class="px-4 py-1.5 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-lg transition-colors flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                Save Content
            </button>
        </div>
    </div>

    <!-- Simple Textarea Editor (Replace with Ace/Monaco for advanced) -->
    <form id="saveForm" action="{{ route('servers.files.save', $server->id) }}" method="POST" class="flex-1 flex flex-col">
        @csrf
        <input type="hidden" name="file" value="{{ $file }}">
        <textarea name="content" class="flex-1 w-full bg-[#09090b] text-zinc-300 font-mono text-sm p-4 border-none focus:ring-0 resize-none outline-none leading-relaxed custom-scrollbar" spellcheck="false">{{ $content }}</textarea>
    </form>
</div>
@endsection