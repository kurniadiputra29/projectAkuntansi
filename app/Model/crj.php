<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class crj extends Model
{
    protected $table = 'crjs';

    protected $fillable = [
      'id','tanggal','kode','customers_id', 'description', 'created_at','update_at'
    ];
    public function data_customers()
    {
        return $this->belongsTo(DataCustomer::class, "customers_id");
    }
}
