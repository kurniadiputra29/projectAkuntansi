<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Account;
use App\Model\CashBankOut;
use App\Model\CashBankOutDetails;
use App\Model\DataSupplier;
use App\Model\LaporanBukuBesar;
use App\Model\LaporanBukuBesarPenyesuaian;
use App\Model\PemetaanAkun;

class PelunasanHutangController extends Controller
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
        $data = CashBankOut::orderBy('created_at', 'desc')->where('dibayar_ke', null)->get();
        return view('pages.pelunasan_hutang.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akun      = Account::all();
        $lastOrder = CashBankOut::orderBy('id', 'desc')->first();
        $suppliers = DataSupplier::all();
        $pemetaan_akuns = PemetaanAkun::first();

        return view('pages.pelunasan_hutang.create', compact('akun', 'lastOrder', 'suppliers', 'pemetaan_akuns'));
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

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->cash_bank_outs_id = $cashinbank->id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailcashinbank['nomor_akun2'][$a];
            $detail->kredit = $detailcashinbank['total'][$a];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->cash_bank_outs_id = $cashinbank->id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailcashinbank['nomor_akun2'][$a];
            $detail->kredit = $detailcashinbank['total'][$a];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank; $i++) {
            $detail = new CashBankOutDetails();
            $detail->cash_bank_outs_id = $cashinbank->id;
            $detail->nomor_akun = $detailcashinbank['nomor_akun'][$i];
            $detail->nama_akun = $detailcashinbank['nama_akun'][$i];
            $detail->debet = $detailcashinbank['jumlah'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->cash_bank_outs_id  = $cashinbank->id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailcashinbank['nomor_akun'][$i];
            $detail->debet = $detailcashinbank['jumlah'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->cash_bank_outs_id  = $cashinbank->id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailcashinbank['nomor_akun'][$i];
            $detail->debet = $detailcashinbank['jumlah'][$i];
            $detail->save();
        }

        return redirect('/pelunasan_hutang')->with('Success', 'Data anda telah berhasil di Input !');
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
        return view('pages.pelunasan_hutang.show', compact('detail'));
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

        return view('pages.pelunasan_hutang.edit', compact('akun', 'cashbanks', 'kredits', 'suppliers'));
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
        LaporanBukuBesar::where('cash_bank_outs_id', $id)->delete();
        LaporanBukuBesarPenyesuaian::where('cash_bank_outs_id', $id)->delete();

        for ($a=0; $a < $countKasBank2; $a++) {
            $detail                     = new CashBankOutDetails();
            $detail->cash_bank_outs_id  = $id;
            $detail->nomor_akun         = $detailcashinbank['nomor_akun2'][$a];
            $detail->nama_akun          = $detailcashinbank['nama_akun2'][$a];
            $detail->kredit             = $detailcashinbank['total'][$a];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->cash_bank_outs_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailcashinbank['nomor_akun2'][$a];
            $detail->kredit = $detailcashinbank['total'][$a];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->cash_bank_outs_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailcashinbank['nomor_akun2'][$a];
            $detail->kredit = $detailcashinbank['total'][$a];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank; $i++) {
            $detail = new CashBankOutDetails();
            $detail->cash_bank_outs_id = $id;
            $detail->nomor_akun = $detailcashinbank['nomor_akun'][$i];
            $detail->nama_akun = $detailcashinbank['nama_akun'][$i];
            $detail->debet = $detailcashinbank['jumlah'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->cash_bank_outs_id  = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailcashinbank['nomor_akun'][$i];
            $detail->debet = $detailcashinbank['jumlah'][$i];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->cash_bank_outs_id  = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailcashinbank['nomor_akun'][$i];
            $detail->debet = $detailcashinbank['jumlah'][$i];
            $detail->save();
        }

        return redirect('/pelunasan_hutang')->with('Success', 'Data anda telah berhasil di Edit !');
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
        return redirect('/pelunasan_hutang')->with('Success', 'Data anda telah berhasil di Hapus !');
    }
}
