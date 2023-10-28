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
        Schema::table('reports', function (Blueprint $table) {
            $table->renameColumn('warehouse_staff_ein', 'warehouse_staff_id');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->renameColumn('warehouse_staff_id', 'warehouse_staff_ein');
        });
    }
};
