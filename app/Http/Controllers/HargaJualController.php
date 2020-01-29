<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Item;
use App\Model\Inventory;
use App\Model\HargaJual;

class HargaJualController extends Controller
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
        $HargaJuals     = HargaJual::orderBy('created_at', 'desc')->get();
        $items          = Item::all();
        return view('pages.harga_jual.index', compact('HargaJuals','items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items          = Item::all();
        $inventories   = Inventory::distinct('items_id')->select('id', 'items_id', 'price', 'total', 'unit')->get();

        return view('pages.harga_jual.create', compact('items', 'inventories'));
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
            'required' => ':attribute Wajib Diisi !!!',
            'unique' => ':attribute Telah Tersedia !!!',
        ];
        $this->validate($request,[
            'items_id' => 'unique:harga_juals,items_id|required',
            'harga_jual' => 'required',
        ],$messages); 
        
        $data = new HargaJual;
        $data->items_id = $request->items_id;
        $data->harga_jual = $request->harga_jual;
        $data->save();

        return redirect('harga_jual')->with('Success', 'Data anda telah berhasil di input !');
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
        $items = Item::all();
        $inventories = Inventory::distinct('items_id')->select('id', 'items_id', 'price', 'total', 'unit')->get();
        $HargaJuals = HargaJual::find($id);

        return view('pages.harga_jual.edit', compact('items', 'inventories', 'HargaJuals'));
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
            'required' => ':attribute Wajib Diisi !!!',
            'unique' => ':attribute Telah Tersedia !!!',
        ];
        $this->validate($request,[
            'items_id' => 'unique:harga_juals,items_id,'.$id,
            'harga_jual' => 'required',
        ],$messages); 
        
        $data = HargaJual::find($id);
        $data->items_id = $request->items_id;
        $data->harga_jual = $request->harga_jual;
        $data->save();

        return redirect('harga_jual')->with('Success', 'Data anda telah berhasil di Edit !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HargaJual::find($id)->delete();
        return redirect('/harga_jual')->with('Success', 'Data anda telah berhasil di Hapus !');
    }
}
