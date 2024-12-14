<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('log', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedInteger('id_user');// id user yang melakukan aktivitas
            $table->string('nama');// nama user
            $table->string('objek'); // nama tabel
            $table->string('log_target', 255);
            $table->enum('log_description', ['insert', 'update', 'delete']); 
            $table->string('old_value');
            $table->string('new_value');
            $table->datetime('log_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log');
    }
};
