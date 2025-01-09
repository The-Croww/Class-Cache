<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\ClassFunds;

class CFChar extends ChartWidget
{
    protected static ?string $heading = 'Class Fund';

    protected function getType(): string
    {
        return 'bar'; // Change chart type to bar
    }

    protected function getData(): array
    {
        // Group contributions by description and count each group
        $data = ClassFunds::select('description')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('description')
            ->orderBy('description') // Optional: Order by description for better visualization
            ->get();

        // Extract labels and data for the chart
        $labels = $data->pluck('description')->toArray();
        $counts = $data->pluck('count')->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Contributions',
                    'data' => $counts,
                    'backgroundColor' => [
                        '#071952', // First color for the first bar
                        '#088395', // Second color for the second bar
                        '#37B7C3', // Third color for the third bar
                        '#EBF4F6', // Fourth color for the fourth bar
                    ],
                    'borderColor' => '#000B58', // Solid navy blue border for all bars
                    'borderWidth' => 2, // Slightly thicker borders for emphasis
                ],
            ],
        ];
    }
}