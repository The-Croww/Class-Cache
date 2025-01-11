<?php

namespace App\Filament\Resources\ClassListResource\Pages;

use App\Filament\Resources\ClassListResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClassLists extends ListRecords
{
    protected static string $resource = ClassListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
