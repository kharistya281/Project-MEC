@extends('layouts.app')

@section('content')
    @include('components.sidebar')
    <main class="md:ml-64 p-4">
        <div class="flex items-center mb-7">
            <a href="{{ route('siswa.kuis') }}">
                <x-heroicon-s-arrow-left class="md:h-7 md:w-7 w-5 h-5" />
            </a>
            <h3 class="text-4xl font-bold text-gray-800 mx-4">Kuis</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($kuiss as $kuis)
                @php
                    $sudah = \App\Models\JawabanKuis::where('id_kuis', $kuis->id)
                        ->where('id_siswa', auth()->user()->siswa->id)
                        ->exists();
                @endphp
                <div class="bg-white rounded-lg shadow-lg p-4 flex items-center justify-between">
                    <div>
                        <h4 class="text-xl font-semibold">Kuis {{ $kuis->materi->nama_materi }}</h4>
                        <h5 class="text-md text-gray-600">Kuis terdiri dari {{ $totalSoal }} soal</h5>
                    </div>
                    <div class="mt-4">
                        @if ($sudah)
                            <a href="{{ route('siswa.kuis.hasil', ['id' => $kuis->id]) }}">
                                <x-primary-button>{{ __('Lihat Hasil') }}</x-primary-button>
                            </a>
                        @else
                            <a href="{{ route('siswa.detail-kuis', ['id' => $kuis->id]) }}">
                                <x-primary-button>{{ __('Kerjakan') }}</x-primary-button>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection
