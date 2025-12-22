<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Mass assignment ke liye allowed fields
    protected $fillable = [
        'customerId', 'userId', 'customerName', 'customerEmail',
        'customerPhone', 'deliveryAddress', 'totalAmount', 'status',
    ];

    // Type casting for specific fields
    protected $casts = [
        'totalAmount' => 'decimal:2',
    ];

    /**
     * Relationship: Order belongs to Customer (M:1)
     * Har order ek customer se belong karta hai
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerId', 'id');
    }

    /**
     * Relationship: Order belongs to User/Staff (M:1)
     * Har order ek staff member ne create kiya hai
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    /**
     * Relationship: Order has many OrderItems (1:M)
     * Ek order mein bohot saray items ho sakte hain
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'orderId', 'id');
    }

    /**
     * Relationship: Order has many IngredientUsages (1:M)
     */
    public function ingredientUsages()
    {
        return $this->hasMany(IngredientUsage::class, 'orderId', 'id');
    }
}
