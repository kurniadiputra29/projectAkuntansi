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
        $SaldoItems                  = SaldoItem::all();
        $inventories            = Inventory::all();
        $cpjs                   = cpj::all();
        $crjs                   = crj::all();
        $PurchaseJournals       = PurchaseJournal::all();
        $SalesJournals          = SalesJournal::all();
        $ReturPembelians        = ReturPembelian::all();
        $ReturPenjualans        = ReturPenjualan::all();

        $distinct_pc            = Item::distinct('id')->select('id', 'kode', 'nama')->get();
        $distinct_pcc           = Inventory::distinct('items_id')->select('unit', 'price', 'total', 'items_id')->get();

        return view('reports.inventory_card.index', compact('items', 'inventories', 'cpjs', 'crjs', 'PurchaseJournals', 'SalesJournals', 'ReturPembelians', 'ReturPenjualans', 'distinct_pc', 'distinct_pcc', 'SaldoItems'));
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

    public function print()
    {
        $items                  = Item::all();
        $inventories            = Inventory::all();
        $cpjs                   = cpj::all();
        $crjs                   = crj::all();
        $PurchaseJournals       = PurchaseJournal::all();
        $SalesJournals          = SalesJournal::all();
        $ReturPembelians        = ReturPembelian::all();
        $ReturPenjualans        = ReturPenjualan::all();

        $distinct_pc            = Item::distinct('id')->select('id', 'kode', 'nama', 'unit', 'harga', 'nilai_persediaan')->get();
        $distinct_pcc           = Inventory::distinct('items_id')->select('unit', 'price', 'total', 'items_id')->get();

        $pdf = PDF::loadview('reports.inventory_card.print', compact('items', 'inventories', 'cpjs', 'crjs', 'PurchaseJournals', 'SalesJournals', 'ReturPembelians', 'ReturPenjualans', 'distinct_pc', 'distinct_pcc'));
        return $pdf->setPaper('a4', 'landscape')->stream('inventory_card.pdf');
    }
}
