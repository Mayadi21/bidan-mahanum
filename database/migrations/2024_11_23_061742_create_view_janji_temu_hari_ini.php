<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Membuat View
        DB::statement("
            CREATE OR REPLACE VIEW view_jadwal_janji_temu AS
            SELECT 
                jt.id,
                u.id id_pasien,
                u.nama AS pasien_nama, 
                jt.keluhan, 
                jt.waktu_janji, 
                jt.status,
                jt.keterangan
            FROM 
                janji_temu jt
            JOIN 
                users u ON jt.id_pasien = u.id
            ORDER BY waktu_janji DESC;  
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};