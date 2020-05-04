<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id_pro');
            $table->string('nama_pro');
            $table->integer('harga_pro');
			$table->integer('diskon');
			$table->string('deleted_by');
			$table->integer('id_owner');
			$table->string('nama_gam');
			$table->string('keterangan');
			$table->integer('jumlah_transaksi');
			$table->softDeletes();
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
        //
    }
}
