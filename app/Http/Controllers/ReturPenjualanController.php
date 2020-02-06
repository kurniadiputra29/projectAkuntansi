<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ReturPenjualan;
use App\Model\ReturPenjualanDetail;
use App\Model\Account;
use App\Model\DataCustomer;
use App\Model\Item;
use App\Model\Inventory;
use App\Model\LaporanPenjualan;
use App\Model\LaporanBukuBesar;
use App\Model\LaporanBukuBesarPenyesuaian;
use App\Model\HargaJual;

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
    $akun             = Account::all();
    $customers        = DataCustomer::all();
    $items            = Item::all();
    $lastOrder      = ReturPenjualan::orderBy('id', 'desc')->first();
    return view('pages.retur_penjualan.create', compact('akun', 'customers', 'items', 'lastOrder'));
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
    $dataReturPenjualan          = $request->only('id','tanggal', 'kode', 'customers_id', 'crj_id', 'salesjournal_id', 'description');
    $ReturPenjualan              = ReturPenjualan::create($dataReturPenjualan);

//insert data retur_penjualan detail
    $detailReturPenjualan        = $request->only('nomor_akun2', 'nama_akun2','nomor_akun_sales', 'nama_akun2_sales', 'nomor_akun_jasa', 'nama_akun2_jasa',  'nomor_akun_ppn', 'nama_akun2_ppn', 'nomor_akun_inventory', 'nama_akun2_inventory', 'nomor_akun_cost', 'nama_akun2_cost', 'nomor_akun_diskon', 'nama_akun2_diskon', 'cost', 'jasa_pengiriman', 'PPN', 'subtotal', 'total', 'diskon');
    $countKasBank1 = count($detailReturPenjualan['total']);
    $countKasBank2 = count($detailReturPenjualan['subtotal']);
    $countKasBank3 = count($detailReturPenjualan['PPN']);
    $countKasBank4 = count($detailReturPenjualan['jasa_pengiriman']);
    $countKasBank5 = count($detailReturPenjualan['cost']);
    if ($request->diskon !== null) {
    $countKasBank6 = count($detailReturPenjualan['diskon']);
    }
    for ($a=0; $a < $countKasBank1; $a++) {
        $detail = new ReturPenjualanDetail();
        $detail->retur_penjualan_id = $ReturPenjualan->id;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun2'][$a];
        $detail->nama_akun = $detailReturPenjualan['nama_akun2'][$a];
        $detail->kredit = $detailReturPenjualan['total'][$a];
        $detail->save();

        //insert Laporan Buku Besar
        $detail = new LaporanBukuBesar();
        $detail->retur_penjualan_id = $ReturPenjualan->id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun2'][$a];
        $detail->kredit = $detailReturPenjualan['total'][$a];
        $detail->save();

        //insert Laporan Buku Besar Penyesuaian
        $detail = new LaporanBukuBesarPenyesuaian();
        $detail->retur_penjualan_id = $ReturPenjualan->id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun2'][$a];
        $detail->kredit = $detailReturPenjualan['total'][$a];
        $detail->save();
    }
    if ($request->diskon !== null) {
        for ($a=0; $a < $countKasBank6; $a++) {
            $detail = new ReturPenjualanDetail();
            $detail->retur_penjualan_id = $ReturPenjualan->id;
            $detail->nomor_akun = $detailReturPenjualan['nomor_akun_diskon'][$a];
            $detail->nama_akun = $detailReturPenjualan['nama_akun2_diskon'][$a];
            $detail->kredit = $detailReturPenjualan['diskon'][$a];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->retur_penjualan_id = $ReturPenjualan->id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailReturPenjualan['nomor_akun_diskon'][$a];
            $detail->kredit = $detailReturPenjualan['diskon'][$a];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->retur_penjualan_id = $ReturPenjualan->id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailReturPenjualan['nomor_akun_diskon'][$a];
            $detail->kredit = $detailReturPenjualan['diskon'][$a];
            $detail->save();
        }
    }
    for ($i=0; $i < $countKasBank5; $i++) {
        $detail = new ReturPenjualanDetail();
        $detail->retur_penjualan_id = $ReturPenjualan->id;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_cost'][$i];
        $detail->nama_akun = $detailReturPenjualan['nama_akun2_cost'][$i];
        $detail->kredit = $detailReturPenjualan['cost'][$i];
        $detail->save();

        //insert Laporan Buku Besar
        $detail = new LaporanBukuBesar();
        $detail->retur_penjualan_id = $ReturPenjualan->id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_cost'][$i];
        $detail->kredit = $detailReturPenjualan['cost'][$i];
        $detail->save();

        //insert Laporan Buku Besar Penyesuaian
        $detail = new LaporanBukuBesarPenyesuaian();
        $detail->retur_penjualan_id = $ReturPenjualan->id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_cost'][$i];
        $detail->kredit = $detailReturPenjualan['cost'][$i];
        $detail->save();
    }
    for ($i=0; $i < $countKasBank2; $i++) {
        $detail = new ReturPenjualanDetail();
        $detail->retur_penjualan_id = $ReturPenjualan->id;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_sales'][$i];
        $detail->nama_akun = $detailReturPenjualan['nama_akun2_sales'][$i];
        $detail->debet = $detailReturPenjualan['subtotal'][$i];
        $detail->save();

        //insert Laporan Buku Besar
        $detail = new LaporanBukuBesar();
        $detail->retur_penjualan_id = $ReturPenjualan->id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_sales'][$i];
        $detail->debet = $detailReturPenjualan['subtotal'][$i];
        $detail->save();

        //insert Laporan Buku Besar Penyesuaian
        $detail = new LaporanBukuBesarPenyesuaian();
        $detail->retur_penjualan_id = $ReturPenjualan->id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_sales'][$i];
        $detail->debet = $detailReturPenjualan['subtotal'][$i];
        $detail->save();
    }
    for ($i=0; $i < $countKasBank3; $i++) {
        $detail = new ReturPenjualanDetail();
        $detail->retur_penjualan_id = $ReturPenjualan->id;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_ppn'][$i];
        $detail->nama_akun = $detailReturPenjualan['nama_akun2_ppn'][$i];
        $detail->debet = $detailReturPenjualan['PPN'][$i];
        $detail->save();

        //insert Laporan Buku Besar
        $detail = new LaporanBukuBesar();
        $detail->retur_penjualan_id = $ReturPenjualan->id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_ppn'][$i];
        $detail->debet = $detailReturPenjualan['PPN'][$i];
        $detail->save();

        //insert Laporan Buku Besar Penyesuaian
        $detail = new LaporanBukuBesarPenyesuaian();
        $detail->retur_penjualan_id = $ReturPenjualan->id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_ppn'][$i];
        $detail->debet = $detailReturPenjualan['PPN'][$i];
        $detail->save();
    }
    for ($i=0; $i < $countKasBank4; $i++) {
        $detail = new ReturPenjualanDetail();
        $detail->retur_penjualan_id = $ReturPenjualan->id;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_jasa'][$i];
        $detail->nama_akun = $detailReturPenjualan['nama_akun2_jasa'][$i];
        $detail->debet = $detailReturPenjualan['jasa_pengiriman'][$i];
        $detail->save();

        //insert Laporan Buku Besar
        $detail = new LaporanBukuBesar();
        $detail->retur_penjualan_id = $ReturPenjualan->id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_jasa'][$i];
        $detail->debet = $detailReturPenjualan['jasa_pengiriman'][$i];
        $detail->save();

        //insert Laporan Buku Besar Penyesuaian
        $detail = new LaporanBukuBesarPenyesuaian();
        $detail->retur_penjualan_id = $ReturPenjualan->id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_jasa'][$i];
        $detail->debet = $detailReturPenjualan['jasa_pengiriman'][$i];
        $detail->save();
    }
    for ($i=0; $i < $countKasBank5; $i++) {
        $detail = new ReturPenjualanDetail();
        $detail->retur_penjualan_id = $ReturPenjualan->id;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_inventory'][$i];
        $detail->nama_akun = $detailReturPenjualan['nama_akun2_inventory'][$i];
        $detail->debet = $detailReturPenjualan['cost'][$i];
        $detail->save();

        //insert Laporan Buku Besar
        $detail = new LaporanBukuBesar();
        $detail->retur_penjualan_id = $ReturPenjualan->id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_inventory'][$i];
        $detail->debet = $detailReturPenjualan['cost'][$i];
        $detail->save();

        //insert Laporan Buku Besar Penyesuaian
        $detail = new LaporanBukuBesarPenyesuaian();
        $detail->retur_penjualan_id = $ReturPenjualan->id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_inventory'][$i];
        $detail->debet = $detailReturPenjualan['cost'][$i];
        $detail->save();
    }

    //insert data Laporan
    for ($b=0; $b < $countKasBank1; $b++) {
        $detail = new LaporanPenjualan();
        $detail->retur_penjualan_id   = $ReturPenjualan->id;
        $detail->total = $detailReturPenjualan['total'][$b];
        $detail->save();
    }

//insert data Inventory
   $inventory                 = $request->only('items', 'unit','harga', 'harga_jual', 'status', 'sales');
   $countinventory1 = count($inventory['harga_jual']);

   for ($x=0; $x < $countinventory1; $x++) {
    $detail                     = new Inventory();
    $detail->tanggal = $request->tanggal;
    $detail->retur_penjualan_id = $ReturPenjualan->id;
    $detail->items_id           = $inventory['items'][$x];
    $detail->status             = $inventory['status'][$x];
    $detail->unit               = $inventory['unit'][$x];
    $detail->price              = $inventory['harga'][$x];
    $detail->total              = $inventory['sales'][$x];
    $detail->sales              = $inventory['harga_jual'][$x];
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
    $akun           = Account::all();
    $customers      = DataCustomer::all();
    $items          = Item::all();
    $cashbanks      = ReturPenjualan::find($id);
    $kredits        = ReturPenjualanDetail::where('retur_penjualan_id', $id)->where('debet', null)->first();
    $inventories    = Inventory::where('retur_penjualan_id', $id)->get();
    $inventoriess   = Inventory::distinct('items_id')->select('id', 'items_id', 'price', 'total', 'unit')->get();
    $Item_count         = Item::all()->count();
    $jasa           = ReturPenjualanDetail::where('retur_penjualan_id', $id)->where('nomor_akun', '4-2200')->first();
    if (ReturPenjualanDetail::where('retur_penjualan_id', $id)->where('nomor_akun', '4-2400')->first() !== null) {
        $diskon = ReturPenjualanDetail::where('retur_penjualan_id', $id)->where('nomor_akun', '4-2400')->first();
    }
    $ppn            = ReturPenjualanDetail::where('retur_penjualan_id', $id)
    ->where('nomor_akun', '2-1310')
    ->where('debet', '>', '0')
    ->exists();
    $hargajuals = HargaJual::all();

    return view('pages.retur_penjualan.edit', compact('akun', 'customers', 'items', 'cashbanks', 'kredits', 'inventories', 'jasa', 'ppn', 'inventoriess', 'Item_count', 'hargajuals', 'diskon'));
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
        'required'  => ':attribute wajib diisi !!!',
        'unique'    => ':attribute harus diisi dengan syarat unique !!!',
    ];
    $this->validate($request,[
        'tanggal'       => 'required',
        'customers_id'  => 'required',
        'description'   => 'required',
        'kode'          => 'unique:retur_penjualans,kode,'.$id,
    ],$messages);

//insert data retur_penjualan
    $dataReturPenjualan          = $request->only('id','tanggal', 'kode', 'customers_id','crj_id', 'salesjournal_id', 'description');
    $ReturPenjualan              = ReturPenjualan::find($id)->update($dataReturPenjualan);

//insert data retur_penjualan detail
    $detailReturPenjualan        = $request->only('nomor_akun2', 'nama_akun2','nomor_akun_sales', 'nama_akun2_sales', 'nomor_akun_jasa', 'nama_akun2_jasa',  'nomor_akun_ppn', 'nama_akun2_ppn', 'nomor_akun_inventory', 'nama_akun2_inventory', 'nomor_akun_cost', 'nama_akun2_cost', 'nomor_akun_diskon', 'nama_akun2_diskon', 'cost', 'jasa_pengiriman', 'PPN', 'subtotal', 'total', 'diskon');
    $countKasBank1 = count($detailReturPenjualan['total']);
    $countKasBank2 = count($detailReturPenjualan['subtotal']);
    $countKasBank3 = count($detailReturPenjualan['PPN']);
    $countKasBank4 = count($detailReturPenjualan['jasa_pengiriman']);
    $countKasBank5 = count($detailReturPenjualan['cost']);
    if ($request->diskon !== null) {
    $countKasBank6 = count($detailReturPenjualan['diskon']);
    }

    ReturPenjualanDetail::where('retur_penjualan_id', $id)->delete();
    LaporanBukuBesar::where('retur_penjualan_id', $id)->delete();
    LaporanBukuBesarPenyesuaian::where('retur_penjualan_id', $id)->delete();

    for ($a=0; $a < $countKasBank1; $a++) {
        $detail = new ReturPenjualanDetail();
        $detail->retur_penjualan_id = $id;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun2'][$a];
        $detail->nama_akun = $detailReturPenjualan['nama_akun2'][$a];
        $detail->kredit = $detailReturPenjualan['total'][$a];
        $detail->save();

        //insert Laporan Buku Besar
        $detail = new LaporanBukuBesar();
        $detail->retur_penjualan_id = $id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun2'][$a];
        $detail->kredit = $detailReturPenjualan['total'][$a];
        $detail->save();

        //insert Laporan Buku Besar Penyesuaian
        $detail = new LaporanBukuBesarPenyesuaian();
        $detail->retur_penjualan_id = $id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun2'][$a];
        $detail->kredit = $detailReturPenjualan['total'][$a];
        $detail->save();
    }
    if ($request->diskon !== null) {
        for ($a=0; $a < $countKasBank6; $a++) {
            $detail = new ReturPenjualanDetail();
            $detail->retur_penjualan_id = $id;
            $detail->nomor_akun = $detailReturPenjualan['nomor_akun_diskon'][$a];
            $detail->nama_akun = $detailReturPenjualan['nama_akun2_diskon'][$a];
            $detail->kredit = $detailReturPenjualan['diskon'][$a];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->retur_penjualan_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailReturPenjualan['nomor_akun_diskon'][$a];
            $detail->kredit = $detailReturPenjualan['diskon'][$a];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->retur_penjualan_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailReturPenjualan['nomor_akun_diskon'][$a];
            $detail->kredit = $detailReturPenjualan['diskon'][$a];
            $detail->save();
        }
    }
    for ($i=0; $i < $countKasBank5; $i++) {
        $detail = new ReturPenjualanDetail();
        $detail->retur_penjualan_id = $id;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_cost'][$i];
        $detail->nama_akun = $detailReturPenjualan['nama_akun2_cost'][$i];
        $detail->kredit = $detailReturPenjualan['cost'][$i];
        $detail->save();

        //insert Laporan Buku Besar
        $detail = new LaporanBukuBesar();
        $detail->retur_penjualan_id = $id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_cost'][$i];
        $detail->kredit = $detailReturPenjualan['cost'][$i];
        $detail->save();

        //insert Laporan Buku Besar Penyesuaian
        $detail = new LaporanBukuBesarPenyesuaian();
        $detail->retur_penjualan_id = $id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_cost'][$i];
        $detail->kredit = $detailReturPenjualan['cost'][$i];
        $detail->save();
    }
    for ($i=0; $i < $countKasBank2; $i++) {
        $detail = new ReturPenjualanDetail();
        $detail->retur_penjualan_id = $id;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_sales'][$i];
        $detail->nama_akun = $detailReturPenjualan['nama_akun2_sales'][$i];
        $detail->debet = $detailReturPenjualan['subtotal'][$i];
        $detail->save();

        //insert Laporan Buku Besar
        $detail = new LaporanBukuBesar();
        $detail->retur_penjualan_id = $id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_sales'][$i];
        $detail->debet = $detailReturPenjualan['subtotal'][$i];
        $detail->save();

        //insert Laporan Buku Besar Penyesuaian
        $detail = new LaporanBukuBesarPenyesuaian();
        $detail->retur_penjualan_id = $id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_sales'][$i];
        $detail->debet = $detailReturPenjualan['subtotal'][$i];
        $detail->save();
    }
    for ($i=0; $i < $countKasBank3; $i++) {
        $detail = new ReturPenjualanDetail();
        $detail->retur_penjualan_id = $id;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_ppn'][$i];
        $detail->nama_akun = $detailReturPenjualan['nama_akun2_ppn'][$i];
        $detail->debet = $detailReturPenjualan['PPN'][$i];
        $detail->save();

        //insert Laporan Buku Besar
        $detail = new LaporanBukuBesar();
        $detail->retur_penjualan_id = $id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_ppn'][$i];
        $detail->debet = $detailReturPenjualan['PPN'][$i];
        $detail->save();

        //insert Laporan Buku Besar Penyesuaian
        $detail = new LaporanBukuBesarPenyesuaian();
        $detail->retur_penjualan_id = $id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_ppn'][$i];
        $detail->debet = $detailReturPenjualan['PPN'][$i];
        $detail->save();
    }
    for ($i=0; $i < $countKasBank4; $i++) {
        $detail = new ReturPenjualanDetail();
        $detail->retur_penjualan_id = $id;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_jasa'][$i];
        $detail->nama_akun = $detailReturPenjualan['nama_akun2_jasa'][$i];
        $detail->debet = $detailReturPenjualan['jasa_pengiriman'][$i];
        $detail->save();

        //insert Laporan Buku Besar
        $detail = new LaporanBukuBesar();
        $detail->retur_penjualan_id = $id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_jasa'][$i];
        $detail->debet = $detailReturPenjualan['jasa_pengiriman'][$i];
        $detail->save();

        //insert Laporan Buku Besar Penyesuaian
        $detail = new LaporanBukuBesarPenyesuaian();
        $detail->retur_penjualan_id = $id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_jasa'][$i];
        $detail->debet = $detailReturPenjualan['jasa_pengiriman'][$i];
        $detail->save();
    }
    for ($i=0; $i < $countKasBank5; $i++) {
        $detail = new ReturPenjualanDetail();
        $detail->retur_penjualan_id = $id;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_inventory'][$i];
        $detail->nama_akun = $detailReturPenjualan['nama_akun2_inventory'][$i];
        $detail->debet = $detailReturPenjualan['cost'][$i];
        $detail->save();

        //insert Laporan Buku Besar
        $detail = new LaporanBukuBesar();
        $detail->retur_penjualan_id = $id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_inventory'][$i];
        $detail->debet = $detailReturPenjualan['cost'][$i];
        $detail->save();

        //insert Laporan Buku Besar Penyesuaian
        $detail = new LaporanBukuBesarPenyesuaian();
        $detail->retur_penjualan_id = $id;
        $detail->tanggal = $request->tanggal;
        $detail->nomor_akun = $detailReturPenjualan['nomor_akun_inventory'][$i];
        $detail->debet = $detailReturPenjualan['cost'][$i];
        $detail->save();
    }

    LaporanPenjualan::where('retur_penjualan_id', $id)->delete();
//insert data Laporan
    for ($b=0; $b < $countKasBank1; $b++) {
        $detail = new LaporanPenjualan();
        $detail->retur_penjualan_id = $id;
        $detail->total = $detailReturPenjualan['total'][$b];
        $detail->save();
    }

   Inventory::where('retur_penjualan_id', $id)->delete();

//insert data Inventory
   $inventory                 = $request->only('items', 'unit','harga', 'harga_jual', 'status', 'sales');
   $countinventory1 = count($inventory['harga_jual']);

   for ($x=0; $x < $countinventory1; $x++) {
    $detail                     = new Inventory();
    $detail->tanggal = $request->tanggal;
    $detail->retur_penjualan_id = $id;
    $detail->items_id           = $inventory['items'][$x];
    $detail->status             = $inventory['status'][$x];
    $detail->unit               = $inventory['unit'][$x];
    $detail->price              = $inventory['harga'][$x];
    $detail->total              = $inventory['sales'][$x];
    $detail->sales              = $inventory['harga_jual'][$x];
    $detail->save();
}
return redirect('/retur_penjualan')->with('Success', 'Data anda telah berhasil di Edit !');
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
