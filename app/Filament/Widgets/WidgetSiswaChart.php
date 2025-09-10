<?php

namespace App\Filament\Widgets;

use App\Models\Siswa;
use App\Models\Pendaftaran;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Cache;

class WidgetSiswaChart extends ChartWidget
{
    protected static ?string $heading = 'Siswa per Bulan';

    protected static string $color = 'primary';

    protected static ?string $pollingInterval = null;

    protected function getData(): array
    {
        $siswaPerbulan = Cache::remember('siswa_per_bulan', 60, function(){
            return Siswa::selectRaw('MONTH(created_at) as bulan, COUNT(*) as jumlah')
                ->whereYear('created_at', now()->year)
                ->groupByRaw('MONTH(created_at)')
                ->orderByRaw('MONTH(created_at)')
                ->pluck('jumlah', 'bulan')
                ->toArray();
        });
        
        
        

        $dataPerBulan = array_fill(1, 12, 0);
        foreach ($siswaPerbulan as $bulan => $jumlah) {
            $dataPerBulan[$bulan] = $jumlah;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pendaftaran',
                    'data' => array_values($dataPerBulan),
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
