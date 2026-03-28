import './bootstrap';

// Landing Page Parallax Logic
(function() {
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.querySelector('.parallax-container');
        if (!container) return; // Exit if not on landing page

        const wrappers = document.querySelectorAll('.parallax-image-wrapper');
        const heroContent = document.querySelector('.hero-content');
        const navbar = document.querySelector('.navbar');

        // Reveal hero text on load
        setTimeout(() => {
            if (heroContent) heroContent.classList.add('visible');
        }, 500);

        // Smooth Scroll & 3D Parallax Logic
        let targetScroll = 0;
        let currentScroll = 0;
        const lerp = (start, end, factor) => start + (end - start) * factor;

        const handleScroll = () => {
            targetScroll = window.scrollY;
            
            // Background Navbar scaling
            if (navbar) {
                if (targetScroll > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }
        };

        const updateParallax = () => {
            currentScroll = lerp(currentScroll, targetScroll, 0.08); // Smoothing factor

            const viewportHeight = window.innerHeight;
            const containerTop = container.offsetTop;
            const containerHeight = container.offsetHeight;

            // Progress of scroll through the parallax container (0 to 1)
            let progress = (currentScroll - containerTop) / (containerHeight - viewportHeight);
            progress = Math.max(0, Math.min(1, progress));

            // Layer configs aligned directly with HTML order (1 to 7)
            const layerConfigs = [
                { zStart: 100,  zEnd: 1269, scatterX: 0,     scatterY: 0 },      // Layer 1 (Adjusted zEnd to perfectly fill view over shorter distance)
                { zStart: -100, zEnd: 1500, scatterX: -1000, scatterY: -1000 },  // Layer 2 (Top Left Gradient)
                { zStart: -200, zEnd: 1300, scatterX: 500,   scatterY: -1000 },  // Layer 3 (Top Cityscape)
                { zStart: -300, zEnd: 1400, scatterX: 1000,  scatterY: 200 },    // Layer 4 (Right Mountains)
                { zStart: -400, zEnd: 1200, scatterX: -1000, scatterY: 800 },    // Layer 5 (Bottom Left Lake)
                { zStart: -150, zEnd: 1250, scatterX: 0,     scatterY: 1000 },   // Layer 6 (Bottom Center MacOS)
                { zStart: -500, zEnd: 1400, scatterX: 800,   scatterY: 800 }     // Layer 7 (Bottom Right Forest)
            ];
            
            wrappers.forEach((wrapper, index) => {
                const config = layerConfigs[index % layerConfigs.length];
                const z = config.zStart + (config.zEnd - config.zStart) * progress;
                const x = config.scatterX * progress;
                const y = config.scatterY * progress;
                
                // Opacity logic:
                let opacity = 1;
                if (index % layerConfigs.length === 0) { // Central Hero (Layer 1)
                    opacity = 1; // Stay fully visible when hitting full screen 

                    // Reveal text and gradient only when closing in on full screen
                    if (progress > 0.6) {
                        wrapper.classList.add('hero-zoomed');
                    } else {
                        wrapper.classList.remove('hero-zoomed');
                    }

                } else {
                    if (z > 800) {
                        opacity = Math.max(0, 1 - (z - 800) / 400); // Surrounding layers fade as they pass
                    }
                }

                wrapper.style.transform = `translate3d(${x}px, ${y}px, ${z}px)`;
                wrapper.style.opacity = opacity;
                
                // Blur effect as layers get close to the camera (skipping central layer)
                const blur = (index % layerConfigs.length !== 0 && z > 500) ? (z - 500) / 30 : 0;
                const imageContainer = wrapper.querySelector('div');
                if (imageContainer) {
                    imageContainer.style.filter = `blur(${blur}px)`;
                }
            });

            // Hero Text Logic is now integrated into Layer 3, 
            // but we can still apply global fade outcomes if needed.
            // (Removed separate heroContent logic as it's inside layer 3 now)

            requestAnimationFrame(updateParallax);
        };

        window.addEventListener('scroll', handleScroll, { passive: true });
        updateParallax(); // Start the loop

        // Intersection Observer for scroll reveal animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.premium-card, .section-header').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(40px)';
            el.style.transition = 'all 0.8s cubic-bezier(0.2, 0.8, 0.2, 1)';
            observer.observe(el);
        });
    });
})();

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
