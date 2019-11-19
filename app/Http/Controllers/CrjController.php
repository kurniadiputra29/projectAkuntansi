<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\crj;
use App\Model\Account;
use App\Model\DataCustomer;
use App\Model\Item;
use App\Model\crjdetail;

class CrjController extends Controller
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
        $data = crj::orderBy('created_at', 'desc')->get();
        return view('pages.crj.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akun = Account::all();
        $customers = DataCustomer::all();
        $items = Item::all();
        return view('pages.crj.create', compact('akun', 'customers', 'items'));
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
            'customers_id' => 'required',
            'description' => 'required',
            'kode' => 'unique:crjs,kode|required',
        ],$messages);

        //insert data crj
        $dataCRJ          = $request->only('id','tanggal', 'kode', 'customers_id', 'description');
        $crj              = crj::create($dataCRJ);

        //insert data crj detail
        $detailcrj                 = $request->only('nomor_akun2', 'nama_akun2','nomor_akun_sales', 'nama_akun2_sales', 'nomor_akun_jasa', 'nama_akun2_jasa',  'nomor_akun_ppn', 'nama_akun2_ppn', 'jasa_pengiriman', 'PPN', 'subtotal', 'total');
        $countKasBank1 = count($detailcrj['total']);
        $countKasBank2 = count($detailcrj['subtotal']);
        $countKasBank3 = count($detailcrj['PPN']);
        $countKasBank4 = count($detailcrj['jasa_pengiriman']);

        for ($a=0; $a < $countKasBank1; $a++) { 
            $detail                     = new crjdetail();
            $detail->crj_id             = $crj->id;
            $detail->nomor_akun         = $detailcrj['nomor_akun2'][$a];
            $detail->nama_akun          = $detailcrj['nama_akun2'][$a];
            $detail->debet              = $detailcrj['total'][$a];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank2; $i++) { 
            $detail                     = new crjdetail();
            $detail->crj_id             = $crj->id;
            $detail->nomor_akun         = $detailcrj['nomor_akun_sales'][$i];
            $detail->nama_akun          = $detailcrj['nama_akun2_sales'][$i];
            $detail->kredit             = $detailcrj['subtotal'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank3; $i++) { 
            $detail                     = new crjdetail();
            $detail->crj_id             = $crj->id;
            $detail->nomor_akun         = $detailcrj['nomor_akun_ppn'][$i];
            $detail->nama_akun          = $detailcrj['nama_akun2_ppn'][$i];
            $detail->kredit             = $detailcrj['PPN'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank4; $i++) { 
            $detail                     = new crjdetail();
            $detail->crj_id             = $crj->id;
            $detail->nomor_akun         = $detailcrj['nomor_akun_jasa'][$i];
            $detail->nama_akun          = $detailcrj['nama_akun2_jasa'][$i];
            $detail->kredit             = $detailcrj['jasa_pengiriman'][$i];
            $detail->save();
        }

        return redirect('/crj')->with('Success', 'Data anda telah berhasil di Input !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = crjdetail::where('crj_id', $id)->get();
        return view('pages.crj.show', compact('detail'));
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
        crj::find($id)->delete();
        return redirect('/crj')->with('Success', 'Data anda telah berhasil di Hapus !');
    }
}
