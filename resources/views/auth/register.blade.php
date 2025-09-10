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
    <div class="flex flex-col md:flex-row">
        <img src="{{ asset('img/login.jpg') }}" alt=""
            class="hidden md:block md:w-2/5 h-screen object-cover bg-left">
        <div class="hidden md:block w-0.5 bg-purple-400"></div> <!-- Garis Vertikal -->
        <div class="md:w-3/5 text-center px-6 md:px-20 py-10 shadow-md">
            <h3 class="text-4xl font-bold text-purple-500">WELCOME</h3>
            <h5 class="text-xl font-bold text-gray-800 mt-3">Silahkan Daftar</h5>
            <div class="container md:bg-gray-100 mt-3 mx-auto p-5 rounded-md">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    {{-- form nama --}}
                    <div class="mt-2">
                        <x-input-label for="name" :value="__('Nama')"
                            class="text-start font-semibold text-gray-900" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    {{-- form email --}}
                    <div class="mt-2">
                        <x-input-label for="email" :value="__('Email')"
                            class="text-start font-semibold text-gray-900" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    {{-- form password --}}
                    <div class="mt-2">
                        <x-input-label for="password" :value="__('Password')"
                            class="text-start font-semibold text-gray-900" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    {{-- form confirm password --}}
                    <div class="mt-2">
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')"
                            class="text-start font-semibold text-gray-900" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    {{-- already account? --}}
                    <p class="text-sm mt-2 font-semibold">Sudah punya akun? Silahkan
                        <a href="{{ route('login') }}" class="text-purple-600 hover:opacity-50">login di sini!</a>
                    </p>
                    <x-primary-button class="ms-4">
                        {{ __('Daftar') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
