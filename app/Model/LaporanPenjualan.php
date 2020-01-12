<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LaporanPenjualan extends Model
{
    protected $table = 'laporan_penjualans';
    protected $fillable = ['id', 'crj_id', 'salesjournal_id', 'retur_penjualan_id', 'total'];

    public function crj()
    {
    	return $this->belongsTo(crj::class, "crj_id");
    }
    public function Sales_Journal()
    {
    	return $this->belongsTo(SalesJournal::class, "salesjournal_id");
    }
    public function ReturPenjualan()
    {
        return $this->belongsTo(ReturPenjualan::class, "retur_penjualan_id");
    }
}
