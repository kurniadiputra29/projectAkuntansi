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
        $salesjournaldetails        = salesjournaldetail::where('nomor_akun', '1-1220')->first();
        $ReturPenjualans            = ReturPenjualan::all();
        $ReturPenjualanDetails      = ReturPenjualanDetail::where('nomor_akun', '1-1220')->first();
        $CashBankIns                = CashBankIn::all();
        $CashBankInDetails          = CashBankInDetails::where('nomor_akun', '1-1220')->first();



        // dd($salesjournaldetails);

        return view('reports.piutang_pelanggan.index', compact('DataCustomers', 'SaldoPiutangs', 'salesjournaldetails', 'SalesJournals', 'ReturPenjualans', 'ReturPenjualanDetails', 'CashBankIns', 'CashBankInDetails'));
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