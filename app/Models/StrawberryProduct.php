<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrawberryProduct extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'category',
        'image_url',
        'origin',
        'harvest_date',
        'quality_grade',
        'is_organic',
        'nutritional_info'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'harvest_date' => 'date',
        'is_organic' => 'boolean',
    ];

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getStockStatusAttribute()
    {
        if ($this->stock_quantity == 0) {
            return 'Out of Stock';
        } elseif ($this->stock_quantity < 10) {
            return 'Low Stock';
        } else {
            return 'In Stock';
        }
    }

    public function getStockStatusColorAttribute()
    {
        if ($this->stock_quantity == 0) {
            return 'text-red-600 bg-red-100';
        } elseif ($this->stock_quantity < 10) {
            return 'text-yellow-600 bg-yellow-100';
        } else {
            return 'text-green-600 bg-green-100';
        }
    }
}
