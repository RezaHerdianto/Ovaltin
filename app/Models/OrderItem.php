<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'strawberry_product_id',
        'product_name',
        'quantity',
        'price_per_unit',
        'subtotal',
    ];

    protected $casts = [
        'price_per_unit' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    /**
     * Get the order that owns the order item
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product for the order item
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(StrawberryProduct::class, 'strawberry_product_id');
    }

    /**
     * Get formatted price per unit
     */
    public function getFormattedPricePerUnitAttribute(): string
    {
        return 'Rp ' . number_format($this->price_per_unit, 0, ',', '.');
    }

    /**
     * Get formatted subtotal
     */
    public function getFormattedSubtotalAttribute(): string
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }
}
