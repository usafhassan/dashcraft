<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Tag;
use Illuminate\Support\Facades\Log;

/**
 * Customer Tagging Service
 * 
 * Handles complex business logic for automatic customer tagging based on rules.
 * Demonstrates clean architecture by separating business logic from models and controllers.
 */
class CustomerTaggingService
{
    /**
     * Auto-apply tags to a customer based on activation rules.
     */
    public function autoApplyTags(Customer $customer): void
    {
        $autoApplyTags = Tag::active()->autoApply()->get();

        foreach ($autoApplyTags as $tag) {
            if ($tag->shouldAutoApplyTo($customer) && !$customer->hasTag($tag->name)) {
                $this->applyTag($customer, $tag, true);
                
                Log::info('Auto-applied tag to customer', [
                    'customer_id' => $customer->id,
                    'tag_id' => $tag->id,
                    'tag_name' => $tag->name,
                ]);
            }
        }
    }

    /**
     * Re-evaluate all tags for a customer (useful when customer data changes).
     */
    public function reEvaluateTags(Customer $customer): void
    {
        // Remove auto-applied tags that no longer match
        $this->removeInvalidAutoTags($customer);
        
        // Apply new auto-tags
        $this->autoApplyTags($customer);
    }

    /**
     * Apply a tag to a customer.
     */
    public function applyTag(Customer $customer, Tag $tag, bool $isAutoApplied = false, ?string $notes = null): void
    {
        $customer->tags()->syncWithoutDetaching([
            $tag->id => [
                'is_auto_applied' => $isAutoApplied,
                'notes' => $notes,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        Log::info('Tag applied to customer', [
            'customer_id' => $customer->id,
            'tag_id' => $tag->id,
            'tag_name' => $tag->name,
            'is_auto_applied' => $isAutoApplied,
        ]);
    }

    /**
     * Remove a tag from a customer.
     */
    public function removeTag(Customer $customer, Tag $tag): void
    {
        $customer->tags()->detach($tag->id);

        Log::info('Tag removed from customer', [
            'customer_id' => $customer->id,
            'tag_id' => $tag->id,
            'tag_name' => $tag->name,
        ]);
    }

    /**
     * Remove auto-applied tags that no longer match the customer's current data.
     */
    protected function removeInvalidAutoTags(Customer $customer): void
    {
        $autoAppliedTags = $customer->tags()
            ->wherePivot('is_auto_applied', true)
            ->get();

        foreach ($autoAppliedTags as $tag) {
            if (!$tag->shouldAutoApplyTo($customer)) {
                $this->removeTag($customer, $tag);
                
                Log::info('Removed invalid auto-applied tag', [
                    'customer_id' => $customer->id,
                    'tag_id' => $tag->id,
                    'tag_name' => $tag->name,
                ]);
            }
        }
    }

    /**
     * Get customers that match specific tag criteria.
     */
    public function getCustomersByTagCriteria(array $criteria): \Illuminate\Database\Eloquent\Collection
    {
        $query = Customer::active()->with('tags');

        foreach ($criteria as $tagName => $required) {
            if ($required) {
                $query->whereHas('tags', function ($q) use ($tagName) {
                    $q->where('name', $tagName);
                });
            } else {
                $query->whereDoesntHave('tags', function ($q) use ($tagName) {
                    $q->where('name', $tagName);
                });
            }
        }

        return $query->get();
    }

    /**
     * Get tag statistics for dashboard.
     */
    public function getTagStatistics(): array
    {
        $tags = Tag::active()->withCount('customers')->get();

        return [
            'total_tags' => $tags->count(),
            'most_used_tags' => $tags->sortByDesc('customers_count')->take(5),
            'auto_apply_tags' => $tags->where('auto_apply', true)->count(),
            'tag_types' => $tags->groupBy('type')->map->count(),
        ];
    }

    /**
     * Bulk apply tags to multiple customers.
     */
    public function bulkApplyTags(array $customerIds, array $tagIds, bool $isAutoApplied = false, ?string $notes = null): int
    {
        $customers = Customer::whereIn('id', $customerIds)->get();
        $tags = Tag::whereIn('id', $tagIds)->get();
        
        $appliedCount = 0;

        foreach ($customers as $customer) {
            foreach ($tags as $tag) {
                if (!$customer->hasTag($tag->name)) {
                    $this->applyTag($customer, $tag, $isAutoApplied, $notes);
                    $appliedCount++;
                }
            }
        }

        Log::info('Bulk applied tags', [
            'customer_count' => $customers->count(),
            'tag_count' => $tags->count(),
            'applied_count' => $appliedCount,
        ]);

        return $appliedCount;
    }
}
