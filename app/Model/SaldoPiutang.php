<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SaldoPiutang extends Model
{
    protected $table = 'saldo_piutangs';

    protected $fillable = [
      'id', 'customers_id', 'keterangan', 'debet', 'kredit'
    ];

    public function customers()
    {
      return $this->belongsTo(DataCustomer::class);
    }
}
