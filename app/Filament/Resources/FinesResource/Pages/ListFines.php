<?php

namespace App\Filament\Resources\FinesResource\Pages;

use App\Filament\Resources\FinesResource;
use App\Filament\Resources\FinesResource\Widgets\StatsOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFines extends ListRecords
{
    protected static string $resource = FinesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return[
            StatsOverview::class,
        ];
    }
}
