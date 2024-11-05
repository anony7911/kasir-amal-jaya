<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'pegawais';

    protected $fillable = ['nama_pegawai','alamat_pegawai','no_telp_pegawai','user_id','toko_id'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function toko()
    {
        return $this->hasOne('App\Models\Toko', 'id', 'toko_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    
}
