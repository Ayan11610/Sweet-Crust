<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Order items ka table - Har order mein kya kya items hain
    // Order items table - What items are in each order
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orderId'); // Kis order ka item hai - Which order this item belongs to
            $table->unsignedBigInteger('productId'); // Konsa product hai - Which product
            $table->integer('quantity'); // Kitni quantity - How many quantity
            $table->decimal('price', 8, 2); // Us waqt ki price - Price at that time
            $table->text('customization')->nullable(); // Special instructions (e.g., "Happy Birthday" on cake)
            $table->timestamps();
            
            // Foreign keys - M:1 relationships
            $table->foreign('orderId')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('productId')->references('id')->on('products')->onDelete('cascade');
        });
    }

    // Table delete karna - Drop table
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
