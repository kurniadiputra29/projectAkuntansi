<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\DataSupplier;
use App\Model\SaldoHutang;
use App\Model\PurchaseJournal;
use App\Model\purchasejournaldetail;
use App\Model\ReturPembelian;
use App\Model\ReturPembelianDetail;
use App\Model\CashBankOut;
use App\Model\CashBankOutDetails;

class HutangController extends Controller
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
        $DataSuppliers             = DataSupplier::all();
        $SaldoHutangs              = SaldoHutang::all();
        $PurchaseJournals          = PurchaseJournal::all();
        $purchasejournaldetails    = purchasejournaldetail::where('nomor_akun', '2-1210')->first();
        $ReturPembelians           = ReturPembelian::all();
        $ReturPembelianDetails     = ReturPembelianDetail::where('nomor_akun', '2-1210')->first();
        $CashBankOuts           = CashBankOut::all();
        $CashBankOutDetails     = CashBankOutDetails::where('nomor_akun', '2-1210')->first();

        return view('reports.hutang_supplier.index', compact('DataSuppliers', 'SaldoHutangs', 'PurchaseJournals', 'purchasejournaldetails', 'ReturPembelians', 'ReturPembelianDetails', 'CashBankOuts', 'CashBankOutDetails'));
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
