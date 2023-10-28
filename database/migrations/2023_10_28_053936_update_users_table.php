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
        Schema::table('users', function (Blueprint $table) {
            $table->date('date_of_birth')->nullable();
            $table->string('ein');
        });
    
        DB::statement("UPDATE users SET date_of_birth = '1980-01-01' WHERE date_of_birth IS NULL");
    
        Schema::table('users', function (Blueprint $table) {
            $table->date('date_of_birth')->nullable(false)->change();
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('date_of_birth');
            $table->dropColumn('ein');
        });
    }
};
