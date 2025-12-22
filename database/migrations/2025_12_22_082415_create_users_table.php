<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Staff users ka table banana - Create staff users table
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // User ka naam - User name
            $table->string('email')->unique(); // Email unique hona chahiye - Email must be unique
            $table->string('password')->nullable(); // Password encrypted form mein - Encrypted password (nullable during registration)
            $table->unsignedBigInteger('roleId'); // Role ID (Admin, Baker, Staff)
            $table->boolean('verified')->default(false); // Email verify hui ya nahi - Email verified or not
            $table->timestamps();
            
            // Foreign key - Role table se link - Link to roles table
            $table->foreign('roleId')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    // Table delete karna - Drop table
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
