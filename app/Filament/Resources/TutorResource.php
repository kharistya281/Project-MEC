<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TutorResource\Pages;
use App\Filament\Resources\TutorResource\RelationManagers;
use App\Models\Tutor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TutorResource extends Resource
{
    protected static ?string $model = Tutor::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function getLabel(): string
    {
        return 'Tutor';
    }

    public static function getPluralLabel(): string
    {
        return 'Tutor';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('id_user')
                //     ->required()
                //     ->numeric(),
                Forms\Components\TextInput::make('nama_tutor')
                    ->label('Nama Tutor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('alamat_tutor')
                    ->label('Alamat Tutor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('notelp_tutor')
                    ->label('No Telp Tutor')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kesibukan_tutor')
                    ->label('Kesibukan Tutor')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('foto_tutor')
                    ->image()
                    ->columnSpan(2),

                // Data untuk login tutor
                Forms\Components\TextInput::make('user.email')
                    ->email()
                    // ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password_tutor')
                    ->password()
                    ->default('password')
                    // ->required()
                    ->readOnly()
                    ->maxLength(255),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('id_user')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('nama_tutor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat_tutor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('notelp_tutor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.email')
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
            'index' => Pages\ListTutors::route('/'),
            'create' => Pages\CreateTutor::route('/create'),
            'edit' => Pages\EditTutor::route('/{record}/edit'),
        ];
    }
}
