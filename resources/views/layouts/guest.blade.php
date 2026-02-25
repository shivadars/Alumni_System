<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Connectwork - Alumni Interaction System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans text-gray-900 bg-white" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
        <div class="relative min-h-screen">
            
            <!-- Sticky Header -->
            <header 
                class="fixed top-0 left-0 w-full z-50 transition-all duration-500 ease-in-out px-8 flex justify-between items-center border-b border-gray-100 shadow-sm"
                :class="scrolled ? 'h-[80px] bg-white' : 'h-[100px] bg-white'"
                style="height: 100px;"
                :style="scrolled ? 'height: 80px !important' : 'height: 100px !important'"
            >
                <div class="flex items-center gap-2">
                    <!-- Geometric Logo Icon -->
                    <svg class="w-10 h-10 text-black transition-transform duration-500" :class="scrolled ? 'scale-90' : 'scale-100'" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="10" cy="20" r="2" fill="currentColor"/>
                        <circle cx="20" cy="10" r="2" fill="currentColor"/>
                        <circle cx="20" cy="30" r="2" fill="currentColor"/>
                        <circle cx="30" cy="20" r="2" fill="currentColor"/>
                        <path d="M10 20L20 10L30 20L20 30L10 20Z" stroke="currentColor" stroke-width="1.5"/>
                        <path d="M20 10L20 30" stroke="currentColor" stroke-width="1.5"/>
                    </svg>
                    <span class="text-2xl font-medium tracking-tight">Connectwork</span>
                </div>
                
                <div class="flex items-center gap-12">
                    <nav class="hidden md:flex gap-12 text-[15px] font-normal">
                        <a href="/" class="text-[#3898EC] font-medium transition-colors">Home</a>
                        <a href="/#about" class="text-black hover:text-[#3898EC] transition-colors">About</a>
                    </nav>

                    <!-- Mobile Menu Button -->
                    <button class="md:hidden p-2 text-black">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </header>

            <!-- Main Full-Screen Container -->
            <main class="relative h-screen flex flex-col overflow-hidden" style="height: 100vh !important; min-height: 100vh !important;">
                <!-- Background Image -->
                <div class="absolute inset-0 z-0 overflow-hidden">
                    <img src="{{ asset('images/hero-bg.png') }}" alt="Background" class="w-full h-full object-cover object-top opacity-90 scale-100">
                    <!-- Improved Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-r from-white/95 via-white/50 to-transparent"></div>
                </div>

                <!-- Header Spacer (pushes content below the fixed header) -->
                <div class="w-full shrink-0" style="height: 120px !important;" aria-hidden="true"></div>

                <!-- Auth Card Content -->
                <div class="relative z-10 flex-grow flex items-start justify-center px-4" style="padding-top: 80px !important;">
                    <div class="relative z-10 w-full sm:max-w-md px-6 py-4 bg-white/90 backdrop-blur-sm shadow-md overflow-hidden sm:rounded-lg">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
