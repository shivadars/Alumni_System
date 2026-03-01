<x-app-layout>
    <div class="pt-6 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col lg:flex-row gap-8 items-start">
                
                <!-- Left Sidebar (New Navigation) -->
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
                            
                            <a href="{{ route('profile.show') }}" class="mt-4 w-full block text-center px-4 py-2 text-xs font-bold text-slate-700 bg-slate-50 border border-slate-200 rounded-xl hover:bg-slate-100 transition-colors">
                                View Profile
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-200">
                        <nav class="space-y-1">
                            <a href="{{ route('messages.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:text-blue-600 hover:bg-blue-50 transition-colors group">
                                <svg class="w-5 h-5 text-slate-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                <span class="text-sm font-semibold">Messages</span>
                            </a>
                            <a href="{{ route('department.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:text-blue-600 hover:bg-blue-50 transition-colors group">
                                <svg class="w-5 h-5 text-slate-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                <span class="text-sm font-semibold">Departments</span>
                            </a>
                            <a href="{{ route('alumni.search') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:text-blue-600 hover:bg-blue-50 transition-colors group">
                                <svg class="w-5 h-5 text-slate-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                <span class="text-sm font-semibold">Alumni Directory</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:text-blue-600 hover:bg-blue-50 transition-colors group">
                                <svg class="w-5 h-5 text-slate-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-sm font-semibold">Events</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 hover:text-blue-600 hover:bg-blue-50 transition-colors group mt-4 pt-4 border-t border-slate-100">
                                <svg class="w-5 h-5 text-slate-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                                <span class="text-sm font-semibold">Saved Posts</span>
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
                                <a href="{{ route('dashboard', ['category' => $topic]) }}" class="px-3 py-1 text-[11px] font-bold rounded-full border cursor-pointer transition-colors whitespace-nowrap {{ request('category') === $topic ? 'bg-blue-600 text-white border-blue-600' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100 hover:text-blue-600' }}">
                                    #{{ str_replace(' ', '', ucwords($topic)) }}
                                </a>
                            @empty
                                <p class="text-xs text-slate-400 italic">No trending topics yet.</p>
                            @endforelse
                            @if(request('category'))
                                <a href="{{ route('dashboard') }}" class="px-3 py-1 bg-rose-50 text-rose-600 text-[11px] font-bold rounded-full border border-rose-200 hover:bg-rose-100 cursor-pointer transition-colors whitespace-nowrap flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    Clear Filter
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Main Feed (Center Column) -->
                <div class="w-full lg:w-1/2 space-y-6">
                    <!-- Feed Header -->
                    <div class="bg-white p-6 md:p-10 rounded-2xl shadow-sm border border-slate-200">
                        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">
                            {{ $department ? $department . ' Community' : 'Global Community' }}
                        </h1>
                        <p class="text-slate-500 mt-2 text-lg font-medium">
                            {{ $department ? 'Stay connected with your ' . $department . ' peers' : 'Stay connected with your entire alumni network' }}
                        </p>
                    </div>

                    @if(session('success'))
                        <div class="p-4 bg-emerald-50 text-emerald-700 rounded-xl border border-emerald-100 font-semibold shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Posts List -->
                    <div class="space-y-6">
                        @forelse($posts as $post)
                            <div x-data="{ showComments: false }" class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all duration-300">
                                <!-- Post Author & Category -->
                                <div class="flex items-center justify-between mb-6">
                                    <div class="flex items-center gap-4">
                                        @if($post->user->profile && $post->user->profile->profile_picture)
                                            <img src="{{ asset('storage/' . $post->user->profile->profile_picture) }}" alt="{{ $post->user->name }}" class="w-8 h-8 rounded-full object-cover ring-2 ring-slate-50 shadow-sm">
                                        @else
                                            <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center border border-slate-200 text-slate-400">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            </div>
                                        @endif
                                        <div>
                                            <h4 class="font-bold text-slate-900 text-[14px] leading-tight">{{ $post->user->name }}</h4>
                                            <p class="text-[10px] text-slate-400 font-semibold mt-0.5">{{ $post->created_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="px-3 py-1.5 text-[10px] font-bold rounded-full bg-blue-50 text-blue-700 uppercase tracking-widest border border-blue-100">
                                            {{ $post->category }}
                                        </span>
                                        @if(Auth::id() === $post->user_id || Auth::user()->role === 'admin')
                                            <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-full transition-colors" title="Delete Post">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>

                                <!-- Post Content -->
                                <div class="mb-8">
                                    <h3 class="text-xl md:text-2xl font-black text-slate-900 mb-2 leading-tight">{{ $post->title }}</h3>
                                    <p class="text-slate-600 text-base md:text-lg leading-relaxed mb-4">{{ $post->content }}</p>
                                    @if($post->image)
                                        <div class="mt-4 rounded-2xl overflow-hidden border border-slate-100 shadow-sm">
                                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-auto object-cover max-h-[500px]">
                                        </div>
                                    @endif

                                    @if($post->video)
                                        <div class="mt-4 rounded-2xl overflow-hidden border border-slate-100 shadow-sm bg-slate-900">
                                            <video controls class="w-full h-auto max-h-[500px]">
                                                <source src="{{ asset('storage/' . $post->video) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    @endif
                                </div>

                                <!-- Post Interactions -->
                                <div class="flex items-center gap-6 pt-6 border-t border-slate-50 text-slate-400">
                                    <form action="{{ route('posts.like.toggle', $post) }}" method="POST" class="inline">
                                        @csrf
                                        @php
                                            $hasLiked = $post->likes->where('user_id', auth()->id())->isNotEmpty();
                                        @endphp
                                        <button type="submit" class="flex items-center gap-2 hover:text-rose-600 transition-colors group px-1 {{ $hasLiked ? 'text-rose-600' : '' }}">
                                            <svg class="w-5 h-5 {{ $hasLiked ? 'fill-current' : 'group-hover:fill-current' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                            <span class="font-bold text-sm">{{ $post->likes->count() }}</span>
                                        </button>
                                    </form>
                                    <button @click="showComments = !showComments" class="flex items-center gap-2 hover:text-blue-600 transition-colors px-1" :class="{ 'text-blue-600': showComments }">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                        <span class="font-bold text-sm">{{ $post->comments->count() }}</span>
                                    </button>
                                    <button class="flex items-center gap-2 hover:text-slate-900 transition-colors ml-auto">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                                        <span class="font-bold text-sm">Share</span>
                                    </button>
                                </div>

                                <!-- Comments Section -->
                                <div x-show="showComments" style="display: none;" x-transition class="mt-8 pt-8 border-t border-slate-50">
                                    <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-6 font-display">Comments</h4>
                                    
                                    <div class="space-y-6 mb-8">
                                        @forelse($post->comments as $comment)
                                            <div class="flex gap-4">
                                                @if($comment->user->profile && $comment->user->profile->profile_picture)
                                                    <img src="{{ asset('storage/' . $comment->user->profile->profile_picture) }}" alt="{{ $comment->user->name }}" class="w-8 h-8 rounded-full object-cover shadow-sm">
                                                @else
                                                    <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center border border-slate-100 text-slate-300">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                    </div>
                                                @endif
                                                <div class="flex-1">
                                                    <div class="bg-slate-50/50 p-4 rounded-2xl border border-slate-100/50">
                                                        <p class="font-extrabold text-slate-900 text-[13px] mb-1 leading-tight">{{ $comment->user->name }}</p>
                                                        <p class="text-slate-600 text-[13px] leading-relaxed">{{ $comment->content }}</p>
                                                    </div>
                                                    <p class="text-[9px] text-slate-400 font-black mt-2 ml-2 tracking-widest uppercase">{{ $comment->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="py-4 text-center">
                                                <p class="text-xs text-slate-400 font-bold italic tracking-wide">No comments yet. Share your thoughts!</p>
                                            </div>
                                        @endforelse
                                    </div>

                                    <!-- Comment Form -->
                                    <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="flex gap-4 mt-8">
                                        @csrf
                                        <div class="flex-1 relative">
                                            <textarea name="content" rows="1" class="w-full bg-slate-50/50 rounded-2xl border-slate-100 text-[13px] focus:ring-4 focus:ring-blue-50 focus:border-blue-400 focus:bg-white placeholder-slate-400 py-3.5 px-4 transition-all duration-300" placeholder="Write a comment..." required></textarea>
                                            <button type="submit" class="absolute right-2 top-2 p-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-300 shadow-md shadow-blue-100 group">
                                                <svg class="w-4 h-4 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white p-12 text-center rounded-2xl shadow-sm border border-slate-100">
                                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM7 8h10M7 12h10M7 16h6"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900">No posts found</h3>
                                <p class="text-slate-500 mt-2">Be the first to share something with the community!</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Sidebar (Right Column) -->
                <div class="w-full lg:w-1/4 space-y-6 lg:sticky lg:top-24 lg:h-[calc(100vh-6rem)] lg:overflow-y-auto lg:pr-2 hidden lg:block" style="scrollbar-width: thin;">
                    <!-- Quick Stats -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                        <h3 class="text-xl font-extrabold text-slate-900 mb-6 tracking-tight">Quick Stats</h3>
                        <div class="space-y-6">
                            <div class="flex items-center gap-4 group">
                                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 transition-colors duration-300 group-hover:bg-blue-600 group-hover:text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-wider">Alumni Network</p>
                                    <p class="text-xl font-black text-slate-900">{{ number_format($totalUsers) }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 group">
                                <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 transition-colors duration-300 group-hover:bg-emerald-600 group-hover:text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-wider">Active Discussions</p>
                                    <p class="text-xl font-black text-slate-900">{{ number_format($activeDiscussions) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Suggested Connections -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                        <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center justify-between">
                            Suggested Alumni
                            <a href="{{ route('alumni.search') }}" class="text-xs text-blue-600 hover:underline">View all</a>
                        </h3>
                        <div class="space-y-4">
                            @foreach($suggestedConnections as $connection)
                                <div class="flex items-center justify-between group py-2 border-b border-slate-50 last:border-0">
                                    <div class="flex items-center gap-3">
                                        @if($connection->profile && $connection->profile->profile_picture)
                                            <img src="{{ asset('storage/' . $connection->profile->profile_picture) }}" alt="{{ $connection->name }}" class="w-8 h-8 rounded-full object-cover shadow-sm">
                                        @else
                                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center border border-slate-100 text-slate-300">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            </div>
                                        @endif
                                        <div class="overflow-hidden">
                                            <h4 class="font-bold text-slate-800 truncate text-[13px] hover:text-blue-600 transition-colors leading-tight">{{ $connection->name }}</h4>
                                            <p class="text-[9px] text-slate-400 font-semibold truncate">{{ $connection->profile->department ?? 'Alumni' }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('messages.show', $connection->id) }}" class="flex-shrink-0 px-3 py-1 text-[10px] font-bold text-slate-700 border border-slate-200 rounded-full hover:bg-slate-50 hover:border-slate-300 transition-all">Message</a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Upcoming Events -->
                    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-200">
                        <div class="relative">
                            <span class="inline-block px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest rounded-full mb-4">Featured Event</span>
                            <h4 class="text-slate-900 text-lg font-black leading-tight mb-2">Annual Alumni Meetup 2026</h4>
                            <p class="text-slate-500 text-[11px] mb-2 font-semibold flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Dec 15, 2026 • Grand Hall
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
