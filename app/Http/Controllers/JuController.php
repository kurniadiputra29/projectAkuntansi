<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Account;
use App\Model\JurnalUmum;
use App\Model\jurnalumumdetail;
use App\Model\LaporanBukuBesar;
use App\Model\LaporanBukuBesarPenyesuaian;

class JuController extends Controller
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
        $data = JurnalUmum::orderBy('created_at', 'desc')->get();
        return view('pages.ju.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akun = Account::all();
        $lastOrder = JurnalUmum::orderBy('id', 'desc')->first();

        return view('pages.ju.create', compact('akun', 'lastOrder'));
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
            'unique' => ':attribute harus diisi dengan syarat unique !!!',
        ];
        $this->validate($request,[
            'tanggal' => 'required',
            'description' => 'required',
            'kode' => 'unique:jurnal_umums,kode|required',
        ],$messages);

        //insert data cashbank
        $dataJurnalUmum          = $request->only('id','tanggal', 'kode', 'description');
        $jurnalumum              = JurnalUmum::create($dataJurnalUmum);

        //insert data cashbank detail
        $detailjurnalumum                 = $request->only('nomor_akun', 'nama_akun', 'debet', 'kredit');
        $countKasBank = count($detailjurnalumum['nomor_akun']);

        for ($a=0; $a < $countKasBank; $a++) {
            $detail = new jurnalumumdetail();
            $detail->jurnal_umums_id = $jurnalumum->id;
            $detail->nomor_akun = $detailjurnalumum['nomor_akun'][$a];
            $detail->nama_akun = $detailjurnalumum['nama_akun'][$a];
            $detail->debet = $detailjurnalumum['debet'][$a];
            $detail->kredit = $detailjurnalumum['kredit'][$a];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->jurnal_umums_id = $jurnalumum->id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailjurnalumum['nomor_akun'][$a];
            $detail->debet = $detailjurnalumum['debet'][$a];
            $detail->kredit = $detailjurnalumum['kredit'][$a];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->jurnal_umums_id = $jurnalumum->id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailjurnalumum['nomor_akun'][$a];
            $detail->debet = $detailjurnalumum['debet'][$a];
            $detail->kredit = $detailjurnalumum['kredit'][$a];
            $detail->save();
        }

        return redirect('/ju')->with('Success', 'Data anda telah berhasil di Input !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = jurnalumumdetail::where('jurnal_umums_id', $id)->get();
        return view('pages.ju.show', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $akun           = Account::all();
        $cashbanks     = JurnalUmum::find($id);
        $details        = jurnalumumdetail::where('jurnal_umums_id', $id)->get();

        return view('pages.ju.edit', compact('akun', 'cashbanks', 'details'));
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
            'unique' => ':attribute harus diisi dengan syarat unique !!!',
        ];
        $this->validate($request,[
            'tanggal' => 'required',
            'description' => 'required',
            'kode' => 'unique:jurnal_umums,kode,'.$id,
        ],$messages);

        //insert data cashbank
        $dataJurnalUmum          = $request->only('id','tanggal', 'kode', 'description');
        $jurnalumum              = JurnalUmum::find($id)->update($dataJurnalUmum);

        //insert data cashbank detail
        $detailjurnalumum                 = $request->only('nomor_akun', 'nama_akun', 'debet', 'kredit');
        $countKasBank = count($detailjurnalumum['nomor_akun']);

        jurnalumumdetail::where('jurnal_umums_id', $id)->delete();
        LaporanBukuBesar::where('jurnal_umums_id', $id)->delete();
        LaporanBukuBesarPenyesuaian::where('jurnal_umums_id', $id)->delete();

        for ($a=0; $a < $countKasBank; $a++) {
            $detail                     = new jurnalumumdetail();
            $detail->jurnal_umums_id    = $id;
            $detail->nomor_akun         = $detailjurnalumum['nomor_akun'][$a];
            $detail->nama_akun          = $detailjurnalumum['nama_akun'][$a];
            $detail->debet              = $detailjurnalumum['debet'][$a];
            $detail->kredit             = $detailjurnalumum['kredit'][$a];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->jurnal_umums_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailjurnalumum['nomor_akun'][$a];
            $detail->debet = $detailjurnalumum['debet'][$a];
            $detail->kredit = $detailjurnalumum['kredit'][$a];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->jurnal_umums_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailjurnalumum['nomor_akun'][$a];
            $detail->debet = $detailjurnalumum['debet'][$a];
            $detail->kredit = $detailjurnalumum['kredit'][$a];
            $detail->save();
        }

        return redirect('/ju')->with('Success', 'Data anda telah berhasil di Edit !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JurnalUmum::find($id)->delete();
        return redirect('/ju')->with('Success', 'Data anda telah berhasil di Hapus !');
    }
}
