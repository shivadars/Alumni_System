<x-app-layout>
    <div class="pt-6 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 md:p-10 rounded-2xl shadow-sm border border-slate-200 mb-8">
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Departments</h1>
                <p class="text-slate-500 mt-2 text-lg font-medium">Select a department to view its alumni network</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($departments as $department)
                    <a href="{{ route('department.show', $department->name) }}" class="group bg-white p-8 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md hover:border-blue-200 transition-all duration-300 flex flex-col items-center text-center">
                        @if($department->profile && $department->profile->profile_picture)
                            <img src="{{ asset('storage/' . $department->profile->profile_picture) }}" alt="{{ $department->name }}" class="w-16 h-16 rounded-2xl object-cover shadow-sm mb-6 ring-4 ring-slate-50">
                        @else
                            <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                        @endif
                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-600 transition-colors">{{ $department->name }}</h3>
                        <p class="text-slate-500 mt-2 font-medium">View Alumni</p>
                    </a>
                @empty
                    <div class="col-span-full bg-white p-12 text-center rounded-2xl shadow-sm border border-slate-100">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">No departments found</h3>
                        <p class="text-slate-500 mt-2">There are currently no registered departments in the system.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
