<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContributionsResource\Pages;
use App\Filament\Resources\ContributionsResource\RelationManagers;
use App\Models\Contributions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\DatePicker;

class ContributionsResource extends Resource
{
    protected static ?string $model = Contributions::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    protected static ?string $navigationGroup = 'Financial Records';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')
                ->label('Name')
                ->required()
                ->placeholder('Enter the name')
                ->helperText('Provide the name for this entry'),
    
            Radio::make('description')
                ->label('Description Type')
                ->options([
                    'class_fund' => 'Class Fund',
                    'org_fee' => 'Organizational Fee',
                    'fines' => 'Fines',
                    'csc_fee' => 'CSC Fee',
                    'other' => 'Other',
                ])
                ->inline() // Display options horizontally for better usability
                ->required(),
    
            TextInput::make('other_description')
                ->label('Specify Description')
                ->placeholder('Enter additional details')
                ->hidden(fn ($get) => $get('description') !== 'other') // Dynamically show when 'Other' is selected
                ->helperText('Only required if "Other" is selected above'),
    
            TextInput::make('amount')
                ->label('Amount')
                ->numeric()
                ->placeholder('Enter the amount')
                ->required()
                ->helperText('Enter a valid numeric value'),
    
            DatePicker::make('date')
                ->label('Date')
                ->default(now())
                ->required()
                ->helperText('Select or use today\'s date by default'),

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
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Amount')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
        ])->defaultSort ('name')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),

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
            'index' => Pages\ListContributions::route('/'),
            'create' => Pages\CreateContributions::route('/create'),
            'edit' => Pages\EditContributions::route('/{record}/edit'),
        ];
    }
}
