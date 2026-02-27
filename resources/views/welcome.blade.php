<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VortexDash &mdash; High-Performance Cloud Infrastructure</title>
    
    <!-- Fonts & Scripts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
        
        /* Subtle Drift for Atmosphere */
        @keyframes drift {
            0% { transform: translate(0, 0); }
            50% { transform: translate(60px, 40px); }
            100% { transform: translate(0, 0); }
        }
        .animate-drift { animation: drift 25s infinite ease-in-out alternate; }

        /* Staggered Entrance Animations */
        @keyframes revealUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .reveal { opacity: 0; animation: revealUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }

        /* SaaS Grid Overlay */
        .bg-grid {
            background-image: radial-gradient(circle, #27272a 1px, transparent 1px);
            background-size: 40px 40px;
        }
    </style>
</head>
<body class="bg-[#050505] text-zinc-400 relative overflow-x-hidden selection:bg-indigo-500/30 selection:text-indigo-200">

    <!-- Global Navigation -->
    <nav class="fixed top-0 w-full z-[100] bg-[#050505]/80 backdrop-blur-xl border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 h-16 flex justify-between items-center">
            <a href="/" class="flex items-center gap-2.5 group">
                <div class="w-7 h-7 rounded-lg bg-indigo-600 flex items-center justify-center text-white shadow-lg shadow-indigo-500/20 group-hover:scale-105 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <span class="font-bold text-lg text-white tracking-tighter">Vortex<span class="text-zinc-500 font-normal">Dash</span></span>
            </a>

            <div class="hidden md:flex items-center space-x-8">
                <a href="#features" class="text-xs font-bold uppercase tracking-widest text-zinc-500 hover:text-white transition-colors">Features</a>
                <a href="#hardware" class="text-xs font-bold uppercase tracking-widest text-zinc-500 hover:text-white transition-colors">Infrastructure</a>
                <a href="https://discord.gg/invite" class="text-xs font-bold uppercase tracking-widest text-zinc-500 hover:text-white transition-colors">Discord</a>
                
                <div class="h-4 w-px bg-white/10"></div>
                
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-xs font-bold uppercase tracking-widest text-white hover:text-indigo-400 transition-colors">Console &rarr;</a>
                @else
                    <a href="{{ route('login') }}" class="text-xs font-bold uppercase tracking-widest text-zinc-400 hover:text-white transition-colors">Sign in</a>
                    <a href="{{ route('register') }}" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-black uppercase tracking-widest rounded-lg transition-all active:scale-95 shadow-lg shadow-indigo-600/20">
                        Launch World
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="relative min-h-screen flex items-center justify-center pt-20 overflow-hidden">
        
        <!-- Background Architecture -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute inset-0 bg-grid opacity-[0.15]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,transparent_0%,#050505_90%)]"></div>
            
            <div class="absolute top-0 right-[10%] w-[800px] h-[800px] bg-indigo-600/10 rounded-full blur-[140px] animate-drift"></div>
            <div class="absolute bottom-[-10%] left-[5%] w-[700px] h-[700px] bg-blue-600/10 rounded-full blur-[140px] animate-drift" style="animation-delay: -5s;"></div>
        </div>

        <div class="relative z-10 text-center max-w-6xl px-6">
            
            <!-- Trust Badge -->
            <div class="reveal inline-flex items-center px-4 py-1.5 mb-10 rounded-full bg-zinc-900 border border-white/5 backdrop-blur-md shadow-2xl">
                <span class="text-indigo-400 font-black text-[9px] uppercase tracking-[0.3em]">Protocol v2.4.0 &mdash; Stable</span>
            </div>
            
            <h1 class="reveal delay-1 text-6xl md:text-8xl lg:text-9xl font-black text-white tracking-tighter leading-none mb-10">
                Performance <br />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-blue-500 to-emerald-400">Without Limits.</span>
            </h1>
            
            <p class="reveal delay-2 text-lg md:text-xl text-zinc-400 mb-12 max-w-2xl mx-auto leading-relaxed font-medium">
                VortexDash provides the foundational infrastructure for the next generation of server owners. Deploy in seconds, scale in real-time.
            </p>
            
            <div class="reveal delay-3 flex flex-col sm:flex-row justify-center items-center gap-5">
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 py-5 bg-white hover:bg-zinc-200 text-black font-black uppercase tracking-widest text-[11px] rounded-2xl transition-all shadow-[0_20px_40px_rgba(255,255,255,0.1)] hover:-translate-y-1 active:scale-95">
                    Start Your Instance
                </a>
                <a href="#features" class="w-full sm:w-auto px-10 py-5 bg-zinc-900/50 hover:bg-zinc-800 border border-white/5 text-white font-black uppercase tracking-widest text-[11px] rounded-2xl transition-all">
                    Explore Matrix
                </a>
            </div>
            
            <!-- TECH STACK TRUST BAR -->
            <div class="reveal delay-3 mt-24 opacity-30 group grayscale hover:grayscale-0 transition-all duration-700">
                <p class="text-[10px] font-black uppercase tracking-[0.4em] mb-8 text-zinc-600">Enterprise Tech Stack</p>
                <div class="flex flex-wrap justify-center gap-12 md:gap-20">
                    <span class="text-2xl font-black text-white tracking-tighter">PTERODACTYL</span>
                    <span class="text-2xl font-black text-white tracking-tighter">NGINX</span>
                    <span class="text-2xl font-black text-white tracking-tighter">REDIS</span>
                    <span class="text-2xl font-black text-white tracking-tighter">MARIADB</span>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURE GRID: Bento Box Style -->
    <section id="features" class="py-32 relative z-10 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Large Feature -->
                <div class="lg:col-span-2 bg-zinc-900/40 border border-white/5 p-10 rounded-[2.5rem] relative overflow-hidden group">
                    <div class="relative z-10">
                        <h3 class="text-2xl font-bold text-white mb-4">Zero-Touch Provisioning</h3>
                        <p class="text-zinc-400 max-w-md leading-relaxed text-sm">Our deployment engine interfaces directly with the Pterodactyl protocol to initialize isolated containers on the nearest available compute node in under 30 seconds.</p>
                    </div>
                    <!-- Mini Terminal Visual -->
                    <div class="mt-10 bg-black border border-white/10 rounded-xl p-4 font-mono text-[10px] shadow-2xl opacity-60 group-hover:opacity-100 transition-opacity">
                        <p class="text-emerald-400">➜ system: <span class="text-white">vortex --init srv_01</span></p>
                        <p class="text-zinc-600">[info] establishing secure socket...</p>
                        <p class="text-zinc-600">[info] mounting nvme volumes...</p>
                        <p class="text-indigo-400 font-bold">[done] instance online: 142.92.12.5:25565</p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="bg-zinc-900/40 border border-white/5 p-10 rounded-[2.5rem] group hover:border-emerald-500/30 transition-all">
                    <div class="w-12 h-12 bg-emerald-500/10 rounded-2xl flex items-center justify-center text-emerald-500 mb-6 border border-emerald-500/20 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Network Shield</h3>
                    <p class="text-sm text-zinc-500 leading-relaxed">Always-on L7 mitigation protocols that automatically neutralize malicious packets before they reach your CPU threads.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-zinc-900/40 border border-white/5 p-10 rounded-[2.5rem] group hover:border-indigo-500/30 transition-all">
                    <div class="w-12 h-12 bg-indigo-500/10 rounded-2xl flex items-center justify-center text-indigo-500 mb-6 border border-indigo-500/20 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Raw Performance</h3>
                    <p class="text-sm text-zinc-500 leading-relaxed">We don't oversell. Your allocated RAM and CPU cycles are dedicated to your process, ensuring consistent tick rates.</p>
                </div>

                <!-- Feature 4 (Large) -->
                <div class="lg:col-span-2 bg-gradient-to-br from-indigo-900/20 to-zinc-900/40 border border-white/5 p-10 rounded-[2.5rem] flex flex-col justify-center">
                    <h3 class="text-2xl font-bold text-white mb-4">Unified Control Matrix</h3>
                    <p class="text-zinc-400 max-w-xl leading-relaxed text-sm">Experience our custom dashboard designed for efficiency. Manage files via in-built editor, monitor live telemetry graphs, and automate tasks through our schedule protocol without ever leaving the dash.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- INFRASTRUCTURE SECTION -->
    <section id="hardware" class="py-32 bg-black/40 border-y border-white/5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-20 items-center">
                <div class="flex-1">
                    <span class="text-[10px] font-black text-indigo-500 uppercase tracking-[0.4em] mb-4 block">Hardware Tier</span>
                    <h2 class="text-4xl md:text-5xl font-black text-white tracking-tight mb-8">Built on the <br /> AMD EPYC Matrix.</h2>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="mt-1 w-5 h-5 rounded-full bg-indigo-600/20 flex items-center justify-center text-indigo-400">✔</div>
                            <div>
                                <h4 class="text-white font-bold text-sm">AMD EPYC™ 7003 Processors</h4>
                                <p class="text-xs text-zinc-500 mt-1 uppercase font-mono tracking-widest">3.5GHz Boost • High IPC Architecture</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="mt-1 w-5 h-5 rounded-full bg-indigo-600/20 flex items-center justify-center text-indigo-400">✔</div>
                            <div>
                                <h4 class="text-white font-bold text-sm">DDR4 ECC Memory</h4>
                                <p class="text-xs text-zinc-500 mt-1 uppercase font-mono tracking-widest">Error Correcting • Stable Performance</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="mt-1 w-5 h-5 rounded-full bg-indigo-600/20 flex items-center justify-center text-indigo-400">✔</div>
                            <div>
                                <h4 class="text-white font-bold text-sm">NVMe Gen4 Storage</h4>
                                <p class="text-xs text-zinc-500 mt-1 uppercase font-mono tracking-widest">7,000MB/s Read • Instant Load Times</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Abstract Server Visual -->
                <div class="flex-1 w-full max-w-md">
                    <div class="relative bg-zinc-900 border border-white/10 rounded-3xl p-8 shadow-2xl rotate-2 hover:rotate-0 transition-transform duration-700">
                        <div class="flex justify-between items-center mb-10">
                            <div class="flex gap-2">
                                <div class="w-3 h-3 rounded-full bg-red-500/50"></div>
                                <div class="w-3 h-3 rounded-full bg-amber-500/50"></div>
                                <div class="w-3 h-3 rounded-full bg-emerald-500/50"></div>
                            </div>
                            <span class="text-[10px] font-mono text-zinc-600">NODE_01_PROVISIONING</span>
                        </div>
                        <div class="space-y-4">
                            <div class="h-1 w-full bg-zinc-800 rounded-full overflow-hidden">
                                <div class="h-full bg-indigo-500 w-[85%]"></div>
                            </div>
                            <div class="h-1 w-3/4 bg-zinc-800 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-500 w-[60%]"></div>
                            </div>
                            <div class="h-1 w-5/6 bg-zinc-800 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-500 w-[95%]"></div>
                            </div>
                        </div>
                        <div class="mt-10 flex justify-center">
                            <div class="w-20 h-20 border-4 border-indigo-500/20 border-t-indigo-500 rounded-full animate-spin"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FINAL CTA -->
    <section class="py-32 relative overflow-hidden text-center">
        <div class="absolute inset-0 bg-indigo-600/[0.03]"></div>
        <div class="relative z-10 max-w-4xl mx-auto px-6">
            <h2 class="text-4xl md:text-6xl font-black text-white tracking-tighter mb-8 italic uppercase">Zero Downtime. <br /> Zero Latency.</h2>
            <p class="text-zinc-400 mb-12 text-lg">Join thousands of world builders who trust our infrastructure.</p>
            <a href="{{ route('register') }}" class="inline-block px-12 py-5 bg-white hover:bg-zinc-200 text-black font-black uppercase tracking-[0.2em] text-xs rounded-2xl transition-all shadow-2xl active:scale-95">
                Initialize Your Network
            </a>
        </div>
    </section>

    <!-- Minimalist Footer -->
    <footer class="py-16 border-t border-white/5 bg-[#050505] relative z-10">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                <span class="font-bold text-white tracking-tighter uppercase text-sm italic">VortexDash <span class="text-zinc-700 font-normal">Cloud</span></span>
            </div>
            <p class="text-[10px] font-bold text-zinc-600 uppercase tracking-widest">
                &copy; {{ date('Y') }} VortexDash Global Infrastructure. All protocols secured.
            </p>
            <div class="flex gap-8 text-[10px] font-black uppercase tracking-widest text-zinc-500">
                <a href="#" class="hover:text-white transition-colors">Privacy</a>
                <a href="#" class="hover:text-white transition-colors">Terms</a>
                <a href="#" class="hover:text-white transition-colors">Discord</a>
            </div>
        </div>
    </footer>

</body>
</html>