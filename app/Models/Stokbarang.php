<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stokbarang extends Model
{
    use HasFactory;

    protected $table = 'stokbarangs';

    protected $fillable = ['jumlah_barang','barang_id','toko_id'];
}
