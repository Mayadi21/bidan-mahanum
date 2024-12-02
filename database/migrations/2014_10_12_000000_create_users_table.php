<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->date('tanggal_lahir');
            $table->string('alamat')->nullable();
            $table->string('pekerjaan') ->nullable();
            $table->string('no_hp')->unique();
            $table->enum('status', ['aktif','tidak aktif'])->default('aktif');
            $table->string('password');
            $table->enum('role', ['user','pegawai', 'admin'])->default('user');
            $table->string('email_verified_at')->nullable();
            $table->rememberToken();
        });
    }

    /**-d
     * Reverse the migrations.
     *--=--
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
