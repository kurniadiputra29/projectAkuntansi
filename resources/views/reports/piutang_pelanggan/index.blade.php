@extends('layouts.app')

@section('title', 'Laporan Piutang Pelanggan')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-trending-up bg-blue"></i>
              <div class="d-inline">
                <h5>Piutang Pelanggan</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Piutang Pelanggan</li>
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
          <div class="table-container list-table">
            <div class="report-title">
              <div class="table-responsive">
                <table class="account-transactions report-table table" id="account-entry">
                  <thead class="report-header">
                    <tr class="bg-secondary font-weight-bold">
                      <th class="text-light">
                        Pelanggan / Tanggal
                      </th>
                      <th class="text-light">
                        Transaksi
                      </th>
                      <th class="text-light">
                        Nomor
                      </th>
                      <th class="text-light">
                        Deskripsi
                      </th>
                      <th class="text-right text-light">

                      </th>
                      <th class="text-right text-light">
                        Jumlah
                      </th>
                      <th class="text-right text-light">
                        Sisa Piutang
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="report-subheader-noindent bg-primary text-light" colspan="7">
                        PT Sanex
                      </td>
                    </tr>
                    <tr>
                      <td class="bold">
                        24/11/2019
                      </td>
                      <td class="text-left bold">
                        Saldo Awal
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td class="text-right bold">
                        10.500.000,00
                      </td>
                      <td class="text-right bold">
                        10.500.000,00
                      </td>
                    </tr>
                    <tr class="report-subtotal" style="border-top: solid 2px grey;">
                      <td class="text-right regular-text" colspan="4">

                      </td>
                      <td class="text-right bold">
                        Total
                      </td>
                      <td class="text-right bold">
                        10.500.000,00
                      </td>
                      <td class="text-right bold">
                        10.500.000,00
                      </td>
                    </tr>
                    <tr>
                      <td class="report-subheader-noindent bg-primary text-light" colspan="7">
                        PT Kent
                      </td>
                    </tr>
                    <tr>
                      <td class="bold">
                        24/11/2019
                      </td>
                      <td class="text-left bold">
                        Saldo Awal
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td class="text-right bold">
                        10.500.000,00
                      </td>
                      <td class="text-right bold">
                        10.500.000,00
                      </td>
                    </tr>
                    <tr class="report-subtotal" style="border-top: solid 2px grey;">
                      <td class="text-right regular-text" colspan="4">

                      </td>
                      <td class="text-right bold">
                        Total
                      </td>
                      <td class="text-right bold">
                        10.500.000,00
                      </td>
                      <td class="text-right bold">
                        10.500.000,00
                      </td>
                    </tr>
                    <tr>
                      <td class="report-subheader-noindent bg-primary text-light" colspan="7">
                        PT Konimex
                      </td>
                    </tr>
                    <tr>
                      <td class="bold">
                        24/11/2019
                      </td>
                      <td class="text-left bold">
                        Saldo Awal
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td class="text-right bold">
                        10.500.000,00
                      </td>
                      <td class="text-right bold">
                        10.500.000,00
                      </td>
                    </tr>
                    <tr class="report-subtotal" style="border-top: solid 2px grey;">
                      <td class="text-right regular-text" colspan="4">

                      </td>
                      <td class="text-right bold">
                        Total
                      </td>
                      <td class="text-right bold">
                        10.500.000,00
                      </td>
                      <td class="text-right bold">
                        10.500.000,00
                      </td>
                    </tr>
                    <tr class="bg-success text-light">
                      <td class="text-right grand-total" colspan="5">
                        Grand Total
                      </td>
                      <td class="text-right grand-total">
                        31.500.000,00
                      </td>
                      <td class="text-right grand-total">
                        31.500.000,00
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="text-left show-total-transaction bold-roboto-text" style="">
                Menampilkan total dari 4 baris transaksi
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
