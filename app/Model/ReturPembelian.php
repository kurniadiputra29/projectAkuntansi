<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReturPembelian extends Model
{
    protected $table = 'retur_pembelians';

    protected $fillable = [
      'id', 'tanggal', 'kode', 'suppliers_id', 'description'
    ];

    public function data_suppliers()
    {
        return $this->belongsTo(DataSupplier::class, "suppliers_id");
    }
}
