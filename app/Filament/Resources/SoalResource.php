<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SoalResource\Pages;
use App\Filament\Resources\SoalResource\RelationManagers;
use App\Models\Soal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SoalResource extends Resource
{
    protected static ?string $model = Soal::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function getLabel(): string
    {
        return 'Soal';
    }

    public static function getPluralLabel(): string
    {
        return 'Soal';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_materi')
                    ->relationship('materi', 'nama_materi')
                    ->label('Nama Materi')
                    ->required(),
                Forms\Components\Select::make('id_kuis')
                    ->relationship('kuis', 'judul_kuis')
                    ->label('Judul Kuis')
                    ->required(),
                Forms\Components\Textarea::make('pertanyaan')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('gambar_pertanyaan')
                    ->image()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('opsi_a')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('opsi_b')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('opsi_c')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('opsi_d')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('opsi_e')
                    ->maxLength(255),
                Forms\Components\Select::make('jawaban_benar')
                    ->options([
                        'A' => 'A',
                        'B' => 'B',
                        'C' => 'C',
                        'D' => 'D',
                        'E' => 'E'
                    ])
                    ->required(),
                Forms\Components\Textarea::make('pembahasan')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('materi.nama_materi')
                    ->sortable(),
                Tables\Columns\TextColumn::make('kuis.judul_kuis')
                    ->sortable(),
                Tables\Columns\TextColumn::make('pertanyaan')
                    ->limit(15)
                    ->searchable(),
                Tables\Columns\ImageColumn::make('gambar_pertanyaan')
                    ->label('Gambar'),
                Tables\Columns\TextColumn::make('jawaban_benar'),
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
            'index' => Pages\ListSoals::route('/'),
            'create' => Pages\CreateSoal::route('/create'),
            'edit' => Pages\EditSoal::route('/{record}/edit'),
        ];
    }
}
