<nav class="sticky top-0 transform bg-purple-50 md:px-1 max-sm:px-1 z-50">
    <div class="container mx-auto flex justify-between item-center py-4">
        <div class="div">
            <a href="{{ route('siswa.siswa') }}" class="">
                <img src="{{ asset('img/logo.png') }}" alt="" class="size-11 rounded-full ml-3">
            </a>
        </div>
        {{-- <a href="" class="">
            <img src="{{ asset('img/account.png') }}" alt="" class="size-8 hidden md:block">
        </a> --}}
        <div class="flex">
            <div class="hidden sm:flex sm:items-center sm:ms-6 mx-3">
                <button
                    class="disable inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-purple-700 bg-purple-100 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                    <div>{{ Auth::user()->name }}</div>
                </button>
            </div>
            <div class="relative">
                <x-ionicon-menu-outline class="hamburger-icon md:hidden sm:items-end mr-3 h-8 w-8" />
                <x-ionicon-close-sharp class="close-icon hidden md:hidden w-8 h-8 cursor-pointer"/>
            </div>
        </div>
    </div>
    <div class="h-0.5 bg-purple-200"></div>
</nav>
