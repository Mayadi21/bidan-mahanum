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
        DROP FUNCTION IF EXISTS total_kuota_promo;
        CREATE FUNCTION total_kuota_promo(promo_id INT) 
        RETURNS INT
        DETERMINISTIC
        BEGIN
            DECLARE total_kuota INT;
            
            SELECT SUM(kuota) INTO total_kuota
            FROM detail_promo
            WHERE promo_id = promo_id;
            
            RETURN total_kuota;
        END;
        ";

        DB::unprepared($sql);


        $sql = "
        DROP FUNCTION IF EXISTS kuota_terpakai_promo;
        CREATE FUNCTION kuota_terpakai_promo(promo_id INT) 
        RETURNS INT
        DETERMINISTIC
        BEGIN
            DECLARE kuota_terpakai INT;
            
            -- Menghitung kuota yang telah digunakan berdasarkan promo_id yang ada pada detail_promo
            SELECT COUNT(*) INTO kuota_terpakai
            FROM janji_temu jt
            JOIN detail_promo dp ON jt.jadwal_promo_id = dp.id
            WHERE dp.promo_id = promo_id AND jt.status != 'ditolak';
            
            RETURN kuota_terpakai;
        END
        ";

        DB::unprepared($sql);

        $sql = "
        DROP FUNCTION IF EXISTS sisa_kuota_promo;
        CREATE FUNCTION sisa_kuota_promo(promo_id INT) 
        RETURNS INT
        DETERMINISTIC
        BEGIN
            DECLARE total_kuota INT;
            DECLARE kuota_terpakai INT;
            
            -- Menggunakan fungsi total_kuota_promo untuk menghitung total kuota
            SET total_kuota = total_kuota_promo(promo_id);

            -- Memanggil fungsi kuota_terpakai_promo untuk menghitung kuota terpakai
            SET kuota_terpakai = kuota_terpakai_promo(promo_id);
            
            -- Mengembalikan sisa kuota
            RETURN total_kuota - kuota_terpakai;
        END
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
