<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\crj;
use App\Model\Account;
use App\Model\DataCustomer;
use App\Model\Item;
use App\Model\crjdetail;
use App\Model\ReturPenjualan;
use App\Model\Inventory;
use App\Model\ReturPenjualanDetail;
use App\Model\LaporanPenjualan;
use App\Model\LaporanBukuBesar;
use App\Model\LaporanBukuBesarPenyesuaian;
use App\Model\HargaJual;
use App\Model\PemetaanAkun;

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
        $data           = crj::orderBy('id', 'desc')->get();
        $inventories    = Inventory::get();
        $items          = Item::all();
        return view('pages.crj.index', compact('data', 'inventories', 'items', 'inventoriess', 'itemss'));
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
        $hargajuals = HargaJual::all();
        $pemetaan_akuns = PemetaanAkun::first();
        $lastOrder = crj::orderBy('id', 'desc')->first();
        $inventories = Inventory::distinct('items_id')->select('id', 'items_id', 'price', 'total', 'unit')->get();

        return view('pages.crj.create', compact('akun', 'customers', 'items', 'inventories', 'hargajuals', 'pemetaan_akuns', 'lastOrder'));
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
        $detailcrj                 = $request->only('nomor_akun2', 'nama_akun2','nomor_akun_sales', 'nama_akun2_sales', 'nomor_akun_jasa', 'nama_akun2_jasa',  'nomor_akun_ppn', 'nama_akun2_ppn', 'nomor_akun_inventory', 'nama_akun2_inventory', 'nomor_akun_cost', 'nama_akun2_cost', 'cost', 'nomor_akun_diskon', 'nama_akun2_diskon', 'jasa_pengiriman', 'PPN', 'subtotal', 'total', 'diskon');
        $countKasBank1 = count($detailcrj['total']);
        $countKasBank2 = count($detailcrj['subtotal']);
        $countKasBank3 = count($detailcrj['PPN']);
        $countKasBank4 = count($detailcrj['jasa_pengiriman']);
        $countKasBank5 = count($detailcrj['cost']);
        $countKasBank6 = count($detailcrj['diskon']);

        for ($a=0; $a < $countKasBank1; $a++) {
            $detail                     = new crjdetail();
            $detail->crj_id             = $crj->id;
            $detail->nomor_akun         = $detailcrj['nomor_akun2'][$a];
            $detail->nama_akun          = $detailcrj['nama_akun2'][$a];
            $detail->debet              = $detailcrj['total'][$a];
            $detail->save();

            //insert Laporan Buku Besar
            $detail                     = new LaporanBukuBesar();
            $detail->crj_id             = $crj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun2'][$a];
            $detail->debet             = $detailcrj['total'][$a];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail                     = new LaporanBukuBesarPenyesuaian();
            $detail->crj_id             = $crj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun2'][$a];
            $detail->debet             = $detailcrj['total'][$a];
            $detail->save();
        }
        for ($a=0; $a < $countKasBank6; $a++) {
            $detail                     = new crjdetail();
            $detail->crj_id             = $crj->id;
            $detail->nomor_akun         = $detailcrj['nomor_akun_diskon'][$a];
            $detail->nama_akun          = $detailcrj['nama_akun2_diskon'][$a];
            $detail->debet              = $detailcrj['diskon'][$a];
            $detail->save();

            //insert Laporan Buku Besar
            $detail                     = new LaporanBukuBesar();
            $detail->crj_id             = $crj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_diskon'][$a];
            $detail->debet             = $detailcrj['diskon'][$a];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail                     = new LaporanBukuBesarPenyesuaian();
            $detail->crj_id             = $crj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_diskon'][$a];
            $detail->debet             = $detailcrj['diskon'][$a];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank5; $i++) {
            $detail                     = new crjdetail();
            $detail->crj_id             = $crj->id;
            $detail->nomor_akun         = $detailcrj['nomor_akun_cost'][$i];
            $detail->nama_akun          = $detailcrj['nama_akun2_cost'][$i];
            $detail->debet             = $detailcrj['cost'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail                     = new LaporanBukuBesar();
            $detail->crj_id             = $crj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_cost'][$i];
            $detail->debet             = $detailcrj['cost'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail                     = new LaporanBukuBesarPenyesuaian();
            $detail->crj_id             = $crj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_cost'][$i];
            $detail->debet             = $detailcrj['cost'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank2; $i++) {
            $detail                     = new crjdetail();
            $detail->crj_id             = $crj->id;
            $detail->nomor_akun         = $detailcrj['nomor_akun_sales'][$i];
            $detail->nama_akun          = $detailcrj['nama_akun2_sales'][$i];
            $detail->kredit             = $detailcrj['subtotal'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail                     = new LaporanBukuBesar();
            $detail->crj_id             = $crj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_sales'][$i];
            $detail->kredit             = $detailcrj['subtotal'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail                     = new LaporanBukuBesarPenyesuaian();
            $detail->crj_id             = $crj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_sales'][$i];
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

            //insert Laporan Buku Besar
            $detail                     = new LaporanBukuBesar();
            $detail->crj_id             = $crj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_ppn'][$i];
            $detail->kredit             = $detailcrj['PPN'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail                     = new LaporanBukuBesarPenyesuaian();
            $detail->crj_id             = $crj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_ppn'][$i];
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

            //insert Laporan Buku Besar
            $detail                     = new LaporanBukuBesar();
            $detail->crj_id             = $crj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_jasa'][$i];
            $detail->kredit             = $detailcrj['jasa_pengiriman'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail                     = new LaporanBukuBesarPenyesuaian();
            $detail->crj_id             = $crj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_jasa'][$i];
            $detail->kredit             = $detailcrj['jasa_pengiriman'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank5; $i++) {
            $detail                     = new crjdetail();
            $detail->crj_id             = $crj->id;
            $detail->nomor_akun         = $detailcrj['nomor_akun_inventory'][$i];
            $detail->nama_akun          = $detailcrj['nama_akun2_inventory'][$i];
            $detail->kredit             = $detailcrj['cost'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail                     = new LaporanBukuBesar();
            $detail->crj_id             = $crj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_inventory'][$i];
            $detail->kredit             = $detailcrj['cost'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail                     = new LaporanBukuBesarPenyesuaian();
            $detail->crj_id             = $crj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_inventory'][$i];
            $detail->kredit             = $detailcrj['cost'][$i];
            $detail->save();
        }

        //insert data Laporan Penjualan
        for ($b=0; $b < $countKasBank1; $b++) {
            $detail = new LaporanPenjualan();
            $detail->crj_id = $crj->id;
            $detail->total = $detailcrj['total'][$b];
            $detail->save();
        }

        //insert data Inventory
        $inventory                 = $request->only('items', 'unit','harga', 'harga_jual', 'status', 'sales');
        $countinventory1 = count($inventory['harga_jual']);

        for ($x=0; $x < $countinventory1; $x++) {
            $detail                     = new Inventory();
            $detail->crj_id             = $crj->id;
            $detail->tanggal = $request->tanggal;
            $detail->items_id           = $inventory['items'][$x];
            $detail->status             = $inventory['status'][$x];
            $detail->unit               = $inventory['unit'][$x];
            $detail->price              = $inventory['harga'][$x];
            $detail->total              = $inventory['sales'][$x];
            $detail->sales              = $inventory['harga_jual'][$x];
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

        $akun = Account::all();
        $customers = DataCustomer::all();
        $items = Item::all();
        $cashbanks = crj::find($id);
        $crjdetails = crjdetail::all();
        $debets = crjdetail::where('crj_id', $id)->where('kredit', null)->first();
        $inventories = Inventory::where('crj_id', $id)->get();
        $inventoriess = Inventory::distinct('items_id')->select('id', 'items_id', 'price', 'total', 'unit')->get();
        $Item_count = Item::all()->count();
        $jasa = crjdetail::where('crj_id', $id)->where('nomor_akun', '4-2200')->first();
        $diskon = crjdetail::where('crj_id', $id)->where('nomor_akun', '4-2400')->first();
        $ppn = crjdetail::where('crj_id', $id)
                                    ->where('nomor_akun', '2-1310')
                                    ->where('kredit', '>', '0')
                                    ->exists();
        $hargajuals = HargaJual::all();
        $pemetaan_akuns = PemetaanAkun::first();
        // dd($ppn);
        return view('pages.crj.edit', compact('akun', 'customers', 'items', 'cashbanks', 'debets', 'inventories', 'crjdetails', 'jasa', 'ppn', 'inventoriess', 'Item_count', 'hargajuals', 'diskon', 'pemetaan_akuns'));
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
            'customers_id' => 'required',
            'description' => 'required',
            'kode' => 'unique:crjs,kode,'.$id,
        ],$messages);

        //insert data crj
        $dataCRJ          = $request->only('id','tanggal', 'kode', 'customers_id', 'description');
        $crj              = crj::find($id)->update($dataCRJ);

        //insert data crj detail
        $detailcrj                 = $request->only('nomor_akun2', 'nama_akun2','nomor_akun_sales', 'nama_akun2_sales', 'nomor_akun_jasa', 'nama_akun2_jasa',  'nomor_akun_ppn', 'nama_akun2_ppn', 'nomor_akun_inventory', 'nama_akun2_inventory', 'nomor_akun_cost', 'nama_akun2_cost', 'cost', 'nomor_akun_diskon', 'nama_akun2_diskon', 'jasa_pengiriman', 'PPN', 'subtotal', 'total', 'diskon');
        $countKasBank1 = count($detailcrj['total']);
        $countKasBank2 = count($detailcrj['subtotal']);
        $countKasBank3 = count($detailcrj['PPN']);
        $countKasBank4 = count($detailcrj['jasa_pengiriman']);
        $countKasBank5 = count($detailcrj['cost']);
        $countKasBank6 = count($detailcrj['diskon']);

        crjdetail::where('crj_id', $id)->delete();
        LaporanBukuBesar::where('crj_id', $id)->delete();
        LaporanBukuBesarPenyesuaian::where('crj_id', $id)->delete();

        for ($a=0; $a < $countKasBank1; $a++) {
            $detail = new crjdetail();
            $detail->crj_id = $id;
            $detail->nomor_akun = $detailcrj['nomor_akun2'][$a];
            $detail->nama_akun  = $detailcrj['nama_akun2'][$a];
            $detail->debet = $detailcrj['total'][$a];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->crj_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailcrj['nomor_akun2'][$a];
            $detail->debet = $detailcrj['total'][$a];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->crj_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailcrj['nomor_akun2'][$a];
            $detail->debet = $detailcrj['total'][$a];
            $detail->save();
        }
        for ($a=0; $a < $countKasBank6; $a++) {
            $detail = new crjdetail();
            $detail->crj_id = $id;
            $detail->nomor_akun = $detailcrj['nomor_akun_diskon'][$a];
            $detail->nama_akun = $detailcrj['nama_akun2_diskon'][$a];
            $detail->debet  = $detailcrj['diskon'][$a];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->crj_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailcrj['nomor_akun_diskon'][$a];
            $detail->debet = $detailcrj['diskon'][$a];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->crj_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailcrj['nomor_akun_diskon'][$a];
            $detail->debet = $detailcrj['diskon'][$a];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank5; $i++) {
            $detail = new crjdetail();
            $detail->crj_id             = $id;
            $detail->nomor_akun         = $detailcrj['nomor_akun_cost'][$i];
            $detail->nama_akun          = $detailcrj['nama_akun2_cost'][$i];
            $detail->debet             = $detailcrj['cost'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->crj_id             = $id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_cost'][$i];
            $detail->debet             = $detailcrj['cost'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->crj_id             = $id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_cost'][$i];
            $detail->debet             = $detailcrj['cost'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank2; $i++) {
            $detail = new crjdetail();
            $detail->crj_id             = $id;
            $detail->nomor_akun         = $detailcrj['nomor_akun_sales'][$i];
            $detail->nama_akun          = $detailcrj['nama_akun2_sales'][$i];
            $detail->kredit             = $detailcrj['subtotal'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->crj_id             = $id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_sales'][$i];
            $detail->kredit             = $detailcrj['subtotal'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->crj_id             = $id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_sales'][$i];
            $detail->kredit             = $detailcrj['subtotal'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank3; $i++) {
            $detail = new crjdetail();
            $detail->crj_id             = $id;
            $detail->nomor_akun         = $detailcrj['nomor_akun_ppn'][$i];
            $detail->nama_akun          = $detailcrj['nama_akun2_ppn'][$i];
            $detail->kredit             = $detailcrj['PPN'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->crj_id             = $id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_ppn'][$i];
            $detail->kredit             = $detailcrj['PPN'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->crj_id             = $id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_ppn'][$i];
            $detail->kredit             = $detailcrj['PPN'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank4; $i++) {
            $detail = new crjdetail();
            $detail->crj_id             = $id;
            $detail->nomor_akun         = $detailcrj['nomor_akun_jasa'][$i];
            $detail->nama_akun          = $detailcrj['nama_akun2_jasa'][$i];
            $detail->kredit             = $detailcrj['jasa_pengiriman'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->crj_id             = $id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_jasa'][$i];
            $detail->kredit             = $detailcrj['jasa_pengiriman'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->crj_id             = $id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_jasa'][$i];
            $detail->kredit             = $detailcrj['jasa_pengiriman'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank5; $i++) {
            $detail = new crjdetail();
            $detail->crj_id             = $id;
            $detail->nomor_akun         = $detailcrj['nomor_akun_inventory'][$i];
            $detail->nama_akun          = $detailcrj['nama_akun2_inventory'][$i];
            $detail->kredit             = $detailcrj['cost'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->crj_id             = $id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_inventory'][$i];
            $detail->kredit             = $detailcrj['cost'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->crj_id             = $id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcrj['nomor_akun_inventory'][$i];
            $detail->kredit             = $detailcrj['cost'][$i];
            $detail->save();
        }

        LaporanPenjualan::where('crj_id', $id)->delete();
        //insert data Laporan Penjualan
        for ($b=0; $b < $countKasBank1; $b++) {
            $detail = new LaporanPenjualan();
            $detail->crj_id = $id;
            $detail->total = $detailcrj['total'][$b];
            $detail->save();
        }

        Inventory::where('crj_id', $id)->delete();
        //insert data Inventory
        $inventory                 = $request->only('items', 'unit','harga', 'harga_jual', 'status', 'sales');
        $countinventory1 = count($inventory['harga_jual']);

        for ($x=0; $x < $countinventory1; $x++) {
            $detail                     = new Inventory();
            $detail->tanggal = $request->tanggal;
            $detail->crj_id             = $id;
            $detail->items_id           = $inventory['items'][$x];
            $detail->status             = $inventory['status'][$x];
            $detail->unit               = $inventory['unit'][$x];
            $detail->price              = $inventory['harga'][$x];
            $detail->total              = $inventory['sales'][$x];
            $detail->sales              = $inventory['harga_jual'][$x];
            $detail->save();
        }
        return redirect('/crj')->with('Success', 'Data anda telah berhasil di Edit !');
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

    public function retur($id)
    {

        $akun           = Account::all();
        $customers      = DataCustomer::all();
        $items          = Item::all();
        $cashbanks      = crj::find($id);
        $crjdetails     = crjdetail::all();
        $lastOrder      = ReturPenjualan::orderBy('id', 'desc')->first();
        $debets         = crjdetail::where('crj_id', $id)->where('kredit', null)->first();
        $inventories    = Inventory::where('crj_id', $id)->get();
        $inventoriess   = Inventory::distinct('items_id')->select('id', 'items_id', 'price', 'total', 'unit')->get();
        $Item_count         = Item::all()->count();
        $jasa           = crjdetail::where('crj_id', $id)->where('nomor_akun', '4-2200')->first();
        $diskon = crjdetail::where('crj_id', $id)->where('nomor_akun', '4-2400')->first();
        $ppn            = crjdetail::where('crj_id', $id)
                                    ->where('nomor_akun', '2-1310')
                                    ->where('kredit', '>', '0')
                                    ->exists();
        $hargajuals = HargaJual::all();
        $pemetaan_akuns = PemetaanAkun::first();
        // dd($ppn);
        return view('pages.crj.retur', compact('akun', 'customers', 'items', 'cashbanks', 'debets', 'inventories', 'crjdetails', 'jasa', 'ppn', 'inventoriess', 'Item_count', 'lastOrder', 'hargajuals', 'diskon', 'pemetaan_akuns'));
    }
}
