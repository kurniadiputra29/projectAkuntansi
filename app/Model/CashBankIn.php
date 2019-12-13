<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CashBankIn extends Model
{
    protected $table = 'cash_bank_ins';

    protected $fillable = [
      'id','tanggal','kode', 'customers_id', 'description', 'created_at','update_at'
    ];
    public function CashBankInDetails()
    {
      return $this->hasMany(CashBankInDetails::class, "cash_bank_ins_id");
    }
    public function data_customers()
    {
        return $this->belongsTo(DataCustomer::class, "customers_id");
    }
}
