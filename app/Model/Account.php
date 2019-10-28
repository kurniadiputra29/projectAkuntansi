<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';

    protected $fillable = [
      'id','nomor','nama','keterangan','created_at','update_at'
    ];

    public function saldo_awal()
    {
      return $this->belongsTo(SaldoAwal::class);
    }
}
