<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Penjualan;
use Livewire\WithPagination;
use App\Models\Orderpelanggan;

class Penjualans extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $selected_id;
    public $keyWord;
    public $jumlah_barang;
    public $total_harga;
    public $barang_id;
    public $toko_id;
    public $user_id;
    public $kode_order;
    public $nama_pelanggan;
    public $alamat_pelanggan;
    public $no_telp_pelanggan;

    public $perPage = 25;
    public function mount()
    {
        $this->kode_order = 'ORD-' . date('Ymd') . '-'. Penjualan::count() + 1;
    }

    public function render()
    {
        $keyWord = '%'.$this->keyWord .'%';
        return view('livewire.penjualans.view', [
            'penjualans' => Penjualan::latest()
                        ->orWhere('jumlah_barang', 'LIKE', $keyWord)
                        ->orWhere('total_harga', 'LIKE', $keyWord)
                        ->paginate(10),
            'orderpelanggans' => Orderpelanggan::latest()
                ->join('penjualans', 'orderpelanggans.id', '=', 'penjualans.orderpelanggan_id')
                ->join('tokos', 'penjualans.toko_id', '=', 'tokos.id')
                ->join('users', 'orderpelanggans.user_id', '=', 'users.id')
                ->select('orderpelanggans.created_at', 'orderpelanggans.kode_order', 'orderpelanggans.nama_pelanggan', 'orderpelanggans.alamat_pelanggan', 'orderpelanggans.no_telp_pelanggan', 'penjualans.toko_id', 'tokos.no_toko', 'tokos.alamat_toko', 'tokos.kategori', 'tokos.jumlah_pegawai', 'users.name')
                ->where(function ($query) use ($keyWord) {
                    $query->where('orderpelanggans.kode_order', 'LIKE', $keyWord)
                        ->orWhere('orderpelanggans.nama_pelanggan', 'LIKE', $keyWord)
                        ->orWhere('orderpelanggans.alamat_pelanggan', 'LIKE', $keyWord)
                        ->orWhere('orderpelanggans.no_telp_pelanggan', 'LIKE', $keyWord);
                })
                ->groupBy('orderpelanggans.kode_order', 'orderpelanggans.nama_pelanggan', 'orderpelanggans.alamat_pelanggan', 'orderpelanggans.no_telp_pelanggan', 'penjualans.toko_id', 'tokos.no_toko', 'tokos.alamat_toko', 'tokos.kategori', 'tokos.jumlah_pegawai', 'orderpelanggans.created_at', 'users.name')
                ->orderBy('orderpelanggans.created_at', 'DESC') // Specify the table alias for created_at
                ->distinct() // Use distinct to avoid duplicate rows
                ->paginate($this->perPage)

        ]);
    }

    public function cancel()
    {
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->jumlah_barang = null;
        $this->total_harga = null;
        $this->barang_id = null;
        $this->toko_id = null;
        $this->user_id = null;
        $this->selected_id = null;
        $this->keyWord = null;
        $this->kode_order = 'ORD-' . date('Ymd') . '-'. Penjualan::count() + 1;
        $this->nama_pelanggan = null;
        $this->alamat_pelanggan = null;
        $this->no_telp_pelanggan = null;
    }

    public function store()
    {
        $this->validate([
        'nama_pelanggan' => 'required',
        'alamat_pelanggan' => 'required',
        'no_telp_pelanggan' => 'required',
        'kode_order' => 'required',
        ]);

        Orderpelanggan::create([
            'nama_pelanggan' => $this-> nama_pelanggan,
            'alamat_pelanggan' => $this-> alamat_pelanggan,
            'no_telp_pelanggan' => $this-> no_telp_pelanggan,
            'kode_order' => $this-> kode_order,
            'user_id' => \Auth::user()->id,
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('closeModal');
        session()->flash('message', 'Penjualan Successfully created.');
    }

    public function edit($id)
    {
        $record = Penjualan::findOrFail($id);
        $this->selected_id = $id;
        $this->jumlah_barang = $record-> jumlah_barang;
        $this->total_harga = $record-> total_harga;
        $this->barang_id = $record-> barang_id;
        $this->toko_id = $record-> toko_id;
        $this->user_id = $record-> user_id;
    }

    public function update()
    {
        $this->validate([
        'jumlah_barang' => 'required',
        'total_harga' => 'required',
        'barang_id' => 'required',
        'toko_id' => 'required',
        'user_id' => 'required',
        ]);

        if ($this->selected_id) {
            $record = Penjualan::find($this->selected_id);
            $record->update([
            'jumlah_barang' => $this-> jumlah_barang,
            'total_harga' => $this-> total_harga,
            'barang_id' => $this-> barang_id,
            'toko_id' => $this-> toko_id,
            'user_id' => $this-> user_id
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
            session()->flash('message', 'Penjualan Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Penjualan::where('id', $id)->delete();
        }
    }


}
