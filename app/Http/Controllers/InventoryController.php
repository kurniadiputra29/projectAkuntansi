<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Item;
use App\Model\Inventory;
use App\Model\cpj;
use App\Model\crj;
use App\Model\PurchaseJournal;
use App\Model\SalesJournal;
use App\Model\ReturPenjualan;
use App\Model\ReturPembelian;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items                 = Item::all();
        $inventories           = Inventory::all();
        $cpjs                  = cpj::all();
        $crjs                  = crj::all();
        $PurchaseJournals      = PurchaseJournal::all();
        $SalesJournals         = SalesJournal::all();
        $ReturPembelians       = ReturPembelian::all();
        $ReturPenjualans      = ReturPenjualan::all();
        return view('reports.inventory_card.index', compact('items', 'inventories', 'cpjs', 'crjs', 'PurchaseJournals', 'SalesJournals', 'ReturPembelians', 'ReturPenjualans'));
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
