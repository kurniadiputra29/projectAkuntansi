<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pettycash extends Model
{
    protected $table = 'pettycashes';

    protected $fillable = [
      'id', 'tanggal', 'kode', 'penerima', 'description', 'status'
    ];

    public function pettycash_detail()
    {
      return $this->hasMany(PettycashDetail::class);
    }
}
