<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'suppliers';

    protected $fillable = ['nama_supplier','alamat_supplier','no_telp_supplier','user_id'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hargabarangs()
    {
        return $this->hasMany('App\Models\Hargabarang', 'supplier_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pembelians()
    {
        return $this->hasMany('App\Models\Pembelian', 'supplier_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    
}
