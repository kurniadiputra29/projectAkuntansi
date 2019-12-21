<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PurchaseJournal extends Model
{
    protected $table = 'purchase_journals';

    protected $fillable = [
      'id','tanggal','kode','suppliers_id', 'description', 'created_at','update_at'
    ];

    public function data_suppliers()
    {
        return $this->belongsTo(DataSupplier::class, "suppliers_id");
    }
    public function Inventory()
    {
      return $this->hasMany(Inventory::class, "purchasejournal_id");
    }
    public function purchase_journals()
    {
        return $this->hasMany(PurchaseJournal::class, "purchasejournal_id");
    }
}
