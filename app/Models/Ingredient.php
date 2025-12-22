<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    // Mass assignment ke liye allowed fields
    protected $fillable = [
        'name',
        'quantity',
        'unit',
        'lowStockThreshold',
    ];

    // Type casting for specific fields
    protected $casts = [
        'quantity' => 'decimal:2',
        'lowStockThreshold' => 'decimal:2',
    ];

    /**
     * Scope: Get low stock ingredients
     * Low stock ingredients retrieve karna (quantity <= reorder level)
     */
    public function scopeLowStock($query)
    {
        return $query->whereColumn('quantity', '<=', 'lowStockThreshold');
    }
}
