<?php

namespace App\Observers;

use App\Jobs\SendWelcomeEmailJob;
use App\Jobs\ProcessCustomerAnalyticsJob;
use App\Models\Customer;
use App\Services\CustomerTaggingService;
use Illuminate\Support\Facades\Log;

/**
 * Customer Observer
 * 
 * Handles customer model events for logging, auto-tagging, and other business logic.
 * Demonstrates clean separation of concerns by moving complex logic to service classes.
 */
class CustomerObserver
{
    protected CustomerTaggingService $taggingService;

    public function __construct(CustomerTaggingService $taggingService)
    {
        $this->taggingService = $taggingService;
    }

    /**
     * Handle the Customer "created" event.
     */
    public function created(Customer $customer): void
    {
        Log::info('Customer created', [
            'customer_id' => $customer->id,
            'name' => $customer->name,
            'email' => $customer->email,
            'classification' => $customer->classification,
            'created_by' => auth()->id(),
        ]);

        // Auto-apply tags based on customer data
        $this->taggingService->autoApplyTags($customer);

        // Dispatch welcome email job
        dispatch(new SendWelcomeEmailJob($customer));

        // Dispatch analytics processing job
        ProcessCustomerAnalyticsJob::dispatchCustomerAnalytics($customer);
    }

    /**
     * Handle the Customer "updated" event.
     */
    public function updated(Customer $customer): void
    {
        Log::info('Customer updated', [
            'customer_id' => $customer->id,
            'name' => $customer->name,
            'email' => $customer->email,
            'changes' => $customer->getChanges(),
            'updated_by' => auth()->id(),
        ]);

        // Re-evaluate auto-tags when customer data changes
        $this->taggingService->reEvaluateTags($customer);
    }

    /**
     * Handle the Customer "deleted" event.
     */
    public function deleted(Customer $customer): void
    {
        Log::info('Customer soft deleted', [
            'customer_id' => $customer->id,
            'name' => $customer->name,
            'email' => $customer->email,
            'deleted_by' => auth()->id(),
        ]);
    }

    /**
     * Handle the Customer "restored" event.
     */
    public function restored(Customer $customer): void
    {
        Log::info('Customer restored', [
            'customer_id' => $customer->id,
            'name' => $customer->name,
            'email' => $customer->email,
            'restored_by' => auth()->id(),
        ]);
    }

    /**
     * Handle the Customer "force deleted" event.
     */
    public function forceDeleted(Customer $customer): void
    {
        Log::info('Customer permanently deleted', [
            'customer_id' => $customer->id,
            'name' => $customer->name,
            'email' => $customer->email,
            'deleted_by' => auth()->id(),
        ]);
    }
}