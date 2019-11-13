<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class cpjdetail extends Model
{
    protected $table = 'cpjdetails';
    protected $fillable = ['cpj_id', 'nomor_akun', 'nama_akun' ,'debet', 'kredit'];
    public function cpjs()
    {
    	return $this->belongsTo(cpj::class);
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
