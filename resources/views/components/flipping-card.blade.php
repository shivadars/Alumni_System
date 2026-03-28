@props([
    'height' => '300',
    'width' => '350',
    'title' => '',
    'description' => '',
    'shortDescription' => '',
    'image' => ''
])

<div class="group [perspective:1000px] w-full" style="--height: {{ $height }}px; max-width: {{ $width }}px;">
    <div class="relative rounded-2xl border border-gray-200 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.06)] transition-all duration-700 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)] h-[var(--height)] w-full">
        <!-- Front Face -->
        <div class="absolute inset-0 h-full w-full rounded-[inherit] bg-white border border-gray-100 text-black [transform-style:preserve-3d] [backface-visibility:hidden] [transform:rotateY(0deg)] flex flex-col p-3 shadow-lg">
            <div class="[transform:translateZ(70px)_scale(.93)] h-full w-full flex flex-col items-start justify-start pt-2 px-1">
                <div class="w-full h-36 rounded-lg overflow-hidden mb-5 border border-gray-100">
                    <img src="{{ $image }}" class="w-full h-full object-cover rounded-lg" alt="{{ $title }}">
                </div>
                <h3 class="text-xl font-bold mb-2 text-gray-900 tracking-tight">{{ $title }}</h3>
                <p class="text-gray-600 text-sm leading-relaxed font-medium">
                    {{ $shortDescription }}
                </p>
            </div>
        </div>
        <!-- Back Face -->
        <div class="absolute inset-0 h-full w-full rounded-[inherit] bg-black text-white [transform-style:preserve-3d] [backface-visibility:hidden] [transform:rotateY(180deg)] flex flex-col items-start justify-center p-8 border border-black shadow-2xl">
            <div class="[transform:translateZ(70px)_scale(.93)] h-full w-full flex flex-col items-start justify-center text-left">
                <h3 class="text-2xl font-bold mb-4 text-white tracking-tight">{{ $title }}</h3>
                <p class="text-gray-300 leading-relaxed font-medium text-sm md:text-base">
                    {{ $description }}
                </p>
            </div>
        </div>
    </div>
</div>
