<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JurnalUmum extends Model
{
    protected $table = 'jurnal_umums';

    protected $fillable = [
      'id','tanggal','kode', 'description', 'created_at','update_at'
    ];
    public function jurnalumumdetail()
    {
      return $this->hasMany(jurnalumumdetail::class, "jurnal_umums_id");
    }
}
