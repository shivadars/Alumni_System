const fs = require('fs');

const inputPath = 'UIdesigns/3.txt';
const outputPath = 'resources/views/partials/footer.blade.php';

let code = fs.readFileSync(inputPath, 'utf8');

const svgRegex = /const tape = (<svg.*?<\/svg>)/s;
const match = code.match(svgRegex);
const svgString = match ? match[1] : '';

let bladeCode = `
<footer class="my-8 px-4 max-w-5xl mx-auto text-gray-900 border-t border-gray-200 mt-24">
    <div class="relative bg-white rounded-3xl max-w-5xl mx-auto px-6 py-10 flex flex-col md:flex-row justify-between items-center gap-8 shadow-xl border border-gray-100 mb-8 z-10 -mt-16">
        <div class="hidden md:block absolute -top-4 -left-8 w-[80px] h-[36px] scale-75 opacity-20 hover:opacity-100 transition duration-300">
            ${svgString}
        </div>
        <div class="hidden md:block absolute -top-4 -right-8 rotate-90 w-[80px] h-[36px] scale-75 opacity-20 hover:opacity-100 transition duration-300">
            ${svgString}
        </div>
        <div class="flex flex-col md:flex-row items-start justify-between gap-6 md:gap-12 px-2 flex-1 w-full relative z-20">
            <div class="flex flex-col items-start gap-4 w-full md:w-1/3">
                <a href="/" class="flex flex-row gap-2 items-center justify-start text-2xl font-extrabold text-gray-900" style="font-family: var(--font-heading)">
                    <img src="{{ asset('images/logo.png') }}" alt="Connectwork" class="h-8 filter brightness-0">
                </a>
                <p class="text-gray-500 font-medium text-sm leading-relaxed max-w-sm">
                    Bridging the gap between education and excellence. Our alumni network connects, empowers, and guides you to a successful career.
                </p>
            </div>

            <div class="flex flex-col md:mx-4 md:flex-row gap-8 md:gap-16 items-start">
                <div class="flex flex-col gap-3 md:gap-4">
                    <h4 class="uppercase text-xs text-gray-400 font-bold tracking-widest">Network</h4>
                    <div class="flex flex-wrap md:flex-col gap-3 text-sm text-gray-600 items-start">
                        <a class="hover:text-[var(--accent)] whitespace-nowrap font-medium transition-colors" href="#">Mentorship</a>
                        <a class="hover:text-[var(--accent)] whitespace-nowrap font-medium transition-colors" href="#">Job Board</a>
                        <a class="hover:text-[var(--accent)] whitespace-nowrap font-medium transition-colors" href="#">Events</a>
                        <span class="pointer-events-none text-gray-400 whitespace-nowrap font-medium flex items-center">Directory <span class="inline-flex ml-2 py-0.5 px-2 bg-blue-50 text-[var(--accent)] text-[10px] uppercase font-bold rounded-full -rotate-2">soon</span></span>
                    </div>
                </div>

                <div class="hidden md:flex flex-col gap-3 md:gap-4">
                    <h4 class="uppercase whitespace-nowrap text-xs text-gray-400 font-bold tracking-widest flex items-center">Community</h4>
                    <div class="flex gap-3 flex-wrap md:flex-col text-sm text-gray-600 items-start">
                        <span class="pointer-events-none text-gray-400 whitespace-nowrap font-medium flex items-center">Clubs & Groups  <span class="inline-flex ml-2 py-0.5 px-2 bg-blue-50 text-[var(--accent)] text-[10px] uppercase font-bold rounded-full rotate-2">soon</span></span>
                        <span class="pointer-events-none text-gray-400 whitespace-nowrap font-medium">Marketplace</span>
                        <span class="pointer-events-none text-gray-400 whitespace-nowrap font-medium">Donations</span>
                    </div>
                </div>
                
                <div class="hidden md:flex flex-col gap-3 md:gap-4">
                    <h4 class="uppercase whitespace-nowrap text-xs text-gray-400 font-bold tracking-widest">Support</h4>
                    <div class="flex flex-col gap-3 text-sm text-gray-600 items-start">
                        <a class="hover:text-[var(--accent)] whitespace-nowrap font-medium transition-colors" href="#">Contact Us</a>
                        <a class="hover:text-[var(--accent)] whitespace-nowrap font-medium transition-colors" href="#">FAQ</a>
                        <a class="hover:text-[var(--accent)] whitespace-nowrap font-medium transition-colors" href="#">Privacy Policy</a>
                        <a class="hover:text-[var(--accent)] whitespace-nowrap font-medium transition-colors" href="#">Terms of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="px-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 text-sm text-gray-500 pb-4">
        <div class="flex flex-col sm:flex-row gap-2 sm:gap-8 items-start sm:items-center">
            <p class="whitespace-nowrap font-medium">
                &copy; {{ date('Y') }} Connectwork. All rights reserved.
            </p>
        </div>

        <div class="flex gap-4 items-center">
            <a href="#" target="_blank" rel="nofollow noopener" aria-label="LinkedIn" class="text-gray-400 hover:text-[var(--accent)] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
            </a>
            <a href="#" target="_blank" rel="nofollow noopener" aria-label="Twitter" class="text-gray-400 hover:text-[var(--accent)] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
            </a>
        </div>
    </div>
</footer>
`;

const dir = 'resources/views/partials';
if (!fs.existsSync(dir)) fs.mkdirSync(dir, { recursive: true });

fs.writeFileSync(outputPath, bladeCode);
console.log('Saved to', outputPath);
