@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Produk Anda</div>
                <div class="card-body">
					Jumlah Pembayaran Anda senilai: Rp.{{$total}}
				</div>
			</div>	
        </div>
    </div>
</div>
@endsection