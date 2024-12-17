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
          DROP FUNCTION IF EXISTS hitung_total_harga;

          CREATE FUNCTION hitung_total_harga(transaksi_id INT) 
          RETURNS INT
          DETERMINISTIC
          BEGIN
              DECLARE total_harga DECIMAL(10,2); 

              SELECT 
                  SUM(dt.harga - IFNULL(dt.potongan, 0)) 
              INTO 
                  total_harga
              FROM 
                  detail_transaksi dt 
              WHERE 
                  dt.transaksi_id = transaksi_id;

              RETURN IFNULL(total_harga, 0); 
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
