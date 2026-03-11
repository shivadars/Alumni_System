<x-app-layout>
    <div class="bg-[#f4f2ee] min-h-screen py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                
                <!-- Main Content Column (Left/Center) -->
                <div class="lg:col-span-8 space-y-4">
                    
                    <!-- Main Event Card -->
                    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
                        <!-- Wide Banner Section -->
                        <div class="w-full h-48 md:h-64 bg-slate-200 overflow-hidden">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-full object-cover" alt="{{ $event->title }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-r from-slate-200 to-slate-300">
                                    <span class="text-slate-400 font-black text-xs italic uppercase tracking-[0.5em]">Event Banner</span>
                                </div>
                            @endif
                        </div>

                        <!-- Event Info -->
                        <div class="p-6">
                            <div class="mb-4">
                                <span class="text-amber-700 text-xs font-bold">Upcoming</span>
                                <h1 class="text-2xl md:text-3xl font-semibold text-slate-900 mt-1">{{ $event->title }}</h1>
                                <p class="text-sm text-slate-500 mt-1">Event by <span class="font-bold hover:text-blue-600 hover:underline cursor-pointer">{{ $event->user->name }}</span></p>
                            </div>

                            <div class="space-y-3 text-sm text-slate-600 mb-6">
                                <div class="flex items-start gap-2">
                                    <svg class="w-5 h-5 text-slate-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <div>
                                        <p class="font-bold text-slate-700">{{ $event->event_date->format('M d, Y, h:i A') }} (your local time)</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-2">
                                    <svg class="w-5 h-5 text-slate-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <p>{{ $event->location }}</p>
                                </div>
                                <div class="flex items-start gap-2">
                                    <svg class="w-5 h-5 text-slate-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.826L10.242 9.242m-4.242 4.242l-.242 1.242m1.242-1.242l1.242-.242m3.158-3.158l-.606-.606m-2.424 2.424l-.606-.606"></path></svg>
                                    <a href="#" class="text-blue-600 font-bold hover:underline">Event link</a>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    <p class="font-bold text-slate-500">10 attendees</p>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-2 mb-6">
                                <button class="px-6 py-1.5 bg-blue-600 text-white font-bold rounded-full hover:bg-blue-700 transition-colors">Attend</button>
                                <button class="px-6 py-1.5 border border-blue-600 text-blue-600 font-bold rounded-full hover:bg-blue-50 transition-colors">Share</button>
                                <button class="p-1.5 text-slate-500 hover:bg-slate-100 rounded-full">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 16a2 2 0 110-4 2 2 0 010 4zm7 0a2 2 0 110-4 2 2 0 010 4zM5 16a2 2 0 110-4 2 2 0 010 4z"></path></svg>
                                </button>
                            </div>

                            <!-- Tabs -->
                            <div class="flex border-t border-slate-100">
                                <button class="px-4 py-3 border-b-2 border-blue-600 text-blue-600 font-bold text-sm">Details</button>
                                <button class="px-4 py-3 text-slate-500 font-bold text-sm hover:bg-slate-50">Comments</button>
                            </div>
                        </div>
                    </div>

                    <!-- Description Card -->
                    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-slate-100 rounded border border-slate-200 overflow-hidden">
                                        @if($event->user->profile && $event->user->profile->profile_picture)
                                            <img src="{{ asset('storage/' . $event->user->profile->profile_picture) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-slate-400 font-bold">AL</div>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-slate-900">{{ $event->user->name }}</h3>
                                        <p class="text-xs text-slate-500">150 followers</p>
                                    </div>
                                </div>
                                <button class="text-blue-600 font-bold text-sm px-4 py-1 hover:bg-blue-50 rounded-full transition-colors">+ Follow</button>
                            </div>

                            <div class="prose prose-slate max-w-none text-sm text-slate-600 leading-relaxed">
                                {!! nl2br(e($event->description)) !!}
                            </div>
                            
                            <div class="mt-6 pt-4 border-t border-slate-100">
                                <div class="flex items-center gap-2 mb-4">
                                    <div class="flex -space-x-2">
                                        <div class="w-6 h-6 rounded-full border-2 border-white bg-blue-500"></div>
                                        <div class="w-6 h-6 rounded-full border-2 border-white bg-rose-500"></div>
                                        <div class="w-6 h-6 rounded-full border-2 border-white bg-emerald-500"></div>
                                    </div>
                                    <span class="text-xs text-slate-500">8</span>
                                </div>
                                <div class="flex gap-4">
                                    <button class="flex items-center gap-1 text-slate-500 font-bold text-xs hover:bg-slate-50 px-2 py-1 rounded">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.757c1.246 0 2.257 1.01 2.257 2.257l-.007.247c-.007.728-.316 1.428-.857 1.968l-1.037 1.037c-.542.541-1.24.843-1.968.85l-7.795.008c-.728.007-1.428-.302-1.968-.843L6.343 14.343a2.757 2.757 0 010-3.899l.247-.247c.541-.541 1.24-.85 1.968-.857L14 10z"></path></svg>
                                        Like
                                    </button>
                                    <button class="flex items-center gap-1 text-slate-500 font-bold text-xs hover:bg-slate-50 px-2 py-1 rounded">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                        Comment
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Column (Right) -->
                <div class="lg:col-span-4 space-y-4">
                    
                    <!-- Create Event Card -->
                    <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                        <div class="flex flex-col items-center text-center">
                            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded flex items-center justify-center mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <p class="text-sm font-medium text-slate-900 mb-4">Host an event on this platform and invite your network</p>
                            @if(in_array(auth()->user()->role, ['admin', 'alumni', 'department']))
                                <a href="{{ route('events.create') }}" class="w-full py-1.5 border border-blue-600 text-blue-600 font-bold rounded-full hover:bg-blue-50 transition-all text-center">Create event</a>
                            @endif
                        </div>
                    </div>

                    <!-- Other Events Card -->
                    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
                        <div class="p-4 flex justify-between items-center border-b border-slate-100">
                            <h3 class="font-semibold text-slate-900 text-sm">Other events for you</h3>
                            <a href="{{ route('events.index') }}" class="text-blue-600 font-bold text-xs hover:underline">See all</a>
                        </div>
                        <div class="divide-y divide-slate-100">
                            @forelse($otherEvents as $other)
                                <a href="{{ route('events.show', $other) }}" class="p-4 flex items-start gap-3 hover:bg-slate-50 transition-all">
                                    <div class="w-16 h-12 bg-slate-100 rounded overflow-hidden flex-shrink-0">
                                        @if($other->image)
                                            <img src="{{ asset('storage/' . $other->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-slate-200 flex items-center justify-center text-[8px] font-black text-slate-400">EVENT</div>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-[10px] text-amber-700 font-bold">{{ $other->event_date->format('D, h:i A') }}</p>
                                        <p class="text-xs font-bold text-slate-900 truncate">{{ $other->title }}</p>
                                        <p class="text-[10px] text-slate-500 truncate">{{ $other->location }}</p>
                                    </div>
                                </a>
                            @empty
                                <div class="p-4 text-center text-xs text-slate-400 italic">No other upcoming events</div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Footer Links (LinkedIn Style) -->
                    <div class="px-6 py-4">
                        <div class="flex flex-wrap justify-center gap-x-4 gap-y-1 text-[11px] text-slate-500">
                            <a href="#" class="hover:text-blue-600 hover:underline">About</a>
                            <a href="#" class="hover:text-blue-600 hover:underline">Accessibility</a>
                            <a href="#" class="hover:text-blue-600 hover:underline">Help Center</a>
                            <a href="#" class="hover:text-blue-600 hover:underline">Privacy & Terms</a>
                            <a href="#" class="hover:text-blue-600 hover:underline">Ad Choices</a>
                            <a href="#" class="hover:text-blue-600 hover:underline">Advertising</a>
                            <a href="#" class="hover:text-blue-600 hover:underline">Business Services</a>
                            <a href="#" class="hover:text-blue-600 hover:underline">Get the App</a>
                            <a href="#" class="hover:text-blue-600 hover:underline">More</a>
                        </div>
                        <p class="text-center text-[11px] text-slate-600 mt-4 flex items-center justify-center gap-1 font-bold">
                            <span class="text-blue-600 font-black italic">Alumni</span> Network © 2026
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
