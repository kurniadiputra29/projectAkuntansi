<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Jurnalpenyesuaian extends Model
{
    protected $table = 'jurnalpenyesuaians';

    protected $fillable = [
      'id','tanggal','kode', 'description', 'created_at','update_at'
    ];
    public function jurnalpenyesuaiandetail()
    {
      return $this->hasMany(jurnalpenyesuaiandetail::class, "jurnalpenyesuaians_id");
    }
}
