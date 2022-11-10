@section('title', __('Ventas'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-hand-holding-usd text-warning text-center"></i>
							Ventas</h4>
						</div>
						<div wire:poll.60s>
							@php
								date_default_timezone_set('America/Bogota');
							@endphp
							<code><h5>{{ now()->format('H:i:s') }} Horas</h5></code>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Venta">
						</div>
						<div style="display: inline-flex">
							{{ Form::open(['route' => 'ventas-excel.store', 'class' => 'form-horizontal']) }}
								<input type="date" name="desde" class="form-control">
								<input type="date" name="hasta" class="form-control">
								<button type="submit" target="_blank" class="btn btn-xs btn-outline-success pull-right"><i class="fas fa-file-excel"></i></button>
							{{ Form::close() }}
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
							<i class="fa fa-plus"></i>  Agreagr Venta
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.ventas.create')
						@include('livewire.ventas.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Fecha</th>
								<th>RUC/Cedula</th>
								<th>Cliente</th>
								<th>Vigencia</th>
								<th>Servicio</th>
								<th>Estatus</th>
								<th>Total</th>
								<th>Sub_Total</th>
								<th>Forma_Pago</th>
								<th>Banco</th>
								<th>Modalidad</th>
								<th>Partner</th>
								<th>Descuento</th>
								<th>Adicional</th>
								<td>ACCIONES</td>
							</tr>
						</thead>
						<tbody>
							@foreach($ventas as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->date }}</td>
								<td>{{ $row->identification }}</td>
								<td>{{ $row->client }}</td>
								<td>{{ $row->validity->years }}</td>
								<td>{{ $row->service->name }}</td>
								<td>{{ $row->status }}</td>
								<td>{{ $row->total }}</td>
								<td>{{ $row->sub_total }}</td>
								<td>{{ $row->payment_form }}</td>
								<td>{{ $row->bank }}</td>
								<td>{{ $row->modality }}</td>
								<td>{{ $row->partner->name }}</td>
								
								<td>{{ $row->discount }}</td>
								<td>{{ $row->aditional_price }}</td>
								<td width="90">
								<div class="btn-group">
									<div class="btn-group" role="group" aria-label="Basic example">
										<a data-toggle="modal" data-target="#updateModal" type="button" class="btn btn-sm btn-warning" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i></a>
										<a type="button" class="btn btn-sm btn-danger" onclick="confirm('Confirm Delete Venta id {{$row->id}}? \nDeleted Venta cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i></a>
									</div>
								</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $ventas->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
