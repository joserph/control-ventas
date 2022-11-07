@section('title', __('Vigencias'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-calendar-alt text-danger text-center"></i>
							Vigencia</h4>
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
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Vigencias">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Agreagr Vigencia
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.vigencias.create')
						@include('livewire.vigencias.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Nombre</th>
								<th>Vigencia</th>
								<th>Precio Total</th>
								<th>Precio Partner</th>
								<td>ACCIONES</td>
							</tr>
						</thead>
						<tbody>
							@foreach($vigencias as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->type }}</td>
								<td>{{ $row->years }}</td>
								<td>{{ $row->price_total }}</td>
								<td>{{ $row->price_partner }}</td>
								<td class="text-center" width="90">
									<div class="btn-group">
										<div class="btn-group" role="group" aria-label="Basic example">
											<a data-toggle="modal" data-target="#updateModal" type="button" class="btn btn-sm btn-warning" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i></a>
											<a type="button" class="btn btn-sm btn-danger" onclick="confirm('Confirm Delete Vigencia id {{$row->id}}? \nDeleted Vigencia cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i></a>
										</div>
									</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $vigencias->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
