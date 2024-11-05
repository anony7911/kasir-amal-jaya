<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderpelanggan extends Model
{
    use HasFactory;

    protected $table = 'orderpelanggans';

    protected $fillable = ['kode_order','nama_pelanggan','alamat_pelanggan','no_telp_pelanggan','user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id', 'user_id');
    }

    public function penjualans()
    {
        return $this->hasMany('App\Models\Penjualan', 'orderpelanggan_id', 'id');
    }
}
