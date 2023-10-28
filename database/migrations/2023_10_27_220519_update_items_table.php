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
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign(['detail_item_id']);
            $table->dropColumn('detail_item_id');
            $table->foreignId('category_id')->references('id')->on('category');
            $table->foreignId('unit_id')->references('id')->on('unit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->foreignId('detail_item_id')->references('id')->on('detail_item_id');
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->dropForeign(['unit_id']);
            $table->dropColumn('unit_id');
        });
    }
};
