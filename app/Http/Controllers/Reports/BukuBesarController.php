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

    public function filter(Request $request)
    {
        $tanggal_mulai  = $request->tanggal_mulai;
        $tanggal_akhir  = $request->tanggal_akhir;
        $add_day        = Carbon::parse($tanggal_akhir)->addDay();

        $saldo_awals = SaldoAwal::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $accounts = Account::all();
        $cbi_details = CashBankInDetails::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $cbo_details = CashBankOutDetails::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $cpj_details = cpjdetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $crj_details = crjdetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $pj_details = purchasejournaldetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $sj_details = salesjournaldetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $rpb_details = ReturPembelianDetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $rpj_details = ReturPenjualanDetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $ju_details = jurnalumumdetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $pc_details = PettycashDetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $LaporanBukuBesars = LaporanBukuBesar::all();
        $distinct_laporan = LaporanBukuBesar::distinct('account_id')->select('debet', 'kredit', 'account_id', 'nomor_akun')->whereBetween('created_at', [$tanggal_mulai,$add_day])->get();

        return view('reports.buku_besar.filter', compact('saldo_awals', 'accounts', 'cbi_details', 'cbo_details', 'cpj_details', 'crj_details', 'jp_detail', 'ju_details', 'pc_details', 'pj_details', 'sj_details', 'rpb_details', 'rpj_details', 'distinct_laporan', 'LaporanBukuBesars','tanggal_mulai','tanggal_akhir','add_day'));
    }

    public function print(Request $request)
    {
        $tanggal_mulai  = $request->tanggal_mulai;
        $tanggal_akhir  = $request->tanggal_akhir;
        $add_day        = Carbon::parse($tanggal_akhir)->addDay();

        $saldo_awals = SaldoAwal::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $accounts = Account::all();
        $cbi_details = CashBankInDetails::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $cbo_details = CashBankOutDetails::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $cpj_details = cpjdetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $crj_details = crjdetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $pj_details = purchasejournaldetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $sj_details = salesjournaldetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $rpb_details = ReturPembelianDetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $rpj_details = ReturPenjualanDetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $ju_details = jurnalumumdetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $pc_details = PettycashDetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $LaporanBukuBesars = LaporanBukuBesar::all();
        $distinct_laporan = LaporanBukuBesar::distinct('account_id')->select('debet', 'kredit', 'account_id', 'nomor_akun')->whereBetween('created_at', [$tanggal_mulai,$add_day])->get();

        $pdf = PDF::loadview('reports.buku_besar.print', compact('saldo_awals', 'accounts', 'cbi_details', 'cbo_details', 'cpj_details', 'crj_details', 'jp_detail', 'ju_details', 'pc_details', 'pj_details', 'sj_details', 'rpb_details', 'rpj_details', 'distinct_laporan', 'LaporanBukuBesars','tanggal_mulai','tanggal_akhir','add_day'));
        return $pdf->setPaper('a4', 'landscape')->stream("laporan_buku_besar.pdf");
    }

    public function printFilter(Request $request)
    {
        $tanggal_mulai  = $request->tanggal_mulai;
        $tanggal_akhir  = $request->tanggal_akhir;
        $add_day        = Carbon::parse($tanggal_akhir)->addDay();
        $saldo_awals = SaldoAwal::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $accounts = Account::all();
        $cbi_details = CashBankInDetails::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $cbo_details = CashBankOutDetails::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $cpj_details = cpjdetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $crj_details = crjdetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $pj_details = purchasejournaldetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $sj_details = salesjournaldetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $rpb_details = ReturPembelianDetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $rpj_details = ReturPenjualanDetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $ju_details = jurnalumumdetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $pc_details = PettycashDetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $LaporanBukuBesars = LaporanBukuBesar::all();
        $distinct_laporan = LaporanBukuBesar::distinct('account_id')->select('debet', 'kredit', 'account_id', 'nomor_akun')->whereBetween('created_at', [$tanggal_mulai,$add_day])->get();

        $pdf = PDF::loadview('reports.buku_besar.print', compact('saldo_awals', 'accounts', 'cbi_details', 'cbo_details', 'cpj_details', 'crj_details', 'jp_detail', 'ju_details', 'pc_details', 'pj_details', 'sj_details', 'rpb_details', 'rpj_details', 'distinct_laporan', 'LaporanBukuBesars','tanggal_mulai','tanggal_akhir','add_day'));
        return $pdf->setPaper('a4', 'landscape')->stream('laporan_buku_besar.pdf');
    }

}
