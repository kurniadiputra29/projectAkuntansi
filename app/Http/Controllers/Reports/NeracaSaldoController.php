<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NeracaSaldoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $neraca_saldo         = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->get();
        $debet_neraca_saldo   = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->sum('debet');
        $kredit_neraca_saldo  = DB::table('accounts')->join('saldo_awals', 'accounts.id', '=', 'saldo_awals.account_id')->sum('kredit');

        return view('reports.neraca_saldo.index', compact('neraca_saldo','debet_neraca_saldo','kredit_neraca_saldo'));
    }
}
