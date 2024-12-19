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
        // $sql = "
        // SET GLOBAL event_scheduler = ON;

        // DROP EVENT IF EXISTS event_generate_penggajian;
        // CREATE EVENT IF NOT EXISTS event_generate_penggajian
        // ON SCHEDULE
        // EVERY 1 MONTH
        // DO
        // CALL generate_monthly_penggajian();
        
        //         ";
                
                // DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
