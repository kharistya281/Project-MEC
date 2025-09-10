@extends('layouts.app')
@section('content')
    <div class="flex items-center mb-4">
            <a href="{{ route('siswa.kuis') }}">
                <x-heroicon-s-arrow-left class="md:h-7 md:w-7 w-5 h-5 ml-4" />
            </a>
            <h3 class="text-4xl font-bold text-purple-700 mx-4">Detail Program</h3>
        </div>
    <div class="container mx-auto py-5 px-3">
        <div class="bg-gray-100 shadow rounded-md p-6 m-4">
            <h3 class="font-bold text-3xl text-purple-600 mb-4 mt-2">{{ $detailProgram->nama_program }}</h3>
            <p class="text-gray-600 my-3 text-xl">{{ $detailProgram->desc_program }}</p>
            <h4 class="font-semibold text-2xl text-gray-800 my-3">Materi yang akan dipelajari:</h4>
            <ul class="my-3">
                @foreach ($detailProgram->materi as $materi)
                    <li class="text-xl font-light text-gray-700 list-disc ml-3">{{ $materi->nama_materi }}</li>
                @endforeach
            </ul>
            <h5 class="font-semibold text-xl text-gray-900 mt-3">
                {{ \Carbon\Carbon::parse($detailProgram->tgl_mulai)->format('d F Y') }}
                - {{ \Carbon\Carbon::parse($detailProgram->tgl_akhir)->format('d F Y') }}

            </h5>
            <h4 class="font-bold text-2xl text-purple-700 mt-3">Rp
                {{ number_format($detailProgram->biaya_program, 0, '.', ',') }}</h4>
            <a href="{{ route('siswa.checkoutProgram', ['id' => $detailProgram->id]) }}"
                class="inline-block rounded-2xl border border-purple-500 bg-gradient-to-br from-purple-600 to-amber-300 px-8 py-3 mt-6 text-center font-medium text-white hover:opacity-80 mx-auto">Daftar
                Sekarang</a>
        </div>
    </div>
@endsection
