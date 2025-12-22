<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Verification codes ka table - Email verification ke liye
    // Table for verification codes - For email verification
    public function up()
    {
        Schema::create('verification_codes', function (Blueprint $table) {
            $table->id();
            $table->string('email'); // Email jisko code bheja gaya - Email to which code was sent
            $table->string('code'); // 6 digit random code
            $table->string('userType'); // 'staff' ya 'customer' - 'staff' or 'customer'
            $table->boolean('verified')->default(false); // Code verify hua ya nahi - Code verified or not
            $table->timestamp('expiresAt'); // Code ki expiry time - Code expiry time
            $table->timestamps();
        });
    }

    // Table delete karna - Drop table
    public function down()
    {
        Schema::dropIfExists('verification_codes');
    }
};
