@extends('layouts.app')

@section('title', 'Laporan Daftar Pembelian')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-trending-up bg-blue"></i>
              <div class="d-inline">
                <h5>Daftar Pembelian</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Daftar Pembelian</li>
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
          <div class="table-container list-table bg-white">
            <div class="report-title">
              <div class="table-responsive dragscroll">
                <table class="report-table table">
                  <thead class="report-header new-report">
                    <tr class="bg-light">
                      <th>Tanggal</th>
                      <th>Transaksi</th>
                      <th>Nomor</th>
                      <th>Supplier</th>
                      <th>Status</th>
                      <th>Keterangan</th>
                      <th>Total tagihan</th>
                      <th>Sisa tagihan</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    function format_uang($angka){
                      $hasil =  number_format($angka,2, ',' , '.');
                      return $hasil;
                    }
                    @endphp
                    <tr>
                      <td>01/05/2016</td>
                      <td>Purchase</td>
                      <td>100018</td>
                      <td>PT All in One</td>
                      <td>Paid</td>
                      <td></td>
                      <td>Rp{{format_uang(3000000)}}</td>
                      <td>Rp{{format_uang(3000000)}}</td>
                    </tr>
                    <tr>
                      <td>01/05/2016</td>
                      <td>Purchase</td>
                      <td>100018</td>
                      <td>PT All in One</td>
                      <td>Paid</td>
                      <td></td>
                      <td>Rp{{format_uang(3000000)}}</td>
                      <td>Rp{{format_uang(3000000)}}</td>
                    </tr>
                    <tr>
                      <td>01/05/2016</td>
                      <td>Purchase</td>
                      <td>100018</td>
                      <td>PT All in One</td>
                      <td>Paid</td>
                      <td></td>
                      <td>Rp{{format_uang(3000000)}}</td>
                      <td>Rp{{format_uang(3000000)}}</td>
                    </tr>
                    <tr>
                      <td>01/05/2016</td>
                      <td>Purchase</td>
                      <td>100018</td>
                      <td>PT All in One</td>
                      <td>Paid</td>
                      <td></td>
                      <td>Rp{{format_uang(3000000)}}</td>
                      <td>Rp{{format_uang(3000000)}}</td>
                    </tr>
                    <tr>
                      <td>01/05/2016</td>
                      <td>Purchase</td>
                      <td>100018</td>
                      <td>PT All in One</td>
                      <td>Paid</td>
                      <td></td>
                      <td>Rp{{format_uang(3000000)}}</td>
                      <td>Rp{{format_uang(3000000)}}</td>
                    </tr>
                    <tr>
                      <td>01/05/2016</td>
                      <td>Purchase</td>
                      <td>100018</td>
                      <td>PT All in One</td>
                      <td>Paid</td>
                      <td></td>
                      <td>Rp{{format_uang(3000000)}}</td>
                      <td>Rp{{format_uang(3000000)}}</td>
                    </tr>
                    <tr>
                      <td>01/05/2016</td>
                      <td>Purchase</td>
                      <td>100018</td>
                      <td>PT All in One</td>
                      <td>Paid</td>
                      <td></td>
                      <td>Rp{{format_uang(3000000)}}</td>
                      <td>Rp{{format_uang(3000000)}}</td>
                    </tr>
                    <tr>
                      <td>01/05/2016</td>
                      <td>Purchase</td>
                      <td>100018</td>
                      <td>PT All in One</td>
                      <td>Paid</td>
                      <td></td>
                      <td>Rp{{format_uang(3000000)}}</td>
                      <td>Rp{{format_uang(3000000)}}</td>
                    </tr>
                    <tr class="bg-success text-light">
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <th>Total</th>
                      <td>Rp{{format_uang(24000000)}}</td>
                      <td>Rp{{format_uang(24000000)}}</td>
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
