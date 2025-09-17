<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Persona Model
 * 
 * Represents customer personas with detailed demographic and behavioral information.
 * Uses JSON fields for flexible persona data storage.
 */
class Persona extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description',
        'family_info',
        'occupation_info',
        'recreation_info',
        'motivation_info',
        'animals_info',
        'favorite_teams',
        'color',
        'is_active',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'family_info' => 'array',
            'occupation_info' => 'array',
            'recreation_info' => 'array',
            'motivation_info' => 'array',
            'animals_info' => 'array',
            'favorite_teams' => 'array',
        ];
    }

    /**
     * Get the customers associated with this persona.
     */
    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class, 'customer_persona')
            ->withPivot(['confidence_score', 'notes'])
            ->withTimestamps();
    }

    /**
     * Scope to get only active personas.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to search personas by name or description.
     */
    public function scopeSearch($query, string $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    /**
     * Get customers with high confidence scores for this persona.
     */
    public function highConfidenceCustomers(): BelongsToMany
    {
        return $this->customers()->wherePivot('confidence_score', '>=', 70);
    }

    /**
     * Get the average confidence score for this persona.
     */
    public function getAverageConfidenceScore(): float
    {
        return $this->customers()->avg('customer_persona.confidence_score') ?? 0;
    }

    /**
     * Get the total number of customers assigned to this persona.
     */
    public function getCustomerCount(): int
    {
        return $this->customers()->count();
    }

    /**
     * Get a summary of persona information for display.
     */
    public function getSummary(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'customer_count' => $this->getCustomerCount(),
            'avg_confidence' => round($this->getAverageConfidenceScore(), 1),
            'color' => $this->color,
        ];
    }

    /**
     * Get family information in a readable format.
     */
    public function getFamilyInfoFormatted(): string
    {
        if (!$this->family_info) {
            return 'Not specified';
        }

        $info = [];
        foreach ($this->family_info as $key => $value) {
            $info[] = ucfirst(str_replace('_', ' ', $key)) . ': ' . $value;
        }

        return implode(', ', $info);
    }

    /**
     * Get occupation information in a readable format.
     */
    public function getOccupationInfoFormatted(): string
    {
        if (!$this->occupation_info) {
            return 'Not specified';
        }

        $info = [];
        foreach ($this->occupation_info as $key => $value) {
            $info[] = ucfirst(str_replace('_', ' ', $key)) . ': ' . $value;
        }

        return implode(', ', $info);
    }
}