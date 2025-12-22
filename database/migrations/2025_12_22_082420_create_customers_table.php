<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Customers ka table banana - Create customers table
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Customer ka naam - Customer name
            $table->string('email')->unique(); // Email unique hona chahiye - Email must be unique
            $table->string('password')->nullable(); // Password encrypted - Encrypted password (nullable during registration)
            $table->string('phone')->nullable(); // Phone number optional - Optional phone
            $table->text('address')->nullable(); // Address optional - Optional address
            $table->boolean('verified')->default(false); // Email verify hui ya nahi - Email verified or not
            $table->timestamps();
        });
    }

    // Table delete karna - Drop table
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
