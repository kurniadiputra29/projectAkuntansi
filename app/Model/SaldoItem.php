<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SaldoItem extends Model
{
    protected $table = 'saldo_items';

    protected $fillable = [
      'id', 'tanggal', 'items_id', 'unit', 'price', 'total'
    ];

    public function saldo_items()
    {
      return $this->belongsTo(Item::class, 'items_id');
    }
}
