<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DataSupplier extends Model
{
    protected $table = 'data_suppliers';

    protected $fillable = [
      'id', 'kode', 'nama', 'npwp', 'alamat', 'termin', 'created_at', 'update_at'
    ];

    public function saldo_hutang()
    {
      return $this->hasMany(SaldoHutang::class);
    }
    public function cashinbank()
    {
      return $this->hasMany(Cashinbank::class, "suppliers_id");
    }
}
