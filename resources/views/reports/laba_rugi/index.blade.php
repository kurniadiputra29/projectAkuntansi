@extends('layouts.app')

@section('title', 'Laporan Laba Rugi')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-trending-up bg-blue"></i>
              <div class="d-inline">
                <h5>Laba Rugi</h5>
                <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="/dasbor"><i class="ik ik-home"></i></a>
                </li>
                <li class="breadcrumb-item">
                  <a href="/laporan">Laporan</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Laba Rugi</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="row py-3">
            <div class="col-md-6">
              <form class="forms-sample" action="#" method="post">
                <label for="filter">Tanggal Mulai</label>
                <input type="date" name="tanggal" id="filter">
                <label for="filter2">Tanggal Akhir</label>
                <input type="date" name="tanggal" id="filter2">
                <button class="btn btn-primary" type="submit" name="button">Filter</button>
              </form>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
              <a type="button" class="btn btn-success mr-5" href="/laporan"><i class="ik ik-arrow-left"></i>Back</a>
              <a type="button" class="btn btn-primary" href="#"><i class="ik ik-printer"></i>Print</a>
            </div>
          </div>
          <div class="table-container list-table bg-light">
            <div class="report-title">
              <div class="table-responsive dragscroll">
                <table class="profit-loss report-table table" id="date-profit-lost">
                  <thead class="report-header bg-light">
                    <tr>
                      <th colspan="2">
                        Tanggal
                      </th>
                      <th class="text-right">
                        25/11/2019
                      </th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="bg-secondary text-light">
                      <td class="report-header report-subheader-noindent" colspan="4">
                        Pendapatan dari Penjualan
                      </td>
                    </tr>
                    <tr>
                      <td class="report-subtotal text-left regular-text" colspan="2">
                        Total Pendapatan dari Penjualan
                      </td>
                      <td class="report-subtotal text-right" id="assets-type-1-total-data">
                        0,00
                      </td>
                      <td class="border-top-thin" style="padding-left:0;">
                      </td>
                    </tr>
                    <tr class="bg-secondary text-light">
                      <td class="report-header report-subheader-noindent" colspan="4">
                        Harga Pokok Penjualan
                      </td>
                    </tr>
                    <tr>
                      <td class="report-subtotal text-left regular-text" colspan="2">
                        Total Harga Pokok Penjualan
                      </td>
                      <td class="report-subtotal text-right" id="assets-type-1-total-data">
                        0,00
                      </td>
                      <td class="border-top-thin" style="padding-left:0;">
                      </td>
                    </tr>
                    <tr>
                      <td class="grand-total text-left no-indent" colspan="2">
                        Laba Kotor
                      </td>
                      <td class="report-subtotal text-right subtotal1">
                        0,00
                      </td>
                      <td class="grand-total no-border-bottom text-left subtotal1 no-indent" style="padding-left:0;">
                      </td>
                    </tr>
                    <tr>
                      <td class="w-border-bottom" colspan="4" height="28px"></td>
                    </tr>
                    <tr class="bg-secondary text-light">
                      <td class="report-header report-subheader-noindent" colspan="4">
                        Biaya Operasional
                      </td>
                    </tr>
                    <tr>
                      <td class="report-subtotal text-left regular-text" colspan="2">
                        Total Biaya
                      </td>
                      <td class="report-subtotal text-right" id="assets-type-1-total-data">
                        0,00
                      </td>
                      <td class="border-top-thin" style="padding-left:0;">
                      </td>
                    </tr>
                    <tr>
                      <td class="grand-total no-border-bottom text-left no-indent subtotal1" colspan="2">
                        Pendapatan Bersih Operasional
                      </td>
                      <td class="grand-total no-border-bottom text-right subtotal1">
                        0,00
                      </td>
                      <td class="grand-total text-right subtotal1 no-border-bottom no-indent" style="padding-left:0;">
                      </td>
                    </tr>
                    <tr>
                      <td class="w-border-bottom" colspan="4" height="28px"></td>
                    </tr>
                    <tr class="bg-secondary text-light">
                      <td class="report-header report-subheader-noindent" colspan="4">
                        Pendapatan Lainnya
                      </td>
                    </tr>
                    <tr>
                      <td class="report-subtotal text-left regular-text" colspan="2">
                        Total Pendapatan Lainnya
                      </td>
                      <td class="report-subtotal text-right" id="assets-type-1-total-data">
                        0,00
                      </td>
                      <td class="border-top-thin" style="padding-left:0;">
                      </td>
                    </tr>
                    <tr class="bg-secondary text-light">
                      <td class="report-header report-subheader-noindent" colspan="4">
                        Biaya Lainnya
                      </td>
                    </tr>
                    <tr>
                      <td class="report-subtotal text-left regular-text" colspan="2">
                        Total Biaya Lainnya
                      </td>
                      <td class="report-subtotal text-right" id="assets-type-1-total-data">
                        0,00
                      </td>
                      <td class="border-top-thin" style="padding-left:0;">
                      </td>
                    </tr>
                    <tr>
                      <td class="grand-total text-left no-indent no-border-bottom subtotal1" colspan="2">
                        Pendapatan Bersih
                      </td>
                      <td class="grand-total no-border-bottom text-right subtotal1">
                        0,00
                      </td>
                      <td class="grand-total no-border-bottom text-right subtotal1 no-indent" style="padding-left:0;">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
