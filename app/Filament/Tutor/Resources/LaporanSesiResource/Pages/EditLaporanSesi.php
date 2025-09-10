<?php

namespace App\Filament\Tutor\Resources\LaporanSesiResource\Pages;

use App\Filament\Tutor\Resources\LaporanSesiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaporanSesi extends EditRecord
{
    protected static string $resource = LaporanSesiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
