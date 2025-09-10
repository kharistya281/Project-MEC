<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class Laporan extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.laporan';

    // public $laporan;

    // public function mount(): void{
    //     $this->laporan = Pendaftaran::with('siswa', 'program')->get();
    // }

    // $laporan = 
    public function getViewData(): array{
        return[
            'laporan' => Pendaftaran::with('siswa', 'program')->paginate(5)
        ];
    }
}
