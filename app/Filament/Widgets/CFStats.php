<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\ClassFunds;


class CFStats extends BaseWidget
{

    protected function getStats(): array
    {
       return [

           Stat::make('Total Fines', '₱' . number_format(ClassFunds::sum('amount'), 2)) // Format as currency
               ->description('Total value of all Class Fund')
               ->descriptionIcon('heroicon-m-banknotes')
               ->color('primary'),

            Stat::make('Total Users', ClassFunds::all()->count())
               ->description('Users Total Inside Class Funds')
               ->descriptionIcon('heroicon-m-arrow-trending-up')
               ->chart([7, 2, 10, 3, 15, 4, 17])
               ->color('success'),
       ];
    }
}
