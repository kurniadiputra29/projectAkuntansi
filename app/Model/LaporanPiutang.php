<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LaporanPiutang extends Model
{
    protected $table = 'laporan_piutangs';
    protected $fillable = ['customers_id', 'saldo_piutangs_id', 'salesjournal_id', 'retur_penjualan_id', 'cash_bank_ins_id', 'debet', 'kredit'];

    public function data_customers()
    {
        return $this->belongsTo(DataCustomer::class, "customers_id");
    }
    public function saldo_piutangs()
    {
        return $this->belongsTo(SaldoItem::class, 'saldo_piutangs_id');
    }
    public function Sales_Journal()
    {
    	return $this->belongsTo(SalesJournal::class, "salesjournal_id");
    }
    public function ReturPenjualan()
    {
        return $this->belongsTo(ReturPenjualan::class, "retur_penjualan_id");
    }
    public function CashBankIn()
    {
        return $this->belongsTo(CashBankIn::class, "cash_bank_ins_id");
    }
}
