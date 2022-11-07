<div class="row">
        
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('identification', 'Cedula/Ruc') }}
            {{ Form::text('identification', null, ['class' => 'form-control', 'wire:model' => 'identification']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('client', 'Cliente') }}
            {{ Form::text('client', null, ['class' => 'form-control', 'wire:model' => 'client']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('date', 'Fecha') }}
            {{ Form::date('date', null, ['class' => 'form-control', 'wire:model' => 'date']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('validity_id', 'Vigencia') }}
            <select name="validity_id" wire:change='changeValidity()' wire:model='validity_id' id="validity_id" class="form-control">
                <option value="">Seleccione Vigencia</option>
                @foreach ($validities as $item)
                    <option value="{{ $item->id }}">{{ $item->type }} - {{ $item->years }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('service_id', 'Servios/Productos') }}
            {{ Form::select('service_id', $services, null, ['class' => 'form-control', 'placeholder' => 'Seleccione vigencia', 'wire:model' => 'service_id']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('status', 'Estatus') }}
            {{ Form::select('status', ['Pagado' => 'Pagado', 'Emitido' => 'Emitido', 'Aprobado' => 'Aprobado', 'Pendiente de Pago' => 'Pendiente de Pago', 'Nuevo' => 'Nuevo'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione Estatus', 'wire:model' => 'status']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('total', 'Total') }}
            {{ Form::text('total', null, ['class' => 'form-control', 'wire:model' => 'total']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('sub_total', 'Sub Total') }}
            {{ Form::text('sub_total', null, ['class' => 'form-control', 'wire:model' => 'sub_total']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('discount', 'Descuento') }}
            {{ Form::text('discount', null, ['class' => 'form-control', 'wire:model' => 'discount']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('aditional_price', 'Adicional') }}
            {{ Form::text('aditional_price', null, ['class' => 'form-control', 'wire:model' => 'aditional_price']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('payment_form', 'Forma de Pago') }}
            {{ Form::text('payment_form', null, ['class' => 'form-control', 'wire:model' => 'payment_form']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('bank', 'Banco') }}
            {{ Form::select('bank', ['Pichincha' => 'Pichincha', 'Pacifico' => 'Pacifico', 'Produbanco' => 'Produbanco', 'Guayaquil' => 'Guayaquil', 'Tarjeta' => 'Tarjeta'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione Banco', 'wire:model' => 'bank']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('modality', 'Modalidad') }}
            {{ Form::select('modality', ['Anual' => 'Anual', 'Mensual' => 'Mensual'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione Modalidad', 'wire:model' => 'modality']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('partner_id', 'Partner') }}
            {{ Form::select('partner_id', $partners, null, ['class' => 'form-control', 'placeholder' => 'Seleccione Partner', 'wire:model' => 'partner_id']) }}
        </div>
    </div>
    
    
    
    @isset($ventas)
        {{ Form::hidden('user_update', Auth::user()->id, ['wire:model' => 'user_update']) }}
    @else
        {{ Form::hidden('user_id', Auth::user()->id, ['wire:model' => 'user_id']) }}
        {{ Form::hidden('user_update', Auth::user()->id, ['wire:model' => 'user_update']) }}
    @endisset
    
</div>