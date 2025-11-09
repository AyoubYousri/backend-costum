<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
    $table->id(); // id auto-incrémenté
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password');
    $table->enum('role', ['admin', 'seller']); // rôle admin ou seller
    $table->string('phone')->nullable();      // facultatif
    $table->string('address')->nullable();    // facultatif
    $table->timestamps();                     // created_at et updated_at
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists('users');
    }
};
