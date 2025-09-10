@extends('layouts.app')
@section('content')
<div class="container mx-auto py-5 px-3">
    <h3 class="font-bold text-3xl text-purple-600 mt-5">{{ $program->nama_program }}</h3>
    <p class="text-gray-600 mt-3">{{$program->desc_program}}</p>
    <h4 class="font-semibold text-xl text-gray-900 mt-3">
        {{ \Carbon\Carbon::parse($program->tgl_mulai)->format('d F Y') }}
        - {{ \Carbon\Carbon::parse($program->tgl_akhir)->format('d F Y') }}

    </h4>
    <h5 class="font-bold text-2xl text-purple-700 mt-3">Rp {{ number_format($program->biaya_program, 0, '.', ',') }}</h5>
    <a href="{{ route('login') }}"
        class="inline-block rounded-2xl border border-purple-500 bg-gradient-to-br from-purple-600 to-amber-300 px-8 py-3 mt-6 text-center font-medium text-white hover:opacity-80 mx-auto">Daftar
        Sekarang</a>
</div>
@endsection
