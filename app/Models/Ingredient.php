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
     * Relationship: Ingredient has many IngredientUsage records (1:M)
     * Ek ingredient bohot saray usage records mein ho sakta hai
     */
    public function usageRecords()
    {
        return $this->hasMany(IngredientUsage::class, 'ingredient_id', 'id');
    }

    /**
     * Scope: Get low stock ingredients
     * Low stock ingredients retrieve karna (quantity <= reorder level)
     */
    public function scopeLowStock($query)
    {
        return $query->whereColumn('quantity', '<=', 'lowStockThreshold');
    }
}
