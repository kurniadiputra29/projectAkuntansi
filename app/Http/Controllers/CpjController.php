<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\cpj;
use App\Model\cpjdetail;
use App\Model\Account;
use App\Model\DataSupplier;
use App\Model\Item;
use App\Model\Inventory;
use App\Model\ReturPembelian;
use App\Model\ReturPembelianDetail;
use App\Model\LaporanPembelian;
use App\Model\LaporanBukuBesar;
use App\Model\LaporanBukuBesarPenyesuaian;

class CpjController extends Controller
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
        $data = cpj::orderBy('created_at', 'desc')->get();
        return view('pages.cpj.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akun           = Account::all();
        $suppliers      = DataSupplier::all();
        $items          = Item::all();
        $lastOrder      = cpj::orderBy('id', 'desc')->first();

        $inventories   = Inventory::distinct('items_id')->select('id', 'items_id', 'price', 'total', 'unit')->get();
        return view('pages.cpj.create', compact('akun', 'suppliers', 'items', 'lastOrder', 'inventories'));
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
            'required'      => ':attribute wajib diisi !!!',
            'unique'        => ':attribute harus diisi dengan syarat unique !!!',
        ];
        $this->validate($request,[
            'tanggal'       => 'required',
            'suppliers_id'  => 'required',
            'description'   => 'required',
            'kode'          => 'unique:cpjs,kode|required',
        ],$messages);

        //insert data cpj
        $dataCPJ          = $request->only('id','tanggal', 'kode', 'suppliers_id', 'description');
        $cpj              = cpj::create($dataCPJ);

        //insert data cpj detail
        $detailcpj                 = $request->only('nomor_akun2', 'nama_akun2','nomor_akun_sales', 'nama_akun2_sales', 'nomor_akun_jasa', 'nama_akun2_jasa',  'nomor_akun_ppn', 'nama_akun2_ppn', 'jasa_pengiriman', 'PPN', 'subtotal', 'total');
        $countKasBank1 = count($detailcpj['total']);
        $countKasBank2 = count($detailcpj['subtotal']);
        $countKasBank3 = count($detailcpj['PPN']);
        $countKasBank4 = count($detailcpj['jasa_pengiriman']);

        for ($a=0; $a < $countKasBank1; $a++) {
            $detail                     = new cpjdetail();
            $detail->cpj_id             = $cpj->id;
            $detail->nomor_akun         = $detailcpj['nomor_akun2'][$a];
            $detail->nama_akun          = $detailcpj['nama_akun2'][$a];
            $detail->kredit             = $detailcpj['total'][$a];
            $detail->save();

            //insert Laporan Buku Besar
            $detail                     = new LaporanBukuBesar();
            $detail->cpj_id             = $cpj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcpj['nomor_akun2'][$a];
            $detail->kredit             = $detailcpj['total'][$a];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail                     = new LaporanBukuBesarPenyesuaian();
            $detail->cpj_id             = $cpj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcpj['nomor_akun2'][$a];
            $detail->kredit             = $detailcpj['total'][$a];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank2; $i++) {
            $detail                     = new cpjdetail();
            $detail->cpj_id             = $cpj->id;
            $detail->nomor_akun         = $detailcpj['nomor_akun_sales'][$i];
            $detail->nama_akun          = $detailcpj['nama_akun2_sales'][$i];
            $detail->debet              = $detailcpj['subtotal'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail                     = new LaporanBukuBesar();
            $detail->cpj_id             = $cpj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcpj['nomor_akun_sales'][$i];
            $detail->debet             = $detailcpj['subtotal'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail                     = new LaporanBukuBesarPenyesuaian();
            $detail->cpj_id             = $cpj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcpj['nomor_akun_sales'][$i];
            $detail->debet             = $detailcpj['subtotal'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank3; $i++) {
            $detail                     = new cpjdetail();
            $detail->cpj_id             = $cpj->id;
            $detail->nomor_akun         = $detailcpj['nomor_akun_ppn'][$i];
            $detail->nama_akun          = $detailcpj['nama_akun2_ppn'][$i];
            $detail->debet              = $detailcpj['PPN'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail                     = new LaporanBukuBesar();
            $detail->cpj_id             = $cpj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcpj['nomor_akun_ppn'][$i];
            $detail->debet             = $detailcpj['PPN'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail                     = new LaporanBukuBesarPenyesuaian();
            $detail->cpj_id             = $cpj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcpj['nomor_akun_ppn'][$i];
            $detail->debet             = $detailcpj['PPN'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank4; $i++) {
            $detail                     = new cpjdetail();
            $detail->cpj_id             = $cpj->id;
            $detail->nomor_akun         = $detailcpj['nomor_akun_jasa'][$i];
            $detail->nama_akun          = $detailcpj['nama_akun2_jasa'][$i];
            $detail->debet              = $detailcpj['jasa_pengiriman'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail                     = new LaporanBukuBesar();
            $detail->cpj_id             = $cpj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcpj['nomor_akun_jasa'][$i];
            $detail->debet             = $detailcpj['jasa_pengiriman'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail                     = new LaporanBukuBesarPenyesuaian();
            $detail->cpj_id             = $cpj->id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcpj['nomor_akun_jasa'][$i];
            $detail->debet             = $detailcpj['jasa_pengiriman'][$i];
            $detail->save();
        }

        //insert data Laporan Penjualan
        for ($b=0; $b < $countKasBank1; $b++) {
            $detail = new LaporanPembelian();
            $detail->cpj_id = $cpj->id;
            $detail->total = $detailcpj['total'][$b];
            $detail->save();
        }

        //insert data Inventory
        $inventory                 = $request->only('items', 'unit','harga', 'jumlah', 'status');
        $countinventory1 = count($inventory['jumlah']);

        for ($x=0; $x < $countinventory1; $x++) {
            $detail                     = new Inventory();
            $detail->tanggal = $request->tanggal;
            $detail->cpj_id             = $cpj->id;
            $detail->items_id           = $inventory['items'][$x];
            $detail->status             = $inventory['status'][$x];
            $detail->unit               = $inventory['unit'][$x];
            $detail->price              = $inventory['harga'][$x];
            $detail->total              = $inventory['jumlah'][$x];
            $detail->save();
        }
        return redirect('/cpj')->with('Success', 'Data anda telah berhasil di Input !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = cpjdetail::where('cpj_id', $id)->get();
        return view('pages.cpj.show', compact('detail'));
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
        $suppliers      = DataSupplier::all();
        $items          = Item::all();
        $cashbanks      = cpj::find($id);
        $inventories    = Inventory::where('cpj_id', $id)->get();
        $inventoriess   = Inventory::distinct('items_id')->select('id', 'items_id', 'price', 'total', 'unit')->get();
        $Item_count         = Item::all()->count();
        $kredits        = cpjdetail::where('cpj_id', $id)->where('debet', null)->get();
        $jasa           = cpjdetail::where('cpj_id', $id)->where('nomor_akun', '5-1300')->first();
        $ppn            = cpjdetail::where('cpj_id', $id)
                                    ->where('nomor_akun', '2-1320')
                                    ->where('debet', '>', '0')
                                    ->exists();

        return view('pages.cpj.edit', compact('akun', 'suppliers', 'items', 'cashbanks', 'inventories', 'kredits', 'jasa', 'ppn', 'inventoriess', 'Item_count'));
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
            'required'      => ':attribute wajib diisi !!!',
            'unique'        => ':attribute harus diisi dengan syarat unique !!!',
        ];
        $this->validate($request,[
            'tanggal'       => 'required',
            'suppliers_id'  => 'required',
            'description'   => 'required',
            'kode'          => 'unique:cpjs,kode,'.$id,
        ],$messages);

        //insert data cpj
        $dataCPJ          = $request->only('id','tanggal', 'kode', 'suppliers_id', 'description');
        $cpj              = cpj::find($id)->update($dataCPJ);

        //insert data cpj detail
        $detailcpj                 = $request->only('nomor_akun2', 'nama_akun2','nomor_akun_sales', 'nama_akun2_sales', 'nomor_akun_jasa', 'nama_akun2_jasa',  'nomor_akun_ppn', 'nama_akun2_ppn', 'jasa_pengiriman', 'PPN', 'subtotal', 'total');
        $countKasBank1 = count($detailcpj['total']);
        $countKasBank2 = count($detailcpj['subtotal']);
        $countKasBank3 = count($detailcpj['PPN']);
        $countKasBank4 = count($detailcpj['jasa_pengiriman']);

        cpjdetail::where('cpj_id', $id)->delete();
        LaporanBukuBesar::where('cpj_id', $id)->delete();
        LaporanBukuBesarPenyesuaian::where('cpj_id', $id)->delete();

        for ($a=0; $a < $countKasBank1; $a++) {
            $detail                     = new cpjdetail();
            $detail->cpj_id             = $id;
            $detail->nomor_akun         = $detailcpj['nomor_akun2'][$a];
            $detail->nama_akun          = $detailcpj['nama_akun2'][$a];
            $detail->kredit             = $detailcpj['total'][$a];
            $detail->save();

            //insert Laporan Buku Besar
            $detail                     = new LaporanBukuBesar();
            $detail->cpj_id             = $id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcpj['nomor_akun2'][$a];
            $detail->kredit             = $detailcpj['total'][$a];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail                     = new LaporanBukuBesarPenyesuaian();
            $detail->cpj_id             = $id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcpj['nomor_akun2'][$a];
            $detail->kredit             = $detailcpj['total'][$a];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank2; $i++) {
            $detail                     = new cpjdetail();
            $detail->cpj_id             = $id;
            $detail->nomor_akun         = $detailcpj['nomor_akun_sales'][$i];
            $detail->nama_akun          = $detailcpj['nama_akun2_sales'][$i];
            $detail->debet              = $detailcpj['subtotal'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail                     = new LaporanBukuBesar();
            $detail->cpj_id             = $id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcpj['nomor_akun_sales'][$i];
            $detail->debet             = $detailcpj['subtotal'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail                     = new LaporanBukuBesarPenyesuaian();
            $detail->cpj_id             = $id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcpj['nomor_akun_sales'][$i];
            $detail->debet             = $detailcpj['subtotal'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank3; $i++) {
            $detail                     = new cpjdetail();
            $detail->cpj_id             = $id;
            $detail->nomor_akun         = $detailcpj['nomor_akun_ppn'][$i];
            $detail->nama_akun          = $detailcpj['nama_akun2_ppn'][$i];
            $detail->debet              = $detailcpj['PPN'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail                     = new LaporanBukuBesar();
            $detail->cpj_id             = $id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcpj['nomor_akun_ppn'][$i];
            $detail->debet             = $detailcpj['PPN'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail                     = new LaporanBukuBesarPenyesuaian();
            $detail->cpj_id             = $id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcpj['nomor_akun_ppn'][$i];
            $detail->debet             = $detailcpj['PPN'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank4; $i++) {
            $detail                     = new cpjdetail();
            $detail->cpj_id             = $id;
            $detail->nomor_akun         = $detailcpj['nomor_akun_jasa'][$i];
            $detail->nama_akun          = $detailcpj['nama_akun2_jasa'][$i];
            $detail->debet              = $detailcpj['jasa_pengiriman'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail                     = new LaporanBukuBesar();
            $detail->cpj_id             = $id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcpj['nomor_akun_jasa'][$i];
            $detail->debet             = $detailcpj['jasa_pengiriman'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail                     = new LaporanBukuBesarPenyesuaian();
            $detail->cpj_id             = $id;
            $detail->tanggal             = $request->tanggal;
            $detail->nomor_akun         = $detailcpj['nomor_akun_jasa'][$i];
            $detail->debet             = $detailcpj['jasa_pengiriman'][$i];
            $detail->save();
        }

        LaporanPembelian::where('cpj_id', $id)->delete();
        //insert data Laporan Penjualan
        for ($b=0; $b < $countKasBank1; $b++) {
            $detail = new LaporanPembelian();
            $detail->cpj_id = $id;
            $detail->total = $detailcpj['total'][$b];
            $detail->save();
        }

        Inventory::where('cpj_id', $id)->delete();
        //insert data Inventory
        $inventory                 = $request->only('items', 'unit','harga', 'jumlah', 'status');
        $countinventory1 = count($inventory['jumlah']);

        for ($x=0; $x < $countinventory1; $x++) {
            $detail                     = new Inventory();
            $detail->tanggal = $request->tanggal;
            $detail->cpj_id             = $id;
            $detail->items_id           = $inventory['items'][$x];
            $detail->status             = $inventory['status'][$x];
            $detail->unit               = $inventory['unit'][$x];
            $detail->price              = $inventory['harga'][$x];
            $detail->total              = $inventory['jumlah'][$x];
            $detail->save();
        }
        return redirect('/cpj')->with('Success', 'Data anda telah berhasil di Edit !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        cpj::find($id)->delete();
        return redirect('/cpj')->with('Success', 'Data anda telah berhasil di Hapus !');
    }

    public function retur($id)
    {
        $akun           = Account::all();
        $suppliers      = DataSupplier::all();
        $items          = Item::all();
        $cashbanks      = cpj::find($id);
        $lastOrder      = ReturPembelian::orderBy('id', 'desc')->first();
        $inventories    = Inventory::where('cpj_id', $id)->get();
        $inventoriess   = Inventory::distinct('items_id')->select('id', 'items_id', 'price', 'total', 'unit')->get();
        $Item_count         = Item::all()->count();
        $kredits        = cpjdetail::where('cpj_id', $id)->where('debet', null)->first();
        $jasa           = cpjdetail::where('cpj_id', $id)->where('nomor_akun', '5-1300')->first();
        $lastOrder      = ReturPembelian::orderBy('id', 'desc')->first();
        $ppn            = cpjdetail::where('cpj_id', $id)
                                    ->where('nomor_akun', '2-1320')
                                    ->where('debet', '>', '0')
                                    ->exists();

        return view('pages.cpj.retur', compact('akun', 'suppliers', 'items', 'cashbanks', 'inventories', 'kredits', 'jasa', 'ppn', 'inventoriess', 'Item_count', 'lastOrder'));
    }
}
