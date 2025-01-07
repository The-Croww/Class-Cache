<?php

namespace App\Filament\Resources\ClassFundsResource\Pages;

use App\Filament\Resources\ClassFundsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClassFunds extends EditRecord
{
    protected static string $resource = ClassFundsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
