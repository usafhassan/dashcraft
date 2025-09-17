<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Persona;
use App\Models\Tag;
use Illuminate\Support\Collection;

/**
 * Customer Analytics Service
 * 
 * Provides analytics and insights about customers, personas, and tags.
 * Demonstrates service layer pattern for complex data aggregation.
 */
class CustomerAnalyticsService
{
    /**
     * Get comprehensive customer analytics for dashboard.
     */
    public function getDashboardAnalytics(): array
    {
        return [
            'customers' => $this->getCustomerAnalytics(),
            'personas' => $this->getPersonaAnalytics(),
            'tags' => $this->getTagAnalytics(),
            'trends' => $this->getTrendAnalytics(),
        ];
    }

    /**
     * Get customer-related analytics.
     */
    public function getCustomerAnalytics(): array
    {
        $totalCustomers = Customer::count();
        $activeCustomers = Customer::active()->count();
        $deletedCustomers = Customer::onlyTrashed()->count();

        $classifications = Customer::active()
            ->selectRaw('classification, COUNT(*) as count')
            ->groupBy('classification')
            ->pluck('count', 'classification')
            ->toArray();

        $recentCustomers = Customer::active()
            ->where('created_at', '>=', now()->subDays(30))
            ->count();

        return [
            'total' => $totalCustomers,
            'active' => $activeCustomers,
            'deleted' => $deletedCustomers,
            'classifications' => $classifications,
            'recent_30_days' => $recentCustomers,
            'growth_rate' => $this->calculateGrowthRate(),
        ];
    }

    /**
     * Get persona-related analytics.
     */
    public function getPersonaAnalytics(): array
    {
        $totalPersonas = Persona::count();
        $activePersonas = Persona::active()->count();

        $personaStats = Persona::active()
            ->withCount('customers')
            ->orderByDesc('customers_count')
            ->take(5)
            ->get()
            ->map(function ($persona) {
                return [
                    'id' => $persona->id,
                    'name' => $persona->name,
                    'customer_count' => $persona->customers_count,
                    'avg_confidence' => round($persona->getAverageConfidenceScore(), 1),
                    'color' => $persona->color,
                ];
            });

        $avgConfidence = Persona::active()
            ->withAvg('customers', 'customer_persona.confidence_score')
            ->get()
            ->avg('customers_avg_confidence_score') ?? 0;

        return [
            'total' => $totalPersonas,
            'active' => $activePersonas,
            'top_personas' => $personaStats,
            'avg_confidence_score' => round($avgConfidence, 1),
        ];
    }

    /**
     * Get tag-related analytics.
     */
    public function getTagAnalytics(): array
    {
        $totalTags = Tag::count();
        $activeTags = Tag::active()->count();
        $autoApplyTags = Tag::active()->autoApply()->count();

        $tagTypes = Tag::active()
            ->selectRaw('type, COUNT(*) as count')
            ->groupBy('type')
            ->pluck('count', 'type')
            ->toArray();

        $mostUsedTags = Tag::active()
            ->withCount('customers')
            ->orderByDesc('customers_count')
            ->take(5)
            ->get()
            ->map(function ($tag) {
                return [
                    'id' => $tag->id,
                    'name' => $tag->name,
                    'type' => $tag->type,
                    'customer_count' => $tag->customers_count,
                    'percentage' => $tag->getCustomerPercentage(),
                    'color' => $tag->color,
                ];
            });

        return [
            'total' => $totalTags,
            'active' => $activeTags,
            'auto_apply' => $autoApplyTags,
            'types' => $tagTypes,
            'most_used' => $mostUsedTags,
        ];
    }

    /**
     * Get trend analytics (monthly data).
     */
    public function getTrendAnalytics(): array
    {
        $months = collect(range(0, 11))->map(function ($month) {
            return now()->subMonths($month)->startOfMonth();
        })->reverse();

        $customerTrends = $months->map(function ($date) {
            $count = Customer::where('created_at', '<=', $date->endOfMonth())->count();
            return [
                'month' => $date->format('M Y'),
                'customers' => $count,
            ];
        });

        $personaTrends = $months->map(function ($date) {
            $count = Persona::where('created_at', '<=', $date->endOfMonth())->count();
            return [
                'month' => $date->format('M Y'),
                'personas' => $count,
            ];
        });

        return [
            'customer_trends' => $customerTrends,
            'persona_trends' => $personaTrends,
        ];
    }

    /**
     * Get customer segmentation insights.
     */
    public function getCustomerSegmentation(): array
    {
        $segments = [];

        // High-value customers (existing classification)
        $segments['high_value'] = Customer::active()
            ->classification('existing')
            ->count();

        // Potential customers
        $segments['potential'] = Customer::active()
            ->classification('potential')
            ->count();

        // Conquest targets
        $segments['conquest'] = Customer::active()
            ->classification('conquest')
            ->count();

        // Customers with high-confidence personas
        $segments['high_confidence_personas'] = Customer::active()
            ->whereHas('personas', function ($query) {
                $query->wherePivot('confidence_score', '>=', 70);
            })
            ->count();

        // Customers with opportunity tags
        $segments['opportunity_tagged'] = Customer::active()
            ->whereHas('tags', function ($query) {
                $query->where('type', 'opportunity');
            })
            ->count();

        return $segments;
    }

    /**
     * Get persona effectiveness metrics.
     */
    public function getPersonaEffectiveness(): Collection
    {
        return Persona::active()
            ->withCount(['customers as total_customers'])
            ->get()
            ->filter(function ($persona) {
                return $persona->total_customers > 0; // Only include personas with customers
            })
            ->map(function ($persona) {
                // Get high confidence customers count manually since withCount with pivot conditions is unreliable
                $highConfidenceCustomers = $persona->customers()
                    ->wherePivot('confidence_score', '>=', 70)
                    ->count();
                
                $effectiveness = $persona->total_customers > 0 
                    ? round(($highConfidenceCustomers / $persona->total_customers) * 100, 1)
                    : 0;

                return [
                    'persona' => $persona->name,
                    'total_customers' => $persona->total_customers,
                    'high_confidence_customers' => $highConfidenceCustomers,
                    'effectiveness_percentage' => $effectiveness,
                    'color' => $persona->color,
                ];
            })
            ->sortByDesc('effectiveness_percentage');
    }

    /**
     * Calculate customer growth rate (month over month).
     */
    protected function calculateGrowthRate(): float
    {
        $currentMonth = Customer::where('created_at', '>=', now()->startOfMonth())->count();
        $lastMonth = Customer::whereBetween('created_at', [
            now()->subMonth()->startOfMonth(),
            now()->subMonth()->endOfMonth()
        ])->count();

        if ($lastMonth === 0) {
            return $currentMonth > 0 ? 100 : 0;
        }

        return round((($currentMonth - $lastMonth) / $lastMonth) * 100, 1);
    }

    /**
     * Get export-ready analytics data.
     */
    public function getExportData(): array
    {
        return [
            'generated_at' => now()->toISOString(),
            'analytics' => $this->getDashboardAnalytics(),
            'segmentation' => $this->getCustomerSegmentation(),
            'persona_effectiveness' => $this->getPersonaEffectiveness(),
        ];
    }
}
