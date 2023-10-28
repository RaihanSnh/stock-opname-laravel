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
        Schema::table('form', function (Blueprint $table) {
            $table->renameColumn('item_code', 'item_id');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::table('form', function (Blueprint $table) {
            $table->renameColumn('item_id', 'item_code');
        });
    }
};
