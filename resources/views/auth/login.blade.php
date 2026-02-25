<x-guest-layout>
    <div class="space-y-8">
        <!-- Brand Logo -->
        <div class="flex justify-center pb-2">
            <img src="{{ asset('images/logo.png') }}" alt="alumni-system Logo" class="h-16 w-auto">
        </div>

        <!-- Title Section -->
        <div class="text-center space-y-1">
            <h2 class="text-2xl font-bold text-slate-800">Welcome Back</h2>
            <p class="text-sm text-slate-500">Log into your alumni-system account</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div class="space-y-1">
                <label for="email" class="block text-xs font-bold text-slate-600 uppercase">Email</label>
                <input id="email" 
                       type="email" 
                       name="email" 
                       :value="old('email')" 
                       required autofocus autocomplete="username"
                       placeholder="you@domain.com"
                       class="w-full px-4 py-3 rounded border border-slate-300 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all placeholder:text-slate-400">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
            </div>

            <!-- Password -->
            <div class="space-y-1">
                <label for="password" class="block text-xs font-bold text-slate-600 uppercase">Password</label>
                <input id="password" 
                       type="password"
                       name="password"
                       required autocomplete="current-password"
                       placeholder="••••••••"
                       class="w-full px-4 py-3 rounded border border-slate-300 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all placeholder:text-slate-400">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
            </div>

            <!-- Options -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500" name="remember">
                    <span class="ms-2 text-xs text-slate-600">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-xs text-blue-600 font-bold hover:underline" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Button -->
            <div class="pt-2">
                <button type="submit" 
                        class="w-full py-3.5 rounded bg-blue-600 hover:bg-blue-700 text-white font-bold transition-colors shadow shadow-blue-500/20">
                    Log in
                </button>
            </div>

            <!-- Register -->
            <div class="text-center pt-6 border-t border-slate-100">
                <p class="text-xs text-slate-500">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">
                        Register Now
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
