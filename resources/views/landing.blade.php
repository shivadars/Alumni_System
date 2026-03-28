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
    
    <!-- Navbar -->
    <header class="navbar">
        <div class="logo">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Connectwork Logo">
            </a>
        </div>
        
        <nav class="nav-links">
            <a href="/">Home</a>
            <a href="#testimonials">Testimonials</a>
            <a href="{{ route('login') }}" class="login-btn">Sign In</a>
        </nav>
    </header>

    <main>
        <!-- Cinematic Parallax Hero -->
        <div class="parallax-container">
            <div class="parallax-sticky">
                <!-- Parallax Layers -->
                <div class="parallax-image-wrapper hero-layer-1">
                    <div>
                        <img src="{{ asset('images/hero-bg.png') }}" alt="Focus">
                        <div class="radial-shadow"></div>
                        <div class="integrated-content">
                            <h1 class="text-gradient" style="margin-bottom: 0;">Connect.<br>Engage. Grow.</h1>
                            <p style="margin-bottom: 0.5rem;">Bridging the gap between education and excellence.</p>
                            <a href="{{ route('login') }}" class="login-btn-zoomed" style="pointer-events: auto;">Sign In</a>
                        </div>
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
                <h2 class="text-4xl md:text-5xl font-bold mb-4 text-black" style="font-family: var(--font-heading)">Why Connectwork?</h2>
                <p class="text-lg text-gray-700 max-w-2xl mx-auto">Everything you need to grow your career, right at your fingertips.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto px-4 w-full justify-items-center">
                
                <x-flipping-card 
                    title="Expert Mentorship"
                    shortDescription="Elevate your career through exclusive 1-on-1 guidance from established alumni leaders."
                    description="Connect with established alumni who have walked your path. Get 1-on-1 guidance, career advice, and industry insights to accelerate your professional growth."
                    image="{{ asset('images/landing/mentorship_3d.png') }}"
                >
                </x-flipping-card>

                <x-flipping-card 
                    title="Job Opportunities"
                    shortDescription="Discover hand-picked roles directly from peers who know the true value of your education."
                    description="Access an exclusive job board curated by your peers. Find roles directly posted by alumni looking to hire fresh talent or experienced professionals from our ecosystem."
                    image="{{ asset('images/landing/hero_6.png') }}"
                >
                </x-flipping-card>

                <x-flipping-card 
                    title="Global Networking"
                    shortDescription="Bridge the geographical gap and forge meaningful, long-lasting connections worldwide."
                    description="Reunite with batchmates and discover alumni worldwide. Stay updated through group discussions and filter directories to find experts in specific industries."
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
