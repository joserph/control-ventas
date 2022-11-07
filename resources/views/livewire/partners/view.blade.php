@section('title', __('Partners'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fas fa-handshake text-info text-center"></i>
							Partner</h4>
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
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Partner">
						</div>
						<div class="btn btn-sm btn-info" data-toggle="modal" data-target="#createDataModal">
						<i class="fa fa-plus"></i>  Agregar Partner
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.partners.create')
						@include('livewire.partners.update')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Nombre</th>
								<td>ACCIONES</td>
							</tr>
						</thead>
						<tbody>
							@foreach($partners as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->name }}</td>
								<td width="90">
									<div class="btn-group">
										<div class="btn-group" role="group" aria-label="Basic example">
											<a data-toggle="modal" data-target="#updateModal" type="button" class="btn btn-warning" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i></a>
											<a type="button" class="btn btn-danger" onclick="confirm('Confirm Delete Partner id {{$row->id}}? \nDeleted Partners cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i></a>
										</div>
									</div>
								</td>
							@endforeach
						</tbody>
					</table>						
					{{ $partners->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
