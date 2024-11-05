<?php

namespace App\Http\Livewire\Barangs;

use Livewire\Component;
use App\Models\Supplier;
use App\Models\Hargabarang;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class BarangSupplier extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search, $perPage = 10;
    public $barangsupplier_id, $nama_barang, $harga, $stok, $supplier_id, $barang_id, $kode_barang, $nama_supplier, $alamat_supplier, $no_telp_supplier, $email_supplier, $harga_jual, $harga_supplier;

    public function render()
    {
        return view('livewire.barangs.barang-supplier',[
            'barangs' => \App\Models\Barang::where('nama_barang', 'like', '%'.$this->search.'%')->paginate($this->perPage),
            // hargabarang model hargabarang ditampilkan berdasarkan barang_id terbaru
            'hargabarangs' => Hargabarang::join('barangs', 'barangs.id', '=', 'hargabarangs.barang_id')
                        ->join(DB::raw('(SELECT barang_id, MAX(id) as max_id FROM hargabarangs GROUP BY barang_id) as latest_hargabarangs'), function ($join) {
                            $join->on('hargabarangs.id', '=', 'latest_hargabarangs.max_id');
                            $join->on('hargabarangs.barang_id', '=', 'latest_hargabarangs.barang_id');
                        })
                        ->select('barangs.nama_barang', 'barangs.kode_barang', 'hargabarangs.harga_jual', 'hargabarangs.harga_supplier')
                        ->where('barangs.nama_barang', 'like', '%' . $this->search . '%')
                        ->where('hargabarangs.supplier_id', Supplier::where('user_id', \Auth::user()->id)->first()->id)
                        ->orderBy('latest_hargabarangs.max_id', 'DESC')
                        ->paginate($this->perPage),
        ])->extends('layouts.app')->section('content');
    }

    public function resetInput(){
        $this->supplier_id = null;
        $this->barang_id = null;
        $this->harga_jual = null;
        $this->harga_supplier = null;
    }

    public function store(){
        $this->validate([
            'barang_id' => 'required',
            'harga_jual' => 'required',
            'harga_supplier' => 'required',
        ]);

        // get user id
        $user_id = \Auth::user()->id;
        // get supplier id berdasarkan user id
        $supplier_id = \App\Models\Supplier::where('user_id', $user_id)->first()->id;

        Hargabarang::create([
            'barang_id' => $this->barang_id,
            'supplier_id' => $supplier_id,
            'harga_jual' => $this->harga_jual,
            'harga_supplier' => $this->harga_supplier,
        ]);

        $this->resetInput();
        session()->flash('message', 'Harga Barang Berhasil Diperbaharui');
    }
}
