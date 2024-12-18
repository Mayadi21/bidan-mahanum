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
        $sql_insert = "
            DROP PROCEDURE IF EXISTS simpan_transaksi;

            CREATE PROCEDURE simpan_transaksi(
                IN p_janji_temu VARCHAR(10),
                IN p_janji_id INT,
                IN p_pasien_id INT,
                IN p_bidan_id INT,
                IN p_keterangan TEXT,
                IN p_tanggal DATETIME,
                IN p_layanan_ids TEXT
            )
            BEGIN
                DECLARE v_transaction_id INT;
                DECLARE v_pasien_id INT;
                DECLARE v_janji_promo_id INT;
                DECLARE v_layanan_id INT;
                DECLARE v_layanan_harga INT;
                DECLARE v_potongan INT DEFAULT 0;
                DECLARE v_bonus_pegawai INT DEFAULT 0;
                DECLARE v_cursor_done INT DEFAULT FALSE;
                DECLARE v_waktu_mulai DATETIME;
                DECLARE v_existing_bonus INT;
                DECLARE v_role_bidan VARCHAR(20);

                -- Cursor untuk memproses layanan ID
                DECLARE layanan_cursor CURSOR FOR 
                    SELECT TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(p_layanan_ids, ',', numbers.n), ',', -1)) AS layanan_id
                    FROM (SELECT 1 n UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6) numbers
                    WHERE CHAR_LENGTH(p_layanan_ids) - CHAR_LENGTH(REPLACE(p_layanan_ids, ',', '')) + 1 >= numbers.n;

                DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_cursor_done = TRUE;

                SELECT role INTO v_role_bidan
                FROM users
                WHERE id = p_bidan_id;

                IF p_janji_temu = 'ya' THEN
                    SELECT id_pasien, jadwal_promo_id, waktu_mulai
                    INTO v_pasien_id, v_janji_promo_id, v_waktu_mulai
                    FROM view_jadwal_janji_temu 
                    WHERE id = p_janji_id;

                    IF p_tanggal <> DATE(v_waktu_mulai) THEN
                        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 
                        'Promo hanya dapat diklaim pada saat jadwal janji pasien';
                    END IF;
                ELSE
                    SET v_pasien_id = p_pasien_id; 
                    SET v_janji_promo_id = NULL;
                END IF;

                START TRANSACTION;

                INSERT INTO transaksi (id_pasien, janji_id, bidan, keterangan, tanggal)
                VALUES (v_pasien_id, p_janji_id, p_bidan_id, p_keterangan, p_tanggal);

                SET v_transaction_id = LAST_INSERT_ID();

                -- Proses setiap layanan
                OPEN layanan_cursor;

                layanan_loop: LOOP
                    FETCH layanan_cursor INTO v_layanan_id;
                    IF v_cursor_done THEN
                        LEAVE layanan_loop;
                    END IF;

                    SELECT harga, besar_bonus INTO v_layanan_harga, v_bonus_pegawai
                    FROM layanan 
                    WHERE id = v_layanan_id;

                    -- Cek promo jika ada janji temu
                    IF p_janji_temu = 'ya' AND v_janji_promo_id IS NOT NULL THEN
                        SELECT IFNULL(diskon, 0) INTO v_potongan
                        FROM promo
                        JOIN detail_promo ON promo.id = detail_promo.promo_id
                        WHERE detail_promo.id = v_janji_promo_id AND promo.layanan_id = v_layanan_id;
                    ELSE
                        SET v_potongan = 0;
                    END IF;

                    -- Atur bonus_pegawai ke 0 jika role bidan adalah 'admin'
                    IF v_role_bidan = 'admin' THEN
                        SET v_bonus_pegawai = 0;
                    END IF;

                    -- Simpan Detail Transaksi
                    INSERT INTO detail_transaksi (transaksi_id, layanan_id, harga, potongan, bonus_pegawai)
                    VALUES (v_transaction_id, v_layanan_id, v_layanan_harga, v_potongan, v_bonus_pegawai);

                    -- Tambahkan bonus ke tabel penggajian jika role bidan bukan 'admin'
                    IF v_role_bidan <> 'admin' THEN
                        SELECT bonus INTO v_existing_bonus
                        FROM penggajian
                        WHERE id_bidan = p_bidan_id
                        AND p_tanggal BETWEEN awal_periode_gaji AND akhir_periode_gaji
                        LIMIT 1;

                        IF v_existing_bonus IS NOT NULL THEN
                            -- Update bonus jika penggajian sudah ada
                            UPDATE penggajian
                            SET bonus = bonus + v_bonus_pegawai
                            WHERE id_bidan = p_bidan_id
                            AND p_tanggal BETWEEN awal_periode_gaji AND akhir_periode_gaji;
                        ELSE
                            -- Insert penggajian baru jika belum ada periode gaji
                            INSERT INTO penggajian (id_bidan, gaji_pokok, bonus, awal_periode_gaji,
                             akhir_periode_gaji, status)
                            VALUES (p_bidan_id, 0, v_bonus_pegawai, DATE_FORMAT(p_tanggal, '%Y-%m-01')
                            , LAST_DAY(p_tanggal), '0');
                        END IF;
                    END IF;

                END LOOP;

                CLOSE layanan_cursor;

                -- Tandai janji temu sebagai selesai jika berasal dari janji temu
                IF p_janji_temu = 'ya' THEN
                    UPDATE janji_temu
                    SET status = 'selesai', keterangan = p_keterangan
                    WHERE id = p_janji_id;
                END IF;

                COMMIT;
            END;
        ";
        
        DB::unprepared($sql_insert);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};