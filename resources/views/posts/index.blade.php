<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if(in_array(Auth::user()->role, ['alumni', 'department']))
                        <div class="text-center py-8">
                            <p class="text-gray-600 mb-4">{{ __('Ready to share something with the community?') }}</p>
                            <a href="{{ route('posts.create') }}" class="inline-flex items-center px-6 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Create New Post') }}
                            </a>
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            {{ __('Visit the Dashboard to see the latest community updates.') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
