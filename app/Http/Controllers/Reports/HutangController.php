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
        $DataSuppliers              = DataSupplier::all();
        $SaldoHutangs               = SaldoHutang::all();
        $PurchaseJournals           = PurchaseJournal::all();
        $purchasejournaldetails     = purchasejournaldetail::where('nomor_akun', '2-1210')->get();
        $ReturPembelians            = ReturPembelian::all();
        $ReturPembelianDetails      = ReturPembelianDetail::where('nomor_akun', '2-1210')->get();
        $CashBankOuts               = CashBankOut::all();
        $CashBankOutDetails         = CashBankOutDetails::where('nomor_akun', '2-1210')->get();

        $sum_debet                  = SaldoHutang::sum('debet');
        $sum_kredit                 = SaldoHutang::sum('kredit');
        $distinct_pc                = DataSupplier::distinct('kode')->select('id', 'kode', 'nama')->get();
        $distinct_pcc                = SaldoHutang::distinct('suppliers_id')->select('debet', 'kredit', 'suppliers_id')->get();
        

        return view('reports.hutang_supplier.index', compact('DataSuppliers', 'SaldoHutangs', 'PurchaseJournals', 'purchasejournaldetails', 'ReturPembelians', 'ReturPembelianDetails', 'CashBankOuts', 'CashBankOutDetails', 'sum_debet', 'sum_kredit', 'distinct_pc', 'purchasejournaldetailss', 'distinct_pcc'));
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
