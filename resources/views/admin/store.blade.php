@extends('layouts.app')
@section('title', 'Economy Control')

@section('content')
<div class="animate-fade-in-up">
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h2 class="text-2xl font-extrabold text-white tracking-tight">Economy Control</h2>
            <p class="text-gray-400 mt-1 font-medium">Adjust resource pricing and allocation packages.</p>
        </div>
        <a href="{{ route('admin.index') }}" class="px-4 py-2 bg-gray-900 border border-gray-700 text-gray-300 hover:text-white rounded-lg text-sm font-bold transition-colors">
            &larr; Back
        </a>
    </div>

    <form action="{{ route('admin.store.update') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            @foreach($items as $item)
            <div class="bg-vortex-card border border-gray-800 rounded-2xl p-6 relative group hover:border-vortex-purple/50 transition-all">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 rounded bg-gray-900 flex items-center justify-center mr-3 text-{{ $item->icon_color }}">
                        <!-- Simple conditional icon -->
                        @if($item->type == 'ram') <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                        @elseif($item->type == 'cpu') <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        @else <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-white font-bold">{{ $item->name }}</h3>
                        <p class="text-xs text-gray-500 uppercase">{{ $item->type }} Package</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Price (Coins)</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-yellow-500 font-bold">$</span>
                            <input type="number" name="items[{{ $item->id }}][cost]" value="{{ $item->cost }}" class="w-full bg-gray-900 border border-gray-700 rounded-lg py-2 pl-6 text-white font-bold focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition-colors">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Amount Given</label>
                        <input type="number" name="items[{{ $item->id }}][amount]" value="{{ $item->amount }}" class="w-full bg-gray-900 border border-gray-700 rounded-lg py-2 px-3 text-white font-bold focus:border-vortex-purple focus:ring-1 focus:ring-vortex-purple transition-colors">
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-vortex-purple to-indigo-600 hover:from-vortex-purple-hover hover:to-indigo-500 text-white font-black tracking-widest rounded-xl shadow-lg transition-all hover:scale-105">
                UPDATE PRICING MATRIX
            </button>
        </div>
    </form>
</div>
@endsection