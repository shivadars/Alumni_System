<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>alumni-system</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('images/tab.png') }}">
        <style>
            html { font-size: 87.5%; }
        </style>
    </head>
    <body class="antialiased font-sans text-gray-900 bg-[#F3F2EF] !important">
        <div class="relative min-h-screen">
            
            <!-- Header (Optional for Guest) -->
            <header class="fixed top-0 left-0 w-full z-50 px-8 h-[80px] flex justify-between items-center">
                <div class="flex items-center">
                    <a href="/">
                        <img src="{{ asset('images/logo.png') }}" alt="Connectwork Logo" class="h-12 w-auto brightness-0 invert">
                    </a>
                </div>
                <nav class="hidden md:flex gap-8 text-[15px] font-medium">
                    <a href="/" class="text-white/70 hover:text-white transition-colors">Home</a>
                    <a href="/#about" class="text-white/70 hover:text-white transition-colors">About</a>
                </nav>
            </header>

            <!-- Main Auth Container -->
            <main class="hero-login relative min-h-screen flex items-center justify-center overflow-hidden">
                <!-- Background Image with Overlay -->
                <div class="absolute inset-0 z-0 overflow-hidden">
                    <img src="{{ asset('images/hero-bg.png') }}" alt="Background" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-slate-900/40"></div>
                </div>

                <!-- Centered Login Card Container -->
                <div class="login-container relative z-10 w-full flex justify-center items-center px-4 py-12">
                    <!-- Standard Professional Squared Card - Wider with Inline Style for reliability -->
                    <div class="login-card bg-white rounded-lg shadow-2xl border border-gray-200 overflow-hidden" style="width: 550px; max-width: 100%;">
                        <div class="p-8 md:p-14">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
