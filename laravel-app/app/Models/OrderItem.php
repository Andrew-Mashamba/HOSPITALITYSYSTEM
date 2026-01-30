<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'menu_item_id',
        'quantity',
        'unit_price',
        'subtotal',
        'status',
        'notes',
        'prepared_by',
        'prepared_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'quantity' => 'integer',
        'prepared_at' => 'datetime',
    ];

    /**
     * Get the order for this item.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the menu item for this order item.
     */
    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }

    /**
     * Get the staff who prepared this item.
     */
    public function preparedBy(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'prepared_by');
    }

    /**
     * Mark item as received by kitchen/bar.
     */
    public function markAsReceived(Staff $staff): void
    {
        $this->update([
            'status' => 'received',
            'prepared_by' => $staff->id,
        ]);
    }

    /**
     * Mark item as done.
     */
    public function markAsDone(): void
    {
        $this->update([
            'status' => 'done',
            'prepared_at' => now(),
        ]);
    }

    /**
     * Calculate subtotal based on quantity and unit price.
     */
    public function calculateSubtotal(): void
    {
        $this->update([
            'subtotal' => $this->quantity * $this->unit_price,
        ]);
    }
}
