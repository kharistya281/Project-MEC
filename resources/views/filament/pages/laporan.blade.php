<x-filament-panels::page>
    {{-- <h2 class="text-lg font-bold mb-4">Laporan Pendaftaran</h2> --}}
    <div class="overflow-x-auto w-full">
        <table class="table-auto w-full border">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Nama Siswa</th>
                    <th class="border px-4 py-2">Program</th>
                    <th class="border px-4 py-2">Total</th>
                    <th class="border px-4 py-2">Status Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                {{-- {{ dd($laporan) }} --}}
                @foreach ($laporan as $data)
                    <tr>
                        <td class="border px-4 py-2">{{ $data->siswa->nama_siswa }}</td>
                        <td class="border px-4 py-2">{{ $data->program->nama_program }}</td>
                        <td class="border px-4 py-2">Rp {{ number_format($data->total, 0, '.', ',') }}</td>
                        <td class="border px-4 py-2">{{ $data->status_pembayaran }}</td>
                    </tr>
                @endforeach
            </tbody>
            {{ $laporan->links() }}
        </table>
    </div>
</x-filament-panels::page>
