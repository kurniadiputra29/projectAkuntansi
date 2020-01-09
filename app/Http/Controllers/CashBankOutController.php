<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Account;
use App\Model\CashBankOut;
use App\Model\CashBankOutDetails;
use App\Model\DataSupplier;
use App\Model\LaporanHutang;

class CashBankOutController extends Controller
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
        $data = CashBankOut::orderBy('created_at', 'desc')->get();
        return view('pages.cashbankout.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akun                   = Account::all();
        $CashBankOut            = CashBankOut::orderBy('id', 'desc')->paginate(1);
        $CashBankOut_count      = CashBankOut::all()->count();
        $suppliers              = DataSupplier::all();

        return view('pages.cashbankout.create', compact('akun', 'CashBankOut', 'CashBankOut_count', 'suppliers'));
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
                'required'         => ':attribute wajib diisi !!!',
                'unique'           => ':attribute harus diisi dengan syarat unique !!!',
        ];
        $this->validate($request,[
                'tanggal'          => 'required',
                'description'      => 'required',
                'kode'             => 'unique:cash_bank_outs,kode|required',
        ],$messages);

        //insert data cashbank
        $dataCashInBank          = $request->only('id','tanggal', 'kode', 'suppliers_id', 'description');
        $cashinbank              = CashBankOut::create($dataCashInBank);

        //insert data cashbank detail
        $detailcashinbank                 = $request->only('nomor_akun', 'nama_akun','nomor_akun2', 'nama_akun2', 'jumlah', 'total');
        $countKasBank = count($detailcashinbank['nomor_akun']);
        $countKasBank2 = count($detailcashinbank['total']);

        for ($a=0; $a < $countKasBank2; $a++) {
            $detail                     = new CashBankOutDetails();
            $detail->cash_bank_outs_id  = $cashinbank->id;
            $detail->nomor_akun         = $detailcashinbank['nomor_akun2'][$a];
            $detail->nama_akun          = $detailcashinbank['nama_akun2'][$a];
            $detail->kredit             = $detailcashinbank['total'][$a];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank; $i++) {
            $detail                     = new CashBankOutDetails();
            $detail->cash_bank_outs_id  = $cashinbank->id;
            $detail->nomor_akun         = $detailcashinbank['nomor_akun'][$i];
            $detail->nama_akun          = $detailcashinbank['nama_akun'][$i];
            $detail->debet              = $detailcashinbank['jumlah'][$i];
            $detail->save();
        }

        //insert data Laporan
        for ($b=0; $b < $countKasBank2; $b++) { 
            $detail = new LaporanHutang();
            $detail->suppliers_id     = $request->suppliers_id;
            $detail->cash_bank_outs_id  = $cashinbank->id;
            $detail->debet = $detailcashinbank['total'][$b];
            $detail->save();
        }

        return redirect('/cashbank_out')->with('Success', 'Data anda telah berhasil di Input !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = CashBankOutDetails::where('cash_bank_outs_id', $id)->get();
        return view('pages.cashbankout.show', compact('detail'));
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
        $cashbanks      = CashBankOut::find($id);
        $kredits        = CashBankOutDetails::where('cash_bank_outs_id', $id)->where('debet', null)->get();
        $suppliers      = DataSupplier::all();

        return view('pages.cashbankout.edit', compact('akun', 'cashbanks', 'kredits', 'suppliers'));
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
                'required'          => ':attribute wajib diisi !!!',
                'unique'            => ':attribute harus diisi dengan syarat unique !!!',
        ];
        $this->validate($request,[
                'tanggal'           => 'required',
                'description'       => 'required',
                'kode'              => 'unique:cash_bank_outs,kode,'.$id,
        ],$messages);

        //insert data cashbank
        $dataCashInBank          = $request->only('id','tanggal', 'kode', 'suppliers_id', 'description');
        $cashinbank              = CashBankOut::find($id)->update($dataCashInBank);

        //insert data cashbank detail
        $detailcashinbank                 = $request->only('nomor_akun', 'nama_akun','nomor_akun2', 'nama_akun2', 'jumlah', 'total');
        $countKasBank = count($detailcashinbank['nomor_akun']);
        $countKasBank2 = count($detailcashinbank['total']);

        CashBankOutDetails::where('cash_bank_outs_id', $id)->delete();

        for ($a=0; $a < $countKasBank2; $a++) {
            $detail                     = new CashBankOutDetails();
            $detail->cash_bank_outs_id  = $id;
            $detail->nomor_akun         = $detailcashinbank['nomor_akun2'][$a];
            $detail->nama_akun          = $detailcashinbank['nama_akun2'][$a];
            $detail->kredit             = $detailcashinbank['total'][$a];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank; $i++) {
            $detail                     = new CashBankOutDetails();
            $detail->cash_bank_outs_id  = $id;
            $detail->nomor_akun         = $detailcashinbank['nomor_akun'][$i];
            $detail->nama_akun          = $detailcashinbank['nama_akun'][$i];
            $detail->debet              = $detailcashinbank['jumlah'][$i];
            $detail->save();
        }

        LaporanHutang::where('cash_bank_outs_id', $id)->delete();
        //insert data Laporan
        for ($b=0; $b < $countKasBank2; $b++) { 
            $detail = new LaporanHutang();
            $detail->suppliers_id     = $request->suppliers_id;
            $detail->cash_bank_outs_id = $id;
            $detail->debet = $detailcashinbank['total'][$b];
            $detail->save();
        }
        return redirect('/cashbank_out')->with('Success', 'Data anda telah berhasil di Edit !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CashBankOut::find($id)->delete();
        return redirect('/cashbank_out')->with('Success', 'Data anda telah berhasil di Hapus !');
    }
}
