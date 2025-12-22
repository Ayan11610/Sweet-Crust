<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Migration chalana - Run the migrations
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Role ka naam - Role name (Admin, Baker, Staff)
            $table->timestamps();
        });
    }

    // Migration wapas lena - Reverse the migrations
    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
