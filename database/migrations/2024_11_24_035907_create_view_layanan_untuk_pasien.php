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
        DB::statement("
            CREATE OR REPLACE VIEW view_layanan_untuk_pasien AS
            SELECT 
                id AS id_layanan,
                jenis_layanan,
                deskripsi,
                harga,
                gambar
            FROM 
                layanan
            WHERE 
                status = 'aktif';
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
