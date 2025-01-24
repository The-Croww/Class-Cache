<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InfosResource\Pages;
use App\Filament\Resources\InfosResource\RelationManagers;
use App\Models\Infos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;

class InfosResource extends Resource
{
    protected static ?string $model = Infos::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id')
                ->label('ID')
                ->numeric()
                ->required()
                ->placeholder('Enter the id')
                ->helperText('Provide the id for this entry'),

                TextInput::make('name')
                ->label('Fullname')
                ->required()
                ->placeholder('Enter the name')
                ->helperText('Provide the name for this entry'),

                TextInput::make('course')
                ->label('Course')
                ->required()
                ->placeholder('Enter the course')
                ->helperText('Provide the course for this entry'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('id')
                ->label('ID'),
            Tables\Columns\TextColumn::make('name')
                ->label('Name'),

            Tables\Columns\TextColumn::make('course')
                ->label('Course'),
        
        ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListInfos::route('/'),
            'create' => Pages\CreateInfos::route('/create'),
            'edit' => Pages\EditInfos::route('/{record}/edit'),
        ];
    }
}
