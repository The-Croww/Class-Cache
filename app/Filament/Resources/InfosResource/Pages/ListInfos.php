<?php

namespace App\Filament\Resources\InfosResource\Pages;

use App\Filament\Resources\InfosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInfos extends ListRecords
{
    protected static string $resource = InfosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
