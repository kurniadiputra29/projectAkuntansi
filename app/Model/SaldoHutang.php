<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SaldoHutang extends Model
{
    protected $table = 'saldo_hutangs';

    protected $fillable = [
      'id', 'suppliers_id', 'keterangan', 'debet', 'kredit'
    ];

    public function supplier()
    {
      return $this->belongsTo(DataSupplier::class, 'suppliers_id');
    }
}
