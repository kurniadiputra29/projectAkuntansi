<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\SaldoHutang;
use App\Model\DataSupplier;
use App\Http\Requests\SaldoHutangRequest;

class SaldoHutangController extends Controller
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
      $dataSaldoHutang = SaldoHutang::orderBy('created_at', 'desc')->get();
      $dataSupplier = DataSupplier::all();
        return view('pages.saldo_hutang.index', compact('dataSaldoHutang','dataSupplier'));
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
                'required' => ':attribute wajib diisi !!!',
        ];
        $this->validate($request,[
                'suppliers_id'  => 'required',
                'keterangan'    => 'required',
        ],$messages);

        $data = new SaldoHutang;
        $data->tanggal = $request->tanggal;
        $data->suppliers_id = $request->suppliers_id;
        $data->keterangan = $request->keterangan;
        $data->debet = $request->debet;
        $data->kredit = $request->kredit;
        $data->save();

        return redirect('saldo_hutang')->with('Success', 'Data anda telah berhasil di input !');
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
        $messages = [
                'required' => ':attribute wajib diisi !!!',
        ];
        $this->validate($request,[
                'suppliers_id'  => 'required',
                'keterangan'    => 'required',
        ],$messages);

        $data = SaldoHutang::find($id);
        $data->tanggal = $request->tanggal;
        $data->suppliers_id = $request->suppliers_id;
        $data->keterangan = $request->keterangan;
        $data->debet = $request->debet;
        $data->kredit = $request->kredit;
        $data->save();

        return redirect('saldo_hutang')->with('Success', 'Data anda telah berhasil di Edit !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SaldoHutang::find($id)->delete();
        return redirect('saldo_awal')->with('Success', 'Data anda telah berhasil di delete !');
    }
}
