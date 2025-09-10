<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalTutorResource\Pages;
use App\Filament\Resources\JadwalTutorResource\RelationManagers;
use App\Models\JadwalTutor;
use App\Rules\UniqueKelasPerSesi;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\ValidationException;
use App\Rules\UniqueRuangPerSesi;
use App\Rules\UniqueTutorPerSesi;

class JadwalTutorResource extends Resource
{
    protected static ?string $model = JadwalTutor::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function getLabel(): string
    {
        return 'Jadwal Tutor';
    }

    public static function getPluralLabel(): string
    {
        return 'Jadwal Tutor';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('id_ruang')
                    ->relationship('ruang', 'nama_ruang')
                    ->required()
                    ->preload(false)
                    ->rules([
                        fn($get) => new UniqueRuangPerSesi($get('hari'), $get('id_sesi')),
                    ]),
                Select::make('id_sesi')
                    ->relationship('sesi', 'keterangan')
                    ->preload(false)
                    ->required(),
                Select::make('hari')
                    ->options([
                        'Senin' => 'Senin',
                        'Selasa' => 'Selasa',
                        'Rabu' => 'Rabu',
                        'Kamis' => 'Kamis',
                        'Jumat' => 'Jumat',
                        'Sabtu' => 'Sabtu',
                        'Minggu' => 'Minggu',
                    ])
                    ->required(),
                Select::make('id_tutor')
                    ->relationship('tutor', 'nama_tutor')
                    ->required()
                    ->preload(false)
                    ->rules([
                        fn($get) => new UniqueTutorPerSesi($get('hari'), $get('id_sesi')),
                    ]),
                Select::make('id_kelas')
                    ->relationship('kelas', 'nama_kelas')
                    ->required()
                    ->preload(false)
                    ->rules([
                        fn($get) => new UniqueKelasPerSesi($get('hari'), $get('id_sesi')),
                    ]),
                Select::make('id_program')
                    ->relationship('program', 'nama_program')
                    ->preload(false)
                    ->required(),
                Select::make('id_materi')
                    ->relationship('materi', 'nama_materi')
                    ->preload(false)
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            // ->lazy()
            ->columns([
                Tables\Columns\TextColumn::make('ruang.nama_ruang'),
                Tables\Columns\TextColumn::make('sesi.keterangan'),
                Tables\Columns\TextColumn::make('hari'),
                Tables\Columns\TextColumn::make('tutor.nama_tutor'),
                Tables\Columns\TextColumn::make('kelas.nama_kelas'),
                Tables\Columns\TextColumn::make('program.nama_program'),
                Tables\Columns\TextColumn::make('materi.nama_materi'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJadwalTutors::route('/'),
            'create' => Pages\CreateJadwalTutor::route('/create'),
            'edit' => Pages\EditJadwalTutor::route('/{record}/edit'),
        ];
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $hari = $data['hari'];
        $idSesi = $data['id_sesi'];
        $idRuang = $data['id_ruang'];
        $idTutor = $data['id_tutor'];
        $idKelas = $data['id_kelas'];

        // Cek bentrok ruang 
        if (JadwalTutor::where('hari', $hari)
            ->where('id_sesi', $idSesi)
            ->where('id_ruang', $idRuang)
            ->where('id_sesi', $idTutor)
            ->where('id_ruang', $idKelas)
            ->where('id_ruang', $idProgram)
            ->exists()
        ) {
            throw ValidationException::withMessages(['id_ruang' => 'Ruang sudah terpkai di sesi ini']);
        }

        // Cek bentrok tutor
        if (JadwalTutor::where('hari', $hari)
            ->where('id_sesi', $idSesi)
            ->where('id_tutor', $idTutor)
            ->where('id_sesi', $idKelas)
            ->where('id_tutor', $idRuang)
            ->where('id_tutor', $idProgram)
            ->exists()
        ) {
            throw ValidationException::withMessages(['id_tutor' => 'Tutor sudah memiliki jadwal di sesi ini']);
        }

        // Cek bentrok kelas
        if (JadwalTutor::where('hari', $hari)
            ->where('id_sesi', $idSesi)
            ->where('id_kelas', $idKelas)
            ->where('id_sesi', $idRuang)
            ->where('id_sesi', $idTutor)
            ->where('id_kelas', $idProgram)
            ->exists()
        ) {
            throw ValidationException::withMessages(['id_kelas' => 'Kelas sudah terjadwal di sesi ini']);
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
