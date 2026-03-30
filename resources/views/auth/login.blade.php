<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign In - {{ config('app.name', 'Connectwork') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50">
    <div class="relative w-full min-h-screen flex items-center justify-center overflow-hidden border">
        
        <!-- Subtle branding background -->
        <div class="absolute inset-0 z-0">
             <img src="{{ asset('images/hero-bg.png') }}" class="w-full h-full object-cover opacity-10 filter blur-[2px]">
        </div>

      <!-- Login Card matching 5.txt -->
      <div class="relative bg-white w-full max-w-md p-8 rounded-xl shadow-lg z-10 flex flex-col gap-6 border border-gray-100">
        
        <div class="flex justify-center mb-1">
            <img src="{{ asset('images/logo.png') }}" alt="Connectwork" class="h-8 w-auto">
        </div>
        
        <h2 class="text-2xl font-bold text-center text-gray-900">Sign In</h2>

        <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-6">
            @csrf
            
            <div class="flex flex-col gap-4">
              <div>
                <label for="email" class="block text-sm font-medium mb-1.5 text-gray-900">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-all text-sm" required autofocus>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-500 font-medium" />
              </div>
              
              <div>
                <div class="flex justify-between items-center mb-1.5">
                    <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs text-blue-600 hover:underline font-medium">Forgot password?</a>
                    @endif
                </div>
                <input id="password" type="password" name="password" placeholder="••••••••" class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900 transition-all text-sm" required>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500 font-medium" />
              </div>
            </div>
    
            <div class="flex items-center -mt-2">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-gray-900 focus:ring-gray-900 w-4 h-4" name="remember">
                <label for="remember_me" class="ms-2 text-sm text-gray-600 cursor-pointer">Remember me</label>
            </div>

            <button type="submit" class="w-full mt-2 bg-gray-900 hover:bg-gray-800 text-white font-medium py-2 px-4 rounded-md transition-colors shadow-sm text-sm">
                Login
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-2 mb-1">
          Don’t have an account? <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-medium hover:text-blue-700">Sign up</a>
        </p>
      </div>
    </div>
</body>
</html>
