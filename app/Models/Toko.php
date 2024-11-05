<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'tokos';

    protected $fillable = ['no_toko','alamat_toko','kategori','jumlah_pegawai'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pegawais()
    {
        return $this->hasMany('App\Models\Pegawai', 'toko_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penjualan()
    {
        return $this->hasMany('App\Models\Penjualan', 'toko_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stokbarangs()
    {
        return $this->hasMany('App\Models\Stokbarang', 'toko_id', 'id');
    }


}
