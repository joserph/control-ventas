<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Actualizar Vigencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    @include('livewire.vigencias.partials.form')
					{{-- <input type="hidden" wire:model="selected_id">
            <div class="form-group">
                <label for="type"></label>
                <input wire:model="type" type="text" class="form-control" id="type" placeholder="Type">@error('type') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="years"></label>
                <input wire:model="years" type="text" class="form-control" id="years" placeholder="Years">@error('years') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="price_total"></label>
                <input wire:model="price_total" type="text" class="form-control" id="price_total" placeholder="Price Total">@error('price_total') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="price_partner"></label>
                <input wire:model="price_partner" type="text" class="form-control" id="price_partner" placeholder="Price Partner">@error('price_partner') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="user_id"></label>
                <input wire:model="user_id" type="text" class="form-control" id="user_id" placeholder="User Id">@error('user_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="user_update"></label>
                <input wire:model="user_update" type="text" class="form-control" id="user_update" placeholder="User Update">@error('user_update') <span class="error text-danger">{{ $message }}</span> @enderror
            </div> --}}

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-warning" data-dismiss="modal">Actualizar</button>
            </div>
       </div>
    </div>
</div>
