<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PettycashDetail;
use App\Model\Account;

class PettyCashBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $account      = Account::all();
        $pc_detail    = PettycashDetail::all();
        $sum_debet    = PettycashDetail::sum('debet');
        $sum_kredit   = PettycashDetail::sum('kredit');
        $distinct_pc  = PettycashDetail::distinct('nomor_akun')->select('nomor_akun', 'nama_akun')->get();

        return view('reports.petty_cash_book.index', compact('pc_detail','sum_debet','sum_kredit','distinct_pc'));
    }
}
