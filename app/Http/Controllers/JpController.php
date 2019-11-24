<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Account;
use App\Model\Jurnalpenyesuaian;
use App\Model\jurnalpenyesuaiandetail;

class JpController extends Controller
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
        $data = Jurnalpenyesuaian::orderBy('created_at', 'desc')->get();
        return view('pages.jp.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akun = Account::all();
        return view('pages.jp.create', compact('akun'));
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
            'kode' => 'unique:jurnalpenyesuaians,kode|required',
        ],$messages);

        //insert data cashbank
        $dataJurnalpenyesuaian          = $request->only('id','tanggal', 'kode', 'description');
        $Jurnalpenyesuaian              = Jurnalpenyesuaian::create($dataJurnalpenyesuaian);

        //insert data cashbank detail
        $detailJurnalpenyesuaian                 = $request->only('nomor_akun', 'nama_akun', 'debet', 'kredit');
        $countKasBank = count($detailJurnalpenyesuaian['nomor_akun']);

        for ($a=0; $a < $countKasBank; $a++) { 
            $detail                     = new jurnalpenyesuaiandetail();
            $detail->jurnalpenyesuaians_id      = $Jurnalpenyesuaian->id;
            $detail->nomor_akun         = $detailJurnalpenyesuaian['nomor_akun'][$a];
            $detail->nama_akun               = $detailJurnalpenyesuaian['nama_akun'][$a];
            $detail->debet              = $detailJurnalpenyesuaian['debet'][$a];
            $detail->kredit             = $detailJurnalpenyesuaian['kredit'][$a];
            $detail->save();
        }

        return redirect('/jp')->with('Success', 'Data anda telah berhasil di Input !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = jurnalpenyesuaiandetail::where('jurnalpenyesuaians_id', $id)->get();
        return view('pages.jp.show', compact('detail'));
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
        $cashbanks     = Jurnalpenyesuaian::find($id);
        $details        = jurnalpenyesuaiandetail::where('jurnalpenyesuaians_id', $id)->get();
        return view('pages.jp.edit', compact('akun', 'cashbanks', 'details'));
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
            'kode' => 'unique:jurnalpenyesuaians,kode,'.$id,
        ],$messages);

        //insert data cashbank
        $dataJurnalpenyesuaian          = $request->only('id','tanggal', 'kode', 'description');
        $Jurnalpenyesuaian              = Jurnalpenyesuaian::find($id)->update($dataJurnalpenyesuaian);


        //insert data cashbank detail
        $detailJurnalpenyesuaian        = $request->only('nomor_akun', 'nama_akun', 'debet', 'kredit');
        $countKasBank                   = count($detailJurnalpenyesuaian['nomor_akun']);

        jurnalpenyesuaiandetail::where('jurnalpenyesuaians_id', $id)->delete();

        for ($a=0; $a < $countKasBank; $a++) { 
            $detail                     = new jurnalpenyesuaiandetail();
            $detail->jurnalpenyesuaians_id      = $id;
            $detail->nomor_akun         = $detailJurnalpenyesuaian['nomor_akun'][$a];
            $detail->nama_akun               = $detailJurnalpenyesuaian['nama_akun'][$a];
            $detail->debet              = $detailJurnalpenyesuaian['debet'][$a];
            $detail->kredit             = $detailJurnalpenyesuaian['kredit'][$a];
            $detail->save();
        }

        return redirect('/jp')->with('Success', 'Data anda telah berhasil di Input !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jurnalpenyesuaian::find($id)->delete();
        return redirect('/jp')->with('Success', 'Data anda telah berhasil di Hapus !');
    }
}
