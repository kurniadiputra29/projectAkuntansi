<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ReturPembelian;
use App\Model\Account;
use App\Model\DataSupplier;
use App\Model\Item;

class ReturPembelianController extends Controller
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
      $data = ReturPembelian::orderBy('created_at', 'desc')->get();
      return view('pages.retur_pembelian.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akun = Account::all();
        $suppliers = DataSupplier::all();
        $items = Item::all();
        return view('pages.retur_pembelian.create', compact('akun', 'suppliers', 'items'));
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
          'kode'          => 'unique:retur_pembelians,kode|required',
      ],$messages);

      //insert data retur_pembelian
      $dataReturPembelian          = $request->only('id','tanggal', 'kode', 'customers_id', 'description');
      $ReturPembelian              = ReturPembelian::create($dataReturPembelian);

      //insert data retur_pembelian detail
      $detailReturPembelian        = $request->only('nomor_akun2', 'nama_akun2','nomor_akun_sales', 'nama_akun2_sales', 'nomor_akun_jasa', 'nama_akun2_jasa',  'nomor_akun_ppn', 'nama_akun2_ppn', 'jasa_pengiriman', 'PPN', 'subtotal', 'total');
      $countKasBank1 = count($detailReturPembelian['total']);
      $countKasBank2 = count($detailReturPembelian['subtotal']);
      $countKasBank3 = count($detailReturPembelian['PPN']);
      $countKasBank4 = count($detailReturPembelian['jasa_pengiriman']);

      for ($a=0; $a < $countKasBank1; $a++) {
          $detail                     = new ReturPembelianDetail();
          $detail->retur_pembelian_id = $ReturPembelian->id;
          $detail->nomor_akun         = $detailReturPembelian['nomor_akun2'][$a];
          $detail->nama_akun          = $detailReturPembelian['nama_akun2'][$a];
          $detail->debet              = $detailReturPembelian['total'][$a];
          $detail->save();
      }
      for ($i=0; $i < $countKasBank2; $i++) {
          $detail                     = new ReturPembelianDetail();
          $detail->retur_pembelian_id = $ReturPembelian->id;
          $detail->nomor_akun         = $detailReturPembelian['nomor_akun_sales'][$i];
          $detail->nama_akun          = $detailReturPembelian['nama_akun2_sales'][$i];
          $detail->kredit             = $detailReturPembelian['subtotal'][$i];
          $detail->save();
      }
      for ($i=0; $i < $countKasBank3; $i++) {
          $detail                     = new ReturPembelianDetail();
          $detail->retur_pembelian_id = $ReturPembelian->id;
          $detail->nomor_akun         = $detailReturPembelian['nomor_akun_ppn'][$i];
          $detail->nama_akun          = $detailReturPembelian['nama_akun2_ppn'][$i];
          $detail->kredit             = $detailReturPembelian['PPN'][$i];
          $detail->save();
      }
      for ($i=0; $i < $countKasBank4; $i++) {
          $detail                     = new ReturPembelianDetail();
          $detail->retur_pembelian_id = $ReturPembelian->id;
          $detail->nomor_akun         = $detailReturPembelian['nomor_akun_jasa'][$i];
          $detail->nama_akun          = $detailReturPembelian['nama_akun2_jasa'][$i];
          $detail->kredit             = $detailReturPembelian['jasa_pengiriman'][$i];
          $detail->save();
      }

      return redirect('/retur_pembelian')->with('Success', 'Data anda telah berhasil di Input !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = ReturPembelianDetail::where('retur_pembelian_id', $id)->get();
        return view('pages.retur_pembelian.show', compact('detail'));
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
      ReturPembelian::find($id)->delete();
      return redirect('/retur_pembelian')->with('Success', 'Data anda telah berhasil di Hapus !');
    }
}
