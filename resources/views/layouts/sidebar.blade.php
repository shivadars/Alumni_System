@php
    // These would normally be passed from the controller, 
    // but for the global sidebar we can fetch basic stats or use a View Composer.
    $trendingTopics = \App\Models\Post::whereNotNull('category')->distinct()->pluck('category')->take(5);
@endphp

<div class="w-full lg:w-1/4 space-y-6 lg:sticky lg:top-24 lg:h-[calc(100vh-6rem)] lg:overflow-y-auto lg:pr-2 hidden lg:block" style="scrollbar-width: thin;">
    
    <!-- User Mini-Profile -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <div class="flex flex-col items-center text-center">
            @if(Auth::user()->profile && Auth::user()->profile->profile_picture)
                <img src="{{ asset('storage/' . Auth::user()->profile->profile_picture) }}" alt="{{ Auth::user()->name }}" class="w-20 h-20 rounded-full object-cover ring-4 ring-slate-50 shadow-sm mb-4">
            @else
                <div class="w-20 h-20 rounded-full bg-slate-100 flex items-center justify-center border border-slate-200 text-slate-400 mb-4 ring-4 ring-slate-50">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
            @endif
            
            <h3 class="text-lg font-bold text-slate-900 leading-tight">{{ Auth::user()->name }}</h3>
            <p class="text-xs text-slate-500 font-semibold mt-1">
                {{ ucfirst(Auth::user()->role) }} 
                @if(Auth::user()->profile && Auth::user()->profile->department)
                    • {{ Auth::user()->profile->department }}
                @endif
            </p>
            
            <a href="{{ route('profile.show') }}" data-ajax class="mt-4 w-full block text-center px-4 py-2 text-xs font-bold text-slate-700 bg-slate-50 border border-slate-200 rounded-xl hover:bg-slate-100 transition-colors">
                View Profile
            </a>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-200">
        <nav class="space-y-1">
            <a href="{{ route('dashboard') }}" data-ajax class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors group {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:text-blue-600 hover:bg-blue-50' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-blue-500' : 'text-slate-400 group-hover:text-blue-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="text-sm font-semibold">Feed</span>
            </a>
            <a href="{{ route('messages.index') }}" data-ajax class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors group {{ request()->routeIs('messages.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:text-blue-600 hover:bg-blue-50' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('messages.*') ? 'text-blue-500' : 'text-slate-400 group-hover:text-blue-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                <span class="text-sm font-semibold">Messages</span>
            </a>
            <a href="{{ route('department.index') }}" data-ajax class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors group {{ request()->routeIs('department.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:text-blue-600 hover:bg-blue-50' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('department.*') ? 'text-blue-500' : 'text-slate-400 group-hover:text-blue-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                <span class="text-sm font-semibold">Departments</span>
            </a>
            <a href="{{ route('alumni.search') }}" data-ajax class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors group {{ request()->routeIs('alumni.search') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:text-blue-600 hover:bg-blue-50' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('alumni.search') ? 'text-blue-500' : 'text-slate-400 group-hover:text-blue-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <span class="text-sm font-semibold">Alumni Directory</span>
            </a>
            <a href="{{ route('events.index') }}" data-ajax class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors group {{ request()->routeIs('events.*') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:text-blue-600 hover:bg-blue-50' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('events.*') ? 'text-blue-500' : 'text-slate-400 group-hover:text-blue-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span class="text-sm font-semibold">Events</span>
            </a>
        </nav>
    </div>

    <!-- Trending Topics -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
        <h3 class="text-sm font-bold text-slate-900 mb-4 flex items-center gap-2">
            <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            Trending Topics
        </h3>
        <div class="flex flex-wrap gap-2">
            @forelse($trendingTopics as $topic)
                <a href="{{ route('dashboard', ['category' => $topic]) }}" data-ajax class="px-3 py-1 text-[11px] font-bold rounded-full border cursor-pointer transition-colors whitespace-nowrap {{ request('category') === $topic ? 'bg-blue-600 text-white border-blue-600' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100 hover:text-blue-600' }}">
                    #{{ str_replace(' ', '', ucwords($topic)) }}
                </a>
            @empty
                <p class="text-xs text-slate-400 italic">No trending topics yet.</p>
            @endforelse
        </div>
    </div>
</div>
