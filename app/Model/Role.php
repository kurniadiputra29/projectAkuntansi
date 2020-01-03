<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
      'nama', 'created_at', 'updated_at'
    ];

    public function user()
    {
      return $this->hasMany(User::class);
    }
}
