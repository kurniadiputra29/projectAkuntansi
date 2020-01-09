<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LaporanHutang extends Model
{
    protected $table = 'laporan_hutangs';
    protected $fillable = ['suppliers_id', 'saldo_hutangs_id', 'purchasejournal_id', 'retur_pembelian_id', 'cash_bank_outs_id', 'debet', 'kredit'];
    public function data_suppliers()
    {
        return $this->belongsTo(DataSupplier::class, "suppliers_id");
    }
    public function saldo_hutangs()
    {
        return $this->belongsTo(SaldoHutang::class, 'saldo_hutangs_id');
    }
    public function purchase_journals()
    {
    	return $this->belongsTo(PurchaseJournal::class, "purchasejournal_id");
    }
    public function ReturPembelian()
    {
        return $this->belongsTo(ReturPembelian::class, "retur_pembelian_id");
    }
    public function CashBankOut()
    {
        return $this->belongsTo(CashBankOut::class, "cash_bank_outs_id");
    }
}
