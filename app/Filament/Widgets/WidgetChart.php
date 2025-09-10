<?php

namespace App\Filament\Widgets;

use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Cache;
use Filament\Widgets\ChartWidget;

class WidgetChart extends ChartWidget
{
    protected static ?string $heading = 'Pendapatan per Bulan';

    protected static string $color = 'success';

    protected static ?string $pollingInterval = null;

    protected function getData(): array
    {
        $pendapatan = Cache::remember('pendapatan_per_bulan', 60, function () {
            return Pendaftaran::selectRaw('MONTH(created_at) as bulan, SUM(total) as total')
                ->where('status_pembayaran', 'Paid')
                ->whereYear('created_at', now()->year)
                ->groupByRaw('MONTH(created_at)')
                ->orderByRaw('MONTH(created_at)')
                ->pluck('total', 'bulan')
                ->toArray();
        });

        $dataPerBulan = array_fill(1, 12, 0);
        foreach ($pendapatan as $bulan => $total) {
            $dataPerBulan[$bulan] = $total;
        }
        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan (Rp)',
                    'data' => array_values($dataPerBulan),
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
