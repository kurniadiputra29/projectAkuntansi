<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabaRugiController extends Controller
{
    public function index()
    {
        $sales            = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '4-%')->get();
        $costs            = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '5-%')->get();
        $expenses         = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '6-%')->get();
        $other_revenues   = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '8-%')->get();
        $other_expenses   = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->where('nomor', 'like', '9-%')->get();

        $debet_total      = $sales->sum('debet')+$costs->sum('debet')+$expenses->sum('debet')+$other_revenues->sum('debet')+$other_expenses->sum('debet');
        $kredit_total     = $sales->sum('kredit')+$costs->sum('kredit')+$expenses->sum('kredit')+$other_revenues->sum('kredit')+$other_expenses->sum('kredit');

        return view('reports.laba_rugi.index', compact('sales','costs','expenses','other_revenues','other_expenses','debet_total','kredit_total'));
    }
}
