<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $fillable = [
      'id','kode','nama','foto'
    ];
    public function Inventory()
    {
      return $this->hasMany(Inventory::class, "items_id");
    }
}
