@extends('layouts.app')
@section('title', __('Dashboard'))
@section('content')
<div class="container-fluid">
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header"><h5><span class="text-center fa fa-home"></span> @yield('title')</h5></div>
			<div class="card-body">
				<h5>Hi <strong>{{ Auth::user()->name }},</strong> {{ __('Selamat datang di ') }}{{ config('app.name', 'Laravel') }}</h5>
				</br>
				<hr>

			<div class="row w-100">
					<div class="col-md-3">
						<div class="card bg-dark mx-sm-1 p-3 text-white">
                            <div class="card border-success text-success p-3 my-card text-center" >PENJUALAN</div>
                            <p class="text-center text-white" >Rp. {{ number_format($total_penjualan, 0, ',', '.') }}</p>
						</div>
					</div>
                    <div class="col-md-3">
                        <div class="card bg-dark mx-sm-1 p-3 text-white">
                            <div class="card border-success text-success p-3 my-card text-center" >PEMBELIAN</div>
                            <p class="text-center text-white" >Rp. {{ number_format($total_pembelian, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    {{-- PELANGGAN --}}
                    <div class="col-md-3">
                        <div class="card bg-dark mx-sm-1 p-3 text-white">
                            <div class="card border-success text-success p-3 my-card text-center" >PELANGGAN</div>
                            <p class="text-center text-white" >{{ $total_pelanggan }}</p>
                        </div>
                    </div>
                    {{-- SUPPLIER --}}
                    <div class="col-md-3">
                        <div class="card bg-dark mx-sm-1 p-3 text-white">
                            <div class="card border-success text-success p-3 my-card text-center" >SUPPLIER</div>
                            <p class="text-center text-white" >{{ $total_supplier }}</p>
                        </div>
                    </div>
				 </div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection
