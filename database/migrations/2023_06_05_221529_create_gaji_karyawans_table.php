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
        Schema::create('gaji_karyawans', function (Blueprint $table) {
            $table->id('id_gaji_karyawan');
            $table->string('nama_karyawan');
            $table->bigInteger('total_gaji');
            $table->string('bukti_transfer_gaji')->nullable();
            $table->foreignId('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gaji_karyawans');

        Schema::table('gaji_karyawans', function (Blueprint $table) {
            $table->dropColumn('id_user');
        });
    }
};
