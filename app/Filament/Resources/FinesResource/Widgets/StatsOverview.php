<?php

namespace App\Filament\Resources\FinesResource\Widgets;

use App\Models\Fines;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {

       // Placeholder for Average time on page (static value for now)
       $averageTimeOnPage = '3:14'; // You can change this if you have dynamic data

       return [
           Stat::make('Total Users', Fines::all()->count())
               ->description('New fines added this week')
               ->descriptionIcon('heroicon-m-arrow-trending-up')
               ->chart([7, 2, 10, 3, 15, 4, 17])
               ->color('success'),

           Stat::make('Total Amounts', '₱' . number_format(Fines::sum('amount'), 2)) // Format as currency
               ->description('Total value of all fines')
               ->descriptionIcon('heroicon-m-banknotes')
               ->color('primary'),

           Stat::make('Average Time on Page', $averageTimeOnPage)
               ->description('Time spent on the fines page')
               ->descriptionIcon('heroicon-m-clock')
               ->color('warning'),
       ];
    }
}
