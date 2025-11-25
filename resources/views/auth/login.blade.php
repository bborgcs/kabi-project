<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 bg-floralBg" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-floralOrange" />
            <x-text-input 
                id="email" 
                class="block mt-1 w-full border-lightBlue hover:border-lightOrange focus:border-floralOrange focus:ring-floralOrange" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="username" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-[#C2410C]" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-floralOrange" />

            <x-text-input 
                id="password" 
                class="block mt-1 w-full border-lightBlue hover:border-lightOrange focus:border-lightOrange focus:ring-floralOrange"
                type="password"
                name="password"
                required 
                autocomplete="current-password" 
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-[#C2410C]" />
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a 
                    class="underline text-sm text-lightBlue hover:text-floralBlue rounded-md" 
                    href="{{ route('password.request') }}"
                >
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3 bg-lightOrange hover:bg-floralOrange text-white focus:ring-floralBrown">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
