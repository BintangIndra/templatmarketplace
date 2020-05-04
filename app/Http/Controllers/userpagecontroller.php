<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\gambar;
use App\product;
use File;

class userpagecontroller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$hasil=product::where('id_owner', Auth::user()->id)->get();
        return view('/userpage',['product' => $hasil]);
    }

	
	public function addpro(Request $Request){
		$this->validate($Request,[
		'nama_pro' => 'required|min:5|max:20',
		'harga_pro' => 'required|numeric',
		'ket_pro' => 'required',
		'gambar' => 'required|image|mimes:jpeg,jpg,png|max:2048',
		]);
		
		$namapro = $Request->input('nama_pro');
		$hargapro = $Request->input('harga_pro');
		$ketpro = $Request->input('ket_pro');
		$gambar = $Request->file('gambar');
		$nama_gam = time()."_".$gambar->getClientOriginalName();
		$tujuan_upload = 'gambar_pro';
		
		product::create([
			'nama_pro' => $namapro,
			'harga_pro' => $hargapro,
			'id_owner'=> Auth::user()->id,
			'nama_gam' => $nama_gam,
			'keterangan' => $ketpro
		]);
		$gambar->move($tujuan_upload,$nama_gam);
		
		$hasil=product::where('id_owner', Auth::user()->id)->get();
		
		return redirect('/userpage');
	}
	
	public function edit_pro(Request $Request){
		$namapro = $Request->input('nama_pro');
		$hargapro = $Request->input('harga_pro');
		$ketpro = $Request->input('ket_pro');
		$gambar = $Request->file('gambar');
		$nama_gam = time()."_".$gambar->getClientOriginalName();
		$tujuan_upload = 'gambar_pro';
		
		$product = product::find($Request->id_pro);
		$old_gam = $product->nama_gam;
		$product->nama_pro = $namapro;
		$product->harga_pro = $hargapro;
		$product->id_owner= Auth::user()->id;
		$product->nama_gam = $nama_gam;
		$product->keterangan = $ketpro;
		$product->save();
		
		file::delete('gambar_pro/'.$old_gam);
		$gambar->move($tujuan_upload,$nama_gam);
		return redirect('/userpage');
	}
	
	public function hapus_pro($id){
		$product = product::find($id);
		file::delete('gambar_pro/'.$product->nama_gam);		
		$product->delete();
	}
}
