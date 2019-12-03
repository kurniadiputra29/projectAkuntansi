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

    public function retur_pembelian_details()
    {
      return $this->hasMany(ReturPembelianDetail::class);
    }
    public function Inventory()
    {
      return $this->hasMany(Inventory::class, "retur_pembelian_id");
    }
}
