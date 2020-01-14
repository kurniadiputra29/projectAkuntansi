<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ReturPembelian;
use App\Model\ReturPembelianDetail;
use App\Model\Account;
use App\Model\DataSupplier;
use App\Model\Item;
use App\Model\Inventory;
use App\Model\cpj;
use App\Model\PurchaseJournal;
use App\Model\LaporanHutang;
use App\Model\LaporanPembelian;
use App\Model\LaporanBukuBesar;

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
        $akun             = Account::all();
        $suppliers        = DataSupplier::all();
        $items            = Item::all();
        $returns          = ReturPembelian::orderBy('id', 'desc')->paginate(1);
        $returns_count    = ReturPembelian::all()->count();
        $cpjs             = cpj::all();
        $PurchaseJournals = PurchaseJournal::all();
        return view('pages.retur_pembelian.create', compact('akun', 'suppliers', 'items', 'returns', 'returns_count', 'cpjs', 'PurchaseJournals'));
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
          'suppliers_id'  => 'required',
          'description'   => 'required',
          'kode'          => 'unique:retur_pembelians,kode|required',
      ],$messages);

      //insert data ReturnPembelian
      $dataReturnPembelian          = $request->only('id','tanggal', 'kode', 'suppliers_id', 'cpj_id', 'purchasejournal_id', 'description');
      $ReturnPembelian              = ReturPembelian::create($dataReturnPembelian);

      //insert data ReturnPembelian detail
      $detailReturnPembelian                 = $request->only('nomor_akun2', 'nama_akun2','nomor_akun_sales', 'nama_akun2_sales', 'nomor_akun_jasa', 'nama_akun2_jasa',  'nomor_akun_ppn', 'nama_akun2_ppn', 'jasa_pengiriman', 'PPN', 'subtotal', 'total');
      $countKasBank1 = count($detailReturnPembelian['total']);
      $countKasBank2 = count($detailReturnPembelian['subtotal']);
      $countKasBank3 = count($detailReturnPembelian['PPN']);
      $countKasBank4 = count($detailReturnPembelian['jasa_pengiriman']);

      for ($a=0; $a < $countKasBank1; $a++) { 
          $detail = new ReturPembelianDetail();
          $detail->retur_pembelian_id = $ReturnPembelian->id;
          $detail->nomor_akun = $detailReturnPembelian['nomor_akun2'][$a];
          $detail->nama_akun = $detailReturnPembelian['nama_akun2'][$a];
          $detail->debet = $detailReturnPembelian['total'][$a];
          $detail->save();

          //insert Laporan Buku Besar
          $detail = new LaporanBukuBesar();
          $detail->retur_pembelian_id = $ReturnPembelian->id;
          $detail->nomor_akun = $detailReturnPembelian['nomor_akun2'][$a];
          $detail->debet = $detailReturnPembelian['total'][$a];
          $detail->save();
      }
      for ($i=0; $i < $countKasBank2; $i++) { 
          $detail = new ReturPembelianDetail();
          $detail->retur_pembelian_id = $ReturnPembelian->id;
          $detail->nomor_akun = $detailReturnPembelian['nomor_akun_sales'][$i];
          $detail->nama_akun = $detailReturnPembelian['nama_akun2_sales'][$i];
          $detail->kredit = $detailReturnPembelian['subtotal'][$i];
          $detail->save();

          //insert Laporan Buku Besar
          $detail = new LaporanBukuBesar();
          $detail->retur_pembelian_id = $ReturnPembelian->id;
          $detail->nomor_akun = $detailReturnPembelian['nomor_akun_sales'][$i];
          $detail->kredit = $detailReturnPembelian['subtotal'][$i];
          $detail->save();
      }
      for ($i=0; $i < $countKasBank3; $i++) { 
          $detail = new ReturPembelianDetail();
          $detail->retur_pembelian_id = $ReturnPembelian->id;
          $detail->nomor_akun = $detailReturnPembelian['nomor_akun_ppn'][$i];
          $detail->nama_akun = $detailReturnPembelian['nama_akun2_ppn'][$i];
          $detail->kredit = $detailReturnPembelian['PPN'][$i];
          $detail->save();

          //insert Laporan Buku Besar
          $detail = new LaporanBukuBesar();
          $detail->retur_pembelian_id = $ReturnPembelian->id;
          $detail->nomor_akun = $detailReturnPembelian['nomor_akun_ppn'][$i];
          $detail->kredit = $detailReturnPembelian['PPN'][$i];
          $detail->save();
      }
      for ($i=0; $i < $countKasBank4; $i++) { 
          $detail = new ReturPembelianDetail();
          $detail->retur_pembelian_id = $ReturnPembelian->id;
          $detail->nomor_akun = $detailReturnPembelian['nomor_akun_jasa'][$i];
          $detail->nama_akun = $detailReturnPembelian['nama_akun2_jasa'][$i];
          $detail->kredit = $detailReturnPembelian['jasa_pengiriman'][$i];
          $detail->save();

          //insert Laporan Buku Besar
          $detail = new LaporanBukuBesar();
          $detail->retur_pembelian_id = $ReturnPembelian->id;
          $detail->nomor_akun = $detailReturnPembelian['nomor_akun_jasa'][$i];
          $detail->kredit = $detailReturnPembelian['jasa_pengiriman'][$i];
          $detail->save();
      }

      //insert data Laporan Pembelian
        for ($b=0; $b < $countKasBank1; $b++) { 
            $detail = new LaporanPembelian();
            $detail->retur_pembelian_id = $ReturnPembelian->id;
            $detail->total = $detailReturnPembelian['total'][$b];
            $detail->save();
        }

      //insert data Laporan
      if (empty($request->cpj_id)) {
        for ($b=0; $b < $countKasBank1; $b++) { 
          $detail = new LaporanHutang();
          $detail->suppliers_id     = $request->suppliers_id;
          $detail->retur_pembelian_id = $ReturnPembelian->id;
          $detail->debet = $detailReturnPembelian['total'][$b];
          $detail->save();
        }
      }
      
      //insert data Inventory
      $inventory                 = $request->only('items', 'unit','harga', 'jumlah', 'status');
      $countinventory1 = count($inventory['jumlah']);

      for ($x=0; $x < $countinventory1; $x++) { 
          $detail                     = new Inventory();
          $detail->retur_pembelian_id             = $ReturnPembelian->id;
          $detail->items_id           = $inventory['items'][$x];
          $detail->status             = $inventory['status'][$x];
          $detail->unit               = $inventory['unit'][$x];
          $detail->price              = $inventory['harga'][$x];
          $detail->total              = $inventory['jumlah'][$x];
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
        $akun           = Account::all();
        $suppliers      = DataSupplier::all();
        $items          = Item::all();
        $cashbanks      = ReturPembelian::find($id);
        $returndetails  = ReturPembelianDetail::all();
        $inventories    = Inventory::where('retur_pembelian_id', $id)->first();
        $inventoriess   = Inventory::distinct('items_id')->select('id', 'items_id', 'price', 'total', 'unit')->get();
        $Item_count     = Item::all()->count();
        $debets         = ReturPembelianDetail::where('retur_pembelian_id', $id)->where('kredit', null)->get();
        $jasa           = ReturPembelianDetail::where('retur_pembelian_id', $id)->where('nomor_akun', '5-1300')->first();
        $ppn            = ReturPembelianDetail::where('retur_pembelian_id', $id)
                                    ->where('nomor_akun', '2-1320')
                                    ->where('kredit', '>', '0')
                                    ->exists();
        
        return view('pages.retur_pembelian.edit', compact('akun', 'suppliers', 'items', 'cashbanks', 'returndetails', 'debets', 'inventories', 'jasa', 'ppn', 'inventoriess', 'Item_count'));
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
          'suppliers_id'  => 'required',
          'description'   => 'required',
          'kode'          => 'unique:retur_pembelians,kode,'.$id,
      ],$messages);

      //insert data ReturnPembelian
      $dataReturnPembelian          = $request->only('id','tanggal', 'kode', 'suppliers_id','cpj_id', 'purchasejournal_id', 'description');
      $ReturnPembelian              = ReturPembelian::find($id)->update($dataReturnPembelian);

      //insert data ReturnPembelian detail
      $detailReturnPembelian                 = $request->only('nomor_akun2', 'nama_akun2','nomor_akun_sales', 'nama_akun2_sales', 'nomor_akun_jasa', 'nama_akun2_jasa',  'nomor_akun_ppn', 'nama_akun2_ppn', 'jasa_pengiriman', 'PPN', 'subtotal', 'total');
      $countKasBank1 = count($detailReturnPembelian['total']);
      $countKasBank2 = count($detailReturnPembelian['subtotal']);
      $countKasBank3 = count($detailReturnPembelian['PPN']);
      $countKasBank4 = count($detailReturnPembelian['jasa_pengiriman']);

      ReturPembelianDetail::where('retur_pembelian_id', $id)->delete();
      LaporanBukuBesar::where('retur_pembelian_id', $id)->delete();

      for ($a=0; $a < $countKasBank1; $a++) { 
          $detail = new ReturPembelianDetail();
          $detail->retur_pembelian_id = $id;
          $detail->nomor_akun = $detailReturnPembelian['nomor_akun2'][$a];
          $detail->nama_akun = $detailReturnPembelian['nama_akun2'][$a];
          $detail->debet = $detailReturnPembelian['total'][$a];
          $detail->save();

          //insert Laporan Buku Besar
          $detail = new LaporanBukuBesar();
          $detail->retur_pembelian_id = $id;
          $detail->nomor_akun = $detailReturnPembelian['nomor_akun2'][$a];
          $detail->debet = $detailReturnPembelian['total'][$a];
          $detail->save();
      }
      for ($i=0; $i < $countKasBank2; $i++) { 
          $detail = new ReturPembelianDetail();
          $detail->retur_pembelian_id = $id;
          $detail->nomor_akun = $detailReturnPembelian['nomor_akun_sales'][$i];
          $detail->nama_akun = $detailReturnPembelian['nama_akun2_sales'][$i];
          $detail->kredit = $detailReturnPembelian['subtotal'][$i];
          $detail->save();

          //insert Laporan Buku Besar
          $detail = new LaporanBukuBesar();
          $detail->retur_pembelian_id = $id;
          $detail->nomor_akun = $detailReturnPembelian['nomor_akun_sales'][$i];
          $detail->kredit = $detailReturnPembelian['subtotal'][$i];
          $detail->save();
      }
      for ($i=0; $i < $countKasBank3; $i++) { 
          $detail = new ReturPembelianDetail();
          $detail->retur_pembelian_id = $id;
          $detail->nomor_akun = $detailReturnPembelian['nomor_akun_ppn'][$i];
          $detail->nama_akun = $detailReturnPembelian['nama_akun2_ppn'][$i];
          $detail->kredit = $detailReturnPembelian['PPN'][$i];
          $detail->save();

          //insert Laporan Buku Besar
          $detail = new LaporanBukuBesar();
          $detail->retur_pembelian_id = $id;
          $detail->nomor_akun = $detailReturnPembelian['nomor_akun_ppn'][$i];
          $detail->kredit = $detailReturnPembelian['PPN'][$i];
          $detail->save();
      }
      for ($i=0; $i < $countKasBank4; $i++) { 
          $detail = new ReturPembelianDetail();
          $detail->retur_pembelian_id = $id;
          $detail->nomor_akun = $detailReturnPembelian['nomor_akun_jasa'][$i];
          $detail->nama_akun = $detailReturnPembelian['nama_akun2_jasa'][$i];
          $detail->kredit = $detailReturnPembelian['jasa_pengiriman'][$i];
          $detail->save();

          //insert Laporan Buku Besar
          $detail = new LaporanBukuBesar();
          $detail->retur_pembelian_id = $id;
          $detail->nomor_akun = $detailReturnPembelian['nomor_akun_jasa'][$i];
          $detail->kredit = $detailReturnPembelian['jasa_pengiriman'][$i];
          $detail->save();
      }

      LaporanPembelian::where('retur_pembelian_id', $id)->delete();
      //insert data Laporan Pembelian
        for ($b=0; $b < $countKasBank1; $b++) { 
            $detail = new LaporanPembelian();
            $detail->retur_pembelian_id = $id;
            $detail->total = $detailReturnPembelian['total'][$b];
            $detail->save();
        }

      LaporanHutang::where('retur_pembelian_id', $id)->delete();
      //insert data Laporan
      if (empty($request->cpj_id)) {
        for ($b=0; $b < $countKasBank1; $b++) { 
          $detail = new LaporanHutang();
          $detail->suppliers_id = $request->suppliers_id;
          $detail->retur_pembelian_id = $id;
          $detail->debet = $detailReturnPembelian['total'][$b];
          $detail->save();
        }
      }

      Inventory::where('retur_pembelian_id', $id)->delete();
      //insert data Inventory
      $inventory                 = $request->only('items', 'unit','harga', 'jumlah', 'status');
      $countinventory1 = count($inventory['jumlah']);

      for ($x=0; $x < $countinventory1; $x++) { 
          $detail                     = new Inventory();
          $detail->retur_pembelian_id = $id;
          $detail->items_id           = $inventory['items'][$x];
          $detail->status             = $inventory['status'][$x];
          $detail->unit               = $inventory['unit'][$x];
          $detail->price              = $inventory['harga'][$x];
          $detail->total              = $inventory['jumlah'][$x];
          $detail->save();
      }

      return redirect('/retur_pembelian')->with('Success', 'Data anda telah berhasil di Edit !');
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
