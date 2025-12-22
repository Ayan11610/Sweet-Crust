<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientUsage extends Model
{
    use HasFactory;

    // Mass assignment ke liye allowed fields
    protected $fillable = [
        'orderId',
        'ingredientId',
        'quantityUsed',
    ];

    // Type casting for specific fields
    protected $casts = [
        'quantityUsed' => 'decimal:2',
    ];

    /**
     * Relationship: IngredientUsage belongs to Order (M:1)
     * Har ingredient usage ek order se belong karta hai
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'orderId', 'id');
    }

    /**
     * Relationship: IngredientUsage belongs to Ingredient (M:1)
     * Har ingredient usage ek ingredient se belong karta hai
     */
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class, 'ingredientId', 'id');
    }
}
