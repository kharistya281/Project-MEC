@extends('layouts.app')

@section('content')
    @include('components.sidebar')
    <main class="md:ml-64 p-4">
        <div class="flex items-center mb-7">
            <a href="{{ route('siswa.transaksi') }}">
                <x-heroicon-s-arrow-left class="md:h-7 md:w-7 w-5 h-5" />
            </a>
            <h3 class="text-4xl font-bold text-gray-800 mx-4">Detail Transaksi</h3>
        </div>
        {{-- part of detail transaksi --}}
        <div class="bg-white rounded-lg shadow-lg p-4">
            {{-- Detail Pembelian --}}
            <h5 class="text-gray-800 font-bold text-md mb-3">Invoice Pembelian</h5>
            <div class="grid md:grid-cols-3 grid-cols-1">
                <div class="">
                    <p class="text-gray-800 font-semibold text-sm">Order ID:</p>
                    <p class="text-gray-800 font-medium text-sm">{{ $pendaftaran->id_order }}</p>
                </div>
                <div class="">
                    <p class="text-gray-800 font-semibold text-sm">Status Pembayaran:</p>
                    <p class="text-gray-800 font-medium text-sm">{{ $pendaftaran->status_pembayaran }}</p>
                </div>
            </div>
            <div class="h-px mt-3 bg-gray-900 col-span-full"></div>

            {{-- Informasi Pembeli --}}
            <h5 class="text-gray-800 font-bold text-md my-3">Informasi Pembeli</h5>
            <div class="grid md:grid-cols-3 grid-cols-1">
                <div class="">
                    <p class="text-gray-800 font-semibold text-sm">Nama Siswa:</p>
                    <p class="text-gray-800 font-medium text-sm">{{ $siswa->nama_siswa }}</p>
                </div>
                <div class="">
                    <p class="text-gray-800 font-semibold text-sm">Asal Sekolah:</p>
                    <p class="text-gray-800 font-medium text-sm">{{ $siswa->asal_sekolah }}</p>
                </div>
            </div>
            <div class="h-px mt-3 bg-gray-900 col-span-full"></div>

            {{-- Detail Program yang dibeli --}}
            <h5 class="text-gray-800 font-bold text-md my-3">Detail Program</h5>
            <div class="grid md:grid-cols-3 grid-cols-1">
                <div class="">
                    <p class="text-gray-800 font-semibold text-sm">Nama Program:</p>
                    <p class="text-gray-800 font-medium text-sm">{{ $program->nama_program }}</p>
                </div>
                <div class="">
                    <p class="text-gray-800 font-semibold text-sm">Biaya Program:</p>
                    <p class="text-gray-800 font-medium text-sm">Rp
                        {{ number_format($program->biaya_program, 0, '.', ',') }}</p>
                </div>
            </div>
            {{-- <div class="h-px mt-3 bg-gray-900 col-span-full"></div> --}}

        </div>
        {{-- tombol cetak invoice --}}
        <div class="mt-4">
            <a href="{{ route('siswa.transaksi.cetakInvoice', $pendaftaran->id) }}" class="ml-1" target="_blank">
                <button class="bg-purple-500 text-white px-3 py-1.5 rounded-lg">Cetak Invoice</button>
            </a>
        </div>
    </main>
@endsection
