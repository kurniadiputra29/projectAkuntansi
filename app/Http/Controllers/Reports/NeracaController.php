<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Account;
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
        $assets = Account::where('nomor', 'like', '1-%')->get();
        $liabilities = Account::where('nomor', 'like', '2-%')->get();
        $equities = Account::where('nomor', 'like', '3-%')->get();
        $distinct_laporan_penyesuaian = LaporanBukuBesarPenyesuaian::distinct('account_id', 'nomor_akun')->select('debet', 'kredit', 'account_id', 'nomor_akun', 'id')->get();


        return view('reports.neraca.index', compact( 'distinct_laporan_penyesuaian', 'assets', 'liabilities', 'equities'));
    }

    public function print()
    {
        $assets = Account::where('nomor', 'like', '1-%')->get();
        $liabilities = Account::where('nomor', 'like', '2-%')->get();
        $equities = Account::where('nomor', 'like', '3-%')->get();
        $distinct_laporan_penyesuaian = LaporanBukuBesarPenyesuaian::distinct('account_id', 'nomor_akun')->select('debet', 'kredit', 'account_id', 'nomor_akun', 'id')->get();

        $pdf = PDF::loadview('reports.neraca.print', compact('distinct_laporan_penyesuaian', 'assets', 'liabilities', 'equities'));
        return $pdf->setPaper('a4', 'potrait')->stream('laporan_neraca.pdf');
    }
}
