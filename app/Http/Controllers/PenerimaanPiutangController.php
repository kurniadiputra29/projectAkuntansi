<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Account;
use App\Model\CashBankIn;
use App\Model\CashBankInDetails;
use App\Model\DataCustomer;
use App\Model\LaporanBukuBesar;
use App\Model\LaporanBukuBesarPenyesuaian;
use App\Model\PemetaanAkun;

class PenerimaanPiutangController extends Controller
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
        $data = CashBankIn::orderBy('created_at', 'desc')->where('diterima_dari', null)->get();
        return view('pages.penerimaan_piutang.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $akun      = Account::all();
        $lastOrder = CashBankIn::orderBy('id', 'desc')->first();
        $customers = DataCustomer::all();
        $pemetaan_akuns = PemetaanAkun::first();

        return view('pages.penerimaan_piutang.create', compact('akun', 'lastOrder', 'customers', 'pemetaan_akuns'));
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
                'kode'             => 'unique:cash_bank_ins,kode|required',
        ],$messages);

        //insert data cashbank
        $dataCashInBank          = $request->only('id','tanggal', 'kode', 'customers_id', 'description');
        $cashinbank              = CashBankIn::create($dataCashInBank);

        //insert data cashbank detail
        $detailcashinbank                 = $request->only('nomor_akun', 'nama_akun','nomor_akun2', 'nama_akun2', 'jumlah', 'total');
        $countKasBank = count($detailcashinbank['nomor_akun']);
        $countKasBank2 = count($detailcashinbank['total']);

        for ($a=0; $a < $countKasBank2; $a++) {
            $detail = new CashBankInDetails();
            $detail->cash_bank_ins_id = $cashinbank->id;
            $detail->nomor_akun = $detailcashinbank['nomor_akun2'][$a];
            $detail->nama_akun = $detailcashinbank['nama_akun2'][$a];
            $detail->debet = $detailcashinbank['total'][$a];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->cash_bank_ins_id = $cashinbank->id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailcashinbank['nomor_akun2'][$a];
            $detail->debet = $detailcashinbank['total'][$a];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->cash_bank_ins_id = $cashinbank->id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailcashinbank['nomor_akun2'][$a];
            $detail->debet = $detailcashinbank['total'][$a];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank; $i++) {
            $detail = new CashBankInDetails();
            $detail->cash_bank_ins_id = $cashinbank->id;
            $detail->nomor_akun = $detailcashinbank['nomor_akun'][$i];
            $detail->nama_akun = $detailcashinbank['nama_akun'][$i];
            $detail->kredit = $detailcashinbank['jumlah'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->cash_bank_ins_id = $cashinbank->id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailcashinbank['nomor_akun'][$i];
            $detail->kredit = $detailcashinbank['jumlah'][$i];
            $detail->save();
            
            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->cash_bank_ins_id = $cashinbank->id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailcashinbank['nomor_akun'][$i];
            $detail->kredit = $detailcashinbank['jumlah'][$i];
            $detail->save();
        }

        return redirect('/penerimaan_piutang')->with('Success', 'Data anda telah berhasil di Input !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = CashBankInDetails::where('cash_bank_ins_id', $id)->get();
        return view('pages.penerimaan_piutang.show', compact('detail'));
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
        $cashbanks      = CashBankIn::find($id);
        $debets         = CashBankInDetails::where('cash_bank_ins_id', $id)->where('kredit', null)->get();
        $customers      = DataCustomer::all();

        return view('pages.penerimaan_piutang.edit', compact('akun', 'cashbanks', 'debets', 'customers'));
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
                'kode'              => 'unique:cash_bank_ins,kode,'.$id,
        ],$messages);

        //insert data cashbank
        $dataCashInBank          = $request->only('id','tanggal', 'kode', 'customers_id', 'description');
        $cashinbank              = CashBankIn::find($id)->update($dataCashInBank);

        //insert data cashbank detail
        $detailcashinbank                 = $request->only('nomor_akun', 'nama_akun','nomor_akun2', 'nama_akun2', 'jumlah', 'total');
        $countKasBank = count($detailcashinbank['nomor_akun']);
        $countKasBank2 = count($detailcashinbank['total']);

        CashBankInDetails::where('cash_bank_ins_id', $id)->delete();
        LaporanBukuBesar::where('cash_bank_ins_id', $id)->delete();
        LaporanBukuBesarPenyesuaian::where('cash_bank_ins_id', $id)->delete();

        for ($a=0; $a < $countKasBank2; $a++) {
            $detail = new CashBankInDetails();
            $detail->cash_bank_ins_id = $id;
            $detail->nomor_akun = $detailcashinbank['nomor_akun2'][$a];
            $detail->nama_akun = $detailcashinbank['nama_akun2'][$a];
            $detail->debet = $detailcashinbank['total'][$a];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->cash_bank_ins_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailcashinbank['nomor_akun2'][$a];
            $detail->debet = $detailcashinbank['total'][$a];
            $detail->save();

            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->cash_bank_ins_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailcashinbank['nomor_akun2'][$a];
            $detail->debet = $detailcashinbank['total'][$a];
            $detail->save();
        }
        for ($i=0; $i < $countKasBank; $i++) {
            $detail = new CashBankInDetails();
            $detail->cash_bank_ins_id = $id;
            $detail->nomor_akun = $detailcashinbank['nomor_akun'][$i];
            $detail->nama_akun = $detailcashinbank['nama_akun'][$i];
            $detail->kredit = $detailcashinbank['jumlah'][$i];
            $detail->save();

            //insert Laporan Buku Besar
            $detail = new LaporanBukuBesar();
            $detail->cash_bank_ins_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailcashinbank['nomor_akun'][$i];
            $detail->kredit = $detailcashinbank['jumlah'][$i];
            $detail->save();
            
            //insert Laporan Buku Besar Penyesuaian
            $detail = new LaporanBukuBesarPenyesuaian();
            $detail->cash_bank_ins_id = $id;
            $detail->tanggal = $request->tanggal;
            $detail->nomor_akun = $detailcashinbank['nomor_akun'][$i];
            $detail->kredit = $detailcashinbank['jumlah'][$i];
            $detail->save();
        }

        return redirect('/penerimaan_piutang')->with('Success', 'Data anda telah berhasil di Edit !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CashBankIn::find($id)->delete();
        return redirect('/penerimaan_piutang')->with('Success', 'Data anda telah berhasil di Hapus !');
    }
}
