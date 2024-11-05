<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Supplier;
use Livewire\WithPagination;

class Suppliers extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nama_supplier, $alamat_supplier, $no_telp_supplier, $user_id, $name, $email, $password, $role;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.suppliers.view', [
            'suppliers' => Supplier::latest()
						->orWhere('nama_supplier', 'LIKE', $keyWord)
						->orWhere('alamat_supplier', 'LIKE', $keyWord)
						->orWhere('no_telp_supplier', 'LIKE', $keyWord)
						->orWhere('user_id', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }

    public function cancel()
    {
        $this->resetInput();
        // close modal
        $this->dispatchBrowserEvent('closeModal');
    }

    private function resetInput()
    {
		$this->nama_supplier = null;
		$this->alamat_supplier = null;
		$this->no_telp_supplier = null;
		$this->user_id = null;
    }

    public function store()
    {
        $this->validate([
		'nama_supplier' => 'required',
		'alamat_supplier' => 'required',
		'no_telp_supplier' => 'required',
        ]);

        $user = User::create([
            'name' => $this-> nama_supplier,
            'email' => $this-> email,
            'password' => bcrypt($this-> password),
            'role' => 'supplier',
        ]);

        Supplier::create([
			'nama_supplier' => $this-> nama_supplier,
			'alamat_supplier' => $this-> alamat_supplier,
			'no_telp_supplier' => $this-> no_telp_supplier,
			'user_id' => $user->id
        ]);

        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Supplier Successfully created.');
    }

    public function edit($id)
    {
        $record = Supplier::findOrFail($id);
        $this->selected_id = $id;
		$this->nama_supplier = $record-> nama_supplier;
		$this->alamat_supplier = $record-> alamat_supplier;
		$this->no_telp_supplier = $record-> no_telp_supplier;
    }

    public function update()
    {
        $this->validate([
		'nama_supplier' => 'required',
		'alamat_supplier' => 'required',
		'no_telp_supplier' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Supplier::find($this->selected_id);
            $record->update([
			'nama_supplier' => $this-> nama_supplier,
			'alamat_supplier' => $this-> alamat_supplier,
			'no_telp_supplier' => $this-> no_telp_supplier,
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Supplier Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Supplier::where('id', $id)->delete();
        }
    }
}
