<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('finances', function (Blueprint $table) {
            $table->id('id_finance');
            $table->string('keterangan');
            $table->bigInteger('jumlah_uang');
            $table->foreignId('id_kategori');
            $table->foreign('id_kategori')->references('id_kategori')->on('categories');
            $table->foreignId('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finances');

        Schema::table('finances', function (Blueprint $table) {
            $table->dropColumn('id_kategori');
        });

        Schema::table('finances', function (Blueprint $table) {
            $table->dropColumn('id_user');
        });
    }
};
