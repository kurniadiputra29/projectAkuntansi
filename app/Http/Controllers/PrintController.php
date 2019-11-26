<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

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
      return view('reports.buku_besar.index');
    }

    public function laba_rugi()
    {
      return view('reports.laba_rugi.index');
    }

    public function alur_kas()
    {
      return view('reports.alur_kas.index');
    }

    public function daftar_penjualan()
    {
      return view('reports.daftar_penjualan.index');
    }

    public function piutang_pelanggan()
    {
      return view('reports.piutang_pelanggan.index');
    }

    public function penjualan_per_produk()
    {
      return view('reports.penjualan_per_produk.index');
    }

    public function daftar_pembelian()
    {
      return view('reports.daftar_pembelian.index');
    }
}
