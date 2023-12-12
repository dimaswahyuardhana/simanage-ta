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
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('id_company')->references('id_company')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_role')->references('id_role')->on('roles')->onDelete('cascade')->onUpdate('cascade');
        });

        // Schema::table('incomes', function (Blueprint $table) {
        //     $table->foreign('id_company')->references('id_company')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        // });

        // Schema::table('expenditures', function (Blueprint $table) {
        //     $table->foreign('id_company')->references('id_company')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        // });

        // Schema::table('debts', function (Blueprint $table) {
        //     $table->foreign('id_company')->references('id_company')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        // });

        // Schema::table('financial_statements', function (Blueprint $table) {
        //     $table->foreign('id_company')->references('id_company')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
