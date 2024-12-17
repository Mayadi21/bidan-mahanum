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
        $sql = "

        DROP PROCEDURE IF EXISTS generate_monthly_penggajian;

        CREATE PROCEDURE generate_monthly_penggajian()
        BEGIN
            -- Variabel deklarasi
            DECLARE done INT DEFAULT 0;
            DECLARE id_pegawai INT;
            DECLARE gaji_pokok DECIMAL(10, 2);
            DECLARE awal_periode DATE;
            DECLARE akhir_periode DATE;
            
            DECLARE cur CURSOR FOR 
                SELECT users.id, gaji_pokok.gaji_pokok
                FROM users
                JOIN gaji_pokok ON users.id = gaji_pokok.id_bidan
                WHERE users.role = 'pegawai'; -- Mengubah role dari 'bidan' ke 'pegawai'

            DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

            OPEN cur;

            -- Loop untuk membaca semua pegawai satu per satu
            read_loop: LOOP
                FETCH cur INTO id_pegawai, gaji_pokok;
                IF done THEN
                    LEAVE read_loop;
                END IF;

                -- Tentukan tanggal periode gaji (25 bulan lalu sampai 24 bulan ini)
                SET awal_periode = DATE_SUB(CURDATE(), INTERVAL 1 MONTH);
                SET awal_periode = DATE_FORMAT(awal_periode, '%Y-%m-25'); -- Mulai dari tanggal 25 bulan sebelumnya
                SET akhir_periode = DATE_FORMAT(CURDATE(), '%Y-%m-24'); -- Sampai tanggal 24 bulan berjalan

                INSERT INTO penggajian (id_bidan, gaji_pokok, bonus, awal_periode_gaji, akhir_periode_gaji, tanggal_penggajian)
                VALUES (id_pegawai, gaji_pokok, 0, awal_periode, akhir_periode, NULL);
            END LOOP;

            -- Menutup cursor
            CLOSE cur;
        END;
        ";

        DB::unprepared($sql);



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
