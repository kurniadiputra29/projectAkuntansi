<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Account;
use App\Model\SaldoAwal;
use App\Http\Requests\SaldoAwalRequest;

class SaldoAwalController extends Controller
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
      $dataSaldoAwal = SaldoAwal::orderBy('account_id', 'asc')->get();
      $dataAkun = Account::all();
        return view('pages.saldo_awal.index', compact('dataSaldoAwal','dataAkun'));
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
                'account_id'  => 'required',
        ],$messages);

        $data                   = new SaldoAwal;
        $data->account_id       = $request->account_id;
        $data->debet            = $request->debet;
        $data->kredit           = $request->kredit;
        $data->save();

        return redirect('saldo_awal')->with('Success', 'Data anda telah berhasil di Input !');
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
    public function update(SaldoAwalRequest $request, $id)
    {
        SaldoAwal::find($id)->update($request->all());
        return redirect('saldo_awal')->with('Success', 'Data anda telah berhasil di Edit !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SaldoAwal::find($id)->delete();
        return redirect('saldo_awal')->with('Success', 'Data anda telah berhasil di delete !');
    }
}
