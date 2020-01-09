@extends('layouts.app')

@section('title', 'Laporan Buku Besar')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-trending-up bg-blue"></i>
              <div class="d-inline">
                <h5>Buku Besar</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Buku Besar</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between flex-row">
              <div class="left-container">
                <h3>Buku Besar</h3>
                <span>use class <code>table-hover</code> inside table element</span>
              </div>
              <div class="right-container">
                <a type="button" class="btn btn-success mr-5" href="/laporan"><i class="ik ik-arrow-left"></i>Back</a>
                <button type="button" class="btn btn-info mr-5" data-toggle="modal" data-target="#createModal"><i class="ik ik-filter"></i>Filter</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pdfModal"><i class="ik ik-printer"></i>Print</button>
              </div>
            </div>
            <div class="card-body">
              <div id="app">


                  <table class="table table-striped table-bordered nowrap" v-for="(item,index) in items" :key="index">
                    <thead>
                      <tr class="bg-secondary font-weight-bold">
                        <th class="col-8 text-light" colspan="4">Nama Akun: Petty Cash</th>
                        <th class="col-4 text-light" colspan="2">Nomor Akun: 1-1111000</th>
                      </tr>
                      <tr>
                        <th class="col-2" rowspan="2">Tanggal</th>
                        <th class="col-2" rowspan="2">Deskripsi</th>
                        <th class="col-2" rowspan="2">Debet</th>
                        <th class="col-2" rowspan="2">Kredit</th>
                        <th class="col-4" colspan="2" style="text-align: center;">Balance</th>
                      </tr>
                      <tr>
                        <th class="col-2">Debet</th>
                        <th class="col-2">Kredit</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                          <td>{{ now() }}</td>
                          <td>Saldo Awal</td>

                          <td></td>
                          <td></td>

                          <td></td>
                          <td></td>
                      </tr>
                      <tr>
                          <td>{{ now() }}</td>
                          <td></td>

                          <td></td>
                          <td></td>

                          <td></td>
                          <td></td>
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

@section('vue')
  <script type="text/javascript">
    new Vue({
      el: '#app',
      data: {
        items: [
          {
            debet: 1,
            kredit: 1,
          }
        ],
      }
    });
  </script>
@endsection
