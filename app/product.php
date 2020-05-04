<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
  //
	use SoftDeletes;
	
	protected $table='products';
	
	protected $fillable = ['nama_pro','harga_pro','id_owner','diskon','deleted_by','nama_gam','keterangan'];
	
	protected $dates=['deleted_at'];
	
	protected $primaryKey='id_pro';
  
	public function user(){
	  $this->belongsTo('App\User');
	}
	
	public function transaksi(){
	  $this->belongsTo('App\transaksi');
	}
	
}
