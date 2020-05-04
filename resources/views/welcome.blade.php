<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
		<script src="{{ asset('js/app.js') }}" defer></script>
		<link rel="dns-prefetch" href="//fonts.gstatic.com">
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
			
			.top-left {
                position: absolute;
                left: 10px;
                top: 45px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-right position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/userpage') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
					<a href="#shop_cart" data-toggle="modal">shopping cart
						</a>
                </div>
            @endif
			
			
			
			<div class="top-left">
				<div><p class="links">Produk Terpopuler</p></div>
                <table>
                    @foreach($product as $pro)
					<td width="155px" height= "200px">
					<div>
					<a data-toggle="modal" href="{{'#a'.$pro->id_pro}}">
					<img src="gambar_pro/{{$pro->nama_gam}}" width="150px" height="150px"></br>
					</a>
					</div>
					<div class="right">
					{{$pro->nama_pro}}</br>
					Rp.{{$pro->harga_pro}}</br>
					{{$pro->keterangan}}
					</div>
					</td>
					
					<div class="modal fade" id="{{'a'.$pro->id_pro}}" role="dialog" data-backdrop="static">
						<div class="modal-dialog">
						<!-- Modal content-->
							<div class="modal-content">
							<div class="modal-header">
								<p class="modal-title">Tambahkan Dalam Shop Cart</p>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								
							</div>
							<div class="modal-body">
								<img src="gambar_pro/{{$pro->nama_gam}}" width="150px" height="150px"></br>
								{{$pro->nama_pro}}</br>
								Rp.{{$pro->harga_pro}}</br>
								{{$pro->keterangan}}
							</div>
								<div class="modal-footer">
									<form method="post" action="/add_cart">
									{{csrf_field()}}
										<input type="number" class="form control" name="jumlah" id="jumlah">
										<input type="hidden" name="add_cart" value="{{$pro->id_pro}}" id="add_cart">
										<input type="submit" class="btn btn-primary" value="tambah">
									</form>
								</div>
							</div>
					  
						</div>
					</div>
					
					@endforeach
				</table>
				<!-- shopping cart modal-->
		<div class="modal fade" id="shop_cart" role="dialog" data-backdrop="static">
			<div clasS="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
			<div class="modal-header">
				<p class="modal-title">Shop Cart</p>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
								
								
			</div>
			<div class="modal-body">
			@if(session('cart'))
				@foreach(session('cart') as $ca=>$jumlah)
					@foreach($product as $pro)
						@if($pro->id_pro==$ca)
						<img src="gambar_pro/{{$pro->nama_gam}}" width="75px" height="75px"></br>
						{{$pro->nama_pro}}</br>
						@.Rp{{$pro->harga_pro}}</br>
						{{$pro->keterangan}}</br>
						jumlah = {{$jumlah[0]}}</br>
						<button type="button" class="btn" data-toggle="modal" data-target="{{'#a'.$pro->id_pro}}" data-dismiss="modal">
						ubah jumlah
						</button>
						<a href="/welcome/{{$ca}}">
						<button type="button" class="btn">
						hapus
						</button></a>
						</br>
						@endif
					@endforeach
				@endforeach
			@endif
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-toggle="modal" data-target="#transaksi" data-dismiss="modal">Beli</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>	
			</div>
			</div>
		</div>
            </div>
        </div>
		
		<!-- Transaksi Modal -->
		<!-- Modal edit product -->
		<div class="modal fade" id="transaksi" role="dialog" data-backdrop="static">
		<div class="modal-dialog">
		<!-- Modal content-->
			<div class="modal-content">
			<div class="modal-header">
				<p class="modal-title">Transaksi</p>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form method="post" action="/transaksi">
					{{csrf_field()}}
					Atas Nama:
					<input type="text" name="atas_nama" class="form-control">
					Alamat:
					<input type="text" name="alamat" class="form-control">
					Metode Pembayaran:
					<select id="met_pem" name="met_pem" class="form-control">
						<option value="Mandiri">Mandiri</option>
						<option value="Gopay">Gopay</option>
						<option value="Paypal">Paypal</option>
					</select>
					<input type="submit" class="btn" value="Beli">
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
    </body>
</html>
