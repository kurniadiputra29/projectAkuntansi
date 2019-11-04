<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Pettycash;
use App\Model\Account;

class KasKecilController extends Controller
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
      $data = Pettycash::orderBy('created_at', 'desc')->get();
        return view('pages.kas_kecil.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $akun = Account::all();
        return view('pages.kas_kecil.create', compact('akun'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $dataKasKecil = $request->only('tanggal', 'kode', 'description', 'nomor_akun', 'debet', 'kredit');
      $countKasKecil = count($dataKasKecil['nomor_akun']);
      for ($i=0; $i < $countKasKecil; $i++) {

          $detail             = new Pettycash();
          $detail->tanggal    = $dataKasKecil['tanggal'];
          $detail->kode       = $dataKasKecil['kode'];
          $detail->description= $dataKasKecil['description'][$i];
          $detail->nomor_akun = $dataKasKecil['nomor_akun'][$i];
          $detail->debet      = $dataKasKecil['debet'][$i];
          $detail->kredit     = $dataKasKecil['kredit'][$i];
          $detail->save();
      }

        return redirect('kas_kecil')->with('Success', 'Data anda telah berhasil di input !');
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
        Pettycash::find($id)->delete();
        return redirect('kas_kecil')->with('Success', 'Data anda telah berhasil di delete !');
    }
}
