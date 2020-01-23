<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\LaporanBukuBesarPenyesuaian;
use App\Model\Account;
use Illuminate\Support\Facades\DB;

class LabaRugiController extends Controller
{
    public function index()
    {
        $saless = Account::where('nomor', 'like', '4-%')->get();
        $costs = Account::where('nomor', 'like', '5-%')->get();
        $expenses = Account::where('nomor', 'like', '6-%')->get();
        $other_revenues = Account::where('nomor', 'like', '8-%')->get();
        $other_expenses = Account::where('nomor', 'like', '9-%')->get();
        $distinct_laporan_penyesuaian = LaporanBukuBesarPenyesuaian::distinct('account_id', 'nomor_akun')->select('debet', 'kredit', 'account_id', 'nomor_akun', 'id')->get();

        return view('reports.laba_rugi.index', compact('saless','costs','expenses','other_revenues','other_expenses', 'distinct_laporan_penyesuaian'));
    }
}
