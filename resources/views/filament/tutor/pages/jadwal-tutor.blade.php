<x-filament-panels::page>
    <div class="overflow-x-auto w-full">
        <table class="table-auto w-full border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">Nama Program - Materi</th>
                    <th class="border px-4 py-2">Senin</th>
                    <th class="border px-4 py-2">Selasa</th>
                    <th class="border px-4 py-2">Rabu</th>
                    <th class="border px-4 py-2">Kamis</th>
                    <th class="border px-4 py-2">Jumat</th>
                    <th class="border px-4 py-2">Sabtu</th>
                    <th class="border px-4 py-2">Minggu</th>
                </tr>
            </thead>
            <tbody>
                {{-- {{ dd($jadwals) }} --}}
                @forelse ($jadwals as $jadwal)
                    <tr>
                        <td class="border px-4 py-2">
                            {{ $jadwal->program->nama_program ?? '-' }} - {{ $jadwal->materi->nama_materi ?? '-' }}
                        </td>
                        <td class="border px-4 py-2 text-center">
                            @if ($jadwal->hari === 'Senin')
                            {{-- <ion-icon name="checkmark-circle-outline" class="text-green-500 w-5 h-5"></ion-icon> --}}
                                <p class="text-green-500 text-md">
                                    <x-ionicon-checkmark-circle-outline class=" text-green-500 h-5 w-5"/>
                                </p>
                            @else
                            {{-- <ion-icon name="close-circle-outline" class="text-red-500 w-5 h-5"></ion-icon> --}}
                                <p class="text-red-500 text-md">
                                    <x-ionicon-close-circle-outline class="h-5 w-5" />
                                </p>
                            @endif
                        </td>
                        <td class="border px-4 py-2 text-center">
                            @if ($jadwal->hari === 'Selasa')
                                <x-ionicon-checkmark-circle-outline class="text-green-500 text-md h-5 w-5" />
                            @else
                                <x-ionicon-close-circle-outline class="text-red-500 text-md h-5 w-5" />
                            @endif
                        </td>
                        <td class="border px-4 py-2 text-center">
                            @if ($jadwal->hari === 'Rabu')
                                <x-ionicon-checkmark-circle-outline class="text-green-500 text-md h-5 w-5" />
                            @else
                                <x-ionicon-close-circle-outline class="text-red-500 text-md h-5 w-5" />
                            @endif
                        </td>
                        <td class="border px-4 py-2 text-center">
                            @if ($jadwal->hari === 'Kamis')
                                <x-ionicon-checkmark-circle-outline class="text-green-500 text-md h-5 w-5" />
                            @else
                                <x-ionicon-close-circle-outline class="text-red-500 text-md h-5 w-5" />
                            @endif
                        </td>
                        <td class="border px-4 py-2 text-center">
                            @if ($jadwal->hari === 'Jumat')
                                <x-ionicon-checkmark-circle-outline class="text-green-500 text-md h-5 w-5" />
                            @else
                                <x-ionicon-close-circle-outline class="text-red-500 text-md h-5 w-5" />
                            @endif
                        </td>
                        <td class="border px-4 py-2 text-center">
                            @if ($jadwal->hari === 'Sabtu')
                                <x-ionicon-checkmark-circle-outline class="text-green-500 text-md h-5 w-5" />
                            @else
                                <x-ionicon-close-circle-outline class="text-red-500 text-md h-5 w-5" />
                            @endif
                        </td>
                        <td class="border px-4 py-2 text-center">
                            @if ($jadwal->hari === 'Minggu')
                                <x-ionicon-checkmark-circle-outline class="text-green-500 text-md h-5 w-5" />
                            @else
                                <x-ionicon-close-circle-outline class="text-red-500 text-md h-5 w-5" />
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center border py-2">Belum ada jadwal</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-filament-panels::page>
