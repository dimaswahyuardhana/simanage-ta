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
        Schema::create('jabatans', function (Blueprint $table) {
            $table->id('id_jabatan');
            $table->string('jabatan')->default('none');
            $table->bigInteger('gaji')->default(0);
            // $table->string('id_company'); //
            $table->string('id_company');
            $table->timestamps();

            $table->foreign('id_company')->references('id_company')->on('companies')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('id_jabatan');
            $table->foreign('id_jabatan')->references('id_jabatan')->on('jabatans')->onUpdate('cascade')->onDelete('cascade');
        });

        // DB::table('jabatans')->insert([
        //     ['id_jabatan' => 1, 'jabatan' => 'none']
        // ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jabatans');
    }
};
