<div class="row">
    <div class="col-sm-8">
        <div class="form-group">
            {{ Form::label('name', 'Nombre') }}
            {{ Form::text('name', null, ['class' => 'form-control', 'wire:model' => 'name']) }}
        </div>
    </div>
    
    @isset($services)
        {{ Form::hidden('user_update', Auth::user()->id, ['wire:model' => 'user_user_update']) }}
    @else
        {{ Form::hidden('user_id', Auth::user()->id, ['wire:model' => 'user_id']) }}
        {{ Form::hidden('user_update', Auth::user()->id, ['wire:model' => 'user_user_update']) }}
    @endisset
    
</div>
