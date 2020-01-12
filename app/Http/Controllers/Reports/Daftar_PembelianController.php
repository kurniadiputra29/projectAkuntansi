<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\cpj;
use App\Model\PurchaseJournal;
use App\Model\ReturPembelian;
use App\Model\CashBankOut;
use App\Model\cpjdetail;
use App\Model\ReturPembelianDetail;
use App\Model\purchasejournaldetail;
use App\Model\CashBankOutDetails;
use App\Model\LaporanPembelian;

class Daftar_PembelianController extends Controller
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
        $cpjs                       = cpj::all();
        $cpjdetails                 = cpjdetail::all();
        $PurchaseJournals           = PurchaseJournal::all();
        $ReturPembelians            = ReturPembelian::all();
        $CashBankOuts               = CashBankOut::all();
        $purchasejournaldetails     = purchasejournaldetail::all();
        $ReturPembelianDetails      = ReturPembelianDetail::all();
        $CashBankOutDetailss        = CashBankOutDetails::all(); 
        $LaporanPembelians        = LaporanPembelian::all(); 

        return view('reports.daftar_pembelian.index', compact('cpjs', 'cpjdetails', 'PurchaseJournals', 'ReturPembelians', 'CashBankOuts', 'purchasejournaldetails', 'ReturPembelianDetails', 'CashBankOutDetailss', 'LaporanPembelians'));
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
