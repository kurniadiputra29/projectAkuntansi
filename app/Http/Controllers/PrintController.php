<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Model\Account;
use App\Model\SaldoAwal;

class PrintController extends Controller
{
    public function neraca()
    {
      return view('reports.neraca.index');
    }

    public function print_neraca()
    {
      $pdf = PDF::loadview('reports.neraca.print');
      return $pdf->stream();
    }

    public function neraca_saldo()
    {
      return view('reports.neraca_saldo.index');
    }

    public function buku_besar()
    {
      $saldo_awal = SaldoAwal::all();
      return view('reports.buku_besar.index', compact('saldo_awal'));
    }

    public function laba_rugi()
    {
      return view('reports.laba_rugi.index');
    }

    public function arus_kas()
    {
      return view('reports.arus_kas.index');
    }

    public function daftar_penjualan()
    {
      return view('reports.daftar_penjualan.index');
    }

    public function piutang_pelanggan()
    {
      return view('reports.piutang_pelanggan.index');
    }

    public function daftar_pembelian()
    {
      return view('reports.daftar_pembelian.index');
    }

    public function hutang_supplier()
    {
      return view('reports.hutang_supplier.index');
    }
}
