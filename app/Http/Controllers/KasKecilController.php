<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Pettycash;
use App\Model\Account;
use App\Model\PettycashDetail;
use App\Model\SaldoAwal;

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
      // ngecheck data yang mau dimasukkan
      $checkDataMasukNggak = $request->all();
      // dd($checkDataMasukNggak);
        //insert data pettycash
        $dataKasKecil = $request->only('id', 'tanggal', 'kode', 'penerima', 'description');
        $pettycash = Pettycash::create($dataKasKecil);

        //insert data pettycash detail
        $detailKasKecil = $request->only('nomor_akun', 'nama_akun', 'nomor_akun2', 'nama_akun2', 'jumlah', 'total');
        $countKasKecil = count($detailKasKecil['nomor_akun']);
        $countKasKecil2 = count($detailKasKecil['total']);

        // versi adib
        $detailKasKecil2 = $request->only('nomor_akun', 'nama_akun', 'akun_id', 'jumlah', 'total');
        $countKasKecil3 = count($detailKasKecil['nomor_akun']);
        $countKasKecil4 = count($detailKasKecil['total']);
        $account = Account::where('id', $detailKasKecil2['akun_id'])->get();
        foreach ($account as $key) {
          $nomor = $key->nomor;
          $nama = $key->nama;
        }

        for ($i=0; $i < $countKasKecil4 ; $i++) {
          // code...
          $total = $detailKasKecil2['total'][$i];

          $detail                     = new PettycashDetail();
          $detail->pettycash_id       = $pettycash->id;
          $detail->nomor_akun         = $nomor;
          $detail->nama_akun          = $nama;
          $detail->kredit             = $detailKasKecil2['total'][$i];
          $detail->save();
        }

        $saldo_awal = SaldoAwal::where('id', $detailKasKecil2['akun_id'])->get();
        foreach ($saldo_awal as $key) {
          $kredit_tertera = $key->kredit;
        }

        $data = ['kredit' => $kredit_tertera + $total];
        $updateSaldoAwal = SaldoAwal::where('id', $detailKasKecil2['akun_id'])->update($data);

        // for ($a=0; $a < $countKasKecil2; $a++) {
        //     $detail                     = new PettycashDetail();
        //     $detail->pettycash_id       = $pettycash->id;
        //     $detail->nomor_akun         = $detailKasKecil['nomor_akun2'][$a];
        //     $detail->nama_akun          = $detailKasKecil['nama_akun2'][$a];
        //     $detail->kredit              = $detailKasKecil['total'][$a];
        //     $detail->save();
        // }
        for ($i=0; $i < $countKasKecil3; $i++) {
            $detail                     = new PettycashDetail();
            $detail->pettycash_id       = $pettycash->id;
            $detail->nomor_akun         = $detailKasKecil2['nomor_akun'][$i];
            $detail->nama_akun          = $detailKasKecil2['nama_akun'][$i];
            $detail->debet              = $detailKasKecil2['jumlah'][$i];
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
      $detail = PettycashDetail::where('pettycash_id', $id)->get();
        return view('pages.kas_kecil.show', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $akun = Account::all();
      $kas_kecil = Pettycash::find($id);
      $detail = PettycashDetail::where('pettycash_id', $id)->get();
        return view('pages.kas_kecil.edit', compact('akun', 'kas_kecil', 'detail'));
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
        //PettycashDetail::where('pettycash_id', $id)->delete();
        return redirect('kas_kecil')->with('Success', 'Data anda telah berhasil di delete !');
    }
}
