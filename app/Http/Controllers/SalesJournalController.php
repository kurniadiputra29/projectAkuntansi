<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Account;
use App\Model\DataCustomer;
use App\Model\Item;
use App\Model\SalesJournal;
use App\Model\salesjournaldetail;
use App\Model\Inventory;
use App\Model\ReturPenjualan;
use App\Model\ReturPenjualanDetail;

class SalesJournalController extends Controller
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
        $data           = SalesJournal::orderBy('created_at', 'desc')->get();
        $DataCustomer   = DataCustomer::all();
        return view('pages.sales_journal.index', compact('data', 'DataCustomer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akun           = Account::all();
        $customers      = DataCustomer::all();
        $items          = Item::all();
        $sales_count    = SalesJournal::all()->count();
        $sales          = SalesJournal::orderBy('id', 'desc')->paginate(1);
        return view('pages.sales_journal.create', compact('akun', 'customers', 'items', 'sales_count', 'sales'));
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
            'customers_id'  => 'required',
            'description'   => 'required',
            'kode'          => 'unique:sales_journals,kode|required',
        ],$messages);

        //insert data SalesJournal
        $dataSalesJournal          = $request->only('id','tanggal', 'kode', 'customers_id', 'description');
        $salesjournal              = SalesJournal::create($dataSalesJournal);

        //insert data SalesJournal detail
        $detailsalesjournal                 = $request->only('nomor_akun2', 'nama_akun2','nomor_akun_sales', 'nama_akun2_sales', 'nomor_akun_jasa', 'nama_akun2_jasa',  'nomor_akun_ppn', 'nama_akun2_ppn', 'nomor_akun_inventory', 'nama_akun2_inventory', 'nomor_akun_cost', 'nama_akun2_cost', 'cost', 'jasa_pengiriman', 'PPN', 'subtotal', 'total');
        $countKasBank1 = count($detailsalesjournal['total']);
        $countKasBank2 = count($detailsalesjournal['subtotal']);
        $countKasBank3 = count($detailsalesjournal['PPN']);
        $countKasBank4 = count($detailsalesjournal['jasa_pengiriman']);
        $countKasBank5 = count($detailsalesjournal['cost']);

        for ($a=0; $a < $countKasBank1; $a++) { 
            $detail                     = new salesjournaldetail();
            $detail->salesjournal_id    = $salesjournal->id;
            $detail->nomor_akun         = $detailsalesjournal['nomor_akun2'][$a];
            $detail->nama_akun          = $detailsalesjournal['nama_akun2'][$a];
            $detail->debet              = $detailsalesjournal['total'][$a];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank5; $i++) { 
            $detail                     = new salesjournaldetail();
            $detail->salesjournal_id    = $salesjournal->id;
            $detail->nomor_akun         = $detailsalesjournal['nomor_akun_cost'][$i];
            $detail->nama_akun          = $detailsalesjournal['nama_akun2_cost'][$i];
            $detail->debet              = $detailsalesjournal['cost'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank2; $i++) { 
            $detail                     = new salesjournaldetail();
            $detail->salesjournal_id    = $salesjournal->id;
            $detail->nomor_akun         = $detailsalesjournal['nomor_akun_sales'][$i];
            $detail->nama_akun          = $detailsalesjournal['nama_akun2_sales'][$i];
            $detail->kredit             = $detailsalesjournal['subtotal'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank3; $i++) { 
            $detail                     = new salesjournaldetail();
            $detail->salesjournal_id    = $salesjournal->id;
            $detail->nomor_akun         = $detailsalesjournal['nomor_akun_ppn'][$i];
            $detail->nama_akun          = $detailsalesjournal['nama_akun2_ppn'][$i];
            $detail->kredit             = $detailsalesjournal['PPN'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank4; $i++) { 
            $detail                     = new salesjournaldetail();
            $detail->salesjournal_id    = $salesjournal->id;
            $detail->nomor_akun         = $detailsalesjournal['nomor_akun_jasa'][$i];
            $detail->nama_akun          = $detailsalesjournal['nama_akun2_jasa'][$i];
            $detail->kredit             = $detailsalesjournal['jasa_pengiriman'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank5; $i++) { 
            $detail                     = new salesjournaldetail();
            $detail->salesjournal_id    = $salesjournal->id;
            $detail->nomor_akun         = $detailsalesjournal['nomor_akun_inventory'][$i];
            $detail->nama_akun          = $detailsalesjournal['nama_akun2_inventory'][$i];
            $detail->kredit             = $detailsalesjournal['cost'][$i];
            $detail->save();
        }

        //insert data Inventory
        $inventory                 = $request->only('items', 'unit','harga', 'jumlah', 'status', 'sales');
        $countinventory1 = count($inventory['jumlah']);

        for ($x=0; $x < $countinventory1; $x++) { 
            $detail                     = new Inventory();
            $detail->salesjournal_id    = $salesjournal->id;
            $detail->items_id           = $inventory['items'][$x];
            $detail->status             = $inventory['status'][$x];
            $detail->unit               = $inventory['unit'][$x];
            $detail->price              = $inventory['harga'][$x];
            $detail->total              = $inventory['sales'][$x];
            $detail->sales              = $inventory['jumlah'][$x];
            $detail->save();
        }

        return redirect('/sales_journal')->with('Success', 'Data anda telah berhasil di Input !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = salesjournaldetail::where('salesjournal_id', $id)->get();
        return view('pages.sales_journal.show', compact('detail'));
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
        $cashbanks      = SalesJournal::find($id);
        $debets         = salesjournaldetail::where('salesjournal_id', $id)->where('kredit', null)->first();
        $inventories    = Inventory::where('salesjournal_id', $id)->get();
        $jasa           = salesjournaldetail::where('salesjournal_id', $id)->where('nomor_akun', '4-2200')->first();
        $ppn            = salesjournaldetail::where('salesjournal_id', $id)
                                    ->where('nomor_akun', '2-1310')
                                    ->where('kredit', '>', '0')
                                    ->exists();
        // dd($ppn);
        return view('pages.sales_journal.edit', compact('akun', 'customers', 'items', 'cashbanks', 'debets', 'inventories', 'crjdetails', 'jasa', 'ppn'));
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
            'customers_id'  => 'required',
            'description'   => 'required',
            'kode'          => 'unique:sales_journals,kode,'.$id,
        ],$messages);

        //insert data SalesJournal
        $dataSalesJournal          = $request->only('id','tanggal', 'kode', 'customers_id', 'description');
        $salesjournal              = SalesJournal::find($id)->update($dataSalesJournal);

        //insert data SalesJournal detail
        $detailsalesjournal                 = $request->only('nomor_akun2', 'nama_akun2','nomor_akun_sales', 'nama_akun2_sales', 'nomor_akun_jasa', 'nama_akun2_jasa',  'nomor_akun_ppn', 'nama_akun2_ppn', 'nomor_akun_inventory', 'nama_akun2_inventory', 'nomor_akun_cost', 'nama_akun2_cost', 'cost', 'jasa_pengiriman', 'PPN', 'subtotal', 'total');
        $countKasBank1 = count($detailsalesjournal['total']);
        $countKasBank2 = count($detailsalesjournal['subtotal']);
        $countKasBank3 = count($detailsalesjournal['PPN']);
        $countKasBank4 = count($detailsalesjournal['jasa_pengiriman']);
        $countKasBank5 = count($detailsalesjournal['cost']);

        salesjournaldetail::where('salesjournal_id', $id)->delete();

        for ($a=0; $a < $countKasBank1; $a++) { 
            $detail                     = new salesjournaldetail();
            $detail->salesjournal_id    = $id;
            $detail->nomor_akun         = $detailsalesjournal['nomor_akun2'][$a];
            $detail->nama_akun          = $detailsalesjournal['nama_akun2'][$a];
            $detail->debet              = $detailsalesjournal['total'][$a];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank5; $i++) { 
            $detail                     = new salesjournaldetail();
            $detail->salesjournal_id    = $id;
            $detail->nomor_akun         = $detailsalesjournal['nomor_akun_cost'][$i];
            $detail->nama_akun          = $detailsalesjournal['nama_akun2_cost'][$i];
            $detail->debet              = $detailsalesjournal['cost'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank2; $i++) { 
            $detail                     = new salesjournaldetail();
            $detail->salesjournal_id    = $id;
            $detail->nomor_akun         = $detailsalesjournal['nomor_akun_sales'][$i];
            $detail->nama_akun          = $detailsalesjournal['nama_akun2_sales'][$i];
            $detail->kredit             = $detailsalesjournal['subtotal'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank3; $i++) { 
            $detail                     = new salesjournaldetail();
            $detail->salesjournal_id    = $id;
            $detail->nomor_akun         = $detailsalesjournal['nomor_akun_ppn'][$i];
            $detail->nama_akun          = $detailsalesjournal['nama_akun2_ppn'][$i];
            $detail->kredit             = $detailsalesjournal['PPN'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank4; $i++) { 
            $detail                     = new salesjournaldetail();
            $detail->salesjournal_id    = $id;
            $detail->nomor_akun         = $detailsalesjournal['nomor_akun_jasa'][$i];
            $detail->nama_akun          = $detailsalesjournal['nama_akun2_jasa'][$i];
            $detail->kredit             = $detailsalesjournal['jasa_pengiriman'][$i];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank5; $i++) { 
            $detail                     = new salesjournaldetail();
            $detail->salesjournal_id    = $id;
            $detail->nomor_akun         = $detailsalesjournal['nomor_akun_inventory'][$i];
            $detail->nama_akun          = $detailsalesjournal['nama_akun2_inventory'][$i];
            $detail->kredit             = $detailsalesjournal['cost'][$i];
            $detail->save();
        }

        Inventory::where('salesjournal_id', $id)->delete();
        //insert data Inventory
        $inventory                 = $request->only('items', 'unit','harga', 'jumlah', 'status', 'sales');
        $countinventory1 = count($inventory['jumlah']);

        for ($x=0; $x < $countinventory1; $x++) { 
            $detail                     = new Inventory();
            $detail->salesjournal_id    = $id;
            $detail->items_id           = $inventory['items'][$x];
            $detail->status             = $inventory['status'][$x];
            $detail->unit               = $inventory['unit'][$x];
            $detail->price              = $inventory['harga'][$x];
            $detail->total              = $inventory['sales'][$x];
            $detail->sales              = $inventory['jumlah'][$x];
            $detail->save();
        }

        return redirect('/sales_journal')->with('Success', 'Data anda telah berhasil di Edit !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SalesJournal::find($id)->delete();
        return redirect('/sales_journal')->with('Success', 'Data anda telah berhasil di Hapus !');
    }

    public function retur($id)
    {
        $akun           = Account::all();
        $customers      = DataCustomer::all();
        $items          = Item::all();
        $cashbanks      = SalesJournal::find($id);
        $debets         = salesjournaldetail::where('salesjournal_id', $id)->where('kredit', null)->first();
        $inventories    = Inventory::where('salesjournal_id', $id)->get();
        $jasa           = salesjournaldetail::where('salesjournal_id', $id)->where('nomor_akun', '4-2200')->first();
        $returns        = ReturPenjualan::orderBy('id', 'desc')->paginate(1);
        $returns_count  = ReturPenjualan::all()->count();
        $ppn            = salesjournaldetail::where('salesjournal_id', $id)
                                    ->where('nomor_akun', '2-1310')
                                    ->where('kredit', '>', '0')
                                    ->exists();
        // dd($ppn);
        return view('pages.sales_journal.retur', compact('akun', 'customers', 'items', 'cashbanks', 'debets', 'inventories', 'crjdetails', 'jasa', 'ppn', 'returns', 'returns_count'));
    }
}
