<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Item;
use App\Model\Inventory;
use Illuminate\Support\Facades\Storage;

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
        $messages = [
            'required'  => ':attribute wajib diisi !!!',
        ];
        $this->validate($request,[
            'kode'      => 'unique:items,kode|required',
            'nama'      => 'required',
            'foto'      => 'required',
        ],$messages);
        
        $data           = new Item;
        $data->kode     = $request->kode;
        $data->nama     = $request->nama;

        $nama_file = $request->file('foto');
        $path = $nama_file->store('public/foto_items'); // ini akan tersimpan pada storage, app, public, files.
        $data->foto = $path;
        $data->save();

        return redirect('item')->with('Success', 'Data anda telah berhasil di input !');
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
          $messages = [
            'required'  => ':attribute wajib diisi !!!',
          ];
          $this->validate($request,[
              'kode'      => 'unique:items,kode,'.$id,
              'nama'      => 'required',
          ],$messages);

          $data           = Item::find($id);
          $data->kode     = $request->kode;
          $data->nama     = $request->nama;
          $data->save();

          return redirect('item')->with('Success', 'Data anda telah berhasil di Edit !');
      } else {
          $messages = [
            'required'  => ':attribute wajib diisi !!!',
          ];
          $this->validate($request,[
              'kode'      => 'unique:items,kode,'.$id,
              'nama'      => 'required',
              'foto'      => 'required',
          ],$messages);
          
          $data           = Item::find($id);
          $data->kode     = $request->kode;
          $data->nama     = $request->nama;

          $nama_file = $request->file('foto');
          $path = $nama_file->store('public/foto_items'); // ini akan tersimpan pada storage, app, public, files.

          // hapus file
          Storage::delete($data->foto);
          $data->foto = $path;
          $data->save();

          return redirect('item')->with('Success', 'Data anda telah berhasil di Edit !');
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
        return redirect('item')->with('Success', 'Data anda telah berhasil di Hapus !');
    }
}
