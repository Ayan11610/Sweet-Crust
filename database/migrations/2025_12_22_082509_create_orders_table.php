<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Orders ka table - Customer orders track karne ke liye
    // Orders table - To track customer orders
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customerId')->nullable(); // Customer ID (agar customer ne order kiya)
            $table->unsignedBigInteger('userId')->nullable(); // Staff ID (agar staff ne order banaya)
            $table->string('customerName'); // Customer ka naam - Customer name
            $table->string('customerEmail'); // Customer ki email - Customer email
            $table->string('customerPhone')->nullable(); // Phone number
            $table->text('deliveryAddress')->nullable(); // Delivery ka address - Delivery address
            $table->decimal('totalAmount', 10, 2); // Total amount
            $table->string('status')->default('Pending'); // Order status (Pending, In-Process, Completed, Delivered)
            $table->timestamps();
            
            // Foreign keys - Relationships
            $table->foreign('customerId')->references('id')->on('customers')->onDelete('set null');
            $table->foreign('userId')->references('id')->on('users')->onDelete('set null');
        });
    }

    // Table delete karna - Drop table
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
