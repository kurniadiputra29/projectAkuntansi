<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class crjdetail extends Model
{
    protected $table = 'crjdetails';
    protected $fillable = ['crj_id', 'nomor_akun', 'nama_akun' ,'debet', 'kredit'];
    public function crjs()
    {
    	return $this->belongsTo(crj::class);
    }
    public function account()
    {
    	return $this->belongsTo(Account::class);
    }
    public function items()
    {
        return $this->belongsTo(Item::class);
    }
}
