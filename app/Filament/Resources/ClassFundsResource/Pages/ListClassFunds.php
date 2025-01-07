<?php

namespace App\Filament\Resources\ClassFundsResource\Pages;

use App\Filament\Resources\ClassFundsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClassFunds extends ListRecords
{
    protected static string $resource = ClassFundsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
