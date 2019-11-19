<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class jurnalpenyesuaiandetail extends Model
{
    protected $table = 'jurnalpenyesuaiandetails';
    protected $fillable = ['jurnalpenyesuaians_id', 'nomor_akun', 'nama_akun' ,'debet', 'kredit'];
    public function jurnalpenyesuaians()
    {
    	return $this->belongsTo(Jurnalpenyesuaian::class, "jurnalpenyesuaians_id");
    }
}
