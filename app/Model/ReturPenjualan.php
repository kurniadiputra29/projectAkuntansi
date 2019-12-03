<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReturPenjualan extends Model
{
    protected $table = 'retur_penjualans';

    protected $fillable = [
      'id', 'tanggal', 'kode', 'customers_id', 'description'
    ];

    public function data_customers()
    {
        return $this->belongsTo(DataCustomer::class, "customers_id");
    }

    public function retur_penjualan_details()
    {
      return $this->hasMany(ReturPenjualanDetail::class);
    }
    public function Inventory()
    {
      return $this->hasMany(Inventory::class, "retur_penjualan_id");
    }
}
