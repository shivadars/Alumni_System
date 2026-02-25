<x-guest-layout>
    <div class="space-y-6">
        <!-- 9️⃣ Small Logo Above Form -->
        <div class="flex justify-center mb-2">
            <img src="{{ asset('images/logo.png') }}" alt="Connectwork Logo" class="h-16 w-auto">
        </div>

        <!-- 3️⃣ Title Above Form -->
        <div class="text-center">
            <h2 class="text-[28px] font-bold text-gray-900 leading-tight">Welcome Back</h2>
            <p class="text-gray-500 mt-1">Login to your account</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <!-- 4️⃣ Improved Input Boxes -->
                <input id="email" 
                       type="email" 
                       name="email" 
                       :value="old('email')" 
                       required autofocus autocomplete="username"
                       class="w-full px-[12px] py-[12px] rounded-[8px] border border-[#ddd] focus:outline-none focus:border-[#2563eb] focus:ring-0 transition-all">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input id="password" 
                       type="password"
                       name="password"
                       required autocomplete="current-password"
                       class="w-full px-[12px] py-[12px] rounded-[8px] border border-[#ddd] focus:outline-none focus:border-[#2563eb] focus:ring-0 transition-all">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between mt-2">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <!-- 8️⃣ Improve Links -->
                    <a class="text-sm text-blue-600 hover:underline font-medium" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- 5️⃣ Improve Login Button -->
            <div class="pt-2">
                <button type="submit" 
                        class="w-full py-[14px] rounded-[8px] text-white font-semibold border-none transition-colors shadow-lg shadow-blue-500/20"
                        style="background-color: #3898EC !important;">
                    Log in
                </button>
            </div>

            <!-- Register Link -->
            <div class="text-center pt-4 border-t border-gray-100">
                <p class="text-sm text-gray-600">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-bold">
                        Register Now
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
