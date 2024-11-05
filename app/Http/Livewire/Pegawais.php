<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Pegawai;
use Livewire\Component;
use Livewire\WithPagination;

class Pegawais extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nama_pegawai, $alamat_pegawai, $no_telp_pegawai, $user_id, $toko_id, $email, $password, $role;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.pegawais.view', [
            'pegawais' => Pegawai::latest()
						->orWhere('nama_pegawai', 'LIKE', $keyWord)
						->orWhere('alamat_pegawai', 'LIKE', $keyWord)
						->orWhere('no_telp_pegawai', 'LIKE', $keyWord)
						->orWhere('user_id', 'LIKE', $keyWord)
						->orWhere('toko_id', 'LIKE', $keyWord)
						->paginate(10),
            'tokos' => \App\Models\Toko::latest()->get(),
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
		$this->nama_pegawai = null;
		$this->alamat_pegawai = null;
		$this->no_telp_pegawai = null;
		$this->user_id = null;
		$this->toko_id = null;
    }

    public function store()
    {
        $this->validate([
		'nama_pegawai' => 'required',
		'alamat_pegawai' => 'required',
		'no_telp_pegawai' => 'required',
		'toko_id' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
        ],[
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Password minimal 8 karakter',
        ]);
        // save user
        $user = User::create([
            'name' => $this-> nama_pegawai,
            'email' => $this-> email,
            'password' => bcrypt($this-> password),
            'role' => 'admin',
        ]);

        Pegawai::create([
			'nama_pegawai' => $this-> nama_pegawai,
			'alamat_pegawai' => $this-> alamat_pegawai,
			'no_telp_pegawai' => $this-> no_telp_pegawai,
			'user_id' => $user->id,
			'toko_id' => $this-> toko_id
        ]);

        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Pegawai Successfully created.');
    }

    public function edit($id)
    {
        $record = Pegawai::findOrFail($id);
        $this->selected_id = $id;
		$this->nama_pegawai = $record-> nama_pegawai;
		$this->alamat_pegawai = $record-> alamat_pegawai;
		$this->no_telp_pegawai = $record-> no_telp_pegawai;
		$this->user_id = $record-> user_id;
		$this->toko_id = $record-> toko_id;
    }

    public function update()
    {
        $this->validate([
		'nama_pegawai' => 'required',
		'alamat_pegawai' => 'required',
		'no_telp_pegawai' => 'required',
		'toko_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Pegawai::find($this->selected_id);
            $record->update([
			'nama_pegawai' => $this-> nama_pegawai,
			'alamat_pegawai' => $this-> alamat_pegawai,
			'no_telp_pegawai' => $this-> no_telp_pegawai,
			'toko_id' => $this-> toko_id
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Pegawai Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            // hapus user dengan user_id ditabel pegawai
            $user = Pegawai::where('id', $id)->first();
            User::where('id', $user->user_id)->delete();
            // hapus pegawai
            Pegawai::where('id', $id)->delete();
        }
    }
}
