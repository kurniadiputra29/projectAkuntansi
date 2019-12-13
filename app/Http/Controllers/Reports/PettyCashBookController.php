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
        $add_day        = Carbon::parse($tanggal_akhir)->addDay();

        $account        = Account::all();
        $pc_detail      = PettycashDetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $sum_debet      = PettycashDetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->sum('debet');
        $sum_kredit     = PettycashDetail::whereBetween('created_at', [$tanggal_mulai,$add_day])->sum('kredit');
        $distinct_pc    = PettycashDetail::distinct('nomor_akun')->select('nomor_akun', 'nama_akun')->whereBetween('created_at', [$tanggal_mulai,$add_day])->get();

        return view('reports.petty_cash_book.filter', compact('pc_detail','sum_debet','sum_kredit','distinct_pc','tanggal_mulai','add_day'));
    }
}
