<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class cpj extends Model
{
    protected $table = 'cpjs';

    protected $fillable = [
      'id','tanggal','kode','suppliers_id', 'description', 'created_at','update_at'
    ];

    public function data_suppliers()
    {
        return $this->belongsTo(DataSupplier::class, "suppliers_id");
    }
    public function cpjdetail()
    {
      return $this->hasMany(cpjdetail::class, "cpj_id");
    }
    public function Inventory()
    {
      return $this->hasMany(Inventory::class, "cpj_id");
    }
    public function ReturPembelian()
    {
        return $this->hasMany(ReturPembelian::class, "cpj_id");
    }
}
