<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PettycashDetail extends Model
{
    protected $table = 'pettycash_details';

    protected $fillable = [
      'id', 'pettycash_id', 'nomor_akun', 'nama_akun', 'debet', 'kredit'
    ];

    public function pettycash()
    {
      return $this->belongsTo(Pettycash::class);
    }
}
