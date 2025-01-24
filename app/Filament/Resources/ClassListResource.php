<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassListResource\Pages;
use App\Filament\Resources\ClassListResource\RelationManagers;
use App\Models\ClassList;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClassListResource extends Resource
{
    protected static ?string $model = ClassList::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Financial Records';

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

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListClassLists::route('/'),
            'create' => Pages\CreateClassList::route('/create'),
            'edit' => Pages\EditClassList::route('/{record}/edit'),
        ];
    }
}
