<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KuisResource\Pages;
use App\Filament\Resources\KuisResource\RelationManagers;
use App\Models\Kuis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KuisResource extends Resource
{
    protected static ?string $model = Kuis::class;

    protected static ?string $navigationIcon = 'gmdi-quiz-o';

    public static function getLabel(): string
    {
        return 'Kuis';
    }

    public static function getPluralLabel(): string
    {
        return 'Kuis';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_materi')
                    ->relationship('materi', 'nama_materi')
                    ->required(),
                Forms\Components\TextInput::make('judul_kuis')
                    ->label('Judul Kuis')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('materi.nama_materi')
                    ->label('Materi')
                    ->sortable(),
                Tables\Columns\TextColumn::make('judul_kuis')
                    ->label('Judul Kuis')
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
            'index' => Pages\ListKuis::route('/'),
            'create' => Pages\CreateKuis::route('/create'),
            'edit' => Pages\EditKuis::route('/{record}/edit'),
        ];
    }
}
