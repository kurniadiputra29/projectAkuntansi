<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Account;
use App\Model\Cashinbank;
use App\Model\Cashinbankdetail;

class CashBankController extends Controller
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
        return view('pages.cashbank.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akun = Account::all();
        return view('pages.cashbank.create', compact('akun'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (empty($request->kredit)) {

			//insert data pettycash
            $dataCashInBank          = $request->only('id','tanggal', 'kode', 'penerima_diterima', 'description','status');
            $cashinbank              = Cashinbank::create($dataCashInBank);

            //insert data pettycash detail
            $detailcashinbank                 = $request->only('nomor_akun', 'nama_akun', 'debet', 'jumlah', 'index');
            $countKasKecil = count($detailcashinbank['nomor_akun']);

            for ($i=0; $i < $countKasKecil; $i++) { 
                $detail                      = new Cashinbankdetail();
                $detail->cashinbank_id       = $cashinbank->id;
                $detail->nomor_akun          = $detailcashinbank['nomor_akun'][$i];
                $detail->nama          		= $detailcashinbank['nama_akun'][$i];
                $detail->debet              = $detailcashinbank['jumlah'][$i];
                $detail->kredit             = $detailcashinbank['jumlah'][$i];
                $detail->save();
            }            
            return redirect('/cashbank')->with('Success', 'Data anda telah berhasil di Input !');

        } else {

            $dataOrder          = $request->only('tanggal', 'kode', 'description','status');
            $order              = Cashinbank::create($dataOrder);

            
            $dataDetail                 = $request->only('nomor_akun','nomor_akun', 'setor', 'jumlah');
            $countDetail                = count($dataDetail['jumlah']);

            for ($i=0; $i < $countDetail; $i++) { 
                $detail                             = new Cashinbankdetail();
                $detail->cashinbank_id           = $order->id;
                $detail->nomor_akun          = $dataDetail['nomor_akun'][$i];
                $detail->nama               = $dataDetail['nomor_akun'][$i];
                $detail->debet              = $dataDetail['setor'][$i];
                $detail->kredit             = $dataDetail['jumlah'][$i];
                $detail->save();
            }            
            return redirect('/cashbank')->with('Success', 'Data anda telah berhasil di Input !');
        }
        
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
