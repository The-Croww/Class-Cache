<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassFundsResource\Pages;
use App\Models\ClassFunds;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\DatePicker;
use Barryvdh\DomPDF\Facade as Pdf;
use Filament\Tables\Actions\ButtonAction;




class ClassFundsResource extends Resource
{
    protected static ?string $model = ClassFunds::class;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    protected static ?string $navigationGroup = 'Financial Records';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                BelongsToSelect::make('class_list_id')
                    ->relationship('student', 'name') // 'name' is the column in ClassList you want to display
                    ->label('Student')
                    ->searchable()
                    ->required()
                    ->afterStateUpdated(function (callable $set, $state) {
                        // Dynamically update the name field based on the selected student
                        if ($state) {
                            $student = \App\Models\ClassList::find($state); // Find student by class_list_id
                            if ($student) {
                                $set('name', $student->name); // Set the name field
                            }
                        }
                    }),

                Select::make('category')
                    ->label('Category')
                    ->options([
                        'Class Fund' => 'Class Fund',
                        'Fine' => 'Fines',
                        'Contribution' => 'Contribution',
                        'Expense' => 'Expense',
                    ])
                    ->reactive()
                    ->required(),

                TextInput::make('amount')
                    ->label('Amount')
                    ->numeric()
                    ->required()
                    ->reactive()
                    ->extraAttributes([
                        'min' => 10,
                        'step' => 10, 
                    ])
                    ->visible(fn (callable $get) => $get('category') === 'Fund' || $get('category')),

                Select::make('description')
                    ->label('Description')
                    ->options(fn (callable $get) => match ($get('category')) {
                        'Fine' => [
                            'Late' => 'Late',
                            'Absent' => 'Absent',
                        ],
                        'Contribution' => [
                            'School Activity' => 'School Activity',
                            'Donation' => 'Donation',
                        ],
                        default => [],
                    })
                    ->hidden(fn (callable $get) => !in_array($get('category'), ['Fine', 'Contribution']))
                    ->required(fn (callable $get) => in_array($get('category'), ['Fine', 'Contribution'])),

                TextInput::make('description_expense')
                    ->label('Description')
                    ->placeholder('Enter description.')
                    ->hidden(fn (callable $get) => $get('category') !== 'Expense')
                    ->required(fn (callable $get) => $get('category') === 'Expense'),

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
                TextColumn::make('student.id')->label('Student ID'),
                TextColumn::make('student.name')->label('Student Name')->sortable()->searchable(),
                TextColumn::make('description')->label('Description')->sortable()->searchable(),
                TextColumn::make('amount')->label('Amount')->sortable()->searchable(),
                TextColumn::make('category')->label('Category')->sortable()->searchable(),
                TextColumn::make('status')->label('Status')->sortable()->searchable(),
                TextColumn::make('date')->label('Date')->sortable(),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])


            ->headerActions([
                ButtonAction::make('Export PDF')
                    ->action(function () {
                        // Fetch all records to be included in the PDF
                        $records = ClassFunds::all();
            
                        // Load the Blade view and pass the records to it
                        $pdf = \Barryvdh\DomPDF\Facade::loadView('pdf.class_funds', compact('records'));
            
                        // Stream the generated PDF as a download
                        return response()->streamDownload(
                            fn () => print($pdf->output()),
                            'class_funds.pdf',
                            ['Content-Type' => 'application/pdf']
                        );
                    })
                    ->icon('heroicon-o-document-text')
                    ->color('success'),            
            ])
            
            


            ->defaultSort('name')
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ])
                ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getWidgets(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClassFunds::route('/'),
            'create' => Pages\CreateClassFunds::route('/create'),
            'edit' => Pages\EditClassFunds::route('/{record}/edit'),
        ];
    }

    public static function create(CreateRecord $page): void
    {
        $page->saved(function ($form) {
            // Set the 'name' field after form is saved
            if ($form->getState('class_list_id')) {
                $student = \App\Models\ClassList::find($form->getState('class_list_id'));
                if ($student) {
                    // Set the 'name' field dynamically
                    $form->model->name = $student->name;
                    $form->model->save(); // Save the model with the updated 'name'
                }
            }
        });
    }

}
