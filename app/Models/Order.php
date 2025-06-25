<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'shipping_address',
        'phone',
        'notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    /**
     * Get user who placed this order
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get order items for this order
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
