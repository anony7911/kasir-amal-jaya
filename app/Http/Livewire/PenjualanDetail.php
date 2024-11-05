<?php

namespace App\Http\Livewire;

use App\Models\Toko;
use App\Models\Barang;
use Livewire\Component;
use App\Models\Penjualan;
use App\Models\Stokbarang;
use App\Models\Orderpelanggan;

class PenjualanDetail extends Component
{

    public $selected_id, $keyWord, $jumlah_barang, $total_harga, $barang_id, $toko_id, $user_id, $kode_order, $nama_pelanggan, $alamat_pelanggan, $no_telp_pelanggan;

    public $perPage = 25;

    public $barangs, $harga, $orderpelanggan_id, $jumlah, $total, $stok;

    public function mount($id)
    {
        $this->orderpelanggan_id = $id;

        $pelanggan = Orderpelanggan::find($id);
        $this->kode_order = $pelanggan->kode_order;
        $this->nama_pelanggan = $pelanggan->nama_pelanggan;
        $this->alamat_pelanggan = $pelanggan->alamat_pelanggan;
        $this->no_telp_pelanggan = $pelanggan->no_telp_pelanggan;

        // tampilkan barang yang barang_id ada di tabel harga barang
        $this->barangs = Barang::whereHas('hargabarangs')->get();

    }

    public function render()
    {
        if ($this->barang_id) {
            $barang = Barang::find($this->barang_id);
            // cari harga barang di tabel hargabarang berdasarkan barang_id dengan harga terakhir
            $harga = $barang->hargabarangs()->latest()->first();
            $this->harga = $harga->harga_jual;
            // stok barang diambil dari tabel stokbarang dijumlahkan semua dengan barang_id yang dipilih
            $this->stok = $barang->stokbarangs()->sum('jumlah_barang');
        }

        if($this->jumlah && $this->harga){
            $this->total = $this->jumlah * $this->harga;
        }

        return view('livewire.penjualan-detail', [
            'penjualans' => Penjualan::latest()
                ->where('orderpelanggan_id', $this->orderpelanggan_id)
                ->paginate($this->perPage),
            'harga' => $this->harga,
            'stok' => $this->stok,
            'total' => $this->total,
        ])->extends('layouts.app')->section('content');
    }

    public function resetInput()
    {
        $this->jumlah = null;
        $this->total = null;
        $this->barang_id = null;
        $this->harga = null;
        $this->stok = null;
    }

    public function tambahPesanan(){
        $this->validate([
            'jumlah' => 'required|numeric|min:1',
            'barang_id' => 'required',
        ]);

        $barang = Barang::find($this->barang_id);
        $stokbarang_lama = $barang->stokbarangs()->oldest()->first();

        // kurangi stok barang yang paling lama
        if($stokbarang_lama){
            $stokbarang_lama->jumlah_barang = $stokbarang_lama->jumlah_barang - $this->jumlah;
            $stokbarang_lama->save();
        }

        // jika barang_id ada ditabel orderpelanggan dengan orderpelanggan_id maka update jumlah barang
        $penjualan = Penjualan::where('barang_id', $this->barang_id)
            ->where('orderpelanggan_id', $this->orderpelanggan_id)
            ->first();

        if($penjualan){
            $penjualan->jumlah_barang = $penjualan->jumlah_barang + $this->jumlah;
            $penjualan->total_harga = $penjualan->total_harga + $this->total;
            $penjualan->save();

            $this->resetInput();
            session()->flash('message', $penjualan ? 'Pesanan berhasil diperbaharui' : 'Pesanan gagal diperbaharui');
        }else{
            $penjualan = Penjualan::create([
                'barang_id' => $this->barang_id,
                'jumlah_barang' => $this->jumlah,
                'total_harga' => $this->total,
                'toko_id' => $stokbarang_lama->toko_id,
                'orderpelanggan_id' => $this->orderpelanggan_id,
                'harga_satuan' => $this->harga,
            ]);
            $this->resetInput();
            session()->flash('message', $penjualan ? 'Pesanan berhasil ditambahkan' : 'Pesanan gagal ditambahkan');
        }

    }

    public function hapusPesanan($id){

        $penjualan = Penjualan::find($id);

        $barang = Barang::find($penjualan->barang_id);
        $stokbarang_lama = $barang->stokbarangs()->oldest()->first();

        // tambah stok barang yang paling lama
        if($stokbarang_lama){
            $stokbarang_lama->jumlah_barang = $stokbarang_lama->jumlah_barang + $penjualan->jumlah_barang;
            $stokbarang_lama->save();
        }

        $penjualan->delete();

        session()->flash('message', $penjualan ? 'Pesanan berhasil dihapus' : 'Pesanan gagal dihapus');
    }
}
