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
          <div>
            @php
            function format_uang($angka){
              $hasil =  number_format($angka,2, ',' , '.');
              return $hasil;
            }
            @endphp
            @foreach ($saldo_awal as $key)
            <table class="table table-striped table-bordered nowrap">
              <thead>
                <tr class="bg-secondary font-weight-bold">
                  <th class="col-8 text-light" colspan="4">Nama Akun: {{$key->account->nama}}</th>
                  <th class="col-4 text-light" colspan="2">Nomor Akun: {{$key->account->nomor}}</th>
                </tr>
                <tr>
                  <th class="col-2" rowspan="2">Tanggal</th>
                  <th class="col-2" rowspan="2">Deskripsi</th>
                  <th class="col-2" rowspan="2">Debet</th>
                  <th class="col-2" rowspan="2">Kredit</th>
                  <th class="col-4" colspan="2" style="text-align: center;">Balance</th>
                </tr>
                <tr>
                  <th>Debet</th>
                  <th>Kredit</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{date('d F Y', strtotime($key->created_at ))}}</td>
                  <td></td>
                  <td>Rp{{format_uang($key->debet)}}</td>
                  <td>Rp{{format_uang($key->kredit)}}</td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
