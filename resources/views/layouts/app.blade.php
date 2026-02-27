<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - VortexDash</title>
    
    <!-- Fonts & Scripts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        /* Premium Fade In */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade { animation: fadeIn 0.5s ease-out forwards; }

        /* Sleek Scrollbar */
        .custom-scroll::-webkit-scrollbar { width: 5px; }
        .custom-scroll::-webkit-scrollbar-track { background: transparent; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #3f3f46; border-radius: 20px; }
        .custom-scroll::-webkit-scrollbar-thumb:hover { background: #52525b; }
    </style>
</head>
<body class="bg-[#09090b] text-zinc-300 antialiased overflow-hidden selection:bg-indigo-500/30 selection:text-indigo-200">

    <!-- Subtle Background Atmosphere -->
    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute top-[-20%] left-[-10%] w-[800px] h-[800px] bg-indigo-500/5 rounded-full blur-[120px]"></div>
    </div>

    <!-- Global Toast Alerts -->
    <div class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 flex flex-col items-center space-y-2 pointer-events-none">
        @if(session('success'))
            <div class="pointer-events-auto flex items-center bg-zinc-900/90 backdrop-blur-md border border-emerald-500/20 text-emerald-400 px-5 py-2.5 rounded-full shadow-xl animate-fade">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="pointer-events-auto flex items-center bg-zinc-900/90 backdrop-blur-md border border-red-500/20 text-red-400 px-5 py-2.5 rounded-full shadow-xl animate-fade">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
        @endif
    </div>

<div class="relative z-10 flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside class="w-[260px] bg-zinc-950/80 backdrop-blur-xl border-r border-white/5 hidden md:flex flex-col z-20">
            
            <!-- Logo -->
            <div class="h-16 flex items-center px-6 border-b border-white/5">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white shadow-lg shadow-indigo-500/20 group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <span class="font-bold text-lg text-white tracking-tight">Vortex<span class="text-zinc-500 font-normal">Dash</span></span>
                </a>
            </div>

            <!-- Nav Links -->
            <div class="flex-1 overflow-y-auto custom-scroll px-3 py-6 space-y-8">
                
                <!-- Section: Platform -->
                <div>
                    <p class="px-3 text-[10px] uppercase tracking-wider font-semibold text-zinc-500 mb-2">Platform</p>
                    <div class="space-y-0.5">
                        <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('dashboard') ? 'bg-white/5 text-white' : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
                            <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012-2h2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            Overview
                        </a>
                        <a href="{{ route('servers.create') }}" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('servers.create') ? 'bg-white/5 text-white' : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
                            <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Deploy Server
                        </a>
                        <a href="{{ route('leaderboard') }}" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('leaderboard') ? 'bg-white/5 text-white' : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
    <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
    Leaderboard
</a>
                    </div>
                </div>

                <!-- Section: Economy -->
                <div>
                    <p class="px-3 text-[10px] uppercase tracking-wider font-semibold text-zinc-500 mb-2">Commerce</p>
                    <div class="space-y-0.5">
                        <a href="{{ route('shop') }}" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('shop') ? 'bg-white/5 text-white' : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
                            <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            Resource Store
                        </a>
                        <a href="{{ route('billing') }}" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('billing') ? 'bg-white/5 text-white' : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
                            <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Transactions
                        </a>
                        <a href="{{ route('referrals') }}" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('referrals') ? 'bg-white/5 text-white' : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
                            <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Affiliates
                        </a>
                        <!-- Rewards Link -->
<a href="{{ route('rewards') }}" class="group relative flex items-center py-3.5 px-4 rounded-xl transition-all duration-300 overflow-hidden {{ request()->routeIs('rewards') ? 'bg-emerald-500/10 border border-emerald-500/20' : 'hover:bg-white/5 border border-transparent' }}">
    <div class="absolute left-0 top-0 h-full w-1 rounded-r-full transition-all duration-300 {{ request()->routeIs('rewards') ? 'bg-emerald-500' : 'bg-transparent group-hover:bg-gray-600' }}"></div>
    
    <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('rewards') ? 'text-emerald-400 drop-shadow-[0_0_5px_rgba(52,211,153,0.5)]' : 'text-gray-500 group-hover:text-gray-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
    
    <span class="font-bold text-sm tracking-wide transition-colors {{ request()->routeIs('rewards') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}">Reward Hub</span>
    
    <!-- Pulse indicator for daily claim -->
    <span class="ml-auto flex h-2 w-2 relative">
        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
    </span>
</a>
                    </div>
                </div>

                        <!-- Section: Developers (NEW!) -->
        <div>
            <p class="px-3 text-[10px] uppercase tracking-wider font-semibold text-zinc-500 mb-2">Developers</p>
            <div class="space-y-0.5">
                <a href="{{ route('account.api') }}" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('account.api') ? 'bg-white/5 text-white' : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    API Credentials
                </a>
                <a href="{{ route('account.activity') }}" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('account.activity') ? 'bg-white/5 text-white' : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
                    <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    Audit Logs
                </a>
            </div>
        </div>

                <!-- Section: Account -->
                <div>
                    <p class="px-3 text-[10px] uppercase tracking-wider font-semibold text-zinc-500 mb-2">Support & Settings</p>
                    <div class="space-y-0.5">
                        <a href="{{ route('account') }}" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('account') ? 'bg-white/5 text-white' : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
                            <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Account Settings
                        </a>
<!-- Support / Ticket System Link -->
<a href="{{ route('support') }}" class="group relative flex items-center py-3.5 px-4 rounded-xl transition-all duration-300 overflow-hidden {{ request()->routeIs('support*') ? 'bg-white/5 text-white' : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
    <div class="absolute left-0 top-0 h-full w-1 rounded-r-full transition-all duration-300 {{ request()->routeIs('support*') ? 'bg-indigo-500' : 'bg-transparent group-hover:bg-gray-600' }}"></div>
    
    <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
    </svg>
    <span class="font-bold text-sm tracking-wide">Help Center</span>
    
    <!-- Answered Ticket Notification Dot (Optional Logic) -->
    @php
        $answeredTickets = \App\Models\Ticket::where('user_id', Auth::id())->where('status', 'answered')->count();
    @endphp
    @if($answeredTickets > 0)
        <span class="ml-auto w-2 h-2 bg-indigo-500 rounded-full animate-pulse shadow-[0_0_8px_#6366f1]"></span>
    @endif
</a>
                    </div>
                </div>

                <!-- Section: Admin (Conditional) -->
                @if(Auth::user()->is_admin)
                <div>
                    <p class="px-3 text-[10px] uppercase tracking-wider font-semibold text-red-500 mb-2">System</p>
                    <div class="space-y-0.5">
                        <a href="{{ route('admin.index') }}" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.index') ? 'bg-red-500/10 text-red-400' : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
                            <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            Admin Control
                        </a>
                        <a href="{{ route('admin.activity') }}" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.activity') ? 'bg-red-500/10 text-red-400' : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
                            <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            Audit Logs
                        </a>
                        <a href="{{ route('admin.announcements') }}" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.announcements') ? 'bg-red-500/10 text-red-400' : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
                            <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                            Broadcasts
                        </a>
                        <a href="{{ route('admin.vouchers') }}" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.vouchers') ? 'bg-red-500/10 text-red-400' : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
                            <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                            Vouchers
                        </a>
                        <a href="{{ route('admin.nodes') }}" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.nodes') ? 'bg-red-500/10 text-red-400' : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
    <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
    Infrastructure
</a>
<a href="{{ route('admin.tickets') }}" class="flex items-center px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.tickets') ? 'bg-red-500/10 text-red-400' : 'text-zinc-400 hover:text-white hover:bg-white/5' }}">
    <svg class="w-4 h-4 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
    Help Desk
</a>
                    </div>
                </div>
                @endif

            </div>

            <!-- Profile Footer -->
            <div class="p-4 border-t border-white/5 bg-black/20">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-zinc-800 flex items-center justify-center text-zinc-400 text-sm font-semibold border border-white/5">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-zinc-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-zinc-500 hover:text-white p-2 rounded-md hover:bg-white/5 transition-colors" title="Log Out">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Area -->
        <div class="flex-1 flex flex-col z-10 overflow-hidden bg-[#09090b]">
            
            <!-- Topbar (Mobile Only mostly, + Wallet) -->
            <header class="h-16 flex items-center justify-between px-6 border-b border-white/5 bg-[#09090b]/80 backdrop-blur-md z-30">
                <div class="md:hidden text-lg font-bold text-white">VortexDash</div>
                
                <div class="ml-auto flex items-center gap-4">
                    <!-- Wallet Pill -->
                    <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-zinc-900 border border-white/5 hover:border-yellow-500/30 transition-colors">
                        <div class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></div>
                        <span class="text-xs font-medium text-zinc-300">{{ number_format(Auth::user()->coins) }} Coins</span>
                    </div>
                </div>
            </header>

            <!-- Canvas -->
            <main class="flex-1 overflow-y-auto custom-scroll p-6 lg:p-10">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
@if(Session::has('impersonate'))
    <div class="fixed bottom-6 right-6 z-[100] bg-red-600 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-4 animate-bounce border border-white/20">
        <div class="flex flex-col">
            <span class="text-[10px] font-black uppercase opacity-80">Impersonation Active</span>
            <span class="text-sm font-bold">Viewing as {{ Auth::user()->name }}</span>
        </div>
        <a href="{{ route('admin.users.stop-impersonation') }}" class="bg-black/20 hover:bg-black/40 px-3 py-1.5 rounded-lg text-xs font-black transition-all">
            RETURN TO BASE
        </a>
    </div>
@endif
</html>