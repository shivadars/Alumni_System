<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Card (Figma Match) -->
            <div class="bg-white p-10 rounded-3xl shadow-sm border border-slate-200 mb-8 overflow-hidden relative">
                <div class="relative z-10 flex items-center gap-8">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 flex-shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <div>
                        <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight">Find Alumni</h1>
                        <p class="text-slate-500 mt-1 text-lg font-medium">Search and connect with alumni from your institution</p>
                    </div>
                </div>
            </div>

            <!-- Search Filters (Figma Match) -->
            <div class="bg-white p-10 rounded-3xl shadow-sm border border-slate-200 mb-8">
                <form method="GET" action="{{ route('alumni.search') }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <div>
                            <label class="block text-sm font-bold text-slate-800 mb-3">Name</label>
                            <input type="text" name="name" value="{{ request('name') }}" placeholder="Search by name..." 
                                class="w-full bg-slate-50 border-slate-100 rounded-xl px-5 py-3.5 text-sm font-medium focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none text-slate-700">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-800 mb-3">Department</label>
                            <input type="text" name="department" value="{{ request('department') }}" placeholder="e.g Computer Science" 
                                class="w-full bg-slate-50 border-slate-100 rounded-xl px-5 py-3.5 text-sm font-medium focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none text-slate-700">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-800 mb-3">Graduation Year</label>
                            <select name="graduation_year" 
                                class="w-full bg-slate-50 border-slate-100 rounded-xl px-5 py-3.5 text-sm font-medium focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none appearance-none text-slate-700">
                                <option value="">Select year</option>
                                @foreach($graduationYears as $year)
                                    <option value="{{ $year }}" {{ request('graduation_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-800 mb-3">Company</label>
                            <input type="text" name="company" value="{{ request('company') }}" placeholder="Search by company..." 
                                class="w-full bg-slate-50 border-slate-100 rounded-xl px-5 py-3.5 text-sm font-medium focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 transition-all outline-none text-slate-700">
                        </div>
                    </div>
                    <div class="flex items-center gap-4 mt-10">
                        <button type="submit" class="inline-flex items-center gap-2 px-8 py-3.5 bg-slate-900 text-white rounded-xl font-bold text-sm hover:bg-black transition-all shadow-xl active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            Search Alumni
                        </button>
                        <a href="{{ route('alumni.search') }}" class="px-8 py-3.5 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold text-sm hover:bg-slate-50 transition-all">Reset</a>
                    </div>
                </form>
            </div>

            <!-- Found Count -->
            <div class="mb-6 px-1">
                <p class="text-slate-400 font-bold text-sm tracking-wide">
                    Found <span class="text-slate-900">{{ $alumni->total() }}</span> alumni
                </p>
            </div>

            <!-- Alumni List (Precisely like Mockup) -->
            <div class="space-y-4">
                @forelse($alumni as $alumnus)
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-8 hover:shadow-md transition-all duration-300 group">
                        <div class="flex items-center gap-8">
                            <!-- Avatar -->
                            <div class="flex-shrink-0">
                                @if($alumnus->profile && $alumnus->profile->profile_picture)
                                    <img src="{{ asset('storage/' . $alumnus->profile->profile_picture) }}" alt="{{ $alumnus->name }}" class="w-20 h-20 rounded-full object-cover ring-8 ring-slate-50 shadow-sm">
                                @else
                                    <div class="w-20 h-20 rounded-full bg-slate-50 flex items-center justify-center border border-slate-100 text-slate-300">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Details -->
                            <div>
                                <h3 class="text-2xl font-black text-slate-900 mb-1 group-hover:text-blue-600 transition-colors">{{ $alumnus->name }}</h3>
                                <p class="text-slate-500 font-bold text-sm mb-4">{{ $alumnus->profile->company ?? 'Alumnus' }}</p>
                                
                                <div class="flex flex-wrap items-center gap-x-8 gap-y-3">
                                    @if($alumnus->profile->department)
                                        <div class="flex items-center gap-2 text-[13px] font-bold text-slate-400">
                                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                                            {{ $alumnus->profile->department }}
                                        </div>
                                    @endif
                                    @if($alumnus->profile->graduation_year)
                                        <div class="flex items-center gap-2 text-[13px] font-bold text-slate-400">
                                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            Batch {{ $alumnus->profile->graduation_year }}
                                        </div>
                                    @endif
                                    @if($alumnus->profile->bio)
                                        <div class="flex items-center gap-2 text-[13px] font-bold text-slate-400">
                                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ \Illuminate\Support\Str::limit($alumnus->profile->bio, 40) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Actions (Aligned to Right) -->
                        <div class="flex flex-row md:flex-col gap-3 min-w-[160px]">
                            <a href="{{ route('messages.show', $alumnus->id) }}" class="flex items-center justify-center gap-2 px-6 py-3 bg-slate-900 text-white rounded-xl font-bold text-xs shadow-lg hover:bg-black transition-all active:scale-95">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                Message
                            </a>
                            <a href="{{ route('profile.show', ['user' => $alumnus->id]) }}" class="flex items-center justify-center px-6 py-3 bg-white border border-slate-200 text-slate-700 rounded-xl font-bold text-xs hover:bg-slate-50 transition-all shadow-sm">
                                View Profile
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-20 text-center rounded-3xl shadow-sm border border-slate-100">
                        <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-8 text-slate-200">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 200 000-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <h3 class="text-3xl font-black text-slate-900 tracking-tight">No results matched your search</h3>
                        <p class="text-slate-500 mt-3 text-lg font-medium">Try clearing your filters to see more alumni.</p>
                        <a href="{{ route('alumni.search') }}" class="inline-block mt-10 text-blue-600 font-extrabold hover:text-blue-700 text-sm tracking-widest uppercase italic">Clear Filters</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-16">
                {{ $alumni->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
