@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto text-center p-10 bg-white shadow-lg rounded mt-10">
        <h2 class="text-3xl font-bold text-green-500 mb-4">Terima Kasih!</h2>
        <p class="text-gray-700 mb-6 font-bold text-lg">Terima kasih sudah mendaftar program.</p>
        <p class="text-gray-600 font-light">Order ID: {{ $id_order }}</p>
        <p class="text-gray-600 font-light mb-4">Status Pembayaran: {{ Str::ucfirst($status) }}</p>
        <a href="{{ route('siswa.siswa') }}" class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-300">
            Kembali ke Dashboard
        </a>
    </div>
@endsection
