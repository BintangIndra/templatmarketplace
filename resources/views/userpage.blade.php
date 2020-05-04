@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Produk Anda</div>
                <div class="card-body">
                    @foreach($product as $pro)
					<table>
					<tr>
					<td>
					<div>
					<img src="gambar_pro/{{$pro->nama_gam}}" width="100px" height="100px"></br>
					</div>
					</td>
					<td width="450px" height="100px">
					<div class="right">
					Nama Produk :
					{{$pro->nama_pro}}</br>
					Harga Produk :
					{{$pro->harga_pro}}</br>
					Keterangan Produk :
					{{$pro->keterangan}}
					</div>
					</td>
					<td>
					<button data-toggle="modal" data-target="{{'#a'.$pro->id_pro}}" class="btn">EDIT</button>
					<button data-toggle="modal" data-target="{{'#b'.$pro->id_pro}}" class="btn">HAPUS</button></br>
					</td>
					</tr>
					</table>
					<!-- Modal edit product -->
					<div class="modal fade" id="{{'a'.$pro->id_pro}}" role="dialog" data-backdrop="static">
					<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<p class="modal-title">Edit Produk</p>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<form method="post" action="/edit_pro" enctype="multipart/form-data">
									{{csrf_field()}}
									Nama Produk :
									<input type="text" class="form-control" name="nama_pro" value="{{$pro->nama_pro}}">
									Harga :
									<input type="number" class="form-control" name="harga_pro" value="{{$pro->harga_pro}}">
									keterangan produk :
									<input type="text" class="form-control" name="ket_pro" value="{{$pro->keterangan}}">
									gambar :
									<input type="file" name="gambar" class="form-control"></br>
									<input type="hidden" name="id_pro" value="{{$pro->id_pro}}" id="id_pro">
									<input type="submit" class="btn btn-primary" value="edit produk" required>
							</form>
						</div>
						<div class="modal-footer">
									<!--<button type="button" class="btn btn-default" data-target="">OK</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									-->
						</div>
					</div>
					  
					</div>
					</div>

					
					<!-- Modal Hapus product -->
					<div class="modal fade" id="{{'b'.$pro->id_pro}}" role="dialog" data-backdrop="static">
					<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<p class="modal-title">Hapus Produk</p>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<p>Apakah Anda yakin ingin menghapus produk</p>
						</div>
						<div class="modal-footer">
							<a href="/hapus_pro/{{$pro->id_pro}}">
							<button type="button" class="btn btn-default" data-target="">OK</button>
							</a>
							<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
						</div>
					</div>
					  
					</div>
					</div>
					@endforeach

                </div>
            </div>
        </div>
    </div>
</div>

	<!-- Modal tambah product -->
	<div class="modal fade" id="myModal" role="dialog" data-backdrop="static">
		<div class="modal-dialog">
    	<!-- Modal content-->
			<div class="modal-content">
			<div class="modal-header">
				<p class="modal-title">Tambah Produk</p>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				
			</div>
			<div class="modal-body">
				@if (count($errors)>0)
					<div class="alert alert-danger">
						<ul>
							@foreach($errors->all() as $error)
							<li>{{$error}}</li>
							@endforeach
						</ul>
					</div>
				@endif
				<form method="post" action="/add_pro" enctype="multipart/form-data">
					{{csrf_field()}}
					Nama Produk :
					<input type="text" class="form-control" name="nama_pro" value="{{ old('nama_pro') }}">
					Harga :
					<input type="number" class="form-control" name="harga_pro" value="{{ old('harga_pro') }}"> </br>
					keterangan produk :
					<input type="text" class="form-control" name="ket_pro" value="{{ old('ket_pro') }}">
					gambar :
					<input type="file" name="gambar" class="form-control"></br>
					
					<input type="submit" class="btn btn-primary" value="Tambahkan produk">
				</form>
			</div>
				<!-- <div class="modal-footer">
					<button type="button" class="btn btn-default" data-target="">OK</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				-->
			</div>
      
		</div>
	</div>
@endsection
