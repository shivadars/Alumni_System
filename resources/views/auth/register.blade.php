<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign Up - {{ config('app.name', 'Connectwork') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50">
    <div class="relative w-full min-h-screen flex items-center justify-center overflow-hidden border p-4">
        
        <!-- Subtle branding background -->
        <div class="absolute inset-0 z-0">
             <img src="{{ asset('images/hero-bg.png') }}" class="w-full h-full object-cover opacity-10 filter blur-[2px]">
        </div>

      <!-- Register Card matching login design -->
      <div class="relative bg-white w-full max-w-lg p-6 sm:p-8 rounded-xl shadow-lg z-10 flex flex-col gap-6 border border-gray-100 my-8">
        
        <div class="flex justify-center mb-1">
            <img src="{{ asset('images/logo.png') }}" alt="Connectwork" class="h-8 w-auto">
        </div>
        
        <h2 class="text-2xl font-bold text-center text-gray-900">Create an Account</h2>

        <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-4.5">
            @csrf
            
            <!-- Name -->
            <div>
              <label for="name" class="block text-sm font-medium mb-1 text-gray-900">Full Name</label>
              <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-all text-sm" required autofocus>
              <x-input-error :messages="$errors->get('name')" class="mt-1.5 text-xs text-red-500 font-medium" />
            </div>

            <!-- Role -->
            <div class="mt-4">
              <label for="role" class="block text-sm font-medium mb-1 text-gray-900">I am a...</label>
              <select id="role" name="role" class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-all text-sm bg-white" required>
                  <option value="" disabled selected>Select your role</option>
                  <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                  <option value="alumni" {{ old('role') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                  <option value="department" {{ old('role') == 'department' ? 'selected' : '' }}>Department</option>
              </select>
              <x-input-error :messages="$errors->get('role')" class="mt-1.5 text-xs text-red-500 font-medium" />
            </div>
            
            <!-- Email -->
            <div class="mt-4">
              <label for="email" class="block text-sm font-medium mb-1 text-gray-900">Email Address</label>
              <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="you@connectwork.edu" class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-all text-sm" required>
              <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-500 font-medium" />
            </div>
            
            <!-- Passwords -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
              <!-- Password -->
              <div>
                <label for="password" class="block text-sm font-medium mb-1 text-gray-900">Password</label>
                <input id="password" type="password" name="password" placeholder="••••••••" class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-all text-sm" required>
                <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-red-500 font-medium" />
              </div>

              <!-- Confirm Password -->
              <div>
                <label for="password_confirmation" class="block text-sm font-medium mb-1 text-gray-900">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="••••••••" class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-all text-sm" required>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5 text-xs text-red-500 font-medium" />
              </div>
            </div>

            <button type="submit" class="w-full mt-6 bg-gray-900 hover:bg-gray-800 text-white font-medium py-2 px-4 rounded-md transition-colors shadow-sm text-sm">
                Create Account
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 -mt-1">
          Already have an account? <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium hover:text-blue-700">Sign in</a>
        </p>
      </div>
    </div>
</body>
</html>
