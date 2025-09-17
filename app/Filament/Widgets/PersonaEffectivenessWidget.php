<?php

namespace App\Filament\Widgets;

use App\Services\CustomerAnalyticsService;
use Filament\Widgets\ChartWidget;

class PersonaEffectivenessWidget extends ChartWidget
{
    protected ?string $heading = 'Persona Effectiveness';

    protected ?string $description = 'Percentage of customers with high confidence (≥70%) for each persona';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        try {
            $analyticsService = app(CustomerAnalyticsService::class);
            $personaEffectiveness = $analyticsService->getPersonaEffectiveness();

            return [
                'datasets' => [
                    [
                        'label' => 'Effectiveness %',
                        'data' => $personaEffectiveness->pluck('effectiveness_percentage')->toArray(),
                        'backgroundColor' => $personaEffectiveness->pluck('color')->toArray(),
                        'borderColor' => $personaEffectiveness->pluck('color')->toArray(),
                        'borderWidth' => 2,
                    ],
                ],
                'labels' => $personaEffectiveness->pluck('persona')->toArray(),
                'originalData' => $personaEffectiveness->toArray(),
            ];
        } catch (\Exception $e) {
            return [
                'datasets' => [
                    [
                        'label' => 'Effectiveness %',
                        'data' => [],
                        'backgroundColor' => [],
                        'borderColor' => [],
                        'borderWidth' => 2,
                    ],
                ],
                'labels' => [],
                'originalData' => [],
            ];
        }
    }

    protected function getType(): string
    {
        return 'bar';
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
                    'callbacks' => [
                        'label' => 'function(context) {
                            const data = context.dataset.data[context.dataIndex];
                            const originalData = context.chart.data.originalData[context.dataIndex];
                            return context.label + ": " + context.parsed.y + "% (" + originalData.high_confidence_customers + "/" + originalData.total_customers + " customers)";
                        }',
                    ],
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'max' => 100,
                    'ticks' => [
                        'callback' => 'function(value) {
                            return value + "%";
                        }',
                    ],
                ],
            ],
        ];
    }
}