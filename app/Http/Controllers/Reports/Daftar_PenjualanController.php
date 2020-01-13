<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\crj;
use App\Model\crjdetail;
use App\Model\SalesJournal;
use App\Model\ReturPenjualan;
use App\Model\CashBankIn;
use App\Model\salesjournaldetail;
use App\Model\ReturPenjualanDetail;
use App\Model\CashBankInDetails;
use App\Model\LaporanPenjualan;
use Carbon\Carbon;
use PDF;

class Daftar_PenjualanController extends Controller
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
        $crjs                       = crj::all();
        $crjdetails                 = crjdetail::all();
        $SalesJournals              = SalesJournal::all();
        $ReturPenjualans            = ReturPenjualan::all();
        $CashBankIns                = CashBankIn::all();
        $salesjournaldetails        = salesjournaldetail::all();
        $ReturPenjualanDetails      = ReturPenjualanDetail::all();
        $CashBankInDetailss         = CashBankInDetails::all();
        $LaporanPenjualans         = LaporanPenjualan::all();

        return view('reports.daftar_penjualan.index', compact('crjs', 'SalesJournals', 'ReturPenjualans', 'CashBankIns', 'salesjournaldetails', 'ReturPenjualanDetails', 'CashBankInDetailss', 'crjdetails', 'LaporanPenjualans'));
    }

    /**
     * Show hasil filteran dari filter modal.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $tanggal_mulai  = $request->tanggal_mulai;
        $tanggal_akhir  = $request->tanggal_akhir;
        $add_day        = Carbon::parse($tanggal_akhir)->addDay();
        $crjs                       = crj::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $crjdetails                 = crjdetail::all();
        $SalesJournals              = SalesJournal::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $ReturPenjualans            = ReturPenjualan::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $CashBankIns                = CashBankIn::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $salesjournaldetails        = salesjournaldetail::all();
        $ReturPenjualanDetails      = ReturPenjualanDetail::all();
        $CashBankInDetailss         = CashBankInDetails::all();
        $LaporanPenjualans         = LaporanPenjualan::all();

        return view('reports.daftar_penjualan.filter', compact('crjs', 'SalesJournals', 'ReturPenjualans', 'CashBankIns', 'salesjournaldetails', 'ReturPenjualanDetails', 'CashBankInDetailss', 'crjdetails', 'LaporanPenjualans','tanggal_mulai','tanggal_akhir','add_day'));
    }

    public function printFilter(Request $request)
    {
        $tanggal_mulai  = $request->tanggal_mulai;
        $tanggal_akhir  = $request->tanggal_akhir;
        $add_day        = Carbon::parse($tanggal_akhir)->addDay();
        $crjs                       = crj::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $crjdetails                 = crjdetail::all();
        $SalesJournals              = SalesJournal::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $ReturPenjualans            = ReturPenjualan::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $CashBankIns                = CashBankIn::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $salesjournaldetails        = salesjournaldetail::all();
        $ReturPenjualanDetails      = ReturPenjualanDetail::all();
        $CashBankInDetailss         = CashBankInDetails::all();
        $LaporanPenjualans         = LaporanPenjualan::all();

        $pdf = PDF::loadview('reports.daftar_penjualan.print', compact('crjs', 'SalesJournals', 'ReturPenjualans', 'CashBankIns', 'salesjournaldetails', 'ReturPenjualanDetails', 'CashBankInDetailss', 'crjdetails', 'LaporanPenjualans','tanggal_mulai','tanggal_akhir','add_day'));
        return $pdf->setPaper('a4', 'landscape')->stream('laporan-penjualan.pdf');
    }

    /**
     * Print hasil filteran dari filter modal.
     *
     * @return \Illuminate\Http\Response
     */
     public function print(Request $request)
     {
         $tanggal_mulai  = $request->tanggal_mulai;
         $tanggal_akhir  = $request->tanggal_akhir;
         $add_day        = Carbon::parse($tanggal_akhir)->addDay();
         $crjs                       = crj::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
         $crjdetails                 = crjdetail::all();
         $SalesJournals              = SalesJournal::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
         $ReturPenjualans            = ReturPenjualan::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
         $CashBankIns                = CashBankIn::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
         $salesjournaldetails        = salesjournaldetail::all();
         $ReturPenjualanDetails      = ReturPenjualanDetail::all();
         $CashBankInDetailss         = CashBankInDetails::all();
         $LaporanPenjualans         = LaporanPenjualan::all();

         $pdf = PDF::loadview('reports.daftar_penjualan.print', compact('crjs', 'SalesJournals', 'ReturPenjualans', 'CashBankIns', 'salesjournaldetails', 'ReturPenjualanDetails', 'CashBankInDetailss', 'crjdetails', 'LaporanPenjualans','tanggal_mulai','tanggal_akhir','add_day'));
         return $pdf->setPaper('a4', 'landscape')->stream('laporan-penjualan.pdf');
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
