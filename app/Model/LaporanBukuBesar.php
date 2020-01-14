<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LaporanBukuBesar extends Model
{
    protected $table = 'laporan_buku_besars';
    protected $fillable = ['account_id', 'saldo_awals_id', 'cpj_id', 'crj_id', 'purchasejournal_id', 'salesjournal_id', 'retur_penjualan_id', 'retur_pembelian_id','cash_bank_ins_id', 'cash_bank_outs_id' ,'jurnal_umums_id', 'pettycash_id', 'debet', 'kredit'];
    public function account()
    {
      return $this->belongsTo(Account::class);
    }
    public function SaldoAwal()
    {
      return $this->belongsTo(SaldoAwal::class, "saldo_awals_id");
    }
    public function purchase_journals()
    {
    	return $this->belongsTo(PurchaseJournal::class, "purchasejournal_id");
    }
    public function Sales_Journal()
    {
    	return $this->belongsTo(SalesJournal::class, "salesjournal_id");
    }
    public function crj()
    {
    	return $this->belongsTo(crj::class, "crj_id");
    }
    public function cpj()
    {
    	return $this->belongsTo(cpj::class, "cpj_id");
    }
    public function ReturPenjualan()
    {
        return $this->belongsTo(ReturPenjualan::class, "retur_penjualan_id");
    }
    public function ReturPembelian()
    {
        return $this->belongsTo(ReturPembelian::class, "retur_pembelian_id");
    }
    public function CashBankIn()
    {
    	return $this->belongsTo(CashBankIn::class, "cash_bank_ins_id");
    }
    public function CashBankOut()
    {
    	return $this->belongsTo(CashBankOut::class, "cash_bank_outs_id");
    }
    public function jurnal_umums()
    {
    	return $this->belongsTo(JurnalUmum::class, "jurnal_umums_id");
    }
    public function pettycash()
    {
      return $this->belongsTo(Pettycash::class, "pettycash_id");
    }
}
