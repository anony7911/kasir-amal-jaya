<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Supplier;
use App\Models\Pembelian;
use App\Models\Hargabarang;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Pembelians extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $jumlah_barang = 0, $barang_id, $supplier_id, $user_id, $hargabarang_id;
    public $harga_barangs = [], $total_harga;
    public $perPage = 25;
    protected $pembelians;

    public $status;

    public function render()
    {
        $keyWord = '%' . $this->keyWord . '%';
        if ($this->supplier_id) {
            // BEGIN: ed8c6549bwf9
            $this->harga_barangs = Hargabarang::join('barangs', 'barangs.id', '=', 'hargabarangs.barang_id')
                ->join(DB::raw('(SELECT barang_id, MAX(id) as max_id FROM hargabarangs GROUP BY barang_id) as latest_hargabarangs'), function ($join) {
                    $join->on('hargabarangs.id', '=', 'latest_hargabarangs.max_id');
                    $join->on('hargabarangs.barang_id', '=', 'latest_hargabarangs.barang_id');
                })
                ->select('barangs.nama_barang', 'barangs.kode_barang', 'hargabarangs.harga_jual', 'hargabarangs.harga_supplier', 'hargabarangs.barang_id')
                ->where('hargabarangs.supplier_id', $this->supplier_id)
                ->orderBy('latest_hargabarangs.max_id', 'DESC')
                ->get();
            // END: ed8c6549bwf9
            if ($this->jumlah_barang) {
                // hargasupplier adalah harga_supplier
                $hargabarang = Hargabarang::join('barangs', 'barangs.id', '=', 'hargabarangs.barang_id')
                ->join(DB::raw('(SELECT barang_id, MAX(id) as max_id FROM hargabarangs GROUP BY barang_id) as latest_hargabarangs'), function ($join) {
                    $join->on('hargabarangs.id', '=', 'latest_hargabarangs.max_id');
                    $join->on('hargabarangs.barang_id', '=', 'latest_hargabarangs.barang_id');
                })
                ->select('barangs.nama_barang', 'barangs.kode_barang', 'hargabarangs.harga_jual', 'hargabarangs.harga_supplier', 'hargabarangs.barang_id')
                    ->where('hargabarangs.barang_id', $this->hargabarang_id)
                    ->first();
                $this->total_harga = $this->jumlah_barang *  $hargabarang->harga_supplier;
            }
        }
        // jika user = supplier maka tampilkan pembelian berdasarkan supplier. jika user = admin maka tampilkan semua pembelian
        if (\Auth::user()->role == 'supplier') {
            $this->supplier_id = Supplier::where('user_id', \Auth::user()->id)->first()->id;
            $this->pembelians = Pembelian::join('suppliers', 'suppliers.id', '=', 'pembelians.supplier_id')
                ->join('barangs', 'barangs.id', '=', 'pembelians.barang_id')
                ->join('users', 'users.id', '=', 'pembelians.user_id')
                ->select('pembelians.id', 'pembelians.status', 'pembelians.jumlah_barang', 'pembelians.total_harga', 'pembelians.created_at', 'suppliers.nama_supplier', 'barangs.nama_barang', 'barangs.kode_barang','users.name')
                ->where('suppliers.id', $this->supplier_id)
                ->where('barangs.nama_barang', 'LIKE', $keyWord)
                ->latest()->paginate($this->perPage);
        } else{
            $this->pembelians = Pembelian::join('suppliers', 'suppliers.id', '=', 'pembelians.supplier_id')
                ->join('barangs', 'barangs.id', '=', 'pembelians.barang_id')
                ->join('users', 'users.id', '=', 'pembelians.user_id')
                ->select('pembelians.id', 'pembelians.status', 'pembelians.jumlah_barang', 'pembelians.total_harga', 'pembelians.created_at', 'suppliers.nama_supplier', 'barangs.nama_barang', 'barangs.kode_barang','users.name')
                ->where('suppliers.nama_supplier', 'LIKE', $keyWord)
                ->orWhere('barangs.nama_barang', 'LIKE', $keyWord)
                ->orWhere('users.name', 'LIKE', $keyWord)
                ->latest()->paginate($this->perPage);
        }
        return view('livewire.pembelians.view', [
            'pembelians' => $this->pembelians,
            'barangs' => \App\Models\Barang::latest()->get(),
            'suppliers' => \App\Models\Supplier::latest()->get(),
            'harga_barangs' => $this->harga_barangs,
            'total_harga' => $this->total_harga,
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
        $this->supplier_id = null;
        $this->user_id = null;
    }

    public function store()
    {
        $this->validate([
		'jumlah_barang' => 'required',
		'total_harga' => 'required',
		'barang_id' => 'required',
		'supplier_id' => 'required',
		'user_id' => 'required',
        ]);

        Pembelian::create([
			'jumlah_barang' => $this-> jumlah_barang,
			'total_harga' => $this-> total_harga,
			'barang_id' => $this-> barang_id,
			'supplier_id' => $this-> supplier_id,
			'user_id' => $this-> user_id
        ]);

        $this->resetInput();
		$this->dispatchBrowserEvent('closeModal');
		session()->flash('message', 'Pembelian Successfully created.');
    }

    public function edit($id)
    {
        $record = Pembelian::findOrFail($id);
        $this->selected_id = $id;
		$this->jumlah_barang = $record-> jumlah_barang;
		$this->total_harga = $record-> total_harga;
		$this->barang_id = $record-> barang_id;
		$this->supplier_id = $record-> supplier_id;
		$this->user_id = $record-> user_id;
    }

    public function update()
    {
        $this->validate([
		'jumlah_barang' => 'required',
		'total_harga' => 'required',
		'barang_id' => 'required',
		'supplier_id' => 'required',
		'user_id' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Pembelian::find($this->selected_id);
            $record->update([
			'jumlah_barang' => $this-> jumlah_barang,
			'total_harga' => $this-> total_harga,
			'barang_id' => $this-> barang_id,
			'supplier_id' => $this-> supplier_id,
			'user_id' => $this-> user_id
            ]);

            $this->resetInput();
            $this->dispatchBrowserEvent('closeModal');
			session()->flash('message', 'Pembelian Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            Pembelian::where('id', $id)->delete();
        }
    }

    public function tambah(){
        $this->validate([
            'supplier_id' => 'required',
            'jumlah_barang' => 'required',
            'hargabarang_id' => 'required',
        ]);

        // barang_id adalah hargabarang_id
        $hargabarang = Hargabarang::join('barangs', 'barangs.id', '=', 'hargabarangs.barang_id')
            ->join(DB::raw('(SELECT barang_id, MAX(id) as max_id FROM hargabarangs GROUP BY barang_id) as latest_hargabarangs'), function ($join) {
                $join->on('hargabarangs.id', '=', 'latest_hargabarangs.max_id');
                $join->on('hargabarangs.barang_id', '=', 'latest_hargabarangs.barang_id');
            })
            ->select('barangs.nama_barang', 'barangs.kode_barang', 'hargabarangs.harga_jual', 'hargabarangs.harga_supplier', 'hargabarangs.barang_id')
                ->where('hargabarangs.barang_id', $this->hargabarang_id)
                ->first();

        Pembelian::create([
            'jumlah_barang' => $this->jumlah_barang,
            'total_harga' => $this->total_harga,
            'barang_id' => $hargabarang->barang_id,
            'supplier_id' => $this->supplier_id,
            'user_id' => \Auth::user()->id,
        ]);

        $this->resetInput();
        session()->flash('message', 'Pembelian Berhasil Ditambahkan');
    }

    public function updatedJumlahBarang()
    {
        // Ubah cara Anda mengambil data harga barang
        // get harga barang berdasarkan barang_id yang terbaru
        $hargabarang = Hargabarang::join(DB::raw('(SELECT barang_id, MAX(id) as max_id FROM hargabarangs GROUP BY barang_id) as latest_hargabarangs'), function ($join) {
            $join->on('hargabarangs.id', '=', 'latest_hargabarangs.max_id');
            $join->on('hargabarangs.barang_id', '=', 'latest_hargabarangs.barang_id');
        })
            ->select('hargabarangs.id', 'hargabarangs.barang_id', 'hargabarangs.harga_supplier')
            ->where('hargabarangs.barang_id', $this->barang_id)
            ->first();

        if ($hargabarang) {
            $this->total_harga = $this->jumlah_barang * $hargabarang->harga_supplier;
        }
    }

    // ['Batal', 'Menunggu', 'Proses','Selesai']
    public function tolak($id)
    {
        $pembelian = Pembelian::find($id);
        $pembelian->update([
            'status' => 'Batal',
        ]);
        session()->flash('message', 'Pembelian Berhasil Ditolak');
    }

    public function proses($id)
    {
        // update status pembelian menjadi proses (tipe data enum)
        $pembelian = Pembelian::find($id)->update([
            'status' => 'Proses',
        ]);
        session()->flash('message', 'Pembelian Berhasil Diproses');
    }

    public function selesai($id)
    {
        $pembelian = Pembelian::find($id);
        $pembelian->update([
            'status' => 'Selesai',
        ]);
        session()->flash('message', 'Pembelian Berhasil Diselesaikan');
    }
}
