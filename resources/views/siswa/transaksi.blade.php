@extends('layouts.app')

@section('content')
    @include('components.sidebar')
    <div class="md:ml-64 p-4">
        <div class="flex items-center mb-7">
            <a href="{{ route('siswa.siswa') }}">
                <x-heroicon-s-arrow-left class="md:h-7 md:w-7 w-5 h-5" />
            </a>
            <h3 class="text-4xl font-bold text-gray-800 mx-4">Transaksi</h3>
        </div>
        <div class="container mx-auto">
            <table class="min-w-full bg-white rounded-lg shadow-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-6 text-left">Id Order</th>
                        <th class="py-3 px-6 text-left">Program</th>
                        <th class="py-3 px-6 text-left">Status Pembayaran</th>
                        <th class="py-3 px-6 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($pendaftaran as $daftar)
                        {{-- {{ dd($daftar) }}; --}}
                        <tr class="border-b">
                            <td class="py-3 px-6">{{ $daftar->id_order }}</td>
                            <td class="py-3 px-6">{{ $daftar->program->nama_program }}</td>
                            <td class="py-3 px-6">{{ $daftar->status_pembayaran }}</td>
                            <td class="py-3 px-6">
                                @if ($daftar->status_pembayaran == 'Pending')
                                    <button class="pay-button bg-purple-500 text-white px-5 py-2 mb-3 mr-2 rounded-xl"
                                        data-token="{{ $daftar->snapToken }}"
                                        data-order-id="{{ $daftar->id_order }}">Bayar</button>
                                @endif
                                <a href="{{ route('siswa.transaksi.detail-transaksi', ['id'=>$daftar->id]) }}">
                                    <button class="bg-gray-700 text-white px-5 py-2 rounded-xl">Detail</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const buttons = document.querySelectorAll(".pay-button");
            buttons.forEach(button => {
                button.addEventListener("click", function(e) {
                    e.preventDefault();
                    const snapToken = this.dataset.token;

                    window.snap.pay(snapToken, {
                        onSuccess: function(result) {
                            console.log("Pembayaran sukses", result);
                            window.location.href = "/siswa/thankyou?id_order=" + result.order_id;
                        },
                        onPending: function(result) {
                            console.log("Pembayaran pending", result);
                            window.location.href = "/siswa/transaksi";
                        },
                        onError: function(result) {
                            console.error("Pembayaran error", result);
                            alert("Terjadi kesalahan saat pembayaran.");
                            window.location.href = "/siswa/transaksi";
                        },
                        onClose: function() {
                            alert(
                                "Kamu menutup popup sebelum menyelesaikan pembayaran.");
                                window.location.href = "/siswa/transaksi";
                        }
                    });
                });
            });
        });
    </script>
@endsection
