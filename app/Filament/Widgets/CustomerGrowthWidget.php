<?php

namespace App\Filament\Widgets;

use App\Services\CustomerAnalyticsService;
use Filament\Widgets\ChartWidget;

class CustomerGrowthWidget extends ChartWidget
{
    protected ?string $heading = 'Customer Growth Trend';

    protected ?string $description = 'Monthly customer growth over the last 12 months';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        try {
            $analyticsService = app(CustomerAnalyticsService::class);
            $trends = $analyticsService->getTrendAnalytics();

            $customerTrends = $trends['customer_trends'] ?? collect([]);

            return [
                'datasets' => [
                    [
                        'label' => 'Customers',
                        'data' => $customerTrends->pluck('customers')->toArray(),
                        'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                        'borderColor' => 'rgb(59, 130, 246)',
                        'borderWidth' => 2,
                        'fill' => true,
                        'tension' => 0.4,
                    ],
                ],
                'labels' => $customerTrends->pluck('month')->toArray(),
            ];
        } catch (\Exception $e) {
            return [
                'datasets' => [
                    [
                        'label' => 'Customers',
                        'data' => [],
                        'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                        'borderColor' => 'rgb(59, 130, 246)',
                        'borderWidth' => 2,
                        'fill' => true,
                        'tension' => 0.4,
                    ],
                ],
                'labels' => [],
            ];
        }
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
                'tooltip' => [
                    'mode' => 'index',
                    'intersect' => false,
                ],
            ],
            'scales' => [
                'x' => [
                    'display' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Month',
                    ],
                ],
                'y' => [
                    'display' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Number of Customers',
                    ],
                    'beginAtZero' => true,
                ],
            ],
            'interaction' => [
                'mode' => 'nearest',
                'axis' => 'x',
                'intersect' => false,
            ],
        ];
    }
}