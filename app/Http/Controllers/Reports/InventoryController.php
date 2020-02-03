<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Item;
use App\Model\Inventory;
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
        $inventories            = Inventory::all();

        return view('reports.inventory_card.index', compact('items', 'inventories'));
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
        $add_day        = Carbon::parse($tanggal_akhir);

        $items = Item::all();
        $inventories = Inventory::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();

        return view('reports.inventory_card.filter', compact('items', 'inventories', 'tanggal_mulai','tanggal_akhir','add_day'));
    }

    public function printFilter(Request $request)
    {
        $tanggal_mulai  = $request->tanggal_mulai;
        $tanggal_akhir  = $request->tanggal_akhir;
        $add_day        = Carbon::parse($tanggal_akhir);

        $items = Item::all();
        $inventories = Inventory::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();

        $pdf = PDF::loadview('reports.inventory_card.print', compact('items','inventories', 'tanggal_mulai','tanggal_akhir','add_day'));
        return $pdf->setPaper('a4', 'landscape')->stream('inventory_card.pdf');
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
        $add_day        = Carbon::parse($tanggal_akhir);

        $items = Item::get();
        $inventories = Inventory::whereBetween('tanggal', [$tanggal_mulai,$add_day])->get();

        $pdf = PDF::loadview('reports.inventory_card.print', compact('items','inventories', 'tanggal_mulai','tanggal_akhir','add_day'));
        return $pdf->setPaper('a4', 'landscape')->stream('inventory_card.pdf');
    }
}
