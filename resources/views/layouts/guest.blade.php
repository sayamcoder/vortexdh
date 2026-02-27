<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - VortexDash</title>
    
    <!-- Fonts & Scripts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }

        /* Smooth subtle drift for background light */
        @keyframes drift {
            0% { transform: translate(0, 0); }
            50% { transform: translate(30px, 20px); }
            100% { transform: translate(0, 0); }
        }
        .animate-drift { animation: drift 20s infinite ease-in-out; }

        /* Professional page entry transition */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade { animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }

        /* Minimalist Grid Pattern Overlay */
        .bg-grid {
            background-image: radial-gradient(circle, #27272a 1px, transparent 1px);
            background-size: 30px 30px;
        }
    </style>
</head>
<body class="bg-[#09090b] text-zinc-400 relative min-h-screen overflow-hidden selection:bg-indigo-500/30 selection:text-indigo-200">
    
    <!-- Deep Ambient Atmosphere -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <!-- Subtle Top Right Glow -->
        <div class="absolute top-[-10%] right-[-5%] w-[600px] h-[600px] bg-indigo-600/10 rounded-full blur-[120px] animate-drift"></div>
        
        <!-- Subtle Bottom Left Glow -->
        <div class="absolute bottom-[-10%] left-[-10%] w-[500px] h-[500px] bg-indigo-900/10 rounded-full blur-[120px] animate-drift" style="animation-delay: -5s;"></div>
        
        <!-- Minimalist Grid Pattern -->
        <div class="absolute inset-0 bg-grid opacity-[0.15]"></div>
        
        <!-- Soft Radial Mask (Center is darker for focus) -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,transparent_0%,#09090b_80%)]"></div>
    </div>

    <!-- Content Wrapper -->
    <div class="relative z-10 flex flex-col justify-center items-center min-h-screen p-6 animate-fade">
        
        <!-- Guest Content (Login/Register Card) -->
        @yield('content')

        <!-- Footer Links (Optional) -->
        <footer class="mt-12 text-zinc-600 text-[11px] font-medium tracking-widest uppercase">
            &copy; {{ date('Y') }} VortexDash Infrastructure &bull; Secure Access
        </footer>
    </div>

</body>
</html>