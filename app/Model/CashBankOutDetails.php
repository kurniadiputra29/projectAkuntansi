<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CashBankOutDetails extends Model
{
    protected $table = 'cash_bank_out_details';
    protected $fillable = ['cash_bank_outs_id', 'nomor_akun', 'nama_akun' ,'debet', 'kredit'];
    public function CashBankOut()
    {
    	return $this->belongsTo(CashBankOut::class, "cash_bank_outs_id");
    }
    public function account()
    {
    	return $this->belongsTo(Account::class);
    }
}
