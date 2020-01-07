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

        return view('reports.daftar_penjualan.index', compact('crjs', 'SalesJournals', 'ReturPenjualans', 'CashBankIns', 'salesjournaldetails', 'ReturPenjualanDetails', 'CashBankInDetailss', 'crjdetails'));
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
