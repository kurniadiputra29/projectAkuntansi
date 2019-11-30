<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ReturPenjualan;
use App\Model\ReturPenjualanDetail;
use App\Model\Account;
use App\Model\DataCustomer;
use App\Model\Item;

class ReturPenjualanController extends Controller
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
        $data = ReturPenjualan::orderBy('created_at', 'desc')->get();
        return view('pages.retur_penjualan.index', compact('data'));
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
        return view('pages.retur_penjualan.create', compact('akun', 'customers', 'items'));
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
          'required'  => ':attribute wajib diisi !!!',
          'unique'    => ':attribute harus diisi dengan syarat unique !!!',
      ];
      $this->validate($request,[
          'tanggal'       => 'required',
          'customers_id'  => 'required',
          'description'   => 'required',
          'kode'          => 'unique:retur_penjualans,kode|required',
      ],$messages);

      //insert data retur_penjualan
      $dataReturPenjualan          = $request->only('id','tanggal', 'kode', 'customers_id', 'description');
      $ReturPenjualan              = ReturPenjualan::create($dataReturPenjualan);

      //insert data retur_penjualan detail
      $detailReturPenjualan        = $request->only('nomor_akun2', 'nama_akun2','nomor_akun_sales', 'nama_akun2_sales', 'nomor_akun_jasa', 'nama_akun2_jasa',  'nomor_akun_ppn', 'nama_akun2_ppn', 'jasa_pengiriman', 'PPN', 'subtotal', 'total');
      $countKasBank1 = count($detailReturPenjualan['total']);
      $countKasBank2 = count($detailReturPenjualan['subtotal']);
      $countKasBank3 = count($detailReturPenjualan['PPN']);
      $countKasBank4 = count($detailReturPenjualan['jasa_pengiriman']);

      for ($a=0; $a < $countKasBank1; $a++) {
          $detail                     = new ReturPenjualanDetail();
          $detail->retur_penjualan_id = $ReturPenjualan->id;
          $detail->nomor_akun         = $detailReturPenjualan['nomor_akun2'][$a];
          $detail->nama_akun          = $detailReturPenjualan['nama_akun2'][$a];
          $detail->kredit             = $detailReturPenjualan['total'][$a];
          $detail->save();
      }
      for ($i=0; $i < $countKasBank2; $i++) {
          $detail                     = new ReturPenjualanDetail();
          $detail->retur_penjualan_id = $ReturPenjualan->id;
          $detail->nomor_akun         = $detailReturPenjualan['nomor_akun_sales'][$i];
          $detail->nama_akun          = $detailReturPenjualan['nama_akun2_sales'][$i];
          $detail->debet              = $detailReturPenjualan['subtotal'][$i];
          $detail->save();
      }
      for ($i=0; $i < $countKasBank3; $i++) {
          $detail                     = new ReturPenjualanDetail();
          $detail->retur_penjualan_id = $ReturPenjualan->id;
          $detail->nomor_akun         = $detailReturPenjualan['nomor_akun_ppn'][$i];
          $detail->nama_akun          = $detailReturPenjualan['nama_akun2_ppn'][$i];
          $detail->debet              = $detailReturPenjualan['PPN'][$i];
          $detail->save();
      }
      for ($i=0; $i < $countKasBank4; $i++) {
          $detail                     = new ReturPenjualanDetail();
          $detail->retur_penjualan_id = $ReturPenjualan->id;
          $detail->nomor_akun         = $detailReturPenjualan['nomor_akun_jasa'][$i];
          $detail->nama_akun          = $detailReturPenjualan['nama_akun2_jasa'][$i];
          $detail->debet              = $detailReturPenjualan['jasa_pengiriman'][$i];
          $detail->save();
      }

      return redirect('/retur_penjualan')->with('Success', 'Data anda telah berhasil di Input !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = ReturPenjualanDetail::where('retur_penjualan_id', $id)->get();
        return view('pages.retur_penjualan.show', compact('detail'));
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
      ReturPenjualan::find($id)->delete();
      return redirect('/retur_penjualan')->with('Success', 'Data anda telah berhasil di Hapus !');
    }
}
