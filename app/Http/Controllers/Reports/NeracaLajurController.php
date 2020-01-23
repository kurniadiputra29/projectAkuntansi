<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Account;
use App\Model\LaporanBukuBesar;
use App\Model\LaporanBukuBesarPenyesuaian;
use App\Model\jurnalpenyesuaiandetail;
use PDF;

class NeracaLajurController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $accounts = Account::all();
        $assets = Account::where('nomor', 'like', '1-%')->get();
        $liabilities = Account::where('nomor', 'like', '2-%')->get();
        $equities = Account::where('nomor', 'like', '3-%')->get();
        $saless = Account::where('nomor', 'like', '4-%')->get();
        $costs = Account::where('nomor', 'like', '5-%')->get();
        $expenses = Account::where('nomor', 'like', '6-%')->get();
        $other_revenues = Account::where('nomor', 'like', '8-%')->get();
        $other_expenses = Account::where('nomor', 'like', '9-%')->get();
        $distinct_laporan = LaporanBukuBesar::distinct('account_id', 'nomor_akun')->select('debet', 'kredit', 'account_id', 'nomor_akun', 'id')->get();
        $distinct_laporan_penyesuaian = LaporanBukuBesarPenyesuaian::distinct('account_id', 'nomor_akun')->select('debet', 'kredit', 'account_id', 'nomor_akun', 'id')->get();
        $jurnalpenyesuaiandetails = jurnalpenyesuaiandetail::distinct('nomor_akun')->select('debet', 'kredit', 'nomor_akun')->get();

        return view('reports.neraca_lajur.index', compact('accounts', 'assets', 'liabilities', 'equities', 'saless', 'costs', 'expenses', 'other_revenues', 'other_expenses', 'distinct_laporan', 'distinct_laporan_penyesuaian', 'jurnalpenyesuaiandetails'));
    }

		public function print()
    {
				$accounts = Account::all();
				$assets = Account::where('nomor', 'like', '1-%')->get();
				$liabilities = Account::where('nomor', 'like', '2-%')->get();
				$equities = Account::where('nomor', 'like', '3-%')->get();
				$saless = Account::where('nomor', 'like', '4-%')->get();
				$costs = Account::where('nomor', 'like', '5-%')->get();
				$expenses = Account::where('nomor', 'like', '6-%')->get();
				$other_revenues = Account::where('nomor', 'like', '8-%')->get();
				$other_expenses = Account::where('nomor', 'like', '9-%')->get();
				$distinct_laporan = LaporanBukuBesar::distinct('account_id', 'nomor_akun')->select('debet', 'kredit', 'account_id', 'nomor_akun', 'id')->get();
				$distinct_laporan_penyesuaian = LaporanBukuBesarPenyesuaian::distinct('account_id', 'nomor_akun')->select('debet', 'kredit', 'account_id', 'nomor_akun', 'id')->get();
				$jurnalpenyesuaiandetails = jurnalpenyesuaiandetail::distinct('nomor_akun')->select('debet', 'kredit', 'nomor_akun')->get();

        $pdf = PDF::loadview('reports.neraca_lajur.print', compact('accounts', 'assets', 'liabilities', 'equities', 'saless', 'costs', 'expenses', 'other_revenues', 'other_expenses', 'distinct_laporan', 'distinct_laporan_penyesuaian', 'jurnalpenyesuaiandetails'));
        return $pdf->setPaper('a4', 'landscape')->stream('laporan_neraca_lajur.pdf');
    }
}
