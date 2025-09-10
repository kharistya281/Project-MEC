@extends('layouts.app')

@section('content')
    @include('components.sidebar')
    <main class="md:ml-64 p-4">
        <div class="flex items-center mb-7">
            <a href="{{ route('siswa.siswa') }}">
                <x-heroicon-s-arrow-left class="md:h-7 md:w-7 w-5 h-5" />
            </a>
            <h3 class="text-4xl font-bold text-gray-800 mx-4">Program Yang Dikuti</h3>
        </div>
        @foreach ($programs as $program)
            {{-- @php
                $isProgramActive = false;
                if ((isset($program->tgl_akhir) && now() > $program->tgl_akhir) || !$program->is_active) {
                    $isProgramActive = true;
                }
            @endphp --}}
            <div class=" bg-white rounded-lg shadow-lg p-4 mb-6">
                <h5 class="text-gray-800 font-bold text-xl">{{ $program->nama_program }}</h5>
                <div class="h-px mt-3 bg-gray-900"></div>
                <div class="flex gap-4 my-4">
                    <p class="text-gray-700 text-lg font-semibold">Jadwal Kelas</p>

                    @if ($program->isDone())
                        <a href="{{ route('siswa.program.testimoni') }}" class="ml-1">
                            <button class="bg-purple-700 text-white px-3 py-1.5 rounded-lg">Testimoni</button>
                        </a>
                    @else
                        <button class="bg-gray-500 text-white px-3 py-1.5 rounded-lg cursor-not-allowed"
                            disabled>Testimoni</button>
                    @endif

                    {{-- tombol cetak invoice --}}
                    {{-- <div class="mt-4"> --}}
                        {{-- <a href="{{ route('siswa.program.cetakInvoice', $pendaftaran->id) }}" class="ml-1"
                            target="_blank">
                            <button class="bg-purple-500 text-white px-3 py-1.5 rounded-lg">Cetak Invoice</button>
                        </a> --}}
                    {{-- </div> --}}
                </div>
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-700">Hari</th>
                            <th class="px-4 py-2 text-left text-gray-700">Jam</th>
                            <th class="px-4 py-2 text-left text-gray-700">Materi</th>
                            <th class="px-4 py-2 text-left text-gray-700">Ruang</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($jadwals[$program->id] ?? [] as $jadwal)
                            {{-- {{ dd($jadwals); }} --}}
                            <tr>
                                <td class="px-4 py-2">{{ $jadwal->hari }}</td>
                                <td class="px-4 py-2">{{ $jadwal->sesi->jam_mulai }} - {{ $jadwal->sesi->jam_selesai }}</td>
                                <td class="px-4 py-2">{{ $jadwal->materi->nama_materi }}</td>
                                <td class="px-4 py-2">{{ $jadwal->ruang->nama_ruang }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500">Tidak ada jadwal ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endforeach
    </main>
@endsection
