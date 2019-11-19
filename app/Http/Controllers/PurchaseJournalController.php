<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\PurchaseJournal;
use App\Model\purchasejournaldetail;
use App\Model\Account;
use App\Model\DataSupplier;
use App\Model\Item;

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
        return view('pages.purchase_journal.create', compact('akun', 'suppliers', 'items'));
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
        $detailcrj                 = $request->only('nomor_akun2', 'nama_akun2','nomor_akun_sales', 'nama_akun2_sales', 'nomor_akun_jasa', 'nama_akun2_jasa',  'nomor_akun_ppn', 'nama_akun2_ppn', 'jasa_pengiriman', 'PPN', 'subtotal', 'total');
        $countKasBank1 = count($detailcrj['total']);
        $countKasBank2 = count($detailcrj['subtotal']);
        $countKasBank3 = count($detailcrj['PPN']);
        $countKasBank4 = count($detailcrj['jasa_pengiriman']);

        for ($a=0; $a < $countKasBank1; $a++) { 
            $detail                     = new purchasejournaldetail();
            $detail->purchasejournal_id             = $PurchaseJournal->id;
            $detail->nomor_akun         = $detailcrj['nomor_akun2'][$a];
            $detail->nama_akun          = $detailcrj['nama_akun2'][$a];
            $detail->kredit              = $detailcrj['total'][$a];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank2; $i++) { 
            $detail                     = new purchasejournaldetail();
            $detail->purchasejournal_id             = $PurchaseJournal->id;
            $detail->nomor_akun         = $detailcrj['nomor_akun_sales'][$i];
            $detail->nama_akun          = $detailcrj['nama_akun2_sales'][$i];
            $detail->debet             = $detailcrj['subtotal'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank3; $i++) { 
            $detail                     = new purchasejournaldetail();
            $detail->purchasejournal_id             = $PurchaseJournal->id;
            $detail->nomor_akun         = $detailcrj['nomor_akun_ppn'][$i];
            $detail->nama_akun          = $detailcrj['nama_akun2_ppn'][$i];
            $detail->debet             = $detailcrj['PPN'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank4; $i++) { 
            $detail                     = new purchasejournaldetail();
            $detail->purchasejournal_id             = $PurchaseJournal->id;
            $detail->nomor_akun         = $detailcrj['nomor_akun_jasa'][$i];
            $detail->nama_akun          = $detailcrj['nama_akun2_jasa'][$i];
            $detail->debet             = $detailcrj['jasa_pengiriman'][$i];
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
        PurchaseJournal::find($id)->delete();
        return redirect('/purchase_journal')->with('Success', 'Data anda telah berhasil di Hapus !');
    }
}
