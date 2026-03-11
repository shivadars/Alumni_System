<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-slate-900">Events</h1>
                @if(in_array(auth()->user()->role, ['admin', 'alumni', 'department']))
                    <a href="{{ route('events.create') }}" class="px-6 py-2 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-100">
                        Create Event
                    </a>
                @endif
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-xl border border-emerald-100 font-semibold shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <h2 class="text-xl font-bold text-slate-800 mb-6">Upcoming Events</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @forelse($upcomingEvents as $event)
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-all group">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-48 object-cover" alt="{{ $event->title }}">
                        @else
                            <div class="w-full h-48 bg-slate-100 flex items-center justify-center text-slate-300">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-600 transition-colors">{{ $event->title }}</h3>
                            <p class="text-slate-500 text-sm mt-2 flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ $event->event_date->format('M d, Y • h:i A') }}
                            </p>
                            <p class="text-slate-500 text-sm mt-1 flex items-center gap-2">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $event->location }}
                            </p>
                            <div class="mt-6">
                                <a href="{{ route('events.show', $event) }}" class="inline-block text-blue-600 font-bold text-sm hover:underline">View Details →</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center bg-white rounded-2xl border border-slate-100">
                        <p class="text-slate-400 font-medium">No upcoming events found.</p>
                    </div>
                @endforelse
            </div>

            @if($pastEvents->isNotEmpty())
                <h2 class="text-xl font-bold text-slate-800 mb-6">Past Events</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach($pastEvents as $event)
                        <a href="{{ route('events.show', $event) }}" class="bg-white p-4 rounded-xl border border-slate-100 hover:border-blue-200 transition-all opacity-75 grayscale hover:grayscale-0 hover:opacity-100">
                            <h4 class="font-bold text-slate-800 truncate">{{ $event->title }}</h4>
                            <p class="text-[10px] text-slate-500 mt-1">{{ $event->event_date->format('M d, Y') }}</p>
                        </a>
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $pastEvents->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
