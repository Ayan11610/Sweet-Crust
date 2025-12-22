<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Ingredient usage ka table - Track karne ke liye ke kahan use hua
    // Ingredient usage table - To track where ingredients were used
    public function up()
    {
        Schema::create('ingredient_usage', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orderId'); // Kis order mein use hua - Which order used it
            $table->unsignedBigInteger('ingredientId'); // Konsa ingredient use hua - Which ingredient
            $table->decimal('quantityUsed', 10, 2); // Kitna use hua - How much was used
            $table->timestamps();
            
            // Foreign keys - M:1 relationships
            $table->foreign('orderId')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('ingredientId')->references('id')->on('ingredients')->onDelete('cascade');
        });
    }

    // Table delete karna - Drop table
    public function down()
    {
        Schema::dropIfExists('ingredient_usage');
    }
};
