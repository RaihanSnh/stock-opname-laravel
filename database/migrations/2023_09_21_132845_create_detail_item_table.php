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
        Schema::create('detail_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->references('id')->on('category')->cascadeOnDelete();
            $table->foreignId('unit_id')->references('id')->on('unit')->cascadeOnDelete();
            $table->foreignId('item_code')->references('code')->on('items')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_item');
    }
};
