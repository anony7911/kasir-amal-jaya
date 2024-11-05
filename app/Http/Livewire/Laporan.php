<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Orderpelanggan;
use App\Models\Pembelian;

use Carbon\Carbon;
use Pdf;

class Laporan extends Component
{
    public $tanggal_awal_penjualan, $tanggal_akhir_penjualan;
    public $tanggal_awal_pembelian, $tanggal_akhir_pembelian;
    public $tanggal_awal_barang, $tanggal_akhir_barang;

    public function render()
    {
        return view('livewire.laporan')->extends('layouts.app')->section('content');
    }

    public function cetak_penjualan(){
        $this->validate([
            'tanggal_awal_penjualan' => 'required',
            'tanggal_akhir_penjualan' => 'required',
        ]);
        $laporan = Orderpelanggan::whereBetween('created_at', [$this->tanggal_awal_penjualan, $this->tanggal_akhir_penjualan])
                ->orderBy('id', 'DESC')
                ->get();
        $tanggal_awal_penjualan = $this->tanggal_awal_penjualan;
        $tanggal_akhir_penjualan = $this->tanggal_akhir_penjualan;

        $pdf = Pdf::loadview('livewire.laporan-pdf-penjualan', compact('laporan', 'tanggal_awal_penjualan', 'tanggal_akhir_penjualan'))->setPaper('a4', 'landscape')->output();
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf;
        }, Carbon::now()->format('Y-m-d') . '-laporan-penjualan-' . $this->tanggal_awal_penjualan . '-' . $this->tanggal_akhir_penjualan . '.pdf'
        );
    }

    public function cetak_pembelian(){
        $this->validate([
            'tanggal_awal_pembelian' => 'required',
            'tanggal_akhir_pembelian' => 'required',
        ]);
        $laporan = Pembelian::join('barangs', 'barangs.id', '=', 'pembelians.barang_id')
                ->join('suppliers', 'suppliers.id', '=', 'pembelians.supplier_id')
                ->join('users', 'users.id', '=', 'pembelians.user_id')
                ->select('pembelians.*','barangs.kode_barang', 'barangs.nama_barang', 'suppliers.nama_supplier', 'users.name')
                ->whereBetween('pembelians.created_at', [$this->tanggal_awal_pembelian, $this->tanggal_akhir_pembelian])
                ->orderBy('pembelians.id', 'DESC')
                ->get();
        $tanggal_awal_pembelian = $this->tanggal_awal_pembelian;
        $tanggal_akhir_pembelian = $this->tanggal_akhir_pembelian;

        $pdf = Pdf::loadview('livewire.laporan-pdf-pembelian', compact('laporan', 'tanggal_awal_pembelian', 'tanggal_akhir_pembelian'))->setPaper('a4', 'landscape')->output();
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf;
        }, Carbon::now()->format('Y-m-d') . '-laporan-pembelian-' . $this->tanggal_awal_pembelian . '-' . $this->tanggal_akhir_pembelian . '.pdf'
        );
    }

    public function cetak_barang(){

        $this->validate([
            'tanggal_awal_barang' => 'required',
            'tanggal_akhir_barang' => 'required',
        ]);

        $laporan = Pembelian::join('barangs', 'barangs.id', '=', 'pembelians.barang_id')
            ->join('suppliers', 'suppliers.id', '=', 'pembelians.supplier_id')
            ->join('users', 'users.id', '=', 'pembelians.user_id')
            ->select('pembelians.*','barangs.kode_barang', 'barangs.nama_barang', 'suppliers.nama_supplier', 'users.name')
            ->whereBetween('pembelians.created_at', [$this->tanggal_awal_barang, $this->tanggal_akhir_barang])
            ->orderBy('pembelians.id', 'DESC')
            ->get();

        $tanggal_awal_barang = $this->tanggal_awal_barang;
        $tanggal_akhir_barang = $this->tanggal_akhir_barang;

        $pdf = Pdf::loadview('livewire.laporan-pdf-barang', compact('laporan', 'tanggal_awal_barang', 'tanggal_akhir_barang'))->setPaper('a4', 'landscape')->output();
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf;
        }, Carbon::now()->format('Y-m-d') . '-laporan-stok-' . $this->tanggal_awal_barang . '-' . $this->tanggal_akhir_barang . '.pdf'
        );
    }
}
