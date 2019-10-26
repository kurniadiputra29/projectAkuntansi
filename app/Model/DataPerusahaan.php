<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DataPerusahaan extends Model
{
    protected $table = 'data_perusahaans';

    protected $fillable = [
      'id', 'name', 'alamat', 'telepon', 'discription', 'created_at', 'update_at'
    ];
}
