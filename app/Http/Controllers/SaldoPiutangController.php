<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\DataCustomer;
use App\Model\SaldoPiutang;
use App\Http\Requests\SaldoPiutangRequest;

class SaldoPiutangController extends Controller
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
      $dataSaldoPiutang     = SaldoPiutang::orderBy('created_at', 'desc')->get();
      $dataCustomer         = DataCustomer::all();
        return view('pages.saldo_piutang.index', compact('dataSaldoPiutang','dataCustomer'));
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
                'customers_id' => 'required',
                'keterangan' => 'required',
        ],$messages);

        $data                   = new SaldoPiutang;
        $data->customers_id     = $request->customers_id;
        $data->keterangan       = $request->keterangan;
        $data->debet            = $request->debet;
        $data->kredit           = $request->kredit;
        $data->save();

        return redirect('saldo_piutang')->with('Success', 'Data anda telah berhasil di input !');
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
                'customers_id' => 'required',
                'keterangan' => 'required',
        ],$messages);

        $data                   = SaldoPiutang::find($id);
        $data->customers_id     = $request->customers_id;
        $data->keterangan       = $request->keterangan;
        $data->debet            = $request->debet;
        $data->kredit           = $request->kredit;
        $data->save();

        return redirect('saldo_piutang')->with('Success', 'Data anda telah berhasil di Edit !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SaldoPiutang::find($id)->delete();
        return redirect('saldo_piutang')->with('Success', 'Data anda telah berhasil di delete !');
    }
}
