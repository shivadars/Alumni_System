<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connectwork - Alumni Interaction System</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

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
                    <a href="#" class="text-[#3898EC] font-medium transition-colors">Home</a>
                    <a href="#about" class="text-black hover:text-[#3898EC] transition-colors">About</a>
                </nav>

                <!-- Mobile Menu Button -->
                <button class="md:hidden p-2 text-black">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </header>

        <!-- Hero Section -->
        <main class="relative h-screen flex flex-col overflow-hidden" style="height: 100vh !important; min-height: 100vh !important;">
            <!-- Background Image -->
            <div class="absolute inset-0 z-0 overflow-hidden">
                <img src="{{ asset('images/hero-bg.png') }}" alt="Background" class="w-full h-full object-cover object-top opacity-90">
                <div class="absolute inset-0 bg-gradient-to-r from-white/95 via-white/40 to-transparent"></div>
            </div>

            <!-- Header Spacer (pushes content below the fixed header) -->
            <div class="w-full shrink-0" style="height: 120px !important;" aria-hidden="true"></div>

            <!-- Hero Content -->
            <div class="relative z-10 flex-grow flex items-center px-8 md:px-24 lg:px-32">
                <div class="max-w-2xl">
                    <h1 class="font-serif text-5xl md:text-7xl leading-tight text-gray-900 mb-10">
                        Connecting Talent <br> with Opportunity
                    </h1>
                    
                    <a href="{{ route('login') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white w-[416px] py-4 text-center text-sm font-semibold tracking-widest uppercase transition-colors duration-300">
                        Log in
                    </a>
                </div>
            </div>
        </main>

        <!-- About Us Section -->
        <section id="about" class="relative z-10 bg-white pt-64 pb-32 px-8 md:px-24 lg:px-32 border-t border-gray-100" style="position: relative; z-index: 10; background-color: white;">
            <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-16 items-start">
                <div class="flex-1">
                    <h2 class="font-serif text-4xl md:text-5xl text-gray-900 mb-8">
                        Our Mission
                    </h2>
                    <div class="w-20 h-1 bg-blue-500 mb-8"></div>
                    <p class="text-xl text-gray-700 leading-relaxed mb-6 italic">
                        "Empowering the next generation through meaningful connection."
                    </p>
                </div>
                <div class="flex-[1.5] text-lg text-gray-600 leading-relaxed">
                    <p class="mb-6">
                        Connectwork started with a simple belief: the journey from student to professional shouldn't be walked alone. Our platform serves as a bridge between the wisdom of alumni and the ambition of current students.
                    </p>
                    <p class="mb-6">
                        We provide a space where mentorship flourishes, opportunities are shared, and lifelong professional networks are built. Whether you're an alumnus looking to give back or a student seeking guidance, Connectwork is your home for growth.
                    </p>
                    <div class="grid grid-cols-2 gap-8 mt-12 pb-2">
                        <div>
                            <span class="block text-3xl font-serif text-gray-900">500+</span>
                            <span class="text-sm uppercase tracking-widest text-gray-500 font-medium">Mentors</span>
                        </div>
                        <div>
                            <span class="block text-3xl font-serif text-gray-900">2.5k+</span>
                            <span class="text-sm uppercase tracking-widest text-gray-500 font-medium">Members</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Simple Footer -->
        <footer class="bg-[#F8FAFC] py-12 px-8 text-center text-sm text-gray-500 border-t border-blue-50/50">
            <p>&copy; {{ date('Y') }} Connectwork. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
