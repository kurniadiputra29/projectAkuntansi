<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\PurchaseJournal;
use App\Model\purchasejournaldetail;
use App\Model\Account;
use App\Model\DataSupplier;
use App\Model\Item;
use App\Model\Inventory;
use App\Model\ReturPembelian;
use App\Model\ReturPembelianDetail;
use App\Model\LaporanPembelian;
use App\Model\LaporanBukuBesar;
use App\Model\LaporanBukuBesarPenyesuaian;
use App\Model\PemetaanAkun;

class PurchaseJournalController extends Controller
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
        $data = PurchaseJournal::orderBy('created_at', 'desc')->get();
        return view('pages.purchase_journal.index', compact('data'));
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
        $lastOrder = PurchaseJournal::orderBy('id', 'desc')->first();
        $pemetaan_akuns = PemetaanAkun::first();
        $inventories   = Inventory::distinct('items_id')->select('id', 'items_id', 'price', 'total', 'unit')->get();
        return view('pages.purchase_journal.create', compact('akun', 'suppliers', 'items', 'lastOrder', 'pemetaan_akuns', 'inventories'));
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
            'suppliers_id' => 'required',
            'description' => 'required',
            'kode' => 'unique:purchase_journals,kode|required',
        ],$messages);

        //insert data PurchaseJournal
        $dataPurchaseJournal          = $request->only('id','tanggal', 'kode', 'suppliers_id', 'description');
        $PurchaseJournal              = PurchaseJournal::create($dataPurchaseJournal);

        //insert data PurchaseJournal detail
        $detailpurchase                 = $request->only('nomor_akun2', 'nama_akun2','nomor_akun_sales', 'nama_akun2_sales', 'nomor_akun_jasa', 'nama_akun2_jasa',  'nomor_akun_ppn', 'nama_akun2_ppn', 'jasa_pengiriman', 'PPN', 'subtotal', 'total');
        $countKasBank1 = count($detailpurchase['total']);
        $countKasBank2 = count($detailpurchase['subtotal']);
        $countKasBank3 = count($detailpurchase['PPN']);
        $countKasBank4 = count($detailpurchase['jasa_pengiriman']);

        for ($a=0; $a < $countKasBank1; $a++) {
            $detail = new purchasejournaldetail();
            $detail->purchasejournal_id = $PurchaseJournal->id;
            $detail->nomor_akun = $detailpurchase['nomor_akun2'][$a];
            $detail->nama_akun = $detailpurchase['nama_akun2'][$a];
            $detail->kredit = $detailpurchase['total'][$a];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->purchasejournal_id = $PurchaseJournal->id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailpurchase['nomor_akun2'][$a];
            $detail->kredit = $detailpurchase['total'][$a];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->purchasejournal_id = $PurchaseJournal->id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailpurchase['nomor_akun2'][$a];
            $detail->kredit = $detailpurchase['total'][$a];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank2; $i++) {
            $detail = new purchasejournaldetail();
            $detail->purchasejournal_id = $PurchaseJournal->id;
            $detail->nomor_akun = $detailpurchase['nomor_akun_sales'][$i];
            $detail->nama_akun = $detailpurchase['nama_akun2_sales'][$i];
            $detail->debet = $detailpurchase['subtotal'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->purchasejournal_id = $PurchaseJournal->id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailpurchase['nomor_akun_sales'][$i];
            $detail->debet = $detailpurchase['subtotal'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->purchasejournal_id = $PurchaseJournal->id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailpurchase['nomor_akun_sales'][$i];
            $detail->debet = $detailpurchase['subtotal'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank3; $i++) {
            $detail = new purchasejournaldetail();
            $detail->purchasejournal_id = $PurchaseJournal->id;
            $detail->nomor_akun = $detailpurchase['nomor_akun_ppn'][$i];
            $detail->nama_akun = $detailpurchase['nama_akun2_ppn'][$i];
            $detail->debet = $detailpurchase['PPN'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->purchasejournal_id = $PurchaseJournal->id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailpurchase['nomor_akun_ppn'][$i];
            $detail->debet = $detailpurchase['PPN'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->purchasejournal_id = $PurchaseJournal->id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailpurchase['nomor_akun_ppn'][$i];
            $detail->debet = $detailpurchase['PPN'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank4; $i++) {
            $detail = new purchasejournaldetail();
            $detail->purchasejournal_id = $PurchaseJournal->id;
            $detail->nomor_akun = $detailpurchase['nomor_akun_jasa'][$i];
            $detail->nama_akun = $detailpurchase['nama_akun2_jasa'][$i];
            $detail->debet = $detailpurchase['jasa_pengiriman'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->purchasejournal_id = $PurchaseJournal->id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailpurchase['nomor_akun_jasa'][$i];
            $detail->debet = $detailpurchase['jasa_pengiriman'][$i];
            $detail->save();

            //insert Laporan Buku Besar Pnyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->purchasejournal_id = $PurchaseJournal->id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailpurchase['nomor_akun_jasa'][$i];
            $detail->debet = $detailpurchase['jasa_pengiriman'][$i];
            $detail->save();
        }

        //insert data Laporan Pembelian
        for ($b=0; $b < $countKasBank1; $b++) {
            $detail = new LaporanPembelian();
            $detail->purchasejournal_id = $PurchaseJournal->id;
            $detail->total = $detailpurchase['total'][$b];
            $detail->save();
        }

        //insert data Inventory
        $inventory                 = $request->only('items', 'unit','harga', 'jumlah', 'status');
        $countinventory1 = count($inventory['jumlah']);

        for ($x=0; $x < $countinventory1; $x++) {
            $detail                     = new Inventory();
            $detail->tanggal = $request->tanggal;
            $detail->purchasejournal_id = $PurchaseJournal->id;
            $detail->items_id           = $inventory['items'][$x];
            $detail->status             = $inventory['status'][$x];
            $detail->unit               = $inventory['unit'][$x];
            $detail->price              = $inventory['harga'][$x];
            $detail->total              = $inventory['jumlah'][$x];
            $detail->save();
        }

        return redirect('/purchase_journal')->with('Success', 'Data anda telah berhasil di Input !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = purchasejournaldetail::where('purchasejournal_id', $id)->get();
        return view('pages.purchase_journal.show', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $akun               = Account::all();
        $suppliers          = DataSupplier::all();
        $items              = Item::all();
        $cashbanks          = PurchaseJournal::find($id);
        $inventories        = Inventory::where('purchasejournal_id', $id)->get();
        $inventoriess       = Inventory::distinct('items_id')->select('id', 'items_id', 'price', 'total', 'unit')->get();
        $Item_count         = Item::all()->count();
        $kredits            = purchasejournaldetail::where('purchasejournal_id', $id)->where('debet', null)->get();
        $jasa               = purchasejournaldetail::where('purchasejournal_id', $id)->where('nomor_akun', '5-1300')->first();
        $ppn                = purchasejournaldetail::where('purchasejournal_id', $id)
                                    ->where('nomor_akun', '2-1320')
                                    ->where('debet', '>', '0')
                                    ->exists();
        $pemetaan_akuns = PemetaanAkun::first();

        return view('pages.purchase_journal.edit', compact('akun', 'suppliers', 'items','cashbanks', 'inventories', 'kredits', 'jasa', 'ppn', 'inventoriess', 'Item_count', 'pemetaan_akuns'));
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
            'suppliers_id' => 'required',
            'description' => 'required',
            'kode' => 'unique:purchase_journals,kode,'.$id,
        ],$messages);

        //insert data PurchaseJournal
        $dataPurchaseJournal          = $request->only('id','tanggal', 'kode', 'suppliers_id', 'description');
        $PurchaseJournal              = PurchaseJournal::find($id)->update($dataPurchaseJournal);

        //insert data PurchaseJournal detail
        $detailpurchase                 = $request->only('nomor_akun2', 'nama_akun2','nomor_akun_sales', 'nama_akun2_sales', 'nomor_akun_jasa', 'nama_akun2_jasa',  'nomor_akun_ppn', 'nama_akun2_ppn', 'jasa_pengiriman', 'PPN', 'subtotal', 'total');
        $countKasBank1 = count($detailpurchase['total']);
        $countKasBank2 = count($detailpurchase['subtotal']);
        $countKasBank3 = count($detailpurchase['PPN']);
        $countKasBank4 = count($detailpurchase['jasa_pengiriman']);

        purchasejournaldetail::where('purchasejournal_id', $id)->delete();
        LaporanBukuBesar::where('purchasejournal_id', $id)->delete();
        LaporanBukuBesarPenyesuaian::where('purchasejournal_id', $id)->delete();

        for ($a=0; $a < $countKasBank1; $a++) {
            $detail = new purchasejournaldetail();
            $detail->purchasejournal_id = $id;
            $detail->nomor_akun = $detailpurchase['nomor_akun2'][$a];
            $detail->nama_akun = $detailpurchase['nama_akun2'][$a];
            $detail->kredit = $detailpurchase['total'][$a];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->purchasejournal_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailpurchase['nomor_akun2'][$a];
            $detail->kredit = $detailpurchase['total'][$a];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->purchasejournal_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailpurchase['nomor_akun2'][$a];
            $detail->kredit = $detailpurchase['total'][$a];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank2; $i++) {
            $detail = new purchasejournaldetail();
            $detail->purchasejournal_id = $id;
            $detail->nomor_akun = $detailpurchase['nomor_akun_sales'][$i];
            $detail->nama_akun = $detailpurchase['nama_akun2_sales'][$i];
            $detail->debet = $detailpurchase['subtotal'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->purchasejournal_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailpurchase['nomor_akun_sales'][$i];
            $detail->debet = $detailpurchase['subtotal'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->purchasejournal_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailpurchase['nomor_akun_sales'][$i];
            $detail->debet = $detailpurchase['subtotal'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank3; $i++) {
            $detail = new purchasejournaldetail();
            $detail->purchasejournal_id = $id;
            $detail->nomor_akun = $detailpurchase['nomor_akun_ppn'][$i];
            $detail->nama_akun = $detailpurchase['nama_akun2_ppn'][$i];
            $detail->debet = $detailpurchase['PPN'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->purchasejournal_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailpurchase['nomor_akun_ppn'][$i];
            $detail->debet = $detailpurchase['PPN'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->purchasejournal_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailpurchase['nomor_akun_ppn'][$i];
            $detail->debet = $detailpurchase['PPN'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank4; $i++) {
            $detail = new purchasejournaldetail();
            $detail->purchasejournal_id = $id;
            $detail->nomor_akun = $detailpurchase['nomor_akun_jasa'][$i];
            $detail->nama_akun = $detailpurchase['nama_akun2_jasa'][$i];
            $detail->debet = $detailpurchase['jasa_pengiriman'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->purchasejournal_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailpurchase['nomor_akun_jasa'][$i];
            $detail->debet = $detailpurchase['jasa_pengiriman'][$i];
            $detail->save();

            //insert Laporan Buku Besar Pnyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->purchasejournal_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailpurchase['nomor_akun_jasa'][$i];
            $detail->debet = $detailpurchase['jasa_pengiriman'][$i];
            $detail->save();
        }

        LaporanPembelian::where('purchasejournal_id', $id)->delete();
        //insert data Laporan Pembelian
        for ($b=0; $b < $countKasBank1; $b++) {
            $detail = new LaporanPembelian();
            $detail->purchasejournal_id = $id;
            $detail->total = $detailpurchase['total'][$b];
            $detail->save();
        }

        Inventory::where('purchasejournal_id', $id)->delete();
        //insert data Inventory
        $inventory                 = $request->only('items', 'unit','harga', 'jumlah', 'status');
        $countinventory1 = count($inventory['jumlah']);

        for ($x=0; $x < $countinventory1; $x++) {
            $detail                         = new Inventory();
            $detail->tanggal = $request->tanggal;
            $detail->purchasejournal_id     = $id;
            $detail->items_id               = $inventory['items'][$x];
            $detail->status                 = $inventory['status'][$x];
            $detail->unit                   = $inventory['unit'][$x];
            $detail->price                  = $inventory['harga'][$x];
            $detail->total                  = $inventory['jumlah'][$x];
            $detail->save();
        }
        return redirect('/purchase_journal')->with('Success', 'Data anda telah berhasil di Edit !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PurchaseJournal::find($id)->delete();
        return redirect('/purchase_journal')->with('Success', 'Data anda telah berhasil di Hapus !');
    }
    public function retur($id)
    {
        $akun               = Account::all();
        $suppliers          = DataSupplier::all();
        $items              = Item::all();
        $cashbanks          = PurchaseJournal::find($id);
        $inventories        = Inventory::where('purchasejournal_id', $id)->get();
        $inventoriess       = Inventory::distinct('items_id')->select('id', 'items_id', 'price', 'total', 'unit')->get();
        $Item_count         = Item::all()->count();
        $lastOrder      = ReturPembelian::orderBy('id', 'desc')->first();
        $kredits            = purchasejournaldetail::where('purchasejournal_id', $id)->where('debet', null)->first();
        $jasa               = purchasejournaldetail::where('purchasejournal_id', $id)->where('nomor_akun', '5-1300')->first();
        $lastOrder          = ReturPembelian::orderBy('id', 'desc')->first();
        $ppn                = purchasejournaldetail::where('purchasejournal_id', $id)
                                    ->where('nomor_akun', '2-1320')
                                    ->where('debet', '>', '0')
                                    ->exists();
        $pemetaan_akuns = PemetaanAkun::first();

        return view('pages.purchase_journal.retur', compact('akun', 'suppliers', 'items','cashbanks', 'inventories', 'kredits', 'jasa', 'ppn', 'inventoriess', 'Item_count', 'lastOrder', 'pemetaan_akuns'));
    }
}
