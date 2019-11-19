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
        $data = Cashinbank::orderBy('created_at', 'desc')->get();
        return view('pages.cashbank.index', compact('data'));
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
        if (($request->status) == 0) {

			//insert data cashbank
            $dataCashInBank          = $request->only('id','tanggal', 'kode', 'penerima_diterima', 'description','status');
            $cashinbank              = Cashinbank::create($dataCashInBank);

            //insert data cashbank detail
            $detailcashinbank                 = $request->only('nomor_akun', 'nama_akun','nomor_akun2', 'nama_akun2', 'debet', 'jumlah', 'index', 'total');
            $countKasBank = count($detailcashinbank['nomor_akun']);
            $countKasBank2 = count($detailcashinbank['total']);

            for ($a=0; $a < $countKasBank2; $a++) { 
                $detail                     = new Cashinbankdetail();
                $detail->cashinbank_id      = $cashinbank->id;
                $detail->nomor_akun         = $detailcashinbank['nomor_akun2'][$a];
                $detail->nama               = $detailcashinbank['nama_akun2'][$a];
                $detail->debet              = $detailcashinbank['total'][$a];
                $detail->save();
            }
            for ($i=0; $i < $countKasBank; $i++) { 
                $detail                     = new Cashinbankdetail();
                $detail->cashinbank_id      = $cashinbank->id;
                $detail->nomor_akun         = $detailcashinbank['nomor_akun'][$i];
                $detail->nama               = $detailcashinbank['nama_akun'][$i];
                $detail->kredit             = $detailcashinbank['jumlah'][$i];
                $detail->save();
            }

            return redirect('/cashbank')->with('Success', 'Data anda telah berhasil di Input !');

        } else {

            //insert data cashbank
            $dataCashInBank          = $request->only('id','tanggal', 'kode', 'penerima_diterima', 'description','status');
            $cashinbank              = Cashinbank::create($dataCashInBank);

            //insert data cashbank detail
            $detailcashinbank                 = $request->only('nomor_akun', 'nama_akun','nomor_akun2', 'nama_akun2', 'debet', 'jumlah', 'index', 'total');
            $countKasBank = count($detailcashinbank['nomor_akun']);
            $countKasBank2 = count($detailcashinbank['total']);

            for ($a=0; $a < $countKasBank2; $a++) { 
                $detail                     = new Cashinbankdetail();
                $detail->cashinbank_id      = $cashinbank->id;
                $detail->nomor_akun         = $detailcashinbank['nomor_akun2'][$a];
                $detail->nama               = $detailcashinbank['nama_akun2'][$a];
                $detail->kredit              = $detailcashinbank['total'][$a];
                $detail->save();
            }
            for ($i=0; $i < $countKasBank; $i++) { 
                $detail                     = new Cashinbankdetail();
                $detail->cashinbank_id      = $cashinbank->id;
                $detail->nomor_akun         = $detailcashinbank['nomor_akun'][$i];
                $detail->nama               = $detailcashinbank['nama_akun'][$i];
                $detail->debet             = $detailcashinbank['jumlah'][$i];
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
        $detail = Cashinbankdetail::where('cashinbank_id', $id)->get();
        return view('pages.cashbank.show', compact('detail'));
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
        Cashinbank::find($id)->delete();
        return redirect('/cashbank')->with('Success', 'Data anda telah berhasil di Hapus !');
    }
}
