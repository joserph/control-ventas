<div class="row">
    <div class="col-sm-8">
        <div class="form-group">
            {{ Form::label('type', 'Nombre') }}
            {{ Form::text('type', null, ['class' => 'form-control', 'wire:model' => 'type']) }}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {{ Form::label('years', 'Vigencia') }}
            {{ Form::text('years', null, ['class' => 'form-control', 'wire:model' => 'years']) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {{ Form::label('price_total', 'Precio Total') }}
            {{ Form::text('price_total', null, ['class' => 'form-control', 'wire:model' => 'price_total']) }}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {{ Form::label('price_partner', 'Precio Partner') }}
            {{ Form::text('price_partner', null, ['class' => 'form-control', 'wire:model' => 'price_partner']) }}
        </div>
    </div>
    @isset($validities)
        {{ Form::hidden('user_update', Auth::user()->id, ['wire:model' => 'user_update']) }}
    @else
        {{ Form::hidden('user_id', Auth::user()->id, ['wire:model' => 'user_id']) }}
        {{ Form::hidden('user_update', Auth::user()->id, ['wire:model' => 'user_update']) }}
    @endisset
    
</div>
