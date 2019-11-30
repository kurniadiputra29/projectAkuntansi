<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReturPenjualanDetail extends Model
{
    protected $table = 'retur_penjualan_details';

    protected $fillable = [
      'id', 'retur_penjualan_id', 'nomor_akun', 'nama_akun', 'debet', 'kredit'
    ];

    public function retur_penjualans()
    {
      return $this->belongsTo(ReturPenjualan::class, "retur_penjualan_id");
    }
}
