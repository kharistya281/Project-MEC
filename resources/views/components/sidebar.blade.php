{{-- side bar --}}
<aside class="menu w-60 hidden md:block fixed h-full top-0 left-0 mt-12 border-r border-purple-200 py-4 bg-purple-50">
    <div class="flex flex-col h-full justify-between">
        <nav class="flex flex-col px-4 py-6 space-y-2">
            <a href="{{ route('siswa.siswa') }}"
                class="flex items-center gap-3 text-md font-semibold px-4 py-3 rounded
            {{ request()->is('siswa') ? 'bg-purple-300 text-gray-700 hover:bg-purple-100' : 'text-gray-700 hover:bg-purple-200' }}">
                <x-heroicon-o-home class="h-6 w-6" />
                <span>Dashboard</span>
            </a>
            <a href="{{ route('siswa.program') }}"
                class="flex items-center gap-3 text-md font-semibold px-4 py-3 rounded
            {{ request()->is('siswa/program*') ? 'bg-purple-300 text-gray-700 hover:bg-purple-100' : 'text-gray-700 hover:bg-purple-200' }}">
                <x-heroicon-o-book-open class="h-6 w-6" />
                <span>Program</span>
            </a>
            <a href="{{ route('siswa.kuis') }}"
                class="flex items-center gap-3 text-md font-semibold px-4 py-3 rounded
            {{ request()->is('siswa/kuis*') ? 'bg-purple-300 text-gray-700 hover:bg-purple-100' : 'text-gray-700 hover:bg-purple-200' }}">
                <x-gmdi-quiz-o class="w-6 h-6" />
                <span>Kuis</span>
            </a>
            <a href="{{ route('siswa.transaksi') }}"
                class="flex items-center gap-3 text-md font-semibold px-4 py-3 rounded
            {{ request()->is('siswa/transaksi*') ? 'bg-purple-300 text-gray-700 hover:bg-purple-100' : 'text-gray-700 hover:bg-purple-200' }}">
                <x-ionicon-wallet-outline class="w-6 h-6" />
                <span>Transaksi</span>
            </a>
            {{-- <a href="{{ route('siswa.testimoni') }}"
                class="flex items-center gap-3 text-md font-semibold px-4 py-3 rounded
            {{ request()->is('siswa/testimoni*') ? 'bg-purple-300 text-gray-700 hover:bg-purple-100' : 'text-gray-700 hover:bg-purple-200' }}">
                <x-heroicon-o-chat-bubble-bottom-center-text class="w-6 h-6" />
                <span>Testimoni</span>
            </a> --}}
            <a href="{{ route('siswa.setting') }}"
                class="flex items-center gap-3 text-md font-semibold px-4 py-3 rounded
            {{ request()->is('siswa/setting') ? 'bg-purple-300 text-gray-700 hover:bg-purple-100' : 'text-gray-700 hover:bg-purple-200' }}">
                <x-bi-gear class="w-6 h-6" />
                <span>Pengaturan</span>
            </a>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}" class="hidden" id="logout-form">
                @csrf

                <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>

            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="flex items-center gap-3 text-md font-semibold text-purple-700 px-4 py-3 rounded hover:bg-purple-200 text-left">
                <x-heroicon-m-arrow-left-on-rectangle class="w-6 h-6" />
                <span>Logout</span>
            </a>
        </nav>
    </div>
</aside>
