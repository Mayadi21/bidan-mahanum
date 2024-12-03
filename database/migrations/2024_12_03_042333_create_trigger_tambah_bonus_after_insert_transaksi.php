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
        DROP TRIGGER IF EXISTS tambah_bonus_after_insert;

        CREATE TRIGGER tambah_bonus_after_insert
        AFTER INSERT ON detail_transaksi
        FOR EACH ROW
        BEGIN
            CALL menambahkan_bonus_bidan(NEW.transaksi_id);
        END
        ";

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
