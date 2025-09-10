<?php

namespace App\Filament\Widgets;

use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\Tutor;
use Illuminate\Support\Facades\Cache;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class WidgetAdmin extends BaseWidget
{
    protected function getStats(): array
    {

        $totalPendapatan = Cache::remember(
            'total_pendapatan',
            60,
            fn() =>
            Pendaftaran::where('status_pembayaran', 'Paid')->sum('total')
        );
        $totalSiswa = Cache::remember('total_siswa', 60, fn() =>
        Siswa::count());
        $totalTutor = Cache::remember('total_tutor', 60, fn() =>
        Tutor::count());
        // $totalPendapatan = Pendaftaran::where('status_pembayaran', 'Paid')->sum('total');
        // $totalSiswa = Siswa::count();
        // $totalTutor = Tutor::count();
        return [
            Stat::make('Pendapatan', 'Rp ' . number_format($totalPendapatan, 0, ',', '.')),
            Stat::make('Siswa', $totalSiswa),
            Stat::make('Tutor', $totalTutor),
        ];
    }
}
