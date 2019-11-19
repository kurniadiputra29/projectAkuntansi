<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class purchasejournaldetail extends Model
{
    protected $table = 'purchasejournaldetails';
    protected $fillable = ['purchasejournal_id', 'nomor_akun', 'nama_akun' ,'debet', 'kredit'];
    public function purchase_journals()
    {
    	return $this->belongsTo(PurchaseJournal::class);
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
