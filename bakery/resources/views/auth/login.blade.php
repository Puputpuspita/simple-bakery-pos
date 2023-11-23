<x-guest-layout>
<section class="text-gray-600 body-font">
    <div class="container px-5 py-10 mx-auto flex flex-wrap items-center">
        <div class="lg:w-3/5 md:w-1/2 md:pr-16 lg:pr-0 pr-0">
   
            <img class="object-cover object-center rounded" alt="hero" src="{{ asset('images/clip-online-shopping-1.png') }}">
        </div>
        <div class="xl:mx-auto 2xl:mx-auto lg:w-2/6 md:w-1/2 bg-white rounded-lg p-8 flex flex-col md:ml-auto w-full shadow-md">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="relative mb-4">
                    <label for="email" :value="__('Email')" class="leading-7 text-sm text-gray-600">Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" class="w-full rounded bg-white border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required autofocus>
                </div>
                <div class="relative mb-4">
                    <label for="password" :value="__('Password')" class="leading-7 text-sm text-gray-600">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" class="w-full rounded bg-white border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
                <div class="relative mb-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <button class="w-full rounded-full text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 text-lg mb-2">{{ __('Log in') }}</button>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif 
            </form>
        </div>
    </div>
</section>
</x-guest-layout>
