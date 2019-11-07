<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cashinbank extends Model
{
    protected $table = 'cashinbanks';

    protected $fillable = [
      'id','tanggal','kode','discription','nomor_akun', 'debet', 'credit', 'created_at','update_at'
    ];
}
