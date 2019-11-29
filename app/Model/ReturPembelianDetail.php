<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReturPembelianDetail extends Model
{
    protected $table = 'retur_pembelian_details';

    protected $fillable = [
      'id', 'retur_pembelian_id', 'nomor_akun', 'nama_akun', 'debet', 'kredit'
    ];

    public function retur_pembelians()
    {
      return $this->belongsTo(ReturPembelian::class, "retur_pembelian_id");
    }
}
