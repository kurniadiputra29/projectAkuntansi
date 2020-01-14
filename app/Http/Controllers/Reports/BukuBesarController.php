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
use App\Model\jurnalumumdetail;
use App\Model\PettycashDetail;
use App\Model\purchasejournaldetail;
use App\Model\salesjournaldetail;
use App\Model\ReturPembelianDetail;
use App\Model\ReturPenjualanDetail;
use App\Model\LaporanBukuBesar;

class BukuBesarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $saldo_awals = SaldoAwal::all();
        $accounts = Account::all();
        $cbi_details = CashBankInDetails::all();
        $cbo_details = CashBankOutDetails::all();
        $cpj_details = cpjdetail::all();
        $crj_details = crjdetail::all();
        $pj_details = purchasejournaldetail::all();
        $sj_details = salesjournaldetail::all();
        $rpb_details = ReturPembelianDetail::all();
        $rpj_details = ReturPenjualanDetail::all();
        $ju_details = jurnalumumdetail::all();
        $pc_details = PettycashDetail::all();
        $LaporanBukuBesars = LaporanBukuBesar::all();
        $distinct_laporan = LaporanBukuBesar::distinct('account_id')->select('debet', 'kredit', 'account_id', 'nomor_akun')->get();

        // return response()->json($pc_details);

        return view('reports.buku_besar.index', compact('saldo_awals', 'accounts', 'cbi_details', 'cbo_details', 'cpj_details', 'crj_details', 'jp_detail', 'ju_details', 'pc_details', 'pj_details', 'sj_details', 'rpb_details', 'rpj_details', 'distinct_laporan', 'LaporanBukuBesars'));
    }
}
