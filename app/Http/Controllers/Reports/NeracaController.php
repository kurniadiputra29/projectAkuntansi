<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Account;
use App\Model\SaldoAwal;
use App\Model\LaporanBukuBesarPenyesuaian;
use Illuminate\Support\Facades\DB;
use PDF;

class NeracaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $saldo_awals     = SaldoAwal::all();
        $accounts        = Account::all();
        $assets = Account::where('nomor', 'like', '1-%')->get();
        $liabilities = Account::where('nomor', 'like', '2-%')->get();
        $equities = Account::where('nomor', 'like', '3-%')->get();
        $distinct_laporan_penyesuaian = LaporanBukuBesarPenyesuaian::distinct('account_id', 'nomor_akun')->select('debet', 'kredit', 'account_id', 'nomor_akun', 'id')->get();


        $asset          = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '1-%')->get();
        $liability      = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '2-%')->get();
        $equity         = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '3-%')->get();

        $sum_debet_asset  = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '1-%')->sum('debet');
        $sum_kredit_asset = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '1-%')->sum('kredit');

        $sum_debet_liability  = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '2-%')->sum('debet');
        $sum_kredit_liability = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '2-%')->sum('kredit');

        $sum_debet_equity  = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '3-%')->sum('debet');
        $sum_kredit_equity = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '3-%')->sum('kredit');
        // dd($liability);

        return view('reports.neraca.index', compact('asset','liability','equity','sum_debet_asset','sum_kredit_asset','sum_debet_liability','sum_kredit_liability','sum_debet_equity','sum_kredit_equity', 'accounts', 'distinct_laporan_penyesuaian', 'assets', 'liabilities', 'equities'));
    }

    public function print()
    {
        $saldo_awal     = SaldoAwal::all();
        $account        = Account::all();
        $asset          = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '1-%')->get();
        $liability      = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '2-%')->get();
        $equity         = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '3-%')->get();

        $sum_debet_asset  = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '1-%')->sum('debet');
        $sum_kredit_asset = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '1-%')->sum('kredit');

        $sum_debet_liability  = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '2-%')->sum('debet');
        $sum_kredit_liability = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '2-%')->sum('kredit');

        $sum_debet_equity  = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '3-%')->sum('debet');
        $sum_kredit_equity = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '3-%')->sum('kredit');

        $pdf = PDF::loadview('reports.neraca.print', compact('asset','liability','equity','sum_debet_asset','sum_kredit_asset','sum_debet_liability','sum_kredit_liability','sum_debet_equity','sum_kredit_equity'));
        return $pdf->setPaper('a4', 'potrait')->stream('laporan_neraca.pdf');
    }
}
