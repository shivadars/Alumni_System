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

                    // Class list updates strictly when state changes
                    const isZoomed = progress > 0.6;
                    if (isZoomed !== !!wrapper._isZoomed) {
                        if (isZoomed) wrapper.classList.add('hero-zoomed');
                        else wrapper.classList.remove('hero-zoomed');
                        wrapper._isZoomed = isZoomed;
                    }

                } else {
                    if (z > 1050) {
                        opacity = Math.max(0, 1 - (z - 1050) / 700); // Drastically slower fade (passes camera before vanishing)
                    }
                }

                wrapper.style.transform = `translate3d(${x}px, ${y}px, ${z}px)`;
                wrapper.style.opacity = opacity;
                
                // Cache the div element dynamically if not present to stop querySelector DOM traverses on 60fps
                if (!wrapper._childDiv) wrapper._childDiv = wrapper.querySelector('div');
                
                // Ultra-soft blur progression
                const blur = (index % layerConfigs.length !== 0 && z > 750) ? (z - 750) / 60 : 0;
                if (wrapper._childDiv) {
                    wrapper._childDiv.style.filter = `blur(${blur}px)`;
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

Alpine.data('circularTestimonials', () => ({
    testimonials: [
        {
            name: "Amith Ajay",
            designation: "Senior Architect at TechFlow",
            quote: "The alumni network completely transformed my career path. I found my current startup co-founder through an alumni meetup hosted right here in Kochi.",
            src: "/images/landing/person1.jpeg"
        },
        {
            name: "Amal Biju",
            designation: "Product Manager at InnovateCo",
            quote: "Connectwork bridged the gap between my college life and the corporate world. The mentorship I received from senior alumni was absolutely invaluable.",
            src: "/images/landing/person2.jpeg"
        },
        {
            name: "Suryakrishna K V",
            designation: "Data Scientist at MedVision",
            quote: "As someone transitioning fields after my studies in Trivandrum, the guidance I found here was extraordinary. It truly feels like a supportive family.",
            src: "/images/landing/person3.jpeg"
        },
        {
            name: "Abab P K",
            designation: "Creative Director at PixelStudio",
            quote: "This platform isn't just a directory; it's a living community. Being able to give back and hire fresh talent from my own alma mater is incredibly rewarding.",
            src: "/images/landing/person4.jpeg"
        }
    ],
    activeIndex: 0,
    containerWidth: 1200,
    interval: null,

    init() {
        this.updateWidth();
        window.addEventListener('resize', () => this.updateWidth());
        this.startAutoplay();
    },

    updateWidth() {
        if (this.$refs.imageContainer) {
            this.containerWidth = this.$refs.imageContainer.offsetWidth;
        }
    },

    startAutoplay() {
        this.stopAutoplay();
        this.interval = setInterval(() => {
            this.next();
        }, 5000);
    },

    stopAutoplay() {
        if (this.interval) clearInterval(this.interval);
    },

    next() {
        this.activeIndex = (this.activeIndex + 1) % this.testimonials.length;
        this.startAutoplay();
    },

    prev() {
        this.activeIndex = (this.activeIndex - 1 + this.testimonials.length) % this.testimonials.length;
        this.startAutoplay();
    },

    handleKey(e) {
        if (e.key === 'ArrowLeft') this.prev();
        if (e.key === 'ArrowRight') this.next();
    },

    getGap() {
        const width = this.containerWidth;
        const minWidth = 1024;
        const maxWidth = 1456;
        const minGap = 60;
        const maxGap = 86;
        if (width <= minWidth) return minGap;
        if (width >= maxWidth) return Math.max(minGap, maxGap + 0.06018 * (width - maxWidth));
        return minGap + (maxGap - minGap) * ((width - minWidth) / (maxWidth - minWidth));
    },

    getImageStyle(index) {
        const gap = this.getGap();
        const maxStickUp = gap * 0.8;
        const len = this.testimonials.length;
        
        const isActive = index === this.activeIndex;
        const isLeft = (this.activeIndex - 1 + len) % len === index;
        const isRight = (this.activeIndex + 1) % len === index;

        if (isActive) {
            return `z-index: 3; opacity: 1; pointer-events: auto; transform: translateX(0px) translateY(0px) scale(1) rotateY(0deg);`;
        }
        if (isLeft) {
            return `z-index: 2; opacity: 1; pointer-events: auto; transform: translateX(-${gap}px) translateY(-${maxStickUp}px) scale(0.85) rotateY(15deg);`;
        }
        if (isRight) {
            return `z-index: 2; opacity: 1; pointer-events: auto; transform: translateX(${gap}px) translateY(-${maxStickUp}px) scale(0.85) rotateY(-15deg);`;
        }
        return `z-index: 1; opacity: 0; pointer-events: none; transform: translateX(0) scale(0.5);`;
    }
}));

Alpine.start();
