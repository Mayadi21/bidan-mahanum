<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        $sql = "
        DROP PROCEDURE IF EXISTS add_user;

        CREATE PROCEDURE add_user(
            IN p_nama VARCHAR(255),
            IN p_alamat VARCHAR(255),
            IN p_tanggal_lahir DATE,
            IN p_pekerjaan VARCHAR(255),
            IN p_no_hp VARCHAR(15),
            IN p_role VARCHAR(50),
            IN p_email VARCHAR(255),
            IN p_password VARCHAR(255),
            IN p_gaji_pokok INT,
            IN p_tanggal_input DATE
        )
        BEGIN
            DECLARE v_user_id INT;
            DECLARE v_awal_periode_gaji DATE;
            DECLARE v_akhir_periode_gaji DATE;

            INSERT INTO users (nama, alamat, tanggal_lahir, pekerjaan, no_hp, role, email, password)
            VALUES (p_nama, p_alamat, p_tanggal_lahir, p_pekerjaan, p_no_hp, p_role, p_email, p_password);

            -- Ambil ID pengguna yang baru ditambahkan
            SET v_user_id = LAST_INSERT_ID();

            IF p_role = 'pegawai' THEN
                IF DAY(p_tanggal_input) >= 25 THEN
                    SET v_awal_periode_gaji = DATE_FORMAT(p_tanggal_input, '%Y-%m-25');
                    SET v_akhir_periode_gaji = DATE_ADD(DATE_FORMAT(p_tanggal_input, '%Y-%m-24'), INTERVAL 1 MONTH);
                ELSE
                    SET v_awal_periode_gaji = DATE_SUB(DATE_FORMAT(p_tanggal_input, '%Y-%m-25'), INTERVAL 1 MONTH);
                    SET v_akhir_periode_gaji = DATE_FORMAT(p_tanggal_input, '%Y-%m-24');
                END IF;

                INSERT INTO penggajian (id_bidan, gaji_pokok, awal_periode_gaji, akhir_periode_gaji, tanggal_penggajian)
                VALUES (v_user_id, p_gaji_pokok, v_awal_periode_gaji, v_akhir_periode_gaji, NULL);
            END IF;
        END;
                ";
                
                DB::unprepared($sql);
    }
};
