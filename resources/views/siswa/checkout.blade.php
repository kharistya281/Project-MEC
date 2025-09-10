@extends('layouts.app')
@section('content')
    <a href="{{ route('siswa.siswa') }}">
        <x-heroicon-s-arrow-left class="md:h-7 md:w-7 w-5 h-5 mx-7 my-4" />
    </a>
    <h2 class="text-3xl font-bold text-purple-500 text-center my-8 -mt-4"> Checkout Program</h2>
    <div class="max-w-6xl mx-auto px-6 py-8 grid grid-cols-1 md:grid-cols-2 gap-8 bg-white shadow-lg rounded">
        <div class="bg-gray-100 shadow rounded p-6 h-min">
            <h3 class="text-lg font-semibold">{{ $checkoutProgram->nama_program }}</h3>
            <p class="text-gray-500 font-light">Tanggal Mulai :
                {{ \Carbon\Carbon::parse($checkoutProgram->tgl_mulai)->format('d F Y') }}</p>
            <p class="text-gray-500 font-semibold">Harga : Rp
                {{ number_format($checkoutProgram->biaya_program, 0, '.', ',') }}</p>
        </div>
        <div class="">
            <form id="checkout-form" class="mt-4">
                @csrf
                {{-- {{ $checkoutProgram->nama_program }} --}}
                <input type="hidden" name="id_siswa" value="{{ $siswa->id }}">
                <input type="hidden" name="id_program" value="{{ $checkoutProgram->id }}">

                <div class="mb-4">
                    <label for="" class="block text-sm font-medium">Nama</label>
                    <input type="text" name="nama" readonly class="w-full border p-2 rounded"
                        value="{{ old('nama_siswa', $siswa->nama_siswa) }}">
                </div>
                <div class="mb-4">
                    <label for="" class="block text-sm font-medium">Asal Sekolah</label>
                    <input type="text" name="asalsekolah" readonly class="w-full border p-2 rounded"
                        value="{{ old('asalsekolah', $siswa->asal_sekolah) }}">
                </div>
                <div class="mb-4">
                    <label for="" class="block text-sm font-medium">No Telp</label>
                    <input type="text" name="notelp" readonly class="w-full border p-2 rounded"
                        value="{{ old('notelp', $siswa->notelp_siswa) }}">
                </div>
                <button id="pay-button" type="button" class="bg-purple-600 text-white py-2 px-4 rounded-xl">
                    Bayar
                </button>
                {{-- <x-primary-button id="pay-button">{{ __('Bayar') }}</x-primary-button> --}}
                {{-- <div id="snap-container"></div> --}}
            </form>
        </div>
    </div>

    @if (isset($snapToken))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var payButton = document.getElementById("pay-button");

                payButton.addEventListener("click", function(event) {
                    event.preventDefault();

                    window.snap.pay('{{ $snapToken }}', {
                        onSuccess: function(result) {
                            // const form = document.querySelector("#pendaftaran-form");
                            // form.querySelector('input[name="order_id"]').value = result.order_id;
                            console.log("Success", result);
                            // form.submit();
                            const orderId = result.order_id;
                            window.location.href = "/siswa/thankyou?id_order=" + orderId;

                            // console.log("Success", result);
                            // document.querySelector("form").submit();
                        },
                        onPending: function(result) {
                            console.log("Pending", result);
                            document.querySelector("form").submit();
                            window.location.href="/siswa/transaksi"
                        },
                        onError: function(result) {
                            alert("Terjadi kesalahan saat pembayaran.");
                            console.log("Error", result);
                            window.location.href="/siswa/transaksi"
                        },
                        onClose: function() {
                            alert("Kamu menutup popup sebelum menyelesaikan pembayaran.");
                            window.location.href="/siswa/transaksi"
                        },
                    });
                });
            });
        </script>
    @endif
@endsection
