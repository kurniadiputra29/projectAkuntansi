<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DataCustomer extends Model
{
    protected $table = 'data_customers';

    protected $fillable = [
      'id', 'kode', 'nama', 'npwp', 'alamat', 'telepon', 'termin', 'created_at', 'update_at'
    ];

    public function saldo_piutang()
    {
      return $this->hasMany(SaldoPiutang::class);
    }
}
