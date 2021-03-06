<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SaldoAwal extends Model
{
    protected $table = 'saldo_awals';

    protected $fillable = [
      'id','tanggal', 'account_id','debet','kredit','created_at','updated_at'
    ];

    public function account()
    {
      return $this->belongsTo(Account::class);
    }
}
