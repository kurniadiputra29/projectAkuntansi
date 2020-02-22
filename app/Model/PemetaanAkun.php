<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PemetaanAkun extends Model
{
    protected $table = 'pemetaan_akuns';
    protected $fillable = ['id', 'inventory', 'penjualan_cash', 'penjualan_credit', 'hpp_penjualan_cash', 'hpp_penjualan_credit', 'ppn_penjualan', 'ppn_pembelian', 'pengiriman_penjualan', 'pengiriman_pembelian', 'diskon_penjualan', 'diskon_pembelian', 'cash', 'hutang', 'piutang', 'kas_kecil'];

    public function inventories()
    {
      return $this->belongsTo(Account::class, "inventory");
    }
    public function penjualan_cashs()
    {
      return $this->belongsTo(Account::class, "penjualan_cash");
    }
    public function penjualan_credits()
    {
      return $this->belongsTo(Account::class, "penjualan_credit");
    }
    public function hpp_penjualan_cashs()
    {
      return $this->belongsTo(Account::class, "hpp_penjualan_cash");
    }
    public function hpp_penjualan_credits()
    {
      return $this->belongsTo(Account::class, "hpp_penjualan_credit");
    }
    public function ppn_penjualans()
    {
      return $this->belongsTo(Account::class, "ppn_penjualan");
    }
    public function ppn_pembelians()
    {
      return $this->belongsTo(Account::class, "ppn_pembelian");
    }
    public function pengiriman_penjualans()
    {
      return $this->belongsTo(Account::class, "pengiriman_penjualan");
    }
    public function pengiriman_pembelians()
    {
      return $this->belongsTo(Account::class, "pengiriman_pembelian");
    }
    public function diskon_penjualans()
    {
      return $this->belongsTo(Account::class, "diskon_penjualan");
    }
    public function diskon_pembelians()
    {
      return $this->belongsTo(Account::class, "diskon_pembelian");
    }
    public function cashs()
    {
      return $this->belongsTo(Account::class, "cash");
    }
    public function hutangs()
    {
      return $this->belongsTo(Account::class, "hutang");
    }
    public function piutangs()
    {
      return $this->belongsTo(Account::class, "piutang");
    }
    public function kas_kecils()
    {
      return $this->belongsTo(Account::class, "kas_kecil");
    }
}
