<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LaporanPembelian extends Model
{
    protected $table = 'laporan_pembelians';
    protected $fillable = ['id', 'cpj_id', 'purchasejournal_id', 'retur_pembelian_id', 'total'];
    public function cpj()
    {
    	return $this->belongsTo(cpj::class, "cpj_id");
    }
    public function purchase_journals()
    {
    	return $this->belongsTo(PurchaseJournal::class, "purchasejournal_id");
    }
    public function ReturPembelian()
    {
        return $this->belongsTo(ReturPembelian::class, "retur_pembelian_id");
    }
}
