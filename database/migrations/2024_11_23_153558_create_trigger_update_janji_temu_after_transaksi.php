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
            DROP TRIGGER IF EXISTS update_janji_temu_after_transaksi;
            CREATE TRIGGER update_janji_temu_after_transaksi
            AFTER INSERT ON `transaksi`
            FOR EACH ROW
            BEGIN
                -- Periksa apakah transaksi berasal dari janji temu
                IF EXISTS (
                    SELECT 1
                    FROM `janji_temu`
                    WHERE `id_pasien` = NEW.id_pasien
                      AND `status` = "disetujui"
                ) THEN
                    -- Update status janji temu menjadi selesai dan tambahkan keterangan
                    UPDATE `janji_temu`
                    SET `status` = "selesai",
                        `keterangan` = NEW.keterangan
                    WHERE `id_pasien` = NEW.id_pasien
                      AND `status` = "disetujui";
                END IF;
            END;        ';
        DB::unprepared($sql);

    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
