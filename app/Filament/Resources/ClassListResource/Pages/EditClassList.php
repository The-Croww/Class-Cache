<?php

namespace App\Filament\Resources\ClassListResource\Pages;

use App\Filament\Resources\ClassListResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClassList extends EditRecord
{
    protected static string $resource = ClassListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
