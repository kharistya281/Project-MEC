<?php

namespace App\Filament\Resources\JadwalTutorResource\Pages;

use App\Filament\Resources\JadwalTutorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJadwalTutors extends ListRecords
{
    protected static string $resource = JadwalTutorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
