<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CashBankInDetails extends Model
{
    protected $table = 'cash_bank_in_details';
    protected $fillable = ['cash_bank_ins_id', 'nomor_akun', 'nama_akun' ,'debet', 'kredit'];
    public function CashBankIn()
    {
    	return $this->belongsTo(CashBankIn::class, "cash_bank_ins_id");
    }
    public function account()
    {
    	return $this->belongsTo(Account::class);
    }
}
