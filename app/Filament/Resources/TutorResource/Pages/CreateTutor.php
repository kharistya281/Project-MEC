<?php

namespace App\Filament\Resources\TutorResource\Pages;

use App\Filament\Resources\TutorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateTutor extends CreateRecord
{
    protected static string $resource = TutorResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = User::create([
            'name' => $data['nama_tutor'],
            'email' =>$data['user']['email'],
            'password' => Hash::make($data['password_tutor']),
            'level' => '2'
        ]);

        unset($data['email_tutor'], $data['password_tutor']);
        $data['id_user'] = $user->id;

        return $data;

    }
}
