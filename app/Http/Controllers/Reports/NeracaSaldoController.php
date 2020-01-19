<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Account;
use App\Model\SaldoAwal;
use App\Model\LaporanBukuBesar;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;

class NeracaSaldoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $saldo_awals = SaldoAwal::all();
        $accounts = Account::all();
        $distinct_laporan = LaporanBukuBesar::distinct('account_id', 'nomor_akun')->select('debet', 'kredit', 'account_id', 'nomor_akun', 'id')->get();

        return view('reports.neraca_saldo.index', compact('saldo_awals', 'accounts', 'distinct_laporan'));
    }

    public function print()
    {
        $saldo_awals = SaldoAwal::all();
        $accounts = Account::all();
        $distinct_laporan = LaporanBukuBesar::distinct('account_id', 'nomor_akun')->select('debet', 'kredit', 'account_id', 'nomor_akun', 'id')->get();

        $pdf = PDF::loadview('reports.neraca_saldo.print', compact('saldo_awals', 'accounts', 'distinct_laporan'));
        return $pdf->setPaper('a4', 'potrait')->stream('laporan_neraca_saldo.pdf');
    }
}
