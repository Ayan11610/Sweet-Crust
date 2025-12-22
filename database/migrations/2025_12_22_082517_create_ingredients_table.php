<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Ingredients ka table - Inventory management ke liye
    // Ingredients table - For inventory management
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ingredient ka naam - Ingredient name (e.g., Flour, Sugar)
            $table->decimal('quantity', 10, 2); // Available quantity
            $table->string('unit'); // Unit of measurement (kg, liters, pieces)
            $table->decimal('lowStockThreshold', 10, 2); // Minimum quantity - Jab is se kam ho to alert
            $table->timestamps();
        });
    }

    // Table delete karna - Drop table
    public function down()
    {
        Schema::dropIfExists('ingredients');
    }
};
