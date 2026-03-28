<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connectwork — Alumni Networking Redefined</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@400;600;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/tab.png') }}">
</head>
<body class="antialiased landing-body">
    
    <!-- Premium Floating Navbar -->
    <header 
        x-data="{ scrolled: false, mobileMenuOpen: false }" 
        @scroll.window="scrolled = (window.pageYOffset > 20)"
        class="fixed top-0 left-0 right-0 z-[1000] w-full flex justify-center px-4 transition-all duration-500 ease-in-out"
        :class="scrolled ? 'pt-4' : 'pt-6'"
    >
        <div 
            class="flex items-center justify-between px-6 py-3 w-full max-w-5xl rounded-full border transition-all duration-500"
            :class="scrolled ? 'bg-white/90 backdrop-blur-xl border-gray-200 shadow-[0_8px_30px_rgb(0,0,0,0.08)]' : 'bg-transparent border-transparent'"
        >
            <!-- Logo -->
            <a href="/" class="flex items-center gap-2 relative z-20 group">
                <img src="{{ asset('images/logo.png') }}" alt="Connectwork Logo" class="h-8 transition-transform duration-300 group-hover:scale-105">
            </a>

            <!-- Desktop Nav -->
            <div class="relative hidden md:block">
                <!-- Nav shown when scrolled -->
                <nav class="flex items-center gap-1 mx-auto border border-gray-200/50 bg-white/50 backdrop-blur-sm rounded-full p-1 shadow-sm absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-max" 
                     x-show="scrolled" x-transition.opacity.duration.300ms style="display: none;">
                    <a href="#features" class="px-5 py-2 rounded-full text-sm font-semibold text-gray-700 hover:text-blue-600 hover:bg-blue-50/80 transition-all">Features</a>
                    <a href="#testimonials" class="px-5 py-2 rounded-full text-sm font-semibold text-gray-700 hover:text-blue-600 hover:bg-blue-50/80 transition-all">Testimonials</a>
                    <a href="#footer" class="px-5 py-2 rounded-full text-sm font-semibold text-gray-700 hover:text-blue-600 hover:bg-blue-50/80 transition-all">Network</a>
                </nav>

                <!-- Nav shown at top -->
                <nav class="flex items-center gap-8 mx-auto" 
                     x-show="!scrolled" x-transition.opacity.duration.300ms>
                    <a href="#features" class="text-sm font-semibold text-gray-900 hover:opacity-70 transition-opacity">Features</a>
                    <a href="#testimonials" class="text-sm font-semibold text-gray-900 hover:opacity-70 transition-opacity">Testimonials</a>
                    <a href="#footer" class="text-sm font-semibold text-gray-900 hover:opacity-70 transition-opacity">Network</a>
                </nav>
            </div>

            <!-- Actions -->
            <div class="hidden md:flex items-center gap-4 relative z-20">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 hover:text-gray-900 transition-colors">Log in</a>
                <a href="{{ route('register') }}" class="px-5 py-2.5 bg-gray-900 hover:bg-black text-white text-sm font-semibold rounded-full shadow-lg shadow-gray-900/20 hover:shadow-gray-900/40 hover:-translate-y-0.5 transition-all duration-300">Join Network</a>
            </div>

            <!-- Mobile Menu Toggle -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden relative z-20 p-2 text-gray-600 hover:text-gray-900 focus:outline-none">
                <svg x-show="!mobileMenuOpen" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                <svg x-show="mobileMenuOpen" style="display:none;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <!-- Mobile Menu Overlay -->
        <div 
            x-show="mobileMenuOpen" 
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="-translate-y-full opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="-translate-y-full opacity-0"
            class="absolute top-0 left-0 w-full bg-white shadow-2xl border-b border-gray-100 z-10 pt-24 pb-8 px-6 flex flex-col gap-6 items-center"
            style="display: none;"
        >
            <a href="#features" @click="mobileMenuOpen = false" class="text-lg font-semibold text-gray-900">Features</a>
            <a href="#testimonials" @click="mobileMenuOpen = false" class="text-lg font-semibold text-gray-900">Testimonials</a>
            <a href="#footer" @click="mobileMenuOpen = false" class="text-lg font-semibold text-gray-900">Network</a>
            
            <div class="w-full h-px bg-gray-100 my-2"></div>
            
            <a href="{{ route('login') }}" class="text-lg font-semibold text-gray-700">Log in</a>
            <a href="{{ route('register') }}" class="w-full text-center py-3 bg-gray-900 text-white rounded-xl font-bold mt-2">Join Network</a>
        </div>
    </header>

    <main>
        <!-- Cinematic Parallax Hero -->
        <div class="parallax-container">
            <div class="parallax-sticky">
                <!-- Parallax Layers -->
                <div class="parallax-image-wrapper hero-layer-1">
                    <div>
                        <img src="{{ asset('images/hero-bg.png') }}" alt="Focus">
                    </div>
                </div>

                <div class="parallax-image-wrapper hero-layer-2">
                    <div>
                        <img src="{{ asset('images/landing/hero_6.png') }}" alt="Left Placeholder" style="background: linear-gradient(135deg, #00d2ff 0%, #3a7bd5 100%);">
                    </div>
                </div>

                <div class="parallax-image-wrapper hero-layer-3">
                    <div>
                        <img src="{{ asset('images/landing/hero_1.png') }}" alt="Top Cityscape">
                    </div>
                </div>

                <div class="parallax-image-wrapper hero-layer-4">
                    <div>
                        <img src="{{ asset('images/landing/hero_3.png') }}" alt="Mountains">
                    </div>
                </div>

                <div class="parallax-image-wrapper hero-layer-5">
                    <div>
                        <img src="{{ asset('images/landing/hero_4.png') }}" alt="Lake">
                    </div>
                </div>

                <div class="parallax-image-wrapper hero-layer-6">
                    <div>
                        <img src="{{ asset('images/landing/hero_5.png') }}" alt="MacOS">
                    </div>
                </div>

                <div class="parallax-image-wrapper hero-layer-7">
                    <div>
                        <img src="{{ asset('images/landing/hero_7.png') }}" alt="Bottom Right Placeholder">
                    </div>
                </div>
            </div>
        </div>
        <!-- Features Section (Flipping Cards) -->
        <section class="py-24 bg-white flex flex-col items-center border-t border-gray-200" id="features">
            <div class="text-center mb-16 px-4">
                <h2 class="text-3xl md:text-5xl font-semibold mb-4 text-gray-900 tracking-tight">Networking, perfected.</h2>
                <p class="text-lg text-gray-500 font-medium max-w-2xl mx-auto">Connect with the people who define the industry. From campus mentors to global founders.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto px-4 w-full justify-items-center">
                
                <x-flipping-card 
                    title="Direct Mentorship"
                    shortDescription="The blueprint for your success, delivered 1-on-1 by established alumni leaders."
                    description="Skip the trial and error. Get direct insights and career roadmaps from industry pioneers who sat in the same seats you do today."
                    image="{{ asset('images/landing/mentorship_3d.png') }}"
                >
                </x-flipping-card>

                <x-flipping-card 
                    title="Inner Circle Access"
                    shortDescription="Access high-impact opportunities that never hit the public job boards."
                    description="The best roles are often unlisted. Unlock a private job board curated by alumni founders and executives looking for elite internal talent."
                    image="{{ asset('images/landing/hero_6.png') }}"
                >
                </x-flipping-card>

                <x-flipping-card 
                    title="Global Reach"
                    shortDescription="A legacy network without borders. Connect from anywhere, scale to everywhere."
                    description="Forge elite partnerships spanning 50+ countries. Leverage the collective intelligence of a worldwide network to scale your career globally."
                    image="{{ asset('images/landing/hero_1.png') }}"
                >
                </x-flipping-card>

            </div>
        </section>


        <!-- Testimonials Section -->
        <section class="section testimonials-section" id="testimonials" x-data="circularTestimonials" @keydown.window="handleKey($event)">
            <div class="testimonial-container">
                <div class="testimonial-grid">
                    <!-- Images -->
                    <div class="image-container" x-ref="imageContainer">
                        <template x-for="(testimonial, index) in testimonials" :key="index">
                            <img
                                :src="testimonial.src"
                                :alt="testimonial.name"
                                class="testimonial-image"
                                :style="getImageStyle(index)"
                            />
                        </template>
                    </div>

                    <!-- Content -->
                    <div class="testimonial-content">
                        <!-- Key wrap for re-rendering animation -->
                        <template x-for="item in [testimonials[activeIndex]]" :key="activeIndex">
                            <div class="quote-wrapper">
                                <h3 class="name" x-text="item.name"></h3>
                                <p class="designation" x-text="item.designation"></p>
                                
                                <!-- Words animation -->
                                <p class="quote">
                                    <template x-for="(word, wIndex) in item.quote.split(' ')" :key="wIndex">
                                        <span class="animated-word" :style="`animation-delay: ${wIndex * 0.025}s`" x-html="word + '&amp;nbsp;'"></span>
                                    </template>
                                </p>
                            </div>
                        </template>
                        
                        <div class="arrow-buttons">
                            <button class="arrow-button" @click="prev()" aria-label="Previous testimonial">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                            </button>
                            <button class="arrow-button" @click="next()" aria-label="Next testimonial">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    @include('partials.footer')

</body>
</html>
