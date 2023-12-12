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
        Schema::create('financial_statements', function (Blueprint $table) {
            $table->id('id_financial_statement');
            $table->bigInteger('total_pemasukan');
            $table->bigInteger('total_pengeluaran');
            $table->bigInteger('total_hutang');
            $table->bigInteger('laba');
            $table->datetime('tanggal');
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
        Schema::dropIfExists('financial_statements');

        Schema::table('financial_statements', function (Blueprint $table) {
            $table->dropColumn('id_user');
        });
    }
};
