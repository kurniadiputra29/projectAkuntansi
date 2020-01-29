<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HargaJual extends Model
{
    protected $table = 'harga_juals';

    protected $fillable = [
      'id', 'items_id', 'harga_jual'
    ];

    public function items()
    {
      return $this->belongsTo(Item::class, 'items_id');
    }
}
