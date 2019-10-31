<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Item;

class ItemController extends Controller
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
      $data = Item::orderBy('created_at', 'desc')->get();
        return view('pages.item.index', compact('data'));
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
        // Item::create($request->all());
        $data           = new Item;
        $data->kode     = $request->kode;
        $data->nama     = $request->nama;
        $data->unit     = $request->unit;
        $data->harga    = $request->harga;
        $data->nilai_persediaan    = $request->nilai_persediaan;

        $nama_file = $request->file('gambar');
        $path = $nama_file->store('public/item'); // ini akan tersimpan pada storage, app, public, files.
        $data->gambar = $path;
        $data->save();

        return redirect('item');
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
      if (empty($request->foto)) {
          $data = Item::find($id);
          $data->kode     = $request->kode;
          $data->nama     = $request->nama;
          $data->unit     = $request->unit;
          $data->harga    = $request->harga;
          $data->nilai_persediaan    = $request->nilai_persediaan;
          $data->save();
          return redirect('item');
      } else {
          $data = Item::find($id);
          $data->kode     = $request->kode;
          $data->nama     = $request->nama;
          $data->unit     = $request->unit;
          $data->harga    = $request->harga;
          $data->nilai_persediaan    = $request->nilai_persediaan;

          $nama_file = $request->file('gambar');
          $path = $nama_file->store('public/item'); // ini akan tersimpan pada storage, app, public, files.

          // hapus file
          Storage::delete($data->gambar);

          $data->gambar = $path;
          $data->save();
          return redirect('item');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::find($id)->delete();
        return redirect('item');
    }
}
