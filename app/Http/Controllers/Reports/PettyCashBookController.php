<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PettycashDetail;
use App\Model\Account;
use Carbon\Carbon;

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

    public function filter(Request $request)
    {
        $tanggal_mulai  = $request->tanggal_mulai;
        $tanggal_akhir  = $request->tanggal_akhir;
        $sub_day        = $tanggal_mulai->subDay();
        $add_day        = $tanggal_akhir->addDay();

        $account        = Account::all();
        $pc_detail      = PettycashDetail::whereBetween('created_at', [$sub_day,$add_day])->get();
        $sum_debet      = PettycashDetail::whereDate('created_at', $tanggal_akhir)->sum('debet');
        $sum_kredit     = PettycashDetail::whereDate('created_at', $tanggal_akhir)->sum('kredit');
        $distinct_pc    = PettycashDetail::distinct('nomor_akun')->select('nomor_akun', 'nama_akun')->whereDate('created_at', $tanggal_akhir)->get();

        dd($one_day);

        return view('reports.petty_cash_book.filter', compact('pc_detail','sum_debet','sum_kredit','distinct_pc'));
    }
}
