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


        DROP FUNCTION IF EXISTS get_transaksi_by_date;
        CREATE FUNCTION get_transaksi_by_date(input_date DATE)
        RETURNS INT
        DETERMINISTIC
        BEGIN
            DECLARE jumlah_transaksi INT;

            SELECT COUNT(*)
            INTO jumlah_transaksi
            FROM transaksi
            WHERE DATE(tanggal) = input_date;

            RETURN jumlah_transaksi;
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
