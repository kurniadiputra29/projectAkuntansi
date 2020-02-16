<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Account;
use App\Model\SaldoAwal;
use App\Model\LaporanBukuBesarPenyesuaian;
use App\Model\PettycashDetail;
use App\Model\CashBankOutDetails;
use App\Model\CashBankOut;
use App\Model\CashBankInDetails;
use App\Model\CashBankIn;
use App\Model\cpjdetail;
use App\Model\crjdetail;
use App\Model\ReturPembelian;
use App\Model\ReturPembelianDetail;
use App\Model\ReturPenjualan;
use App\Model\ReturPenjualanDetail;

class ArusKasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $cashs = Account::where('nomor', '1-1110')->get();
        $pettycashs = Account::where('nomor', '1-1120')->get();
        $saldo_awals = SaldoAwal::all();    
        $PettycashDetails = PettycashDetail::all();	
        $CashBankOutDetails = CashBankOutDetails::all();
        $CashBankOuts = CashBankOut::all();
        $CashBankInDetails = CashBankInDetails::all();
        $CashBankIns = CashBankIn::all();
        $cpjdetails = cpjdetail::all();
        $crjdetails = crjdetail::all();
        $ReturPembelians = ReturPembelian::all();
        $ReturPembelianDetails = ReturPembelianDetail::all();
        $ReturPenjualans = ReturPenjualan::all();
        $ReturPenjualanDetails = ReturPenjualanDetail::all();
        $distinct_laporan_penyesuaian = LaporanBukuBesarPenyesuaian::distinct('account_id', 'nomor_akun')->select('debet', 'kredit', 'account_id', 'nomor_akun', 'id')->get();

        return view('reports.arus_kas.index', compact( 'distinct_laporan_penyesuaian', 'cashs', 'pettycashs',  'saldo_awals', 'PettycashDetails', 'CashBankOutDetails', 'cpjdetails', 'crjdetails', 'CashBankInDetails', 'CashBankIns', 'CashBankOuts', 'ReturPembelians', 'ReturPembelianDetails', 'ReturPenjualans', 'ReturPenjualanDetails'));
    }
}
