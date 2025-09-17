<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Customer Model
 * 
 * Represents customers with classification, contact info, and relationships.
 * Supports many-to-many relationships with personas and tags.
 */
class Customer extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'address',
        'classification',
        'metadata',
        'is_active',
        'created_by',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'metadata' => 'array',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Customer classifications with their display labels and colors.
     */
    public static function getClassifications(): array
    {
        return [
            'existing' => ['label' => 'Existing Customer', 'color' => 'success'],
            'potential' => ['label' => 'Potential Customer', 'color' => 'warning'],
            'conquest' => ['label' => 'Conquest Target', 'color' => 'danger'],
        ];
    }

    /**
     * Get the user who created this customer.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the personas associated with this customer.
     */
    public function personas(): BelongsToMany
    {
        return $this->belongsToMany(Persona::class, 'customer_persona')
            ->withPivot(['confidence_score', 'notes'])
            ->withTimestamps();
    }

    /**
     * Get the tags associated with this customer.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'customer_tag')
            ->withPivot(['is_auto_applied', 'notes', 'expires_at'])
            ->withTimestamps();
    }

    /**
     * Scope to get only active customers.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to filter by classification.
     */
    public function scopeClassification($query, string $classification)
    {
        return $query->where('classification', $classification);
    }

    /**
     * Scope to search customers by name or email.
     */
    public function scopeSearch($query, string $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('mobile', 'like', "%{$search}%");
        });
    }

    /**
     * Get the classification label and color.
     */
    public function getClassificationAttribute($value): array
    {
        $classifications = self::getClassifications();
        return $classifications[$value] ?? ['label' => ucfirst($value), 'color' => 'gray'];
    }

    /**
     * Get active tags only.
     */
    public function activeTags(): BelongsToMany
    {
        return $this->tags()->where('is_active', true);
    }

    /**
     * Get high-confidence personas (confidence score >= 70).
     */
    public function highConfidencePersonas(): BelongsToMany
    {
        return $this->personas()->wherePivot('confidence_score', '>=', 70);
    }

    /**
     * Check if customer has a specific tag.
     */
    public function hasTag(string $tagName): bool
    {
        return $this->tags()->where('name', $tagName)->exists();
    }

    /**
     * Check if customer has a specific persona.
     */
    public function hasPersona(string $personaName): bool
    {
        return $this->personas()->where('name', $personaName)->exists();
    }
}