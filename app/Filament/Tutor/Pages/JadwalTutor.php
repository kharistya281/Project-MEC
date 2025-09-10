<?php

namespace App\Filament\Tutor\Pages;

use App\Models\JadwalTutor as Jadwal;
use Filament\Pages\Page;
// use Filament\Tables;
// use Filament\Resources\Resource;
// use Filament\Resources\Table;
use Illuminate\Support\Facades\Auth;


class JadwalTutor extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.tutor.pages.jadwal-tutor';

    public function getViewData(): array
    {
        // dd(Auth::id());
        $tutorId = \App\Models\Tutor::where('id_user', Auth::id())->value('id');
        // $jadwals = Jadwal::where('id_tutor', $tutorId)
        //     ->get();
        // dd($jadwals);
        return [
            'jadwals' => Jadwal::with('program', 'materi')
                ->where('id_tutor', $tutorId)
                ->get()
        ];
        // dd($jadwals);
    }
}
