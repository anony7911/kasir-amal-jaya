<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Toko;

class Tokos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $no_toko, $alamat_toko, $kategori, $jumlah_pegawai;

    public function mount()
    {
        // jumlah toko
        $toko = Toko::count();
        $this->no_toko = 'TK-00'. ($toko ?? 0) + 1;
    }

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.tokos.view', [
            'tokos' => Toko::latest()
						->orWhere('no_toko', 'LIKE', $keyWord)
						->orWhere('alamat_toko', 'LIKE', $keyWord)
						->orWhere('kategori', 'LIKE', $keyWord)
						->orWhere('jumlah_pegawai', 'LIKE', $keyWord)
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
		$this->alamat_toko = null;
		$this->kategori = null;
		$this->jumlah_pegawai = null;
    }

    public function store()
    {
        $this->validate([
		'no_toko' => 'required',
		'alamat_toko' => 'required',
		'kategori' => 'required',
		'jumlah_pegawai' => 'required',
        ]);

        Toko::create([
			'no_toko' => $this-> no_toko,
			'alamat_toko' => $this-> alamat_toko,
			'kategori' => $this-> kategori,
			'jumlah_pegawai' => $this-> jumlah_pegawai
        ]);

        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Toko Successfully created.');
    }

    public function edit($id)
    {
        $record = Toko::findOrFail($id);
        $this->selected_id = $id;
		$this->no_toko = $record-> no_toko;
		$this->alamat_toko = $record-> alamat_toko;
		$this->kategori = $record-> kategori;
		$this->jumlah_pegawai = $record-> jumlah_pegawai;
    }

    public function update()
    {
        $this->validate([
		'alamat_toko' => 'required',
		'kategori' => 'required',
		'jumlah_pegawai' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Toko::find($this->selected_id);
            $record->update([
			'alamat_toko' => $this-> alamat_toko,
			'kategori' => $this-> kategori,
			'jumlah_pegawai' => $this-> jumlah_pegawai
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Toko Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Toko::where('id', $id)->delete();
        }
    }
}
