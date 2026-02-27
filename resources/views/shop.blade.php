@extends('layouts.app')
@section('title', 'Resource Store')

@section('content')
<div class="animate-fade space-y-12">
    
    <!-- Header & Redeem Section -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8 bg-zinc-900/50 border border-white/5 rounded-2xl p-8 shadow-sm">
        <div class="max-w-xl">
            <h1 class="text-2xl font-semibold text-white tracking-tight">Resource Store</h1>
            <p class="text-sm text-zinc-400 mt-2 leading-relaxed">
                Exchange your V-Coins for permanent infrastructure upgrades. All resources purchased are added to your global account limits instantly.
            </p>
        </div>

        <!-- Voucher Redeem Form -->
        <div class="w-full lg:w-96">
            <p class="text-[10px] font-black text-zinc-500 uppercase tracking-widest mb-3 px-1">Redeem Gift Code</p>
            <form action="{{ route('shop.redeem') }}" method="POST" class="relative group">
                @csrf
                <div class="flex items-center gap-2 bg-zinc-950 border border-zinc-800 rounded-xl p-1.5 focus-within:border-indigo-500/50 focus-within:ring-4 focus-within:ring-indigo-500/10 transition-all">
                    <input type="text" name="code" placeholder="ENTER-CODE-HERE" 
                        class="flex-1 bg-transparent border-none text-white text-sm font-mono px-3 focus:ring-0 outline-none uppercase placeholder-zinc-700">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold py-2 px-4 rounded-lg transition-colors shadow-lg shadow-indigo-500/20">
                        REDEEM
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Resource Selection Grid -->
    <div>
        <div class="flex items-center gap-3 mb-6">
            <h2 class="text-sm font-bold text-zinc-500 uppercase tracking-[0.2em]">Available Upgrades</h2>
            <div class="h-px flex-1 bg-white/5"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            @foreach($items as $item)
                @php
                    // Dynamic styling based on item type
                    $config = match($item->type) {
                        'ram' => [
                            'color' => 'indigo',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>'
                        ],
                        'cpu' => [
                            'color' => 'blue',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>'
                        ],
                        'disk' => [
                            'color' => 'emerald',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>'
                        ],
                        'slot' => [
                            'color' => 'amber',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>'
                        ],
                        default => [
                            'color' => 'zinc',
                            'icon' => '<path d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z"></path>'
                        ],
                    };
                @endphp

                <div class="bg-zinc-900 border border-white/5 rounded-2xl p-6 flex flex-col justify-between transition-all duration-300 hover:-translate-y-1 hover:border-{{ $config['color'] }}-500/30 group shadow-sm">
                    
                    <div>
                        <!-- Icon -->
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-6 text-{{ $config['color'] }}-400 bg-{{ $config['color'] }}-500/10 border border-{{ $config['color'] }}-500/20 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $config['icon'] !!}
                            </svg>
                        </div>
                        
                        <h3 class="text-lg font-semibold text-white mb-1">{{ $item->name }}</h3>
                        <p class="text-sm text-zinc-500 mb-8 leading-relaxed">Increase your account's global hardware allocation immediately.</p>
                    </div>

                    <!-- Purchase Button -->
                    <form action="{{ route('shop.buy') }}" method="POST" class="mt-auto">
                        @csrf 
                        <input type="hidden" name="item" value="{{ $item->type }}">
                        
                        <button type="submit" class="w-full flex items-center justify-between px-4 py-3 bg-zinc-950 border border-zinc-800 hover:bg-zinc-800 hover:border-zinc-700 rounded-xl transition-all group/btn">
                            <span class="text-xs font-bold text-zinc-400 group-hover/btn:text-white uppercase tracking-widest transition-colors">Purchase</span>
                            <div class="flex items-center text-amber-500 font-bold text-sm bg-amber-500/5 px-2 py-1 rounded-lg border border-amber-500/10">
                                {{ number_format($item->cost) }}
                                <svg class="w-3.5 h-3.5 ml-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.736 6.979C9.208 6.193 9.696 6 10 6c.304 0 .792.193 1.264.979a1 1 0 001.715-1.029C12.279 4.784 11.232 4 10 4s-2.279.784-2.979 1.95c-.285.475-.507 1-.67 1.55H6a1 1 0 000 2h.013a9.358 9.358 0 000 1H6a1 1 0 100 2h.343c.163.55.385 1.075.67 1.55C7.721 15.216 8.768 16 10 16s2.279-.784 2.979-1.95a1 1 0 10-1.715-1.029c-.472.786-.96.979-1.264.979-.304 0-.792-.193-1.264-.979a4.265 4.265 0 01-.264-.421H10a1 1 0 100-2H8.017a7.36 7.36 0 010-1H10a1 1 0 100-2H8.472c.08-.154.167-.3.264-.421z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Store Footer Note -->
    <div class="text-center py-10">
        <p class="text-xs text-zinc-600 font-medium uppercase tracking-[0.3em]">All transactions are final • Managed by VortexDash Core</p>
    </div>

</div>
@endsection