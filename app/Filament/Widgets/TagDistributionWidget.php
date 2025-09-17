<?php

namespace App\Filament\Widgets;

use App\Services\CustomerAnalyticsService;
use Filament\Widgets\ChartWidget;

class TagDistributionWidget extends ChartWidget
{
    protected ?string $heading = 'Tag Distribution';

    protected ?string $description = 'Customer distribution across tag types';

    protected static ?int $sort = 4;

    protected function getData(): array
    {
        try {
            $analyticsService = app(CustomerAnalyticsService::class);
            $tagAnalytics = $analyticsService->getTagAnalytics();

            $tagTypes = $tagAnalytics['types'] ?? [];
            $colors = [
                'opportunity' => '#10B981',
                'activation' => '#3B82F6',
                'behavioral' => '#8B5CF6',
                'demographic' => '#F59E0B',
            ];

            return [
                'datasets' => [
                    [
                        'label' => 'Tag Count',
                        'data' => array_values($tagTypes),
                        'backgroundColor' => array_map(fn($type) => $colors[$type] ?? '#6B7280', array_keys($tagTypes)),
                        'borderColor' => array_map(fn($type) => $colors[$type] ?? '#6B7280', array_keys($tagTypes)),
                        'borderWidth' => 2,
                    ],
                ],
                'labels' => array_map(fn($type) => ucfirst($type), array_keys($tagTypes)),
            ];
        } catch (\Exception $e) {
            return [
                'datasets' => [
                    [
                        'label' => 'Tag Count',
                        'data' => [],
                        'backgroundColor' => [],
                        'borderColor' => [],
                        'borderWidth' => 2,
                    ],
                ],
                'labels' => [],
            ];
        }
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                ],
                'tooltip' => [
                    'callbacks' => [
                        'label' => 'function(context) {
                            const label = context.label || "";
                            const value = context.parsed;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return label + ": " + value + " (" + percentage + "%)";
                        }',
                    ],
                ],
            ],
        ];
    }
}