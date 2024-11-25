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
        $sql = '
            DROP TRIGGER IF EXISTS cek_janji_temu_belum_selesai;
            CREATE TRIGGER cek_janji_temu_belum_selesai
            BEFORE INSERT ON `janji_temu`
            FOR EACH ROW
            BEGIN
                -- Periksa apakah pasien sudah memiliki janji temu dengan status "disetujui"
                IF EXISTS (
                    SELECT 1
                    FROM `janji_temu`
                    WHERE `id_pasien` = NEW.id_pasien
                      AND `status` = "disetujui"
                ) THEN
                    -- Jika ada, tampilkan pesan error dan batalkan insert
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT = "Terjadi kesalahan: [Pasien yang ditambahkan sedang memiliki janji temu yang disetujui. Harap selesaikan janji temu tersebut terlebih dahulu.]";
                END IF;
            END;
        ';
        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
