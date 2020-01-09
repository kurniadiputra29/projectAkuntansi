<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Item;
use App\Model\SaldoItem;
use App\Model\Inventory;
use App\Model\cpj;
use App\Model\crj;
use App\Model\PurchaseJournal;
use App\Model\SalesJournal;
use App\Model\ReturPenjualan;
use App\Model\ReturPembelian;
use Carbon\Carbon;
use PDF;

class InventoryController extends Controller
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
        $items                  = Item::all();
        $SaldoItems             = SaldoItem::all();
        $inventories            = Inventory::all();
        $cpjs                   = cpj::all();
        $crjs                   = crj::all();
        $PurchaseJournals       = PurchaseJournal::all();
        $SalesJournals          = SalesJournal::all();
        $ReturPembelians        = ReturPembelian::all();
        $ReturPenjualans        = ReturPenjualan::all();

        $distinct_pc            = Item::distinct('id')->select('id', 'kode', 'nama')->get();
        $distinct_pcc           = Inventory::distinct('items_id')->select('unit', 'price', 'total', 'items_id', 'status')->get();
        return view('reports.inventory_card.index', compact('items', 'inventories', 'cpjs', 'crjs', 'PurchaseJournals', 'SalesJournals', 'ReturPembelians', 'ReturPenjualans', 'distinct_pc', 'distinct_pcc', 'SaldoItems'));
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

        $items = Item::all();
        $inventories = Inventory::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $distinct_pc = Item::distinct('id')->select('id', 'kode', 'nama')->whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $distinct_pcc = Inventory::distinct('items_id')->select('unit', 'price', 'total', 'items_id', 'status')->whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        return view('reports.inventory_card.filter', compact('items','inventories','distinct_pc','distinct_pcc','tanggal_mulai','tanggal_akhir','add_day'));
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Untuk print laporan
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function print(Request $request)
    {
        $tanggal_mulai  = $request->tanggal_mulai;
        $tanggal_akhir  = $request->tanggal_akhir;
        $add_day        = Carbon::parse($tanggal_akhir)->addDay();

        $items = Item::all();
        $inventories = Inventory::whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $distinct_pc = Item::distinct('id')->select('id', 'kode', 'nama')->whereBetween('created_at', [$tanggal_mulai,$add_day])->get();
        $distinct_pcc = Inventory::distinct('items_id')->select('unit', 'price', 'total', 'items_id', 'status')->whereBetween('created_at', [$tanggal_mulai,$add_day])->get();

        $pdf = PDF::loadview('reports.inventory_card.index', compact('inv','items','inventories','distinct_pc','distinct_pcc','tanggal_mulai','tanggal_akhir','add_day'));
        return $pdf->setPaper('a4', 'landscape')->stream('inventory_card.pdf');
        // return view('reports.inventory_card.print', compact('inv','items','inventories','distinct_pc','distinct_pcc','tanggal_mulai','tanggal_akhir','add_day'));
    }
}
