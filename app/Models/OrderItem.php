<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Get order of this item
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get product of this item
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
