<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\DataCustomer;
use App\Model\SaldoPiutang;
use App\Model\salesjournaldetail;
use App\Model\SalesJournal;
use App\Model\ReturPenjualan;
use App\Model\ReturPenjualanDetail;
use App\Model\CashBankIn;
use App\Model\CashBankInDetails;
use PDF;
use Carbon\Carbon;

class PiutangController extends Controller
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
        $DataCustomers              = DataCustomer::all();
        $SaldoPiutangs              = SaldoPiutang::all();
        $SalesJournals              = SalesJournal::all();
        $salesjournaldetails        = salesjournaldetail::where('nomor_akun', '1-1220')->get();
        $ReturPenjualans            = ReturPenjualan::all();
        $ReturPenjualanDetails      = ReturPenjualanDetail::where('nomor_akun', '1-1220')->get();
        $CashBankIns                = CashBankIn::all();
        $CashBankInDetails          = CashBankInDetails::where('nomor_akun', '1-1220')->get();

        return view('reports.piutang_pelanggan.index', compact('DataCustomers', 'SaldoPiutangs', 'salesjournaldetails', 'SalesJournals', 'ReturPenjualans', 'ReturPenjualanDetails', 'CashBankIns', 'CashBankInDetails'));
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
        $add_day        = Carbon::parse($tanggal_akhir);

        $DataCustomers              = DataCustomer::all();
        $SaldoPiutangs              = SaldoPiutang::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $SalesJournals              = SalesJournal::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $salesjournaldetails        = salesjournaldetail::where('nomor_akun', '1-1220')->get();
        $ReturPenjualans            = ReturPenjualan::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $ReturPenjualanDetails      = ReturPenjualanDetail::where('nomor_akun', '1-1220')->get();
        $CashBankIns                = CashBankIn::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $CashBankInDetails          = CashBankInDetails::where('nomor_akun', '1-1220')->get();

        return view('reports.piutang_pelanggan.filter', compact('DataCustomers', 'SaldoPiutangs', 'salesjournaldetails', 'SalesJournals', 'ReturPenjualans', 'ReturPenjualanDetails', 'CashBankIns', 'CashBankInDetails', 'tanggal_mulai','tanggal_akhir','add_day'));
    }

    public function printFilter(Request $request)
    {
        $tanggal_mulai  = $request->tanggal_mulai;
        $tanggal_akhir  = $request->tanggal_akhir;
        $add_day        = Carbon::parse($tanggal_akhir);
        $DataCustomers              = DataCustomer::all();
        $SaldoPiutangs              = SaldoPiutang::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $SalesJournals              = SalesJournal::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $salesjournaldetails        = salesjournaldetail::where('nomor_akun', '1-1220')->get();
        $ReturPenjualans            = ReturPenjualan::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $ReturPenjualanDetails      = ReturPenjualanDetail::where('nomor_akun', '1-1220')->get();
        $CashBankIns                = CashBankIn::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $CashBankInDetails          = CashBankInDetails::where('nomor_akun', '1-1220')->get();

        $pdf = PDF::loadview('reports.piutang_pelanggan.print', compact('DataCustomers', 'SaldoPiutangs', 'salesjournaldetails', 'SalesJournals', 'ReturPenjualans', 'ReturPenjualanDetails', 'CashBankIns', 'CashBankInDetails', 'tanggal_mulai','tanggal_akhir','add_day'));
        return $pdf->setPaper('a4', 'landscape')->stream('laporan-piutang-pelanggan.pdf');
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

    public function print(Request $request)
    {
        $tanggal_mulai  = $request->tanggal_mulai;
        $tanggal_akhir  = $request->tanggal_akhir;
        $add_day        = Carbon::parse($tanggal_akhir);

        $DataCustomers              = DataCustomer::all();
        $SaldoPiutangs              = SaldoPiutang::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $SalesJournals              = SalesJournal::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $salesjournaldetails        = salesjournaldetail::where('nomor_akun', '1-1220')->get();
        $ReturPenjualans            = ReturPenjualan::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $ReturPenjualanDetails      = ReturPenjualanDetail::where('nomor_akun', '1-1220')->get();
        $CashBankIns                = CashBankIn::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();
        $CashBankInDetails          = CashBankInDetails::where('nomor_akun', '1-1220')->get();

        $pdf = PDF::loadview('reports.piutang_pelanggan.print', compact('DataCustomers', 'SaldoPiutangs', 'salesjournaldetails', 'SalesJournals', 'ReturPenjualans', 'ReturPenjualanDetails', 'CashBankIns', 'CashBankInDetails', 'tanggal_mulai','tanggal_akhir','add_day'));
        return $pdf->setPaper('a4', 'landscape')->stream('laporan-piutang-pelanggan.pdf');
    }
}
