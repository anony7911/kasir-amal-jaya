<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'pembelians';

    protected $fillable = ['jumlah_barang','total_harga','barang_id','supplier_id','user_id', 'status'];

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
    public function supplier()
    {
        return $this->hasOne('App\Models\Supplier', 'id', 'supplier_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

}
