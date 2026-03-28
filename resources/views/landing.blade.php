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
            <a href="#about">About</a>
            <a href="#impact">Impact</a>
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

        <!-- Impact Section -->
        <section class="section" id="about">
            <div class="section-header">
                <h2 class="text-gradient">The power of your network, unlocked.</h2>
                <p style="color: var(--text-secondary); font-size: 1.25rem;">We've built an ecosystem that goes beyond job boards. It's about legacy, mentorship, and building the future together.</p>
            </div>
            
            <div class="grid-cards">
                <div class="premium-card">
                    <div class="card-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <h3>Global Network</h3>
                    <p>Access a worldwide directory of successful professionals across every industry imaginable.</p>
                </div>
                
                <div class="premium-card" style="margin-top: 2rem;">
                    <div class="card-icon" style="background: #3b82f6;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                    </div>
                    <h3>Career Catalyst</h3>
                    <p>Exclusive internships and high-level roles shared directly by alumni who know your potential.</p>
                </div>
                
                <div class="premium-card" style="margin-top: 4rem;">
                    <div class="card-icon" style="background: #6366f1;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19l7-7 3 3-7 7-3-3z"></path><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path><path d="M2 2l7.586 7.586"></path><circle cx="11" cy="11" r="2"></circle></svg>
                    </div>
                    <h3>Direct Mentorship</h3>
                    <p>Bridge the gap with 1-on-1 guidance from those who have walked the path before you.</p>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="section" id="impact" style="text-align: center; background: radial-gradient(circle at center, #111, #000);">
            <div style="max-width: 800px; margin: 0 auto;">
                <h2 class="text-gradient" style="font-size: 4rem; margin-bottom: 2rem;">Ready to join the legacy?</h2>
                <p style="color: var(--text-secondary); font-size: 1.5rem; margin-bottom: 3rem;">Join 5,000+ alumni and students building the future of our institution.</p>
                <a href="{{ route('login') }}" class="login-btn" style="font-size: 1.25rem; padding: 1.25rem 3rem;">Get Started Now</a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="landing-footer">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Connectwork" style="height: 32px; filter: grayscale(1) opacity(0.5);">
        </div>
        <div class="footer-copy">
            <p>© 2026 Connectwork. Crafted with excellence for our alumni community.</p>
        </div>
    </footer>

</body>
</html>
