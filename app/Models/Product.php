<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Mass assignment ke liye allowed fields
    protected $fillable = [
        'productName', 'description', 'category', 'price',
        'stockQuantity', 'imageUrl', 'isActive',
    ];

    // Type casting for specific fields
    protected $casts = [
        'price' => 'decimal:2',
        'stockQuantity' => 'integer',
        'isActive' => 'boolean',
    ];

    /**
     * Relationship: Product has many OrderItems (1:M)
     * Ek product bohot saray order items mein ho sakta hai
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'productId', 'id');
    }

    /**
     * Scope: Get active products only
     * Sirf active products retrieve karna
     */
    public function scopeActive($query)
    {
        return $query->where('isActive', true);
    }

    /**
     * Scope: Get low stock products
     * Low stock products retrieve karna (quantity < 10)
     */
    public function scopeLowStock($query, $threshold = 10)
    {
        return $query->where('stockQuantity', '<', $threshold);
    }

    /**
     * Accessor: Get stock attribute (alias for stockQuantity)
     */
    public function getStockAttribute()
    {
        return $this->stockQuantity;
    }

    /**
     * Accessor: Get image attribute (alias for imageUrl)
     */
    public function getImageAttribute()
    {
        return $this->imageUrl;
    }

    /**
     * Accessor: Get name attribute (alias for productName)
     */
    public function getNameAttribute()
    {
        return $this->productName;
    }
}
