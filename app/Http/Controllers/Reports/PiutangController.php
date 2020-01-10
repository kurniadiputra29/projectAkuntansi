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
use App\Model\LaporanPiutang;
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

        $sum_debet                  = SaldoPiutang::sum('debet');
        $sum_kredit                 = SaldoPiutang::sum('kredit');
        $distinct_pc                = DataCustomer::distinct('kode')->select('id', 'kode', 'nama')->get();
        $distinct_pcc                = SaldoPiutang::distinct('customers_id')->select('debet', 'kredit', 'customers_id')->get();
        $distinct_laporan           = LaporanPiutang::distinct('customers_id')->select('debet', 'kredit', 'customers_id')->get();
        // dd($salesjournaldetails);

        return view('reports.piutang_pelanggan.index', compact('DataCustomers', 'SaldoPiutangs', 'salesjournaldetails', 'SalesJournals', 'ReturPenjualans', 'ReturPenjualanDetails', 'CashBankIns', 'CashBankInDetails', 'sum_debet', 'sum_kredit', 'distinct_pc', 'distinct_pcc', 'distinct_laporan'));
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

        $DataCustomers              = DataCustomer::all();
        $SaldoPiutangs              = SaldoPiutang::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $SalesJournals              = SalesJournal::all();
        $salesjournaldetails        = salesjournaldetail::where('nomor_akun', '1-1220')->get();
        $ReturPenjualans            = ReturPenjualan::all();
        $ReturPenjualanDetails      = ReturPenjualanDetail::where('nomor_akun', '1-1220')->get();
        $CashBankIns                = CashBankIn::all();
        $CashBankInDetails          = CashBankInDetails::where('nomor_akun', '1-1220')->get();

        $sum_debet                  = SaldoPiutang::whereBetween('created_at', [$tanggal_mulai,$add_day])->sum('debet');
        $sum_kredit                 = SaldoPiutang::whereBetween('created_at', [$tanggal_mulai,$add_day])->sum('kredit');
        $distinct_pc                = DataCustomer::distinct('kode')->select('id', 'kode', 'nama')->get();
        $distinct_pcc               = SaldoPiutang::distinct('customers_id')->select('debet', 'kredit', 'customers_id')->get();
        $distinct_laporan           = LaporanPiutang::distinct('customers_id')->select('debet', 'kredit', 'customers_id')->get();
        return view('reports.piutang_pelanggan.filter', compact('DataCustomers', 'SaldoPiutangs', 'salesjournaldetails', 'SalesJournals', 'ReturPenjualans', 'ReturPenjualanDetails', 'CashBankIns', 'CashBankInDetails', 'sum_debet', 'sum_kredit', 'distinct_pc', 'distinct_pcc', 'distinct_laporan','tanggal_mulai','tanggal_akhir','add_day'));
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
        $add_day        = Carbon::parse($tanggal_akhir)->addDay();

        $DataCustomers              = DataCustomer::all();
        $SaldoPiutangs              = SaldoPiutang::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $SalesJournals              = SalesJournal::all();
        $salesjournaldetails        = salesjournaldetail::where('nomor_akun', '1-1220')->get();
        $ReturPenjualans            = ReturPenjualan::all();
        $ReturPenjualanDetails      = ReturPenjualanDetail::where('nomor_akun', '1-1220')->get();
        $CashBankIns                = CashBankIn::all();
        $CashBankInDetails          = CashBankInDetails::where('nomor_akun', '1-1220')->get();

        $sum_debet                  = SaldoPiutang::whereBetween('created_at', [$tanggal_mulai,$add_day])->sum('debet');
        $sum_kredit                 = SaldoPiutang::whereBetween('created_at', [$tanggal_mulai,$add_day])->sum('kredit');
        $distinct_pc                = DataCustomer::distinct('kode')->select('id', 'kode', 'nama')->get();
        $distinct_pcc               = SaldoPiutang::distinct('customers_id')->select('debet', 'kredit', 'customers_id')->get();
        $distinct_laporan           = LaporanPiutang::distinct('customers_id')->select('debet', 'kredit', 'customers_id')->get();

        $pdf = PDF::loadview('reports.piutang_pelanggan.print', compact('DataCustomers', 'SaldoPiutangs', 'salesjournaldetails', 'SalesJournals', 'ReturPenjualans', 'ReturPenjualanDetails', 'CashBankIns', 'CashBankInDetails', 'sum_debet', 'sum_kredit', 'distinct_pc', 'distinct_pcc', 'distinct_laporan','tanggal_mulai','tanggal_akhir','add_day'));
        return $pdf->setPaper('a4', 'landscape')->stream('laporan-piutang-pelanggan.pdf');
    }
}
