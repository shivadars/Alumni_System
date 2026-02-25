<x-app-layout>
    <div class="py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Section -->
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">My Info</h1>
                    <p class="text-slate-500 font-medium">View and manage your profile information</p>
                </div>
                @if($user->id === Auth::id())
                    <a href="{{ route('profile.edit-details') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-900 text-white rounded-xl font-bold text-sm hover:bg-black transition-all shadow-lg active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Edit Profile
                    </a>
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start w-full">
                
                <!-- Sidebar (Left Column - Narrower) -->
                <div class="lg:col-span-3 space-y-6 w-full">
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200 text-center w-full">
                        <!-- Profile Image -->
                        <div class="relative w-32 h-32 mx-auto mb-6">
                            @if($user->profile && $user->profile->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile->profile_picture) }}" alt="{{ $user->name }}" class="w-full h-full rounded-full object-cover ring-8 ring-slate-50 shadow-inner">
                            @else
                                <div class="w-full h-full rounded-full bg-slate-50 flex items-center justify-center border border-slate-100 text-slate-300 ring-8 ring-slate-50 shadow-inner">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                            @endif
                            @if($user->id === Auth::id())
                                <a href="{{ route('profile.edit-details') }}" class="absolute bottom-1 right-1 w-8 h-8 bg-slate-900 text-white rounded-full flex items-center justify-center border-2 border-white shadow-lg hover:bg-black transition-all">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </a>
                            @endif
                        </div>

                        <h2 class="text-xl font-black text-slate-900 mb-1 tracking-tight">{{ $user->name }}</h2>
                        <p class="text-[10px] text-slate-500 font-bold tracking-widest uppercase mb-3">{{ $user->role }}</p>
                        <span class="inline-block px-3 py-1 bg-slate-50 text-slate-700 text-[10px] font-black rounded-full border border-slate-100">{{ $user->profile?->department ?? 'General' }}</span>

                        <!-- Contact Info -->
                        <div class="mt-8 space-y-3 text-left border-t border-slate-50 pt-6">
                            <div class="flex items-center gap-3 group">
                                <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <span class="text-[11px] font-bold text-slate-500 truncate">{{ $user->email }}</span>
                            </div>
                            @if($user->profile?->phone)
                                <div class="flex items-center gap-3 group">
                                    <div class="w-7 h-7 rounded-lg bg-green-50 flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l.148.441.465 1.396a1 1 0 01-.252.923L8.33 7.644a15.207 15.207 0 006.012 6.012l1.253-1.253a1 1 0 01.923-.252l1.396.465.441.148a1 1 0 01.684.948V19a2 2 0 01-2 2h-3.28a1 1 0 01-.948-.684l-.148-.441-2.087-6.262-6.262-2.087-.441-.148A1 1 0 013 8.33V5z"></path></svg>
                                    </div>
                                    <span class="text-[11px] font-bold text-slate-500">{{ $user->profile->phone }}</span>
                                </div>
                            @endif
                            <div class="flex items-center gap-3 group">
                                <div class="w-7 h-7 rounded-lg bg-orange-50 flex items-center justify-center text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <span class="text-[11px] font-bold text-slate-500">{{ $user->profile?->location ?? 'Not specified' }}</span>
                            </div>
                        </div>

                        <!-- Info Badges -->
                        <div class="grid grid-cols-2 gap-3 mt-8">
                            <div class="bg-blue-50/50 p-3 rounded-2xl border border-blue-100">
                                <p class="text-[9px] font-black uppercase tracking-widest text-blue-400 mb-1">Batch</p>
                                <p class="text-[11px] font-black text-blue-900">{{ $user->profile?->graduation_year ?? $user->profile?->year ?? '2024' }}</p>
                            </div>
                            <div class="bg-purple-50/50 p-3 rounded-2xl border border-purple-100">
                                <p class="text-[9px] font-black uppercase tracking-widest text-purple-400 mb-1">Year</p>
                                <p class="text-[11px] font-black text-purple-900">{{ $user->profile?->year ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content (Right Column - Wider) -->
                <div class="lg:col-span-9 space-y-6 w-full">
                    
                    <!-- Academic Information -->
                    <div class="bg-white p-10 rounded-3xl shadow-sm border border-slate-200">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                            </div>
                            <h3 class="text-xl font-black text-slate-900 tracking-tight">Academic Information</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Department</p>
                                <p class="text-lg font-black text-slate-800">{{ $user->profile?->department ?? 'Computer Science' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Current Year</p>
                                <p class="text-lg font-black text-slate-800">Year {{ $user->profile?->year ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Batch</p>
                                <p class="text-lg font-black text-slate-800">{{ $user->profile?->graduation_year ?? '2023-2027' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Roll Number</p>
                                <p class="text-lg font-black text-slate-800">{{ $user->profile?->roll_number ?? 'CS2023042' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Bio Section -->
                    <div class="bg-white p-10 rounded-3xl shadow-sm border border-slate-200">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h3m2.457-2.857L17 20l5-8.5a11 11 0 10-18.457 1.143L6 20l4.543-8.857z"></path></svg>
                            </div>
                            <h3 class="text-xl font-black text-slate-900 tracking-tight">Bio</h3>
                        </div>
                        <p class="text-slate-600 leading-relaxed font-medium">
                            {{ $user->profile?->bio ?? 'Passionate about web development and building innovative solutions. I am committed to learning and growing in the field of technology.' }}
                        </p>
                    </div>

                    <!-- Skills Section -->
                    <div class="bg-white p-10 rounded-3xl shadow-sm border border-slate-200">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center text-green-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                            </div>
                            <h3 class="text-xl font-black text-slate-900 tracking-tight">Skills</h3>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            @if($user->profile?->skills)
                                @foreach(explode(',', $user->profile->skills) as $skill)
                                    <span class="px-5 py-2.5 bg-slate-50 text-slate-700 text-xs font-black rounded-xl border border-slate-100 hover:bg-slate-900 hover:text-white transition-all cursor-default">{{ trim($skill) }}</span>
                                @endforeach
                            @else
                                <p class="text-slate-400 font-bold italic">No skills listed yet.</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
