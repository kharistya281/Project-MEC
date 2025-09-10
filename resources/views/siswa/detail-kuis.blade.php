@extends('layouts.app')

@section('content')
    @include('components.sidebar')
    <main class="md:ml-64 p-4">
        <div class="flex items-center mb-7">
            <a href="{{ route('siswa.kuis') }}">
                <x-heroicon-s-arrow-left class="md:h-7 md:w-7 w-5 h-5" />
            </a>
            {{-- {{ dd($kuis) }} --}}
            <h3 class="text-4xl font-bold text-gray-800 mx-4">{{ $kuis->judul_kuis }}</h3>
        </div>
        @foreach ($soals->soal as $index => $soal)
            <form action="{{ route('siswa.kuis.submit', $soals->id) }}" method="post" class="mb-5">
                @csrf
                <div class="mb-2 p-4 bg-white rounded-lg shadow-lg">
                    <strong>No {{ $index + 1 }}</strong>
                    <p class="text-md text-gray-800">{{ $soal->pertanyaan }}</p>
                    @if ($soal->gambar_pertanyaan)
                        <img src="{{ asset('storage/' . $soal->gambar_pertanyaan) }}" alt=""
                            class="object-contain w-1/2 max-h-80">
                    @endif
                    <div class="space-y-2 mt-2">
                        <label for="" class="flex items-center space-x-2">
                            <input type="radio" name="jawaban_{{ $index }}" value="A"
                                class="form-radio text-blue-700">
                            <p class="text-md text-gray-800"> A. {{ $soal->opsi_a }}</p>
                        </label>
                        <label for="" class="flex items-center space-x-2">
                            <input type="radio" name="jawaban_{{ $index }}" value="B"
                                class="form-radio text-blue-700">
                            <p class="text-md text-gray-800"> B. {{ $soal->opsi_b }}</p>
                        </label>
                        <label for="" class="flex items-center space-x-2">
                            <input type="radio" name="jawaban_{{ $index }}" value="C"
                                class="form-radio text-blue-700">
                            <p class="text-md text-gray-800"> C. {{ $soal->opsi_c }}</p>
                        </label>
                        <label for="" class="flex items-center space-x-2">
                            <input type="radio" name="jawaban_{{ $index }}" value="D"
                                class="form-radio text-blue-700">
                            <p class="text-md text-gray-800"> D. {{ $soal->opsi_d }}</p>
                        </label>
                        <label for="" class="flex items-center space-x-2">
                            <input type="radio" name="jawaban_{{ $index }}" value="E"
                                class="form-radio text-blue-700">
                            <p class="text-md text-gray-800"> E. {{ $soal->opsi_e }}</p>
                        </label>
                    </div>
                </div>
        @endforeach
        <x-primary-button>{{ __('Submit') }}</x-primary-button>
        </form>
    </main>
@endsection
