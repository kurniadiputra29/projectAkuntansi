<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PettycashDetail;

class PettyCashBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pc_detail    = PettycashDetail::all();
        $sum_debet    = PettycashDetail::sum('debet');
        $sum_kredit   = PettycashDetail::sum('kredit');
        $debet        = PettycashDetail::get('debet');
        // $dfs = PettycashDetail::where('nomor_akun', '1-1120')->sum('kredit');
        // $fds = $pc_detail->where('nomor_akun', '1-1120')->sum('kredit');
        // dd($fds);
        return view('reports.petty_cash_book.index', compact('pc_detail','sum_debet','sum_kredit','debet'));
    }
}
