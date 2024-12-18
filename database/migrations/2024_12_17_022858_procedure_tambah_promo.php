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

        DROP PROCEDURE IF EXISTS procedure_tambah_promo;

        CREATE PROCEDURE procedure_tambah_promo(
            IN judul_promo_param VARCHAR(255),
            IN deskripsi_param TEXT,
            IN layanan_id_param INT,
            IN diskon_param INT,
            IN kuota_param INT,
            IN tanggal_mulai_param DATE,
            IN tanggal_selesai_param DATE
        )
        BEGIN
            -- Deklarasi variabel
            DECLARE promo_id INT;
            DECLARE start_date DATE;
            DECLARE end_date DATE;
            DECLARE days INT;
            DECLARE quota_per_day INT;
            DECLARE remaining_quota INT;
            DECLARE current_promo_date DATE; 
            DECLARE i INT DEFAULT 0;
            DECLARE current_quota INT;
            DECLARE is_transaction_successful TINYINT(1) DEFAULT 1;
            DECLARE EXIT HANDLER FOR SQLEXCEPTION
            BEGIN
                SET is_transaction_successful = 0;
                ROLLBACK;
            END;

            START TRANSACTION;

            INSERT INTO promo (judul_promo, deskripsi, layanan_id, diskon)
            VALUES (judul_promo_param, deskripsi_param, layanan_id_param, diskon_param);
            
            -- Mendapatkan ID promo yang baru saja dimasukkan
            SET promo_id = LAST_INSERT_ID();
            
            SET start_date = tanggal_mulai_param;
            SET end_date = tanggal_selesai_param;
            SET days = DATEDIFF(end_date, start_date) + 1; -- Jumlah hari promo
            
            -- Menghitung kuota per hari dan sisa kuota
            SET quota_per_day = FLOOR(kuota_param / days); 
            SET remaining_quota = kuota_param - (quota_per_day * days); 
            
            -- Menambahkan detail promo untuk setiap hari
            WHILE i < days DO
                SET current_promo_date = DATE_ADD(start_date, INTERVAL i DAY);
                
                -- Distribusikan kuota
                SET current_quota = quota_per_day;
                IF i < remaining_quota THEN
                    SET current_quota = current_quota + 1; -- Tambahkan ke hari pertama
                END IF;
                
                INSERT INTO detail_promo (promo_id, tanggal, kuota)
                VALUES (
                    promo_id, 
                    current_promo_date, 
                    current_quota
                );
                
                SET i = i + 1;
            END WHILE;
            
            IF is_transaction_successful THEN
                COMMIT;
            END IF;

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

