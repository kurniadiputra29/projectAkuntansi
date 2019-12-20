<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Model\Account;
use App\Model\SaldoAwal;
use App\Model\CashBankInDetails;
use App\Model\CashBankOutDetails;
use App\Model\cpjdetail;
use App\Model\crjdetail;
use App\Model\jurnalpenyesuaiandetail;
use App\Model\jurnalumumdetail;
use App\Model\PettycashDetail;
use App\Model\purchasejournaldetail;
use App\Model\salesjournaldetail;
use App\Model\ReturPembelianDetail;
use App\Model\ReturPenjualanDetail;

class BukuBesarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $saldo_awal   = SaldoAwal::all();
        $account      = Account::all();
        $cbi_detail   = CashBankInDetails::all();
        $cbo_detail   = CashBankOutDetails::all();
        $cpj_detail   = cpjdetail::all();
        $crj_detail   = crjdetail::all();
        $jp_detail    = jurnalpenyesuaiandetail::all();
        $ju_detail    = jurnalumumdetail::all();
        $pc_detail    = PettycashDetail::all();
        $pj_detail    = purchasejournaldetail::all();
        $sj_detail    = salesjournaldetail::all();
        $rpb_detail   = ReturPembelianDetail::all();
        $rpj_detail   = ReturPenjualanDetail::all();

        return view('reports.buku_besar.index', compact('saldo_awal', 'account', 'cbi_detail', 'cbo_detail', 'cpj_detail', 'crj_detail', 'jp_detail', 'ju_detail', 'pc_detail', 'pj_detail', 'sj_detail', 'rpb_detail', 'rpj_detail'));
    }
}
