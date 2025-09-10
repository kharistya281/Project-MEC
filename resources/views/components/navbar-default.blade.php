{{-- navbar start --}}
<nav class="sticky top-0 transform bg-purple-50 max-sm:px-1 z-50">
    <div class="container mx-auto px-4 flex justify-between items-center py-4 relative transition duration-500 ease-in-out">
        {{-- logo --}}
        <a href="/" class="">
            <img src="{{ asset('img/logo.png') }}" alt="" class="size-12 rounded-full">
        </a>
        {{-- navigation links --}}
        <div class="absolute left-1/2 -translate-x-1/2 space-x-6 font-semibold hidden md:flex">
            <a href="/program" class="text-purple-700 hover:text-gray-600 transition duration-300 ease-in-out">Program</a>
            <a href="/#tutor"
                class="text-purple-700 hover:text-gray-600 transition duration-300 ease-in-out mb-1">Tutor</a>
            <a href="/#testimoni"
                class="text-purple-700 hover:text-gray-600 transition duration-300 ease-in-out">Testimoni</a>
            <a href="/#aboutus" class="text-purple-700 hover:text-gray-600 transition duration-300 ease-in-out">Tentang
                Kami</a>
            {{-- <a href="" class="text-purple-700 hover:text-gray-600 transition duration-300 ease-in-out">Kontak</a> --}}
        </div>
        <div class="space-x-3 hidden md:flex ml-auto">
            <a href="{{ route('login') }}"
                class="rounded-2xl border border-purple-500 bg-white px-8 py-3 text-center font-medium text-purple-600 hover:bg-gray-100">Masuk</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="rounded-2xl border-purple-500 bg-gradient-to-br from-purple-600 to-amber-300 px-8 py-3 text-center font-medium text-white hover:opacity-80">Buat
                    Akun</a>
            @endif
        </div>
        <div class="relative">
            <x-ionicon-menu-outline class="hamburger-icon md:hidden sm:items-end mr-3 h-8 w-8" />
            <x-ionicon-close-sharp class="close-icon hidden md:hidden w-8 h-8 cursor-pointer"/>
        </div>
    </div>
    {{-- mobile responsive --}}
    <div class="md:hidden">
        <div class="menu absolute top-16 container hidden flex-col bg-purple-50 shadow-md inset-x-0 mx-auto py-5">
            <a href="/program"
                class="text-purple-700 hover:text-gray-600 transition duration-300 ease-in-out mb-1">Program</a>
            <a href="/#tutor"
                class="text-purple-700 hover:text-gray-600 transition duration-300 ease-in-out mb-1">Tutor</a>
            <a href="/#testimoni"
                class="text-purple-700 hover:text-gray-600 transition duration-300 ease-in-out mb-1">Testimoni</a>
            <a href="/#aboutus" class="text-purple-700 hover:text-gray-600 transition duration-300 ease-in-out">Tentang
                Kami</a>
            <div class="space-x-5 md:inline mt-5">
                <a href="{{ route('login') }}"
                    class="rounded-xl border border-purple-500 bg-white px-3 py-2 text-center font-medium text-purple-600 hover:bg-gray-100">Masuk</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="rounded-xl border-purple-500 bg-gradient-to-br from-purple-600 to-amber-300 px-3 py-2 text-center font-medium text-white hover:opacity-80">Buat
                        Akun</a>
                @endif
            </div>
        </div>
    </div>
</nav>
{{-- Navber end --}}
