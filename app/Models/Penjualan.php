<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'penjualans';

    protected $fillable = ['jumlah_barang','total_harga','barang_id','toko_id', 'orderpelanggan_id', 'harga_satuan'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function barang()
    {
        return $this->hasOne('App\Models\Barang', 'id', 'barang_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function toko()
    {
        return $this->belongsTo('App\Models\Toko', 'id', 'toko_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function orderpelanggan()
    {
        return $this->hasOne('App\Models\Orderpelanggan', 'id', 'orderpelanggan_id');
    }
}
