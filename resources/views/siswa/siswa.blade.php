@extends('layouts.app')
@section('content')
    @php
        $user = Auth::user();
    @endphp
    @include('components.sidebar')
    <main class="md:ml-64 p-4">
        <h3 class="text-2xl font-bold text-gray-700">Selamat Datang,
            <span class="text-purple-700">{{ Auth::user()->name }}</span>!
        </h3>
        {{-- dashboard atas --}}
        <div class="flex md:items-center md:flex-row flex-col py-6">
            {{-- Info Akun --}}
            <div class="bg-gray-50 border-gray-100 shadow-md md:w-1/3 rounded-md md:mr-3 p-5 mb-4">
                <div class="flex items-center gap-5">
                    <x-heroicon-c-user-circle class="md:h-10 md:w-10 h-9 w-9" />
                    <div class="">
                        <h4 class="text-lg font-semibold text-purple-500">
                            {{ $user->name }}
                        </h4>
                        <h5 class="text-md font-light text-gray-500">
                            {{ $user ->email }}
                        </h5>
                    </div>
                </div>
            </div>
            {{-- Info Program --}}
            <div class="bg-gray-50 border-gray-100 shadow-md md:w-1/3 rounded-md md:mr-3 p-5 mb-4">
                <div>
                    <h4 class="text-lg font-semibold text-gray-700">
                        Program yang Diikuti
                    </h4>
                    <h5 class="text-sm font-light text-gray-500">
                        {{ $siswa->program->nama_program ?? 'Tidak ada program yang kamu ikuti' }}
                    </h5>
                </div>
            </div>
            {{-- Info kelas --}}
            <div class="bg-gray-50 border-gray-100 shadow-md md:w-1/3 rounded-md p-5 mb-4">
                <div>
                    <h4 class="text-lg font-semibold text-gray-700">
                        Kelas yang Diikuti
                    </h4>
                    @foreach ($jadwals as $jadwal)
                        <h5 class="text-sm font-light text-gray-500">
                            {{ $jadwal->kelas->nama_kelas }}
                        </h5>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- Alert warning isi data --}}
        @include('components.alert-warn')
        {{-- program --}}
        <div class="my-auto">
            <h2 class="font-semibold text-gray-800 text-lg">Silahkan bergabung dengan program kami</h2>
            {{-- tampilan berbagai program --}}
            <div class="container mx-auto flex flex-col md:flex-row my-2 gap-y-6 md:gap-x-8">
                {{-- program --}}
                @foreach ($programs as $program)
                    <div class="bg-gray-100 md:w-1/3 mb-4 rounded-xl border-gray-200 p-7 shadow-lg">
                        <h5 class="font-bold text-2xl mt-2 text-purple-600">{{ $program->nama_program }}</h5>
                        <h4 class="font-bold text-3xl mt-2">Rp {{ number_format($program->biaya_program, 0, '.', ',') }}
                        </h4>
                        <p class="text-gray-500 mt-3">{{ Str::words($program->desc_program, 10, '...') }}</p>
                        <a href="{{ route('siswa.detailProgram', ['id' => $program->id]) }}"
                            class="inline-block
                            rounded-2xl border border-purple-500 bg-gradient-to-br from-purple-600 to-amber-300 px-8 py-3
                            mt-6 text-center font-medium text-white hover:opacity-80 mx-auto">Lihat
                            Detail</a>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
