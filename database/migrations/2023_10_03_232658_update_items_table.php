<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::table('items', function(Blueprint $table) {
            $table->foreignID('detail_item_id')->references('id')->on('detail_item');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::table('items', function(Blueprint $table) {
            $table->dropColumn('detail_item_id');
        });
    }
};
