<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Item
            // Kategori item sesuai request lu
            $table->enum('category', ['attack', 'magic', 'defense', 'movement', 'jungling', 'roaming']);
            $table->string('image')->nullable(); // Foto Item
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};