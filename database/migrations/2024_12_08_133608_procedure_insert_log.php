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
        $sql = " DROP PROCEDURE IF EXISTS insert_log;

        CREATE PROCEDURE insert_log(IN id_pengguna INT UNSIGNED, IN nama_pengguna varchar(255), IN transaksi INT UNSIGNED, IN target varchar(255),  IN description VARCHAR(6), IN oldValue varchar(255), IN newValue varchar(255))
        BEGIN
            INSERT INTO logs (log_time, id_user, nama, transaksi_id, log_target, log_description, old_value, new_value)
            VALUES (NOW(), id_pengguna, nama_pengguna, transaksi, target, description, oldValue, newValue);
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
