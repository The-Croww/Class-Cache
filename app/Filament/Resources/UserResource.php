<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'User Management';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')
                ->label('Your Full Name')
                ->required()
                ->placeholder('Please enter your full name')
                ->helperText('This name will be used for your account identification.')
                ->maxLength(100) // Limiting name to 100 characters
                ->minLength(2),  // Name should be at least 3 characters
        
            TextInput::make('email')
                ->label('Email Address')
                ->required()
                ->placeholder('Please enter a valid email address')
                ->email() // Email validation
                ->helperText('We will use this email to send important account notifications.')
                ->maxLength(255) // Limiting email to 255 characters (standard for most email providers)
                ->minLength(5),  // Email should be at least 5 characters long
        
            TextInput::make('password')
                ->label('Create a Password')
                ->required()
                ->placeholder('Choose a strong password')
                ->password() // Password-specific styling for security
                ->helperText('At least 8 characters, including numbers and symbols for stronger security.')
                ->minLength(8)  // Password should be at least 8 characters
                ->maxLength(20) // Limiting password length to a maximum of 20 characters
                ->regex('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/') // Password must contain letters, numbers, and symbols
        ]);     
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
            Tables\Columns\TextColumn::make('name')->label('Name')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('email')->label('email')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('email_verified_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            ])
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
