<?php

namespace App\Http\Livewire;

use App\Models\Partner;
use App\Models\Servicio;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Venta;
use App\Models\Vigencia;
use Illuminate\Support\Facades\Auth;

class Ventas extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $date, $identification, $client, $validity_id, $service_id, $status, $total, $payment_form, $bank, $modality, $partner_id, $sub_total, $discount, $aditional_price, $user_id, $user_update;
    public $updateMode = false;

	public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;
        $this->user_update = $user->id;
    }

    public function render()
    {
		$services = Servicio::pluck('name', 'id');
        $partners = Partner::pluck('name', 'id');
        $validities = Vigencia::select('id', 'type', 'years')->get();

		$keyWord = '%'.$this->keyWord .'%';
		$ventas = Venta::latest()
			->orWhere('date', 'LIKE', $keyWord)
			->orWhere('identification', 'LIKE', $keyWord)
			->orWhere('client', 'LIKE', $keyWord)
			->orWhere('validity_id', 'LIKE', $keyWord)
			->orWhere('service_id', 'LIKE', $keyWord)
			->orWhere('status', 'LIKE', $keyWord)
			->orWhere('total', 'LIKE', $keyWord)
			->orWhere('payment_form', 'LIKE', $keyWord)
			->orWhere('bank', 'LIKE', $keyWord)
			->orWhere('modality', 'LIKE', $keyWord)
			->orWhere('partner_id', 'LIKE', $keyWord)
			->orWhere('sub_total', 'LIKE', $keyWord)
			->orWhere('discount', 'LIKE', $keyWord)
			->orWhere('aditional_price', 'LIKE', $keyWord)
			->orWhere('user_id', 'LIKE', $keyWord)
			->orWhere('user_update', 'LIKE', $keyWord)
			->with('validity')->with('service')->with('partner')
			->paginate(10);
		//dd($ventas);
        return view('livewire.ventas.view', [
            'ventas' => $ventas,
			'services' => $services,
			'partners' => $partners,
			'validities' => $validities
        ]);
    }

	public function changeValidity()
    {
        //dd($this->validity_id);
        if($this->validity_id){
            $validity = Vigencia::find($this->validity_id);
            $this->total = number_format($validity->price_partner, 2, '.', ',');
            $sub_total = $validity->price_partner - ($validity->price_partner * 0.12);
            $this->sub_total = number_format($sub_total, 2, '.', ',');
        }else{
            $this->total = number_format(0, 2, '.', ',');
            $this->sub_total = number_format(0, 2, '.', ',');
        }
        
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->date = null;
		$this->identification = null;
		$this->client = null;
		$this->validity_id = null;
		$this->service_id = null;
		$this->status = null;
		$this->total = null;
		$this->payment_form = null;
		$this->bank = null;
		$this->modality = null;
		$this->partner_id = null;
		$this->sub_total = null;
		$this->discount = null;
		$this->aditional_price = null;
		$this->user_id = null;
		$this->user_update = null;
    }

    public function store()
    {
        $this->validate([
		'date' => 'required',
		'identification' => 'required',
		'client' => 'required',
		'validity_id' => 'required',
		'service_id' => 'required',
		'status' => 'required',
		'total' => 'required',
		'payment_form' => 'required',
		'bank' => 'required',
		'modality' => 'required',
		'partner_id' => 'required',
		'sub_total' => 'required',
		'discount' => 'required',
		'aditional_price' => 'required',
		'user_id' => 'required',
		'user_update' => 'required',
        ]);

        Venta::create([ 
			'date' => $this-> date,
			'identification' => $this-> identification,
			'client' => $this-> client,
			'validity_id' => $this-> validity_id,
			'service_id' => $this-> service_id,
			'status' => $this-> status,
			'total' => $this-> total,
			'payment_form' => $this-> payment_form,
			'bank' => $this-> bank,
			'modality' => $this-> modality,
			'partner_id' => $this-> partner_id,
			'sub_total' => $this-> sub_total,
			'discount' => $this-> discount,
			'aditional_price' => $this-> aditional_price,
			'user_id' => $this-> user_id,
			'user_update' => $this-> user_update
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Venta Successfully created.');
    }

    public function edit($id)
    {
        $record = Venta::findOrFail($id);

        $this->selected_id = $id; 
		$this->date = $record-> date;
		$this->identification = $record-> identification;
		$this->client = $record-> client;
		$this->validity_id = $record-> validity_id;
		$this->service_id = $record-> service_id;
		$this->status = $record-> status;
		$this->total = $record-> total;
		$this->payment_form = $record-> payment_form;
		$this->bank = $record-> bank;
		$this->modality = $record-> modality;
		$this->partner_id = $record-> partner_id;
		$this->sub_total = $record-> sub_total;
		$this->discount = $record-> discount;
		$this->aditional_price = $record-> aditional_price;
		$this->user_id = $record-> user_id;
		$this->user_update = $record-> user_update;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'date' => 'required',
		'identification' => 'required',
		'client' => 'required',
		'validity_id' => 'required',
		'service_id' => 'required',
		'status' => 'required',
		'total' => 'required',
		'payment_form' => 'required',
		'bank' => 'required',
		'modality' => 'required',
		'partner_id' => 'required',
		'sub_total' => 'required',
		'discount' => 'required',
		'aditional_price' => 'required',
		'user_id' => 'required',
		'user_update' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Venta::find($this->selected_id);
            $record->update([ 
			'date' => $this-> date,
			'identification' => $this-> identification,
			'client' => $this-> client,
			'validity_id' => $this-> validity_id,
			'service_id' => $this-> service_id,
			'status' => $this-> status,
			'total' => $this-> total,
			'payment_form' => $this-> payment_form,
			'bank' => $this-> bank,
			'modality' => $this-> modality,
			'partner_id' => $this-> partner_id,
			'sub_total' => $this-> sub_total,
			'discount' => $this-> discount,
			'aditional_price' => $this-> aditional_price,
			'user_id' => $this-> user_id,
			'user_update' => $this-> user_update
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Venta Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Venta::where('id', $id);
            $record->delete();
        }
    }
}
