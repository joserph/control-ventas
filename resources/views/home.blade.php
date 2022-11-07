@extends('layouts.app')
@section('title', __('Dashboard'))
@section('content')
<div class="container-fluid">
<div class="row justify-content-center">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header"><h5><span class="text-center fa fa-home"></span> @yield('title')</h5></div>
			<div class="card-body">
				<h5>Hola <strong>{{ Auth::user()->name }},</strong> {{ __('Estás conectado a Control de Ventas') }}</h5>
				</br> 
				<hr>
								
			<div class="row w-100">
					<div class="col-md-3">
						<div class="card border-info mx-sm-1 p-3">
							<a href="{{ url('/partners') }}">
								<div class="card border-info text-info p-3" ><i class="fas fa-handshake text-info text-center"></i></div>
							</a>
							<div class="text-info text-center mt-3"><h4>Partners</h4></div>
							@php
								use App\Models\Partner;
								$countPartners = Partner::count();
							@endphp
							<div class="text-info text-center mt-2"><h1>{{ $countPartners }}</h1></div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card border-success mx-sm-1 p-3">
							<a href="{{ url('/servicios') }}">
								<div class="card border-success text-success p-3 my-card"><i class="fas fa-vector-square text-success text-center"></i></div>
							</a>
							<div class="text-success text-center mt-3"><h4>Productos / Servicios</h4></div>
							@php
								use App\Models\Servicio;
								$countServices = Servicio::count();
							@endphp
							<div class="text-success text-center mt-2"><h1>{{ $countServices }}</h1></div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card border-danger mx-sm-1 p-3">
							<a href="{{ url('/vigencias') }}">
								<div class="card border-danger text-danger p-3 my-card" ><i class="fas fa-calendar-alt text-danger text-center"></i></div>
							</a>
							<div class="text-danger text-center mt-3"><h4>Vigencias</h4></div>
							@php
								use App\Models\Vigencia;
								$countValidities = Vigencia::count();
							@endphp
							<div class="text-danger text-center mt-2"><h1>{{ $countValidities }}</h1></div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card border-warning mx-sm-1 p-3">
							<a href="{{ url('/ventas') }}">
								<div class="card border-warning text-warning p-3 my-card" ><i class="fas fa-hand-holding-usd text-warning text-center"></i></div>
							</a>
							<div class="text-warning text-center mt-3"><h4>Ventas</h4></div>
							@php
								use App\Models\Venta;
								$countVentas = Venta::count();
							@endphp
							<div class="text-warning text-center mt-2"><h1>{{ $countVentas }}</h1></div>
						</div>
					</div>
				 </div>				
			</div>
		</div>
	</div>
</div>
</div>
@endsection