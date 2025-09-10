<?php

namespace App\Filament\Tutor\Resources\LaporanSesiResource\Pages;

use App\Filament\Tutor\Resources\LaporanSesiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLaporanSesis extends ListRecords
{
    protected static string $resource = LaporanSesiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
