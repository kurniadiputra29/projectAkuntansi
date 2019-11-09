<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cashinbankdetail extends Model
{
    protected $table = 'cashinbankdetails';
    protected $fillable = ['cashinbank_id', 'nomor_akun', 'nama' ,'debet', 'kredit'];
    public function cashinbank()
    {
    	return $this->belongsTo(Cashinbank::class);
    }
    public function account()
    {
    	return $this->belongsTo(Account::class);
    }
}
