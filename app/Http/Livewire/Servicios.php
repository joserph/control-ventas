<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Servicio;
use Illuminate\Support\Facades\Auth;

class Servicios extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $user_id, $user_update;
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
        return view('livewire.servicios.view', [
            'servicios' => Servicio::latest()
						->orWhere('name', 'LIKE', $keyWord)
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
		$this->name = null;
		$this->user_id = null;
		$this->user_update = null;
    }

    public function store()
    {
        $this->validate([
		'name' => 'required',
		'user_id' => 'required',
		'user_update' => 'required',
        ]);

        Servicio::create([ 
			'name' => $this-> name,
			'user_id' => $this-> user_id,
			'user_update' => $this-> user_update
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Servicio Successfully created.');
    }

    public function edit($id)
    {
        $record = Servicio::findOrFail($id);

        $this->selected_id = $id; 
		$this->name = $record-> name;
		$this->user_id = $record-> user_id;
		$this->user_update = $record-> user_update;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'name' => 'required',
		'user_id' => 'required',
		'user_update' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Servicio::find($this->selected_id);
            $record->update([ 
			'name' => $this-> name,
			'user_id' => $this-> user_id,
			'user_update' => $this-> user_update
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Servicio Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Servicio::where('id', $id);
            $record->delete();
        }
    }
}
