<?php

namespace App\Filament\Resources\InfosResource\Pages;

use App\Filament\Resources\InfosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInfos extends EditRecord
{
    protected static string $resource = InfosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
