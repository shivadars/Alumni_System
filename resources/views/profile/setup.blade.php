<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($profile) ? __('Edit Your Profile') : __('Complete Your Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('profile.store-details') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Profile Picture -->
                        <div class="mb-4">
                            <x-input-label for="profile_picture" :value="__('Profile Picture')" />
                            @if(isset($profile) && $profile->profile_picture)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profile Picture" class="w-8 h-8 rounded-full object-cover">
                                </div>
                            @endif
                            <input id="profile_picture" type="file" name="profile_picture" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            <x-input-error :messages="$errors->get('profile_picture')" class="mt-2" />
                        </div>

                        <!-- Department -->
                        <div class="mt-4">
                            <x-input-label for="department" :value="__('Department')" />
                            <x-text-input id="department" class="block mt-1 w-full" type="text" name="department" :value="old('department', $profile->department ?? '')" required autofocus />
                            <x-input-error :messages="$errors->get('department')" class="mt-2" />
                        </div>

                        <!-- Role Specific Fields -->
                        @if ($user->role === 'student')
                            <!-- Year (Student) -->
                            <div class="mt-4">
                                <x-input-label for="year" :value="__('Year (e.g., 2nd Year, 2026)')" />
                                <x-text-input id="year" class="block mt-1 w-full" type="text" name="year" :value="old('year', $profile->year ?? '')" required />
                                <x-input-error :messages="$errors->get('year')" class="mt-2" />
                            </div>
                        @endif

                        @if ($user->role === 'alumni')
                            <!-- Graduation Year (Alumni) -->
                            <div class="mt-4">
                                <x-input-label for="graduation_year" :value="__('Graduation Year')" />
                                <x-text-input id="graduation_year" class="block mt-1 w-full" type="text" name="graduation_year" :value="old('graduation_year', $profile->graduation_year ?? '')" required />
                                <x-input-error :messages="$errors->get('graduation_year')" class="mt-2" />
                            </div>

                            <!-- Company (Alumni) -->
                            <div class="mt-4">
                                <x-input-label for="company" :value="__('Current Company')" />
                                <x-text-input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company', $profile->company ?? '')" required />
                                <x-input-error :messages="$errors->get('company')" class="mt-2" />
                            </div>
                        @endif

                        <!-- Contact & Location -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <!-- Phone -->
                            <div>
                                <x-input-label for="phone" :value="__('Phone Number')" />
                                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $profile->phone ?? '')" placeholder="+91 XXXX XXX XXX" />
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>

                            <!-- Location -->
                            <div>
                                <x-input-label for="location" :value="__('Location')" />
                                <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location', $profile->location ?? '')" placeholder="e.g Kochi, Kerala" />
                                <x-input-error :messages="$errors->get('location')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Web & Roll -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <!-- LinkedIn -->
                            <div>
                                <x-input-label for="linkedin_url" :value="__('LinkedIn Profile URL')" />
                                <x-text-input id="linkedin_url" class="block mt-1 w-full" type="url" name="linkedin_url" :value="old('linkedin_url', $profile->linkedin_url ?? '')" placeholder="https://linkedin.com/in/username" />
                                <x-input-error :messages="$errors->get('linkedin_url')" class="mt-2" />
                            </div>

                            <!-- Roll Number -->
                            @if ($user->role !== 'department')
                                <div>
                                    <x-input-label for="roll_number" :value="__('Roll Number / ID')" />
                                    <x-text-input id="roll_number" class="block mt-1 w-full" type="text" name="roll_number" :value="old('roll_number', $profile->roll_number ?? '')" />
                                    <x-input-error :messages="$errors->get('roll_number')" class="mt-2" />
                                </div>
                            @endif
                        </div>

                        <!-- Skills -->
                        @if ($user->role !== 'department')
                            <div class="mt-4">
                                <x-input-label for="skills" :value="__('Skills (Comma separated)')" />
                                <x-text-input id="skills" class="block mt-1 w-full" type="text" name="skills" :value="old('skills', $profile->skills ?? '')" placeholder="PHP, Laravel, TailwindCSS" />
                                <x-input-error :messages="$errors->get('skills')" class="mt-2" />
                            </div>
                        @endif

                        <!-- Bio -->
                        <div class="mt-4">
                            <x-input-label for="bio" :value="__('Bio')" />
                            <textarea id="bio" name="bio" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4">{{ old('bio', $profile->bio ?? '') }}</textarea>
                            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Save Profile') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
