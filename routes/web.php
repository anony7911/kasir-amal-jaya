<?php

use App\Http\Livewire\Laporan;
use App\Http\Livewire\ManajemenUser;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\PenjualanDetail;
use App\Http\Livewire\Barangs\BarangSupplier;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes(['register' => false], ['reset' => false], ['verify' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route Hooks - Do not delete//
	Route::view('penjualans', 'livewire.penjualans.index')->middleware('auth');
	Route::view('pembelians', 'livewire.pembelians.index')->middleware('auth');
	Route::view('barangs', 'livewire.barangs.index')->middleware('auth');
	Route::view('pegawais', 'livewire.pegawais.index')->middleware('auth');
	Route::view('suppliers', 'livewire.suppliers.index')->middleware('auth');
	Route::view('tokos', 'livewire.tokos.index')->middleware('auth');
    // route barang/barangsupplier
    Route::get('/barangs/barang-supplier', BarangSupplier::class)->name('barangs.barangsupplier')->middleware('auth');
    // manajemen-user
    Route::get('/users', ManajemenUser::class)->name('users')->middleware('auth');
    // laporan
    Route::get('/laporan', Laporan::class)->name('laporan')->middleware('auth');
    // detail penjualan
    Route::get('/penjualans/{id}', PenjualanDetail::class)->name('penjualans.detail')->middleware('auth');
