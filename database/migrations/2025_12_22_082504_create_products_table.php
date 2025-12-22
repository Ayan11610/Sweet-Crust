<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Products ka table - Bakery items ke liye
    // Products table - For bakery items
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('productName'); // Product ka naam - Product name (e.g., Chocolate Cake)
            $table->text('description'); // Product ki details - Product details
            $table->decimal('price', 8, 2); // Price in decimal format
            $table->string('category'); // Category (Cakes, Pastries, Desserts)
            $table->integer('stockQuantity')->default(0); // Stock quantity - Available stock
            $table->string('imageUrl')->nullable(); // Image path - Image file path
            $table->boolean('isActive')->default(true); // Active status - Product visibility
            $table->timestamps();
        });
    }

    // Table delete karna - Drop table
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
