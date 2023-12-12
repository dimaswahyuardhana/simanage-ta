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
        Schema::create('categories', function (Blueprint $table) {
            $table->id('id_kategori');
            $table->string('kategori');
        });

        DB::table('categories')->insert([
            ['id_kategori' => 1, 'kategori' => 'Pemasukan ( + )'],
            ['id_kategori' => 2, 'kategori' => 'Pengeluaran ( - )'],
            ['id_kategori' => 3, 'kategori' => 'Hutang ( - )']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
