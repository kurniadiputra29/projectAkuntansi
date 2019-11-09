<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cashinbank extends Model
{
    protected $table = 'cashinbanks';

    protected $fillable = [
      'id','tanggal','kode','penerima_diterima', 'description','status', 'created_at','update_at'
    ];
    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
