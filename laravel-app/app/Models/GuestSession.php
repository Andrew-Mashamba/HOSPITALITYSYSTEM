<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GuestSession extends Model
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
        'session_token',
        'status',
        'started_at',
        'ended_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    /**
     * Get the guest for this session.
     */
    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    /**
     * Get the table for this session.
     */
    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    /**
     * Get all orders for this session.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'session_id');
    }

    /**
     * Close the session.
     */
    public function close(): void
    {
        $this->update([
            'status' => 'closed',
            'ended_at' => now(),
        ]);
    }

    /**
     * Check if session is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }
}
