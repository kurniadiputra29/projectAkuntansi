<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pettycash extends Model
{
    protected $table = 'pettycashes';

    protected $fillable = [
      'id', 'tanggal', 'kode', 'description', 'nomor_akun', 'debet', 'kredit'
    ];
}
