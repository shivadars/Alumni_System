<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-black text-slate-900 mb-8 tracking-tight">Post New Event</h1>

            <div class="bg-white p-8 md:p-10 rounded-3xl shadow-sm border border-slate-200">
                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="title" value="Event Title" class="font-bold text-slate-700" />
                        <x-text-input id="title"
                            class="block mt-1 w-full bg-slate-50 border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-100"
                            type="text" name="title" :value="old('title')" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="description" value="About the Event" class="font-bold text-slate-700" />
                        <textarea id="description" name="description" rows="5"
                            class="block mt-1 w-full bg-slate-50 border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-100"
                            required>{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="location" value="Location" class="font-bold text-slate-700" />
                            <x-text-input id="location"
                                class="block mt-1 w-full bg-slate-50 border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-100"
                                type="text" name="location" :value="old('location')" required
                                placeholder="e.g. Grand Hall, Online" />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="event_date" value="Date & Time" class="font-bold text-slate-700" />
                            <x-text-input id="event_date"
                                class="block mt-1 w-full bg-slate-50 border-slate-200 rounded-xl focus:ring-4 focus:ring-blue-100"
                                type="datetime-local" name="event_date" :value="old('event_date')" required />
                            <x-input-error :messages="$errors->get('event_date')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="image" value="Cover Image (Optional)" class="font-bold text-slate-700" />
                        <div
                            class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-2xl bg-slate-50 hover:bg-slate-100 transition-colors cursor-pointer group relative">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-slate-400 group-hover:text-blue-500 transition-colors"
                                    stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-slate-600">
                                    <span
                                        class="relative cursor-pointer font-bold text-blue-600 hover:text-blue-500">Upload
                                        a file</span>
                                </div>
                                <p class="text-xs text-slate-500">PNG, JPG, GIF up to 2MB</p>
                            </div>
                            <input id="image" name="image" type="file"
                                class="absolute inset-0 opacity-0 cursor-pointer">
                        </div>
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6">
                        <a href="{{ route('events.index') }}"
                            class="text-sm font-bold text-slate-500 hover:text-slate-800 transition-colors">Cancel</a>
                        <button type="submit"
                            class="px-8 py-3 bg-blue-600 text-white font-black rounded-2xl hover:bg-blue-700 transition-all shadow-xl shadow-blue-100 transform active:scale-95">
                            Publish Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>