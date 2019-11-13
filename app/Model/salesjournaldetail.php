<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class salesjournaldetail extends Model
{
    protected $table = 'salesjournaldetail';
    protected $fillable = ['salesjournal_id', 'nomor_akun', 'nama_akun' ,'debet', 'kredit'];
    public function seles_journals()
    {
    	return $this->belongsTo(SelesJournal::class);
    }
    public function account()
    {
    	return $this->belongsTo(Account::class);
    }
    public function items()
    {
        return $this->belongsTo(Item::class);
    }
}
