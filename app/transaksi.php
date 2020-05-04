<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    //
	protected $table='transaksi';
	protected $fillable=['met_pem','atas_nama','alamat','id_produk','jumlah_produk'];
	public function product(){
		return $this->hasMany('App\product');
	}
}
