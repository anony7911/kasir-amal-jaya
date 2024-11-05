<?php

namespace App\Http\Livewire;

use App\Models\Barang;
use Livewire\Component;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Stokbarang;
use Livewire\WithPagination;

class Barangs extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $kode_barang, $nama_barang, $deskripsi_barang;

    // public $kode_barang = 'BRG-'. Barang::count() + 1;
    public function mount()
    {
        $this->kode_barang = 'BRG-00'. (Barang::count() ?? 0) + 1;
    }

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.barangs.view', [
            'barangs' => Barang::latest()
						->orWhere('kode_barang', 'LIKE', $keyWord)
						->orWhere('nama_barang', 'LIKE', $keyWord)
						->orWhere('deskripsi_barang', 'LIKE', $keyWord)
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
		$this->nama_barang = null;
		$this->deskripsi_barang = null;
    }

    public function store()
    {
        $this->validate([
		'kode_barang' => 'required',
		'nama_barang' => 'required',
		'deskripsi_barang' => 'required',
        ]);

        Barang::create([
			'kode_barang' => $this-> kode_barang,
			'nama_barang' => $this-> nama_barang,
			'deskripsi_barang' => $this-> deskripsi_barang
        ]);

        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
        return redirect()->to('/barangs')->with('message', 'Barang Successfully created.');
    }

    public function edit($id)
    {
        $record = Barang::findOrFail($id);
        $this->selected_id = $id;
		$this->kode_barang = $record-> kode_barang;
		$this->nama_barang = $record-> nama_barang;
		$this->deskripsi_barang = $record-> deskripsi_barang;
    }

    public function update()
    {
        $this->validate([
		'nama_barang' => 'required',
		'deskripsi_barang' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Barang::find($this->selected_id);
            $record->update([
			'nama_barang' => $this-> nama_barang,
			'deskripsi_barang' => $this-> deskripsi_barang
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Barang Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            // jika ada id di tabel pembelian, penjualan, atau stokbarang, maka tidak boleh dihapus
            if (Pembelian::where('barang_id', $id)->exists() || Penjualan::where('barang_id', $id)->exists() || Stokbarang::where('barang_id', $id)->exists()) {
                session()->flash('message', 'Barang tidak bisa dihapus karena sudah ada transaksi.');
                return;
            } else {
                $record = Barang::where('id', $id);
                $record->delete();
            }
        }
    }
}
