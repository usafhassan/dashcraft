<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use App\Models\Persona;
use App\Models\Tag;
use App\Services\CustomerAnalyticsService;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CustomerStatsWidget extends StatsOverviewWidget
{
    protected ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        try {
            $analyticsService = app(CustomerAnalyticsService::class);
            $analytics = $analyticsService->getCustomerAnalytics();

            return [
                Stat::make('Total Customers', $analytics['total'] ?? 0)
                    ->description('All customers in the system')
                    ->descriptionIcon('heroicon-m-users')
                    ->color('primary'),

                Stat::make('Active Customers', $analytics['active'] ?? 0)
                    ->description('Currently active customers')
                    ->descriptionIcon('heroicon-m-check-circle')
                    ->color('success'),

                Stat::make('Recent Customers', $analytics['recent_30_days'] ?? 0)
                    ->description('Added in last 30 days')
                    ->descriptionIcon('heroicon-m-calendar')
                    ->color('info'),

                Stat::make('Growth Rate', ($analytics['growth_rate'] ?? 0) . '%')
                    ->description('Month over month growth')
                    ->descriptionIcon(($analytics['growth_rate'] ?? 0) >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                    ->color(($analytics['growth_rate'] ?? 0) >= 0 ? 'success' : 'danger'),
            ];
        } catch (\Exception $e) {
            return [
                Stat::make('Total Customers', 0)
                    ->description('Error loading data')
                    ->descriptionIcon('heroicon-m-exclamation-triangle')
                    ->color('danger'),

                Stat::make('Active Customers', 0)
                    ->description('Error loading data')
                    ->descriptionIcon('heroicon-m-exclamation-triangle')
                    ->color('danger'),

                Stat::make('Recent Customers', 0)
                    ->description('Error loading data')
                    ->descriptionIcon('heroicon-m-exclamation-triangle')
                    ->color('danger'),

                Stat::make('Growth Rate', '0%')
                    ->description('Error loading data')
                    ->descriptionIcon('heroicon-m-exclamation-triangle')
                    ->color('danger'),
            ];
        }
    }
}