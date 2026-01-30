<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Guest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'phone_number',
        'name',
        'first_visit_at',
        'last_visit_at',
        'loyalty_points',
        'preferences',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'first_visit_at' => 'datetime',
        'last_visit_at' => 'datetime',
        'preferences' => 'array',
    ];

    /**
     * Get all orders for the guest.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get all sessions for the guest.
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(GuestSession::class);
    }

    /**
     * Get all payments through orders.
     */
    public function payments(): HasManyThrough
    {
        return $this->hasManyThrough(Payment::class, Order::class);
    }

    /**
     * Get the active session for the guest.
     */
    public function activeSession()
    {
        return $this->sessions()->where('status', 'active')->latest()->first();
    }

    /**
     * Update last visit timestamp.
     */
    public function updateLastVisit(): void
    {
        $this->update(['last_visit_at' => now()]);
    }
}
