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
        DB::statement('
            CREATE OR REPLACE VIEW view_gaji_pokok AS
            SELECT 
                gaji_pokok.id AS id,
                users.nama AS nama_bidan,
                gaji_pokok.gaji_pokok
            FROM gaji_pokok
            JOIN users ON gaji_pokok.id_bidan = users.id
            WHERE users.role = "pegawai" AND users.status = "aktif"
            ORDER BY nama_bidan DESC;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_gaji_pokok');
    }
};
