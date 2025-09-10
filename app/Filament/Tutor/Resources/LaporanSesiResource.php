<?php

namespace App\Filament\Tutor\Resources;

use App\Filament\Tutor\Resources\LaporanSesiResource\Pages;
use App\Filament\Tutor\Resources\LaporanSesiResource\RelationManagers;
use App\Models\LaporanSesi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LaporanSesiResource extends Resource
{
    protected static ?string $model = LaporanSesi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getLabel(): string
    {
        return 'Laporan Sesi';
    }

    public static function getPluralLabel(): string
    {
        return 'Laporan Sesi';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('jadwal')
                    ->label('Pilih Jadwal')
                    ->options(
                        \App\Models\JadwalTutor::with(['program', 'kelas', 'materi'])
                            ->get()
                            ->mapWithKeys(function ($jadwal) {
                                return [
                                    $jadwal->id => "{$jadwal->program->nama_program} - {$jadwal->hari} - {$jadwal->kelas->nama_kelas} - {$jadwal->materi->nama_materi}"
                                ];
                            })
                    )
                    ->required(),
                Forms\Components\Select::make('id_tutor')
                    ->relationship('tutor', 'nama_tutor')
                    ->required(),
                Forms\Components\DatePicker::make('tgl_laporan')
                    ->label('tanggal laporan')
                    ->required(),
                Forms\Components\TextInput::make('materi_yg_dibahas')
                    ->label('Materi yang dibahas')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kehadiran')
                    ->placeholder('Diisi jumlah siswa yang hadir')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TimePicker::make('durasi_pertemuan')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_jadwal')
                    ->label('Jadwal')
                    ->formatStateUsing(function ($state, $record) {
                        return "{$record->jadwal->program->nama_program} - {$record->jadwal->hari} - {$record->jadwal->kelas->nama_kelas} - {$record->jadwal->materi->nama_materi}";
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tutor.nama_tutor')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tgl_laporan')
                    ->label('Tanggal Laporan')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kehadiran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListLaporanSesis::route('/'),
            'create' => Pages\CreateLaporanSesi::route('/create'),
            'edit' => Pages\EditLaporanSesi::route('/{record}/edit'),
        ];
    }
}
