<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\LaporanBukuBesarPenyesuaian;
use App\Model\Account;
use App\Model\SaldoAwal;
use Illuminate\Support\Facades\DB;
use PDF;

class RetainedEarningController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts        = Account::all();
        $assets = Account::where('nomor', 'like', '1-%')->get();
        $liabilities = Account::where('nomor', 'like', '2-%')->get();
        $equities = Account::where('nomor', 'like', '3-%')->get();
        $retained_earnings = Account::where('nomor', '3-1200')->get();
        $distinct_laporan_penyesuaian = LaporanBukuBesarPenyesuaian::distinct('account_id', 'nomor_akun')->select('debet', 'kredit', 'account_id', 'nomor_akun', 'id')->get();

        return view('reports.retained_earning.index', compact('accounts','assets','liabilities','equities', 'retained_earnings', 'distinct_laporan_penyesuaian'));
    }

    public function print()
    {
        $accounts = Account::all();
        $assets = Account::where('nomor', 'like', '1-%')->get();
        $liabilities = Account::where('nomor', 'like', '2-%')->get();
        $equities = Account::where('nomor', 'like', '3-%')->get();
        $retained_earnings = Account::where('nomor', '3-1200')->get();
        $distinct_laporan_penyesuaian = LaporanBukuBesarPenyesuaian::distinct('account_id', 'nomor_akun')->select('debet', 'kredit', 'account_id', 'nomor_akun', 'id')->get();

        $pdf = PDF::loadview('reports.retained_earning.print', compact('accounts','assets','liabilities','equities', 'retained_earnings', 'distinct_laporan_penyesuaian'));
        return $pdf->setPaper('a4', 'potrait')->stream('retained_earning.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
