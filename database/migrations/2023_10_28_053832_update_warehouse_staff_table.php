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
        Schema::table('warehouse_staff', function (Blueprint $table) {
            $table->renameColumn('user_ein', 'user_id');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::table('warehouse_staff', function (Blueprint $table) {
            $table->renameColumn('user_id', 'user_ein');
        });
    }
};
