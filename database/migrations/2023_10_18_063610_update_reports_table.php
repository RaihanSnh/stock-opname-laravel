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
        Schema::table('reports', function (Blueprint $table) {
            $table->foreignId('reports_in_id')->references('id')->on('reports_in');
            $table->foreignId('reports_out_id')->references('id')->on('reports_out');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign(['reports_in_id']);
            $table->dropColumn('reports_in_id');
            $table->dropForeign(['reports_out_id']);
            $table->dropColumn('reports_out_id');
        });
    }
};