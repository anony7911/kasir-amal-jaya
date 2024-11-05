<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'barangs';

    protected $fillable = ['kode_barang','nama_barang','deskripsi_barang'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hargabarangs()
    {
        return $this->hasMany('App\Models\Hargabarang', 'barang_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pembelians()
    {
        return $this->hasMany('App\Models\Pembelian', 'barang_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penjualans()
    {
        return $this->hasMany('App\Models\Penjualan', 'barang_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stokbarangs()
    {
        return $this->hasMany('App\Models\Stokbarang', 'barang_id', 'id');
    }

}
