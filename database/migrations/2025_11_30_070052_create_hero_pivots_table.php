<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Hubungan Hero <-> Role
        Schema::create('hero_role', function (Blueprint $table) {
            $table->foreignId('hero_id')->constrained('heroes')->onDelete('cascade');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
        });

        // Tabel Hubungan Hero <-> Item
        Schema::create('hero_item', function (Blueprint $table) {
            $table->foreignId('hero_id')->constrained('heroes')->onDelete('cascade');
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
        });

        Schema::create('hero_position', function (Blueprint $table) {
            $table->foreignId('hero_id')->constrained()->onDelete('cascade');
            $table->foreignId('position_id')->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_role');
        Schema::dropIfExists('hero_item');
        Schema::dropIfExists('hero_position');
    }
};