<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class jurnalumumdetail extends Model
{
    protected $table = 'jurnalumumdetails';
    protected $fillable = ['jurnal_umums_id', 'nomor_akun', 'nama_akun' ,'debet', 'kredit'];
    public function jurnal_umums()
    {
    	return $this->belongsTo(JurnalUmum::class, "jurnal_umums_id");
    }
}
