<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Actualizar Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    @include('livewire.ventas.partials.form')
					{{-- <input type="hidden" wire:model="selected_id">
            <div class="form-group">
                <label for="date"></label>
                <input wire:model="date" type="text" class="form-control" id="date" placeholder="Date">@error('date') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="identification"></label>
                <input wire:model="identification" type="text" class="form-control" id="identification" placeholder="Identification">@error('identification') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="client"></label>
                <input wire:model="client" type="text" class="form-control" id="client" placeholder="Client">@error('client') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="validity_id"></label>
                <input wire:model="validity_id" type="text" class="form-control" id="validity_id" placeholder="Validity Id">@error('validity_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="service_id"></label>
                <input wire:model="service_id" type="text" class="form-control" id="service_id" placeholder="Service Id">@error('service_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="status"></label>
                <input wire:model="status" type="text" class="form-control" id="status" placeholder="Status">@error('status') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="total"></label>
                <input wire:model="total" type="text" class="form-control" id="total" placeholder="Total">@error('total') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="payment_form"></label>
                <input wire:model="payment_form" type="text" class="form-control" id="payment_form" placeholder="Payment Form">@error('payment_form') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="bank"></label>
                <input wire:model="bank" type="text" class="form-control" id="bank" placeholder="Bank">@error('bank') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="modality"></label>
                <input wire:model="modality" type="text" class="form-control" id="modality" placeholder="Modality">@error('modality') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="partner_id"></label>
                <input wire:model="partner_id" type="text" class="form-control" id="partner_id" placeholder="Partner Id">@error('partner_id') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="sub_total"></label>
                <input wire:model="sub_total" type="text" class="form-control" id="sub_total" placeholder="Sub Total">@error('sub_total') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="discount"></label>
                <input wire:model="discount" type="text" class="form-control" id="discount" placeholder="Discount">@error('discount') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="aditional_price"></label>
                <input wire:model="aditional_price" type="text" class="form-control" id="aditional_price" placeholder="Aditional Price">@error('aditional_price') <span class="error text-danger">{{ $message }}</span> @enderror
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
