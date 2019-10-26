<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DataSupplier extends Model
{
    protected $table = 'data_suppliers';

    protected $fillable = [
      'id', 'kode', 'nama', 'npwp', 'alamat', 'termin', 'created_at', 'update_at'
    ];
}
