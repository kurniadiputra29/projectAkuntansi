<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\SaldoItem;
use App\Model\Item;
use App\Model\Inventory;

class SaldoItemController extends Controller
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
        $SaldoItems     = SaldoItem::orderBy('created_at', 'desc')->get();
        $Items          = Item::all();
        return view('pages.saldo_items.index', compact('SaldoItems','Items'));
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
        $messages = [
            'required'   => ':attribute wajib diisi !!!',
        ];
        $this->validate($request,[
            'items_id'   => 'required',
            'unit'       => 'required',
            'price'      => 'required',
            'total'      => 'required',
        ],$messages);
        
        $datas               = new SaldoItem;
        $datas->items_id     = $request->items_id;
        $datas->unit         = $request->unit;
        $datas->price        = $request->price;
        $datas->total        = $request->total;
        $datas->save();

        $data                   = new Inventory;
        $data->items_id         = $request->items_id;
        $data->saldo_items_id   = $datas->id;
        $data->status            = $request->status;
        $data->unit             = $request->unit;
        $data->price            = $request->price;
        $data->total            = $request->total;
        $data->save();

        return redirect('saldo_item')->with('Success', 'Data anda telah berhasil di input !');
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
        $SaldoItems     = SaldoItem::find($id);
        $Items          = Item::all();
        return view('pages.saldo_items.edit', compact('SaldoItems','Items'));
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
        $messages = [
            'required'   => ':attribute wajib diisi !!!',
        ];
        $this->validate($request,[
            'items_id'   => 'required',
            'unit'       => 'required',
            'price'      => 'required',
            'total'      => 'required',
        ],$messages);
        
        $datas               = SaldoItem::find($id);
        $datas->items_id     = $request->items_id;
        $datas->unit         = $request->unit;
        $datas->price        = $request->price;
        $datas->total        = $request->total;
        $datas->save();

        Inventory::where('saldo_items_id', $id)->delete();

        $data                   = new Inventory;
        $data->items_id         = $request->items_id;
        $data->saldo_items_id   = $id;
        $data->status            = $request->status;
        $data->unit             = $request->unit;
        $data->price            = $request->price;
        $data->total            = $request->total;
        $data->save();

        return redirect('saldo_item')->with('Success', 'Data anda telah berhasil di Edit !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SaldoItem::find($id)->delete();
        return redirect('saldo_item')->with('Success', 'Data anda telah berhasil di Delete !');
    }
}
