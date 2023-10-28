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
        Schema::table('items', function (Blueprint $table) {
            $table->renameColumn('code', 'id');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::table('items', function(Blueprint $table) {
            $table->renameColumn('id', 'code');
        });
    }
};
