<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    // Mass assignment ke liye allowed fields
    protected $fillable = [
        'orderId',
        'productId',
        'quantity',
        'price',
        'customization',
    ];

    // Type casting for specific fields
    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
    ];

    /**
     * Relationship: OrderItem belongs to Order (M:1)
     * Har order item ek order se belong karta hai
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'orderId', 'id');
    }

    /**
     * Relationship: OrderItem belongs to Product (M:1)
     * Har order item ek product se belong karta hai
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'productId', 'id');
    }
}
