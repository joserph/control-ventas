<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Vigencia;
use Illuminate\Support\Facades\Auth;

class Vigencias extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $type, $years, $price_total, $price_partner, $user_id, $user_update;
    public $updateMode = false;

    public function mount()
    {
        $user = Auth::user();
        $this->user_id = $user->id;
        $this->user_update = $user->id;
    }

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.vigencias.view', [
            'vigencias' => Vigencia::latest()
						->orWhere('type', 'LIKE', $keyWord)
						->orWhere('years', 'LIKE', $keyWord)
						->orWhere('price_total', 'LIKE', $keyWord)
						->orWhere('price_partner', 'LIKE', $keyWord)
						->orWhere('user_id', 'LIKE', $keyWord)
						->orWhere('user_update', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->type = null;
		$this->years = null;
		$this->price_total = null;
		$this->price_partner = null;
		$this->user_id = null;
		$this->user_update = null;
    }

    public function store()
    {
        $this->validate([
		'type' => 'required',
		'years' => 'required',
		'price_total' => 'required',
		'price_partner' => 'required',
		'user_id' => 'required',
		'user_update' => 'required',
        ]);

        Vigencia::create([ 
			'type' => $this-> type,
			'years' => $this-> years,
			'price_total' => $this-> price_total,
			'price_partner' => $this-> price_partner,
			'user_id' => $this-> user_id,
			'user_update' => $this-> user_update
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Vigencia Successfully created.');
    }

    public function edit($id)
    {
        $record = Vigencia::findOrFail($id);

        $this->selected_id = $id; 
		$this->type = $record-> type;
		$this->years = $record-> years;
		$this->price_total = $record-> price_total;
		$this->price_partner = $record-> price_partner;
		$this->user_id = $record-> user_id;
		$this->user_update = $record-> user_update;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'type' => 'required',
		'years' => 'required',
		'price_total' => 'required',
		'price_partner' => 'required',
		'user_id' => 'required',
		'user_update' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Vigencia::find($this->selected_id);
            $record->update([ 
			'type' => $this-> type,
			'years' => $this-> years,
			'price_total' => $this-> price_total,
			'price_partner' => $this-> price_partner,
			'user_id' => $this-> user_id,
			'user_update' => $this-> user_update
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Vigencia Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Vigencia::where('id', $id);
            $record->delete();
        }
    }
}
