<?php

namespace App\Jobs;

use App\Models\Customer;
use App\Services\CustomerAnalyticsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

/**
 * Process Customer Analytics Job
 * 
 * Demonstrates complex background processing for analytics calculations.
 * Processes customer data and caches results for dashboard performance.
 */
class ProcessCustomerAnalyticsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 2;
    public int $timeout = 300; // 5 minutes

    /**
     * Create a new job instance.
     */
    public function __construct(
        public ?Customer $customer = null,
        public string $analyticsType = 'full'
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(CustomerAnalyticsService $analyticsService): void
    {
        try {
            Log::info('Processing customer analytics', [
                'analytics_type' => $this->analyticsType,
                'customer_id' => $this->customer?->id,
            ]);

            match ($this->analyticsType) {
                'full' => $this->processFullAnalytics($analyticsService),
                'customer' => $this->processCustomerAnalytics($analyticsService),
                'dashboard' => $this->processDashboardAnalytics($analyticsService),
                default => throw new \InvalidArgumentException('Invalid analytics type'),
            };

            Log::info('Customer analytics processed successfully', [
                'analytics_type' => $this->analyticsType,
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to process customer analytics', [
                'analytics_type' => $this->analyticsType,
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    /**
     * Process full analytics for all customers.
     */
    protected function processFullAnalytics(CustomerAnalyticsService $analyticsService): void
    {
        $analytics = $analyticsService->getExportData();
        
        // Cache the results for 1 hour
        Cache::put('analytics:full', $analytics, 3600);
        
        Log::info('Full analytics cached', [
            'customer_count' => $analytics['analytics']['customers']['total'],
            'persona_count' => $analytics['analytics']['personas']['total'],
            'tag_count' => $analytics['analytics']['tags']['total'],
        ]);
    }

    /**
     * Process analytics for a specific customer.
     */
    protected function processCustomerAnalytics(CustomerAnalyticsService $analyticsService): void
    {
        if (!$this->customer) {
            throw new \InvalidArgumentException('Customer is required for customer analytics');
        }

        $customerData = [
            'customer_id' => $this->customer->id,
            'personas' => $this->customer->personas->map(function ($persona) {
                return [
                    'id' => $persona->id,
                    'name' => $persona->name,
                    'confidence_score' => $persona->pivot->confidence_score,
                ];
            }),
            'tags' => $this->customer->tags->map(function ($tag) {
                return [
                    'id' => $tag->id,
                    'name' => $tag->name,
                    'type' => $tag->type,
                    'is_auto_applied' => $tag->pivot->is_auto_applied,
                ];
            }),
            'analytics' => [
                'total_tags' => $this->customer->tags->count(),
                'high_confidence_personas' => $this->customer->highConfidencePersonas()->count(),
                'active_tags' => $this->customer->activeTags()->count(),
            ],
        ];

        // Cache customer-specific analytics for 30 minutes
        Cache::put("analytics:customer:{$this->customer->id}", $customerData, 1800);
        
        Log::info('Customer analytics cached', [
            'customer_id' => $this->customer->id,
            'tag_count' => $customerData['analytics']['total_tags'],
        ]);
    }

    /**
     * Process dashboard analytics.
     */
    protected function processDashboardAnalytics(CustomerAnalyticsService $analyticsService): void
    {
        $dashboardData = $analyticsService->getDashboardAnalytics();
        
        // Cache dashboard data for 15 minutes
        Cache::put('analytics:dashboard', $dashboardData, 900);
        
        Log::info('Dashboard analytics cached', [
            'total_customers' => $dashboardData['customers']['total'],
            'active_customers' => $dashboardData['customers']['active'],
            'total_personas' => $dashboardData['personas']['total'],
            'total_tags' => $dashboardData['tags']['total'],
        ]);
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('Customer analytics job failed permanently', [
            'analytics_type' => $this->analyticsType,
            'customer_id' => $this->customer?->id,
            'error' => $exception->getMessage(),
            'attempts' => $this->attempts(),
        ]);
    }

    /**
     * Get the tags that should be assigned to the job.
     */
    public function tags(): array
    {
        $tags = ['analytics:' . $this->analyticsType];
        
        if ($this->customer) {
            $tags[] = 'customer:' . $this->customer->id;
        }
        
        return $tags;
    }

    /**
     * Dispatch analytics processing jobs.
     */
    public static function dispatchAnalyticsProcessing(): void
    {
        // Dispatch dashboard analytics
        self::dispatch(null, 'dashboard');
        
        // Dispatch full analytics
        self::dispatch(null, 'full');
        
        Log::info('Analytics processing jobs dispatched');
    }

    /**
     * Dispatch customer-specific analytics processing.
     */
    public static function dispatchCustomerAnalytics(Customer $customer): void
    {
        self::dispatch($customer, 'customer');
        
        Log::info('Customer analytics job dispatched', [
            'customer_id' => $customer->id,
        ]);
    }
}