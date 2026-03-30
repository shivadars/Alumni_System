<x-app-layout>
    <div class="pt-6 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 md:p-10 rounded-2xl shadow-sm border border-slate-200 mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 text-blue-600 mb-2">
                         <a href="{{ route('department.index') }}" class="hover:underline flex items-center gap-1 font-bold text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            Back to Departments
                         </a>
                    </div>
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">{{ $department }} Alumni</h1>
                    <p class="text-slate-500 mt-2 text-lg font-medium">Showing all alumni in this department</p>
                </div>
                <div class="bg-blue-50 px-6 py-3 rounded-xl border border-blue-100">
                    <span class="text-blue-700 font-bold text-sm">{{ $alumni->count() }} Alumni Found</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($alumni as $user)
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all duration-300">
                        <div class="flex items-center gap-4 mb-6">
                            @if($user->profile && $user->profile->profile_picture)
                                <img src="{{ $user->profile->getProfilePictureUrl() }}" alt="{{ $user->name }}" class="w-16 h-16 rounded-full object-cover ring-4 ring-slate-50 shadow-sm">
                            @else
                                <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center border border-slate-200 text-slate-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                            @endif
                            <div>
                                <h4 class="font-bold text-slate-900 text-lg leading-tight">{{ $user->name }}</h4>
                                <p class="text-sm text-slate-400 font-semibold mt-1">{{ $user->profile->graduation_year ?? 'Alumni' }} Graduate</p>
                            </div>
                        </div>

                        <div class="space-y-3 mb-6">
                            @if($user->profile && $user->profile->company)
                                <div class="flex items-center gap-3 text-slate-600">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    <span class="text-sm font-medium">{{ $user->profile->company }}</span>
                                </div>
                            @endif
                            <div class="flex items-center gap-3 text-slate-600">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span class="text-sm font-medium">{{ $user->email }}</span>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-50 flex gap-3">
                            <a href="{{ route('profile.show', $user->id) }}" class="flex-1 text-center py-2.5 bg-slate-50 text-slate-700 text-sm font-bold rounded-xl hover:bg-slate-100 transition-colors">View Profile</a>
                            <a href="{{ route('messages.show', $user->id) }}" class="flex-1 text-center py-2.5 bg-blue-600 text-white text-sm font-bold rounded-xl hover:bg-blue-700 shadow-sm shadow-blue-100 transition-colors">Message</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white p-12 text-center rounded-2xl shadow-sm border border-slate-100">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">No alumni found</h3>
                        <p class="text-slate-500 mt-2">There are currently no alumni registered in this department.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
