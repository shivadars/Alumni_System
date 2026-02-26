<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center">
                        <x-application-logo class="block h-10 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-10 sm:flex items-center">
                    @php
                        $linkClasses = "inline-flex items-center gap-2 px-4 py-2 text-sm font-bold transition-all duration-200 rounded-lg";
                        $activeClasses = "bg-slate-900 text-white shadow-md ring-1 ring-slate-800";
                        $inactiveClasses = "text-slate-600 hover:text-slate-900 hover:bg-slate-100";
                    @endphp

                    <a href="{{ route('dashboard') }}" class="{{ $linkClasses }} {{ request()->routeIs('dashboard') ? $activeClasses : $inactiveClasses }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        {{ __('Dashboard') }}
                    </a>

                    <a href="{{ route('alumni.search') }}" class="{{ $linkClasses }} {{ request()->routeIs('alumni.search') ? $activeClasses : $inactiveClasses }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        {{ __('Find Alumni') }}
                    </a>

                    <a href="{{ route('messages.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('messages.index') ? $activeClasses : $inactiveClasses }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                        {{ __('Messages') }}
                        @php
                            $totalUnread = \App\Models\Message::where('receiver_id', Auth::id())
                                ->where('is_read', false)
                                ->count();
                        @endphp
                        @if($totalUnread > 0)
                            <span class="px-1.5 py-0.5 text-[10px] font-bold bg-red-500 text-white rounded-full">
                                {{ $totalUnread }}
                            </span>
                        @endif
                    </a>

                    @if(in_array(Auth::user()->role, ['alumni', 'department']))
                        <a href="{{ route('posts.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('posts.index') ? $activeClasses : $inactiveClasses }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            {{ __('Posts') }}
                        </a>
                    @endif

                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.users.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('admin.users.index') ? $activeClasses : $inactiveClasses }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            {{ __('Users') }}
                        </a>
                    @endif

                    @if(Auth::user()->role === 'department')
                        <a href="{{ route('department.index') }}" class="{{ $linkClasses }} {{ request()->routeIs('department.index') || request()->routeIs('department.show') ? $activeClasses : $inactiveClasses }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            {{ __('Departments') }}
                        </a>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                <!-- Notification Bell -->
                <button class="relative p-2 text-gray-400 hover:text-gray-600 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="absolute top-2 right-2 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                </button>

                <x-dropdown align="right" width="64">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            @if(Auth::user()->profile && Auth::user()->profile->profile_picture)
                                <img src="{{ asset('storage/' . Auth::user()->profile->profile_picture) }}" alt="{{ Auth::user()->name }}" class="h-7 w-7 rounded-full object-cover border border-gray-200">
                            @else
                                <div class="h-7 w-7 rounded-full bg-gray-100 flex items-center justify-center border border-gray-200">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                            @endif
                            <div class="font-bold text-gray-900">{{ Auth::user()->name }}</div>

                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 11.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.show')">
                            {{ __('My Info') }}
                        </x-dropdown-link>


                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-lg">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('alumni.search')" :active="request()->routeIs('alumni.search')" class="rounded-lg">
                {{ __('Find Alumni') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('messages.index')" :active="request()->routeIs('messages.index')" class="rounded-lg">
                {{ __('Messages') }}
            </x-responsive-nav-link>
            
             @if(in_array(Auth::user()->role, ['alumni', 'department']))
                <x-responsive-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')" class="rounded-lg">
                    {{ __('Posts') }}
                </x-responsive-nav-link>
            @endif

             @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')" class="rounded-lg">
                    {{ __('Users') }}
                </x-responsive-nav-link>
             @endif

             @if(Auth::user()->role === 'department')
                <x-responsive-nav-link :href="route('department.index')" :active="request()->routeIs('department.index') || request()->routeIs('department.show')" class="rounded-lg">
                    {{ __('Departments') }}
                </x-responsive-nav-link>
             @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <!-- Responsive My Info -->
             <div class="mt-3 space-y-1 border-t border-gray-200 pt-2">
                <x-responsive-nav-link :href="route('profile.show')">
                    {{ __('My Info') }}
                </x-responsive-nav-link>
            </div>


                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
</nav>
