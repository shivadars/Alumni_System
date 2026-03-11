<x-app-layout>
    <div class="bg-slate-50 min-h-screen py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Breadcrumbs -->
            <nav class="flex mb-8 text-xs font-bold uppercase tracking-widest text-slate-400" aria-label="Breadcrumb">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors">Home</a>
                <span class="mx-3">/</span>
                <a href="{{ route('events.index') }}" class="hover:text-blue-600 transition-colors">Events</a>
                <span class="mx-3">/</span>
                <span class="text-slate-900">Details</span>
            </nav>

            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-200 overflow-hidden">
                <!-- Header Banner (Minimalist) -->
                <div class="p-8 md:p-12 border-b border-slate-100 bg-slate-50/30">
                    <div class="max-w-4xl">
                        <span class="inline-block px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest rounded-full mb-6">Upcoming Event</span>
                        <h1 class="text-3xl md:text-5xl font-black text-slate-900 leading-tight tracking-tight">{{ $event->title }}</h1>
                        
                        <div class="flex flex-wrap gap-8 mt-8">
                            <div class="flex items-center gap-3 text-slate-600">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="font-bold text-sm">{{ $event->event_date->format('F d, Y • h:i A') }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-slate-600">
                                <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="font-bold text-sm">{{ $event->location }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col lg:flex-row">
                    <!-- Left: Description -->
                    <div class="flex-1 p-8 md:p-12 space-y-10">
                        <section>
                            <h2 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-6">About this event</h2>
                            <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed font-normal text-lg">
                                {!! nl2br(e($event->description)) !!}
                            </div>
                        </section>

                        <section class="pt-10 border-t border-slate-50">
                            <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-6">Organizer</h3>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full overflow-hidden border border-slate-100 bg-slate-50">
                                    @if($event->user->profile && $event->user->profile->profile_picture)
                                        <img src="{{ asset('storage/' . $event->user->profile->profile_picture) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300 capitalize">{{ substr($event->user->name, 0, 1) }}</div>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-base font-black text-slate-900 leading-tight">{{ $event->user->name }}</p>
                                    <p class="text-xs font-bold text-slate-500 mt-1">{{ $event->user->role }}</p>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Right: Small Image & Actions -->
                    <div class="w-full lg:w-80 bg-slate-50/50 p-8 border-l border-slate-100 space-y-8">
                        @if($event->image)
                            <div class="rounded-2xl overflow-hidden shadow-lg shadow-slate-200 border border-white">
                                <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-auto object-cover" alt="{{ $event->title }}">
                            </div>
                        @endif

                        <div class="space-y-4 pt-4">
                            <button class="w-full py-4 bg-slate-900 text-white font-black text-xs uppercase tracking-widest hover:bg-slate-800 transition-all rounded-xl shadow-lg shadow-slate-200">
                                Register Now
                            </button>
                            <p class="text-[10px] text-slate-400 text-center font-bold">Registration is open to all members</p>
                        </div>

                        <!-- Admin Actions -->
                        @if(auth()->id() === $event->user_id || auth()->user()->role === 'admin')
                            <div class="pt-8 border-t border-slate-200 space-y-3">
                                <a href="#" class="block w-full text-center py-2.5 bg-white text-slate-600 text-[11px] font-black uppercase tracking-widest rounded-xl border border-slate-200 hover:bg-slate-50 transition-all">Edit Event</a>
                                <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Delete this event?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full py-2.5 text-rose-500 text-[11px] font-black uppercase tracking-widest border border-rose-100 hover:bg-rose-50 rounded-xl transition-all">Delete</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="mt-8 text-center">
                <a href="{{ route('events.index') }}" class="text-sm font-bold text-slate-400 hover:text-blue-600 transition-all">← Back to all events</a>
            </div>
        </div>
    </div>
</x-app-layout>
