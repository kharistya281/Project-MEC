<?php

namespace App\Filament\Resources\JadwalTutorResource\Pages;

use App\Filament\Resources\JadwalTutorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\JadwalTutor;
use Illuminate\Validation\ValidationException;

class EditJadwalTutor extends EditRecord
{
    protected static string $resource = JadwalTutorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function mutateFormDataBeforeUpdate(array $data): array
    {
        $hari = $data['hari'];
        $idSesi = $data['id_sesi'];
        $idRuang = $data['id_ruang'];
        $idTutor = $data['id_tutor'];
        $idKelas = $data['id_kelas'];
        $idProgram = $data['id_program'];

        $errors = [];

        // Cek bentrok ruang 
        if (JadwalTutor::where('hari', $hari)
            ->where('id_sesi', $idSesi)
            ->where('id_ruang', $idRuang)
            // ->where('id_sesi', $idTutor)
            // ->where('id_ruang', $idKelas)
            // ->where('id_ruang', $idProgram)
            ->exists()) {
                $errors['id_ruang'] =['Ruang sudah terpkai di sesi ini'];
        }

        // Cek bentrok tutor
        if (JadwalTutor::where('hari', $hari)
            ->where('id_sesi', $idSesi)
            ->where('id_tutor', $idTutor)
            // ->where('id_sesi', $idKelas)
            // ->where('id_tutor', $idRuang)
            // ->where('id_tutor', $idProgram)
            ->exists()) {
                $errors['id_tutor'] = ['Tutor sudah memiliki jadwal di sesi ini'];
        }

        // Cek bentrok kelas
        if (JadwalTutor::where('hari', $hari)
            ->where('id_sesi', $idSesi)
            ->where('id_kelas', $idKelas)
            // ->where('id_sesi', $idRuang)
            // ->where('id_sesi', $idTutor)
            // ->where('id_kelas', $idProgram)
            ->exists()) {
                $errors['id_kelas'] = ['Kelas sudah terjadwal di sesi ini'];
        }

        if(!empty($errors)){
            throw ValidationException::withMessages($errors);
        }
        
        // Cek duplikat jadwal
        // if (JadwalTutor::where('hari', $hari)
        //     ->where('id_sesi', $idSesi)
        //     ->where('id_kelas', $idKelas)
        //     ->where('id_ruang', $idRuang)
        //     ->where('id_tutor', $idTutor)
        //     ->where('id_program', $idProgram)
        //     ->exists()) {
        //         throw ValidationException::withMessages(['id_kelas' =>'Kelas sudah terjadwal di sesi ini']);
        // }

        return $data;
    }
}
