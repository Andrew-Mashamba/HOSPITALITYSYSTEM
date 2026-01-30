<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'category',
        'price',
        'prep_area',
        'image_url',
        'is_available',
        'preparation_time',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
        'preparation_time' => 'integer',
    ];

    /**
     * Get all order items for this menu item.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Check if item is available.
     */
    public function isAvailable(): bool
    {
        return $this->is_available === true;
    }

    /**
     * Mark item as unavailable.
     */
    public function markAsUnavailable(): void
    {
        $this->update(['is_available' => false]);
    }

    /**
     * Mark item as available.
     */
    public function markAsAvailable(): void
    {
        $this->update(['is_available' => true]);
    }

    /**
     * Scope to get only available items.
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    /**
     * Scope to get items by category.
     */
    public function scopeCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope to get items by prep area.
     */
    public function scopePrepArea($query, string $prepArea)
    {
        return $query->where('prep_area', $prepArea);
    }
}
