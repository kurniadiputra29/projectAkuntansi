<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Model\Account;
use App\Model\SaldoAwal;
use App\Model\CashBankIn;
use App\Model\CashBankOut;
use App\Model\ReturPembelian;
use App\Model\ReturPenjualan;
use App\Model\PurchaseJournal;
use App\Model\SalesJournal;
use App\Model\cpj;
use App\Model\crj;
use App\Model\JurnalUmum;
use App\Model\Pettycash;

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

use Carbon\Carbon;

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
        $CashBankIns = CashBankIn::all();
        $cbi_details = CashBankInDetails::all();
        $CashBankOuts = CashBankOut::all();
        $cbo_details = CashBankOutDetails::all();
        $cpjs = cpj::all();
        $cpj_details = cpjdetail::all();
        $crjs = crj::all();
        $crj_details = crjdetail::all();
        $PurchaseJournals = PurchaseJournal::all();
        $pj_details = purchasejournaldetail::all();
        $SalesJournals = SalesJournal::all();
        $sj_details = salesjournaldetail::all();
        $ReturPembelians = ReturPembelian::all();
        $rpb_details = ReturPembelianDetail::all();
        $ReturPenjualans = ReturPenjualan::all();
        $rpj_details = ReturPenjualanDetail::all();
        $JurnalUmums = JurnalUmum::all();
        $ju_details = jurnalumumdetail::all();
        $Pettycashs = Pettycash::all();
        $pc_details = PettycashDetail::all();        
        $LaporanBukuBesars = LaporanBukuBesar::all();
        $distinct_laporan = LaporanBukuBesar::distinct('account_id')->select('debet', 'kredit', 'account_id', 'nomor_akun')->get();

        // return response()->json($pc_details);

        return view('reports.buku_besar.index', compact('saldo_awals', 'accounts', 'CashBankIns', 'cbi_details', 'CashBankOuts', 'cbo_details', 'cpjs', 'cpj_details', 'crjs', 'crj_details', 'PurchaseJournals', 'pj_details', 'SalesJournals', 'sj_details', 'ReturPembelians', 'rpb_details', 'ReturPenjualans', 'rpj_details', 'JurnalUmums', 'ju_details', 'Pettycashs', 'pc_details', 'LaporanBukuBesars', 'distinct_laporan'));
    }

    public function filter(Request $request)
    {
        $tanggal_mulai  = $request->tanggal_mulai;
        $tanggal_akhir  = $request->tanggal_akhir;
        $add_day        = Carbon::parse($tanggal_akhir);
        $saldo_awals = SaldoAwal::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $accounts = Account::all();
        $CashBankIns = CashBankIn::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $cbi_details = CashBankInDetails::all();
        $CashBankOuts = CashBankOut::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $cbo_details = CashBankOutDetails::all();
        $cpjs = cpj::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $cpj_details = cpjdetail::all();
        $crjs = crj::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $crj_details = crjdetail::all();
        $PurchaseJournals = PurchaseJournal::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $pj_details = purchasejournaldetail::all();
        $SalesJournals = SalesJournal::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $sj_details = salesjournaldetail::all();
        $ReturPembelians = ReturPembelian::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $rpb_details = ReturPembelianDetail::all();
        $ReturPenjualans = ReturPenjualan::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $rpj_details = ReturPenjualanDetail::all();
        $JurnalUmums = JurnalUmum::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $ju_details = jurnalumumdetail::all();
        $Pettycashs = Pettycash::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $pc_details = PettycashDetail::all();        
        $LaporanBukuBesars = LaporanBukuBesar::all();
        $distinct_laporan = LaporanBukuBesar::distinct('account_id')->select('debet', 'kredit', 'account_id', 'nomor_akun')->whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();

        return view('reports.buku_besar.filter', compact('saldo_awals', 'accounts', 'CashBankIns', 'cbi_details', 'CashBankOuts', 'cbo_details', 'cpjs', 'cpj_details', 'crjs', 'crj_details', 'PurchaseJournals', 'pj_details', 'SalesJournals', 'sj_details', 'ReturPembelians', 'rpb_details', 'ReturPenjualans', 'rpj_details', 'JurnalUmums', 'ju_details', 'Pettycashs', 'pc_details', 'LaporanBukuBesars', 'distinct_laporan', 'tanggal_mulai', 'tanggal_akhir', 'add_day'));
    }

    public function print(Request $request)
    {
        $tanggal_mulai  = $request->tanggal_mulai;
        $tanggal_akhir  = $request->tanggal_akhir;
        $add_day        = Carbon::parse($tanggal_akhir);
        $saldo_awals = SaldoAwal::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $accounts = Account::all();
        $CashBankIns = CashBankIn::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $cbi_details = CashBankInDetails::all();
        $CashBankOuts = CashBankOut::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $cbo_details = CashBankOutDetails::all();
        $cpjs = cpj::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $cpj_details = cpjdetail::all();
        $crjs = crj::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $crj_details = crjdetail::all();
        $PurchaseJournals = PurchaseJournal::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $pj_details = purchasejournaldetail::all();
        $SalesJournals = SalesJournal::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $sj_details = salesjournaldetail::all();
        $ReturPembelians = ReturPembelian::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $rpb_details = ReturPembelianDetail::all();
        $ReturPenjualans = ReturPenjualan::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $rpj_details = ReturPenjualanDetail::all();
        $JurnalUmums = JurnalUmum::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $ju_details = jurnalumumdetail::all();
        $Pettycashs = Pettycash::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $pc_details = PettycashDetail::all();        
        $LaporanBukuBesars = LaporanBukuBesar::all();
        $distinct_laporan = LaporanBukuBesar::distinct('account_id')->select('debet', 'kredit', 'account_id', 'nomor_akun')->whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();

        $pdf = PDF::loadview('reports.buku_besar.print', compact('saldo_awals', 'accounts', 'CashBankIns', 'cbi_details', 'CashBankOuts', 'cbo_details', 'cpjs', 'cpj_details', 'crjs', 'crj_details', 'PurchaseJournals', 'pj_details', 'SalesJournals', 'sj_details', 'ReturPembelians', 'rpb_details', 'ReturPenjualans', 'rpj_details', 'JurnalUmums', 'ju_details', 'Pettycashs', 'pc_details', 'LaporanBukuBesars', 'distinct_laporan', 'tanggal_mulai', 'tanggal_akhir', 'add_day'));
        return $pdf->setPaper('a4', 'landscape')->stream("laporan_buku_besar.pdf");
    }

    public function printFilter(Request $request)
    {
        $tanggal_mulai  = $request->tanggal_mulai;
        $tanggal_akhir  = $request->tanggal_akhir;
        $add_day        = Carbon::parse($tanggal_akhir);
        $saldo_awals = SaldoAwal::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $accounts = Account::all();
        $CashBankIns = CashBankIn::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $cbi_details = CashBankInDetails::all();
        $CashBankOuts = CashBankOut::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $cbo_details = CashBankOutDetails::all();
        $cpjs = cpj::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $cpj_details = cpjdetail::all();
        $crjs = crj::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $crj_details = crjdetail::all();
        $PurchaseJournals = PurchaseJournal::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $pj_details = purchasejournaldetail::all();
        $SalesJournals = SalesJournal::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $sj_details = salesjournaldetail::all();
        $ReturPembelians = ReturPembelian::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $rpb_details = ReturPembelianDetail::all();
        $ReturPenjualans = ReturPenjualan::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $rpj_details = ReturPenjualanDetail::all();
        $JurnalUmums = JurnalUmum::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $ju_details = jurnalumumdetail::all();
        $Pettycashs = Pettycash::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $pc_details = PettycashDetail::all();        
        $LaporanBukuBesars = LaporanBukuBesar::all();
        $distinct_laporan = LaporanBukuBesar::distinct('account_id')->select('debet', 'kredit', 'account_id', 'nomor_akun')->whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();

        $pdf = PDF::loadview('reports.buku_besar.print', compact('saldo_awals', 'accounts', 'CashBankIns', 'cbi_details', 'CashBankOuts', 'cbo_details', 'cpjs', 'cpj_details', 'crjs', 'crj_details', 'PurchaseJournals', 'pj_details', 'SalesJournals', 'sj_details', 'ReturPembelians', 'rpb_details', 'ReturPenjualans', 'rpj_details', 'JurnalUmums', 'ju_details', 'Pettycashs', 'pc_details', 'LaporanBukuBesars', 'distinct_laporan', 'tanggal_mulai', 'tanggal_akhir', 'add_day'));
        return $pdf->setPaper('a4', 'landscape')->stream('laporan_buku_besar.pdf');
    }

}
