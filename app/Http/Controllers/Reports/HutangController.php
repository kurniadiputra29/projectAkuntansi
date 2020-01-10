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
use App\Model\LaporanHutang;
use PDF;
use Carbon\Carbon;

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
        $distinct_laporan           = LaporanHutang::distinct('suppliers_id')->select('debet', 'kredit', 'suppliers_id')->get();
        $purchasejournaldetails     = purchasejournaldetail::where('nomor_akun', '2-1210')->get();
        $ReturPembelians            = ReturPembelian::all();
        $ReturPembelianDetails      = ReturPembelianDetail::where('nomor_akun', '2-1210')->get();
        $CashBankOuts               = CashBankOut::all();
        $CashBankOutDetails         = CashBankOutDetails::where('nomor_akun', '2-1210')->get();

        $distinct_pc                = DataSupplier::distinct('kode')->select('id', 'kode', 'nama')->get();

        return view('reports.hutang_supplier.index', compact('DataSuppliers', 'SaldoHutangs', 'PurchaseJournals', 'purchasejournaldetails', 'ReturPembelians', 'ReturPembelianDetails', 'CashBankOuts', 'CashBankOutDetails', 'sum_debet', 'sum_kredit', 'distinct_pc', 'distinct_laporan'));
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

        $DataSuppliers              = DataSupplier::all();
        $SaldoHutangs               = SaldoHutang::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $PurchaseJournals           = PurchaseJournal::all();
        $distinct_laporan           = LaporanHutang::distinct('suppliers_id')->select('debet', 'kredit', 'suppliers_id')->whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $purchasejournaldetails     = purchasejournaldetail::where('nomor_akun', '2-1210')->get();
        $ReturPembelians            = ReturPembelian::all();
        $ReturPembelianDetails      = ReturPembelianDetail::where('nomor_akun', '2-1210')->get();
        $CashBankOuts               = CashBankOut::all();
        $CashBankOutDetails         = CashBankOutDetails::where('nomor_akun', '2-1210')->get();
        $distinct_pc                = DataSupplier::distinct('kode')->select('id', 'kode', 'nama')->get();
        return view('reports.hutang_supplier.filter', compact('DataSuppliers', 'SaldoHutangs', 'PurchaseJournals', 'purchasejournaldetails', 'ReturPembelians', 'ReturPembelianDetails', 'CashBankOuts', 'CashBankOutDetails','distinct_pc', 'distinct_laporan','tanggal_mulai','tanggal_akhir','add_day'));
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

        $DataSuppliers              = DataSupplier::all();
        $SaldoHutangs               = SaldoHutang::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $PurchaseJournals           = PurchaseJournal::all();
        $distinct_laporan           = LaporanHutang::distinct('suppliers_id')->select('debet', 'kredit', 'suppliers_id')->whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $purchasejournaldetails     = purchasejournaldetail::where('nomor_akun', '2-1210')->get();
        $ReturPembelians            = ReturPembelian::all();
        $ReturPembelianDetails      = ReturPembelianDetail::where('nomor_akun', '2-1210')->get();
        $CashBankOuts               = CashBankOut::all();
        $CashBankOutDetails         = CashBankOutDetails::where('nomor_akun', '2-1210')->get();
        $distinct_pc                = DataSupplier::distinct('kode')->select('id', 'kode', 'nama')->whereBetween('created_at', [$tanggal_mulai,$add_day])->get();

        $pdf = PDF::loadview('reports.hutang_supplier.print', compact('DataSuppliers', 'SaldoHutangs', 'PurchaseJournals', 'purchasejournaldetails', 'ReturPembelians', 'ReturPembelianDetails', 'CashBankOuts', 'CashBankOutDetails','distinct_pc', 'distinct_laporan','tanggal_mulai','tanggal_akhir','add_day'));
        return $pdf->setPaper('a4', 'landscape')->stream('laporan-hutang-supplier.pdf');
    }
}
