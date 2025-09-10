<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MEC Ngawi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-purple-50 font-roboto-condensed animate-fade-in">
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="flex flex-col md:flex-row">
        <img src="{{ asset('img/login.jpg') }}" alt=""
            class="hidden md:block md:w-2/5 h-screen object-cover bg-left">
        <div class="hidden md:block w-0.5 bg-purple-400"></div> <!-- Garis Vertikal -->
        <div class="md:w-3/5 text-center px-6 md:px-20 py-10">
            <h3 class="text-4xl font-bold text-purple-500 mt-10">WELCOME</h3>
            <h5 class="text-xl font-bold text-gray-800 mt-5">Silahkan Login</h5>
            <div class="container md:bg-gray-100 mt-5 mx-auto p-5 rounded-md shadow-md">
                @if (session('status'))
                    <x-alert-success :message="session('status')" />
                @endif
                {{-- form login --}}
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        {{-- <label for="email"
                            class="block text-sm/6 font-semibold text-gray-900 text-start">Email</label> --}}
                        <div class="mt-2.5">
                            <x-input-label for="email" :value="__('Email')"
                                class="text-start text-gray-900 font-semibold" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <x-input-label for="password" :value="__('Password')"
                            class="text-start text-gray-900 font-semibold" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="">
                        {{-- Belum daftar --}}
                        @if (Route::has('register'))
                            <p class="text-sm mt-7 font-semibold">Belum punya akun? Silahkan
                                <a href="{{ route('register') }}" class="text-purple-600 hover:opacity-50">daftar di
                                    sini!</a>
                            </p>
                        @endif
                        {{-- Lupa password --}}
                        @if (Route::has('password.request'))
                            <a class="font-semibold text-sm text-purple-600 hover:opacity-50 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                href="{{ route('password.request') }}">
                                {{ __('Lupa password?') }}
                            </a>
                        @endif
                    </div>
                    <button type="submit"
                        class="inline-block rounded-2xl border border-violet-800 bg-white px-8 py-2 text-center font-medium text-purple-600 hover:bg-gray-50 mt-5">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
