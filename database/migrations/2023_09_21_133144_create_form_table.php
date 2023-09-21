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
        Schema::create('form', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requester_ein')->references('user_ein')->on('requester')->cascadeOnDelete();
            $table->foreignId('item_code')->references('code')->on('items')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('form');
    }
};