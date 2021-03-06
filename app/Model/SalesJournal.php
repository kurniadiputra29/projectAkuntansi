<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SalesJournal extends Model
{
    protected $table = 'sales_journals';

    protected $fillable = [
      'id','tanggal','kode','customers_id', 'description', 'created_at','update_at'
    ];
    
    public function data_customers()
    {
        return $this->belongsTo(DataCustomer::class, "customers_id");
    }
    public function salesjournaldetail()
    {
      return $this->hasMany(salesjournaldetail::class);
    }
    public function Inventory()
    {
      return $this->hasMany(Inventory::class, "salesjournal_id");
    }
}
