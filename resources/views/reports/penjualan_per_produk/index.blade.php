@extends('layouts.app')

@section('title', 'Laporan Penjualan per Produk')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-trending-up bg-blue"></i>
              <div class="d-inline">
                <h5>Penjualan per Produk</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Penjualan per Produk</li>
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
                        Kode Produk
                      </th>
                      <th class="text-light">
                        Nama Produk
                      </th>
                      <th class="text-light">
                        Kuantitas Terjual
                      </th>
                      <th class="text-light">
                        Kuantitas Retur
                      </th>
                      <th class="text-light">
                        Satuan
                      </th>
                      <th class="text-right text-light">
                        Total Nilai Terjual
                      </th>
                      <th class="text-right text-light">
                        Total Nilai Retur
                      </th>
                      <th class="text-right text-light">
                        Harga Penjualan Rata-rata
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>AU-N06</td>
                      <td>Lemari Es</td>
                      <td>40</td>
                      <td>0</td>
                      <td>Buah</td>
                      <td class="text-right">Rp80.000.000,00</td>
                      <td class="text-right">0</td>
                      <td class="text-right">Rp2.000.000,00</td>
                    </tr>
                    <tr>
                      <td>AU-N08</td>
                      <td>AC</td>
                      <td>40</td>
                      <td>0</td>
                      <td>Buah</td>
                      <td class="text-right">Rp100.000.000,00</td>
                      <td class="text-right">0</td>
                      <td class="text-right">Rp2.500.000,00</td>
                    </tr>
                    <tr class="bg-success text-light">
                      <td class="text-right grand-total" colspan="5">
                        Total
                      </td>
                      <td class="text-right grand-total">
                        Rp180.000.000,00
                      </td>
                      <td class="text-right grand-total">
                        0,00
                      </td>
                      <td></td>
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
