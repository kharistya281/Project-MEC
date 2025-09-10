@extends('layouts.app')

@section('content')
    @include('components.sidebar')
    <main class="md:ml-64 p-4">
        <div class="flex items-center mb-7">
            <a href="{{ route('siswa.kuis') }}">
                <x-heroicon-s-arrow-left class="md:h-7 md:w-7 w-5 h-5" />
            </a>
            <h3 class="text-4xl font-bold text-gray-800 mx-4">Hasil Kuis</h3>
        </div>
        <div class="mb-6">
            @foreach ($jawabanKuis as $index => $jawaban)
                {{-- {{ dd($jawaban); }} --}}
                @php
                    $soal = $jawaban->soal;
                    $opsi = [
                        'A' => $soal->opsi_a,
                        'B' => $soal->opsi_b,
                        'C' => $soal->opsi_c,
                        'D' => $soal->opsi_d,
                        'E' => $soal->opsi_e,
                    ];
                    // if ($jawaban->jawaban_siswa == $key && $jawaban->is_benar) {
                    //     $textColor = 'text-green-600';
                    //     $fontWeight = 'font-semibold';
                    // } elseif ($jawaban->jawaban_siswa == $key && !$jawaban->is_benar) {
                    //     $textColor = 'text-red-500';
                    //     $fontWeight = 'font-semibold';
                    // } elseif ($jawaban->$jawaban_benar == $key) {
                    //     $textColor = 'text-gray-800';
                    // }
                @endphp
                <div class="mb-2 p-4 bg-white rounded-lg shadow-lg">
                    <strong>No {{ $index + 1 }}</strong>
                    <p class="text-md text-gray-800">{{ $soal->pertanyaan }}</p>
                    @if ($soal->gambar_pertanyaan)
                        <img src="{{ asset('storage/' . $soal->gambar_pertanyaan) }}" alt=""
                            class="object-contain w-1/2 max-h-80">
                    @endif
                    <div class="space-y-2 mt-2">
                        @foreach ($opsi as $key => $text)
                            @php
                                $textColor = '';
                                $fontWeight = '';
                                if ($jawaban->jawaban_siswa == $key && $jawaban->is_benar) {
                                    $textColor = 'text-green-600';
                                    $fontWeight = 'font-semibold';
                                } elseif ($jawaban->jawaban_siswa == $key && !$jawaban->is_benar) {
                                    $textColor = 'text-red-500';
                                    $fontWeight = 'font-semibold';
                                } elseif ($jawaban->jawaban_benar == $key) {
                                    $textColor = 'text-gray-800';
                                }
                            @endphp
                            <label class="flex items-center space-x-2 {{ $textColor }} {{ $fontWeight }}">
                                <input type="radio" disabled {{ $jawaban->jawaban_siswa == $key ? 'checked' : '' }}>
                                <p>{{ $key }}.{{ $text }}</p>
                            </label>
                        @endforeach
                    </div>
                    <div class="h-0.5 mt-3 bg-gray-900"></div>
                    {{-- Pembahasan --}}
                    <div class="mt-3">
                        <strong>Pembahasan</strong>
                        <p class="text-md text-gray-800">{{ $soal->pembahasan }}</p>
                    </div>
                </div>
            @endforeach
            <div class="mb-2 p-4 bg-white rounded-lg shadow-lg">
                <p class="text-md font-semibold text-gray-700">Total Jawaban Benar : {{ $jawabanBenar }}</p>
                <p class="text-md font-semibold text-gray-700">Total Jawaban Salah : {{ $jawabanSalah }}</p>
            </div>
        </div>
        {{-- <div class="bg-white rounded-lg shadow-lg p-4">
        </div> --}}
    </main>
@endsection
