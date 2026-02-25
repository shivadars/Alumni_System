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
                <!-- Background Image with Dark Overlay -->
                <div class="absolute inset-0 z-0 overflow-hidden">
                    <img src="{{ asset('images/hero-bg.png') }}" alt="Background" class="w-full h-full object-cover">
                    <!-- 1️⃣ Dark Overlay -->
                    <div class="absolute inset-0 bg-black/40"></div>
                </div>

                <!-- 6️⃣ Center the Login Card Perfectly -->
                <div class="login-container relative z-10 w-full flex justify-center items-center px-4 py-12">
                    <!-- 7️⃣ Add Glass Effect Card Layer -->
                    <div class="login-card w-full sm:max-w-md backdrop-blur-md bg-white/90 rounded-[15px] shadow-[0_10px_30px_rgba(0,0,0,0.15)] overflow-hidden">
                        <div class="p-10">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
