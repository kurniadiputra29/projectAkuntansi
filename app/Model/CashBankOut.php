<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CashBankOut extends Model
{
    protected $table = 'cash_bank_outs';

    protected $fillable = [
      'id','tanggal','kode','suppliers_id', 'description','status', 'created_at','update_at'
    ];
    public function CashBankOutDetails()
    {
      return $this->hasMany(CashBankOutDetails::class, "cash_bank_outs_id");
    }
    public function data_suppliers()
    {
        return $this->belongsTo(DataSupplier::class, "suppliers_id");
    }
}
