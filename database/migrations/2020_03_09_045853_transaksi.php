<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Transaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::create('transaksi', function (Blueprint $table) {
            $table->bigIncrements('id_trans');
            $table->string('met_pem');
            $table->string('atas_nama');
			$table->string('alamat');
			$table->integer('id_produk');
			$table->integer('jumlah_produk');
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
