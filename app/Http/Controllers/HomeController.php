<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\product;
use App\transaksi;

class homecontroller extends Controller
{
    //
	public function product(){
		$hasil= product::orderBy('jumlah_transaksi', 'desc')
				->take(10)
				->get();
        return view('/welcome',['product'=>$hasil]);
	}
	
	
	public function addcart(Request $request){
		//fungsi untuk menambah barang pada shop cart
		$produk=[$request->add_cart => [$request->jumlah]];
		$value=session()->get('cart');
		//mendapatkan barang yg akan ditambahkan dan mendapatkan isi shop cart
		if($value==Null){
			session()->put('cart',$produk);
			$value=session()->get('$cart');
			return redirect('/welcome');
			//cek apakah shop cart kosong dan mengisi shop cart dengan nilai baru
		}
		elseif(isset($value[$request->add_cart])){
			$value[$request->add_cart][0] = $request->jumlah ;
			session()->put('cart',$value);
			$value=session()->get('cart');	
			return redirect('/welcome');
			//mengecek apakah barang sudah ada di shop cart
			//jika ada menambah jumlah barang sesuai dengan barang yang ditambahkan
		}
		
		if(!isset($value[$request->add_cart])){
			$value[$request->add_cart]= [$request->jumlah];
			session()->put('cart',$value);
			$value=session()->get('cart');
			return redirect('/welcome');
			//mengecek apakah barang tidak ada pada shopcart
			//jika tidak ada menambah barang baru
		}
		//perlu diperhatikan yang di lakukan disini adalah mengubah nilai array pada $value
		//lalu mengganti isi session 
	}
	
	public function recart($id){
		//mengganti nilai session dengan array
		$value = session()->get('cart');
		$nex = arr::pull($value,$id);
		//mengambil nilai dan menghapus
		session()->put('cart',$value);
		return redirect('/welcome');
		
	}
	
	public function transaksi(Request $request){
		//menambahkan data transaksi ke database
		$value = session()->get('cart');
		$total = 0;
		if(!$value==Null){
			foreach($value as $ca => $jumlah){
				$pro=product::find($ca);
				$pro->jumlah_transaksi++;
				$pro->save();
				$total = $total + ($pro->harga_pro * $jumlah[0]);
				if(!$pro==Null){
					transaksi::create([
					'met_pem' => $request->input('met_pem'),
					'atas_nama' => $request->input('atas_nama'),
					'alamat' => $request->input('alamat'),
					'id_produk' => $ca,
					'jumlah_produk' => $jumlah[0]
					]);
				}
			}
			session()->flush('cart');
			return view('/payment',['total'=>$total]);
			//mengembalikan nilai total yang dibayar
		}
		
		
	}
}
