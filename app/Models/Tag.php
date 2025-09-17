<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Tag Model
 * 
 * Represents tags for customer segmentation and opportunity identification.
 * Supports automatic application based on activation rules.
 */
class Tag extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description',
        'type',
        'color',
        'activation_rules',
        'priority',
        'is_active',
        'auto_apply',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'activation_rules' => 'array',
            'priority' => 'integer',
            'is_active' => 'boolean',
            'auto_apply' => 'boolean',
        ];
    }

    /**
     * Tag types with their display labels and default colors.
     */
    public static function getTypes(): array
    {
        return [
            'opportunity' => ['label' => 'Opportunity', 'color' => '#10B981'],
            'activation' => ['label' => 'Activation', 'color' => '#3B82F6'],
            'behavioral' => ['label' => 'Behavioral', 'color' => '#8B5CF6'],
            'demographic' => ['label' => 'Demographic', 'color' => '#F59E0B'],
        ];
    }

    /**
     * Get the customers associated with this tag.
     */
    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class, 'customer_tag')
            ->withPivot(['is_auto_applied', 'notes', 'expires_at'])
            ->withTimestamps();
    }

    /**
     * Scope to get only active tags.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to filter by type.
     */
    public function scopeType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope to get auto-apply tags.
     */
    public function scopeAutoApply($query)
    {
        return $query->where('auto_apply', true);
    }

    /**
     * Scope to search tags by name or description.
     */
    public function scopeSearch($query, string $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    /**
     * Scope to order by priority (highest first).
     */
    public function scopeByPriority($query)
    {
        return $query->orderBy('priority', 'desc');
    }

    /**
     * Get the type label and color.
     */
    public function getTypeAttribute($value): array
    {
        $types = self::getTypes();
        return $types[$value] ?? ['label' => ucfirst($value), 'color' => '#6B7280'];
    }

    /**
     * Get customers with this tag that are not expired.
     */
    public function activeCustomers(): BelongsToMany
    {
        return $this->customers()->where(function ($query) {
            $query->whereNull('customer_tag.expires_at')
                  ->orWhere('customer_tag.expires_at', '>', now());
        });
    }

    /**
     * Get manually applied tags (not auto-applied).
     */
    public function manuallyAppliedCustomers(): BelongsToMany
    {
        return $this->customers()->wherePivot('is_auto_applied', false);
    }

    /**
     * Get automatically applied tags.
     */
    public function autoAppliedCustomers(): BelongsToMany
    {
        return $this->customers()->wherePivot('is_auto_applied', true);
    }

    /**
     * Get the total number of customers with this tag.
     */
    public function getCustomerCount(): int
    {
        return $this->activeCustomers()->count();
    }

    /**
     * Get the percentage of customers with this tag.
     */
    public function getCustomerPercentage(): float
    {
        $totalCustomers = Customer::active()->count();
        if ($totalCustomers === 0) {
            return 0;
        }

        return round(($this->getCustomerCount() / $totalCustomers) * 100, 1);
    }

    /**
     * Check if this tag should be auto-applied to a customer.
     */
    public function shouldAutoApplyTo(Customer $customer): bool
    {
        if (!$this->auto_apply || !$this->activation_rules) {
            return false;
        }

        // Simple rule evaluation - can be extended for complex logic
        foreach ($this->activation_rules as $rule) {
            if ($this->evaluateRule($rule, $customer)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Evaluate a single activation rule against a customer.
     */
    protected function evaluateRule(array $rule, Customer $customer): bool
    {
        $field = $rule['field'] ?? null;
        $operator = $rule['operator'] ?? null;
        $value = $rule['value'] ?? null;

        if (!$field || !$operator || !$value) {
            return false;
        }

        $customerValue = $customer->getAttribute($field);

        return match ($operator) {
            'equals' => $customerValue === $value,
            'contains' => is_string($customerValue) && str_contains($customerValue, $value),
            'in' => in_array($customerValue, (array) $value),
            'greater_than' => $customerValue > $value,
            'less_than' => $customerValue < $value,
            default => false,
        };
    }
}