<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // DB::unprepared('
        //     CREATE TRIGGER items AFTER INSERT ON request
        //     FOR EACH ROW
        //     BEGIN
        //         DECLARE total INT;
        //         SET total = NEW.total;
        //         UPDATE barang SET total = total - total WHERE kd_barang = NEW.id_barang;
        //     END
        // ');

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER `update_stok_barang`');
    }
};
