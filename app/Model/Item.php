<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    protected $fillable = [
      'id','kode','nama','unit','harga','nilai_persediaan','gambar'
    ];
}
