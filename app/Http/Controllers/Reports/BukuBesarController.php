<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Model\Account;
use App\Model\SaldoAwal;
use App\Model\cpj;
use App\Model\cpjdetail;
use App\Model\crj;
use App\Model\crjdetail;
use App\Model\Jurnalpenyesuaian;
use App\Model\jurnalpenyesuaiandetail;
use App\Model\JurnalUmum;
use App\Model\jurnalumumdetail;
use App\Model\PettyCash;
use App\Model\PettycashDetail;
use App\Model\PurchaseJournal;
use App\Model\purchasejournaldetail;
use App\Model\ReturPembelian;
use App\Model\ReturPembelianDetail;
use App\Model\ReturPenjualan;
use App\Model\ReturPenjualanDetail;
use App\Model\SalesJournal;
use App\Model\salesjournaldetail;

class BukuBesarController extends Controller
{
    public function index()
    {
        $saldo_awal = SaldoAwal::all();
        return view('reports.buku_besar.index', compact('saldo_awal'));
    }
}
