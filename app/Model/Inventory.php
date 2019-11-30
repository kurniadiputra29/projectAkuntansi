<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventories';
    protected $fillable = ['items_id', 'cpj_id', 'crj_id', 'purchasejournal_id', 'salesjournal_id', 'status', 'unit' ,'price', 'total'];
    public function Items()
    {
    	return $this->belongsTo(Item::class, "items_id");
    }
    public function purchase_journals()
    {
    	return $this->belongsTo(PurchaseJournal::class, "purchasejournal_id");
    }
    public function Sales_Journal()
    {
    	return $this->belongsTo(SalesJournal::class, "salesjournal_id");
    }
    public function crj()
    {
    	return $this->belongsTo(crj::class, "crj_id");
    }
    public function cpj()
    {
    	return $this->belongsTo(cpj::class, "cpj_id");
    }
}
