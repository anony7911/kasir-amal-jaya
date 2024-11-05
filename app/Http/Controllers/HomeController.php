<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_penjualan = \App\Models\Penjualan::sum('total_harga');
        $total_pembelian = \App\Models\Pembelian::sum('total_harga');
        $total_barang = \App\Models\Barang::count();
        $total_supplier = \App\Models\Supplier::count();
        $total_pelanggan = \App\Models\Orderpelanggan::count();
        return view('home', compact('total_penjualan', 'total_pembelian', 'total_barang', 'total_supplier', 'total_pelanggan'));
    }
}
