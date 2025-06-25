<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'category_id',
        'slug',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Get category of this product
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get order items for this product
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
