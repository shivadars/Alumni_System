<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            

            <div class="max-w-4xl mx-auto w-full space-y-6">
                
                <!-- Main Header Card (LinkedIn Style) -->
                <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                    <!-- Cover Banner (Gradient Placeholder) -->
                    <div class="h-48 md:h-64 w-full bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 relative">
                        @if($user->id === Auth::id())
                            <a href="{{ route('profile.edit-details') }}" class="absolute top-4 right-4 bg-white/20 hover:bg-white/40 backdrop-blur-md text-white p-2 rounded-full transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                        @endif
                    </div>

                    <!-- Profile Info Area -->
                    <div class="px-6 md:px-10 pb-8 relative">
                        
                        <!-- Profile Picture Overlay -->
                        <div class="flex justify-between items-end -mt-16 md:-mt-24 mb-4 relative z-10">
                            <div class="relative w-32 h-32 md:w-40 md:h-40 rounded-full bg-white p-1.5 ring-1 ring-slate-100 shadow-xl">
                                @if($user->profile && $user->profile->profile_picture)
                                    <img src="{{ $user->profile->getProfilePictureUrl() }}" alt="{{ $user->name }}" class="w-full h-full rounded-full object-cover">
                                @else
                                    <div class="w-full h-full rounded-full bg-slate-100 flex items-center justify-center text-slate-300">
                                        <svg class="w-16 h-16 md:w-20 md:h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            
                            @if($user->id !== Auth::id())
                                <a href="{{ route('messages.show', $user->id) }}" class="mb-4 inline-flex items-center gap-2 px-6 py-2 bg-blue-600 text-white rounded-full font-bold text-sm hover:bg-blue-700 transition-all shadow-md">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                    Message
                                </a>
                            @endif
                        </div>

                        <!-- Name and Headline -->
                        <div>
                            <h1 class="text-3xl font-black text-slate-900 tracking-tight">{{ $user->name }}</h1>
                            <p class="text-lg text-slate-700 font-medium mt-1">
                                {{ ucfirst($user->role) }} 
                                @if($user->profile && $user->profile->department)
                                    • {{ $user->profile->department }}
                                @endif
                            </p>
                            
                            <!-- Location & Contact -->
                            <div class="flex flex-wrap items-center gap-4 mt-3 text-sm text-slate-500 font-medium">
                                @if($user->profile?->location)
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $user->profile->location }}
                                    </div>
                                @endif
                                
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    <a href="mailto:{{ $user->email }}" class="hover:text-blue-600 transition-colors">{{ $user->email }}</a>
                                </div>
                                
                                @if($user->profile?->phone)
                                    <div class="flex items-center gap-1.5 mb-1 sm:mb-0">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l.148.441.465 1.396a1 1 0 01-.252.923L8.33 7.644a15.207 15.207 0 006.012 6.012l1.253-1.253a1 1 0 01.923-.252l1.396.465.441.148a1 1 0 01.684.948V19a2 2 0 01-2 2h-3.28a1 1 0 01-.948-.684l-.148-.441-2.087-6.262-6.262-2.087-.441-.148A1 1 0 013 8.33V5z"></path></svg>
                                        {{ $user->profile->phone }}
                                    </div>
                                @endif

                                @if($user->profile?->linkedin_url)
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-[#0077b5]" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                        <a href="{{ $user->profile->linkedin_url }}" target="_blank" class="text-[#0077b5] font-bold hover:underline transition-colors uppercase tracking-tight text-[10px]">LinkedIn Profile</a>
                                    </div>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>

                <!-- About Section Card -->
                <div class="bg-white p-8 md:p-10 rounded-3xl shadow-sm border border-slate-200">
                    <h3 class="text-xl font-bold text-slate-900 mb-4 tracking-tight">About</h3>
                    <p class="text-slate-700 leading-relaxed font-medium">
                        {{ $user->profile?->bio ?? 'Passionate about web development and building innovative solutions. I am committed to learning and growing in the field of technology.' }}
                    </p>
                </div>

                @if($user->role !== 'department')
                    <!-- Academic/Experience Card -->
                    <div class="bg-white p-8 md:p-10 rounded-3xl shadow-sm border border-slate-200">
                        <h3 class="text-xl font-bold text-slate-900 mb-6 tracking-tight">Academic Background</h3>
                        
                        <div class="flex items-start gap-5">
                            <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 flex-shrink-0 mt-1">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-slate-900">{{ $user->profile?->department ?? 'General Department' }}</h4>
                                <p class="text-sm font-semibold text-slate-600 mt-1">
                                    Batch of {{ $user->profile?->graduation_year ?? $user->profile?->year ?? '2027' }} 
                                    • Year {{ $user->profile?->year ?? 'N/A' }}
                                </p>
                                <p class="text-sm text-slate-500 mt-2">
                                    Roll Number: <span class="font-medium font-mono text-slate-700 bg-slate-50 px-2 py-0.5 rounded">{{ $user->profile?->roll_number ?? 'Not specified' }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Skills Section -->
                    <div class="bg-white p-8 md:p-10 rounded-3xl shadow-sm border border-slate-200">
                        <h3 class="text-xl font-bold text-slate-900 mb-6 tracking-tight">Skills</h3>
                        <div class="flex flex-wrap gap-2">
                            @if($user->profile?->skills)
                                @foreach(explode(',', $user->profile->skills) as $skill)
                                    <span class="px-4 py-2 bg-slate-100 text-slate-700 text-sm font-bold rounded-lg hover:bg-slate-200 transition-colors cursor-default">{{ trim($skill) }}</span>
                                @endforeach
                            @else
                                <p class="text-slate-500 font-medium italic">No skills listed yet.</p>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Activity / Posts Card -->
                <div class="mt-8">
                    <h3 class="text-xl font-bold text-slate-900 mb-6 tracking-tight flex items-center gap-2">
                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM7 8h10M7 12h10M7 16h6"></path></svg>
                        Activity
                    </h3>
                    
                    @if(isset($posts) && $posts->count() > 0)
                        <div class="space-y-6">
                            @foreach($posts as $post)
                                <x-post-card :post="$post" />
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white p-8 md:p-10 rounded-3xl shadow-sm border border-slate-200 text-center">
                            <p class="text-slate-500 font-medium italic">No posts yet.</p>
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
