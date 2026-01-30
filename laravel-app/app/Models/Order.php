<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'guest_id',
        'table_id',
        'waiter_id',
        'session_id',
        'status',
        'order_source',
        'subtotal',
        'tax',
        'service_charge',
        'total_amount',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'service_charge' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];

    /**
     * Get the guest for this order.
     */
    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    /**
     * Get the table for this order.
     */
    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    /**
     * Get the waiter for this order.
     */
    public function waiter(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'waiter_id');
    }

    /**
     * Get the session for this order.
     */
    public function session(): BelongsTo
    {
        return $this->belongsTo(GuestSession::class, 'session_id');
    }

    /**
     * Get all items in this order.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get all payments for this order.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get all tips for this order.
     */
    public function tips(): HasMany
    {
        return $this->hasMany(Tip::class);
    }

    /**
     * Calculate and update order totals.
     */
    public function calculateTotals(): void
    {
        $subtotal = $this->items()->sum('subtotal');
        $tax = $subtotal * 0.18; // 18% VAT
        $serviceCharge = $subtotal * 0.05; // 5% service charge
        $total = $subtotal + $tax + $serviceCharge;

        $this->update([
            'subtotal' => $subtotal,
            'tax' => $tax,
            'service_charge' => $serviceCharge,
            'total_amount' => $total,
        ]);
    }

    /**
     * Update order status.
     */
    public function updateStatus(string $status): void
    {
        $this->update(['status' => $status]);
    }

    /**
     * Check if order is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if order is completed.
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }
}
