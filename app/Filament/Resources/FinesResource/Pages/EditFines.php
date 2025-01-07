<?php

namespace App\Filament\Resources\FinesResource\Pages;

use App\Filament\Resources\FinesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFines extends EditRecord
{
    protected static string $resource = FinesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
