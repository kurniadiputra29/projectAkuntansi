@extends('layouts.app')

@section('title', 'Laporan Neraca Saldo')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-trending-up bg-blue"></i>
              <div class="d-inline">
                <h5>Neraca Saldo</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Neraca Saldo</li>
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
                <h3>Neraca Saldo</h3>
                <span>use class <code>table-hover</code> inside table element</span>
              </div>
              <div class="right-container">
                <a type="button" class="btn btn-success mr-5" href="/laporan"><i class="ik ik-arrow-left"></i>Back</a>
                <button type="button" class="btn btn-info mr-5" data-toggle="modal" data-target="#createModal"><i class="ik ik-filter"></i>Filter</button>                
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pdfModal"><i class="ik ik-printer"></i>Print</button>
              </div>
            </div>
            <div class="card-body">
              @php
                function format_uang($angka){
                  $hasil =  number_format($angka,0, ',' , '.');
                  return $hasil;
                }
              @endphp
              <div class="dt-responsive">
                <table class="table table-bordered nowrap">
                  <thead>
                    <tr class="bg-secondary font-weight-bold">
                      <td class="text-light text-center" colspan="4">Akun</td>
                    </tr>
                    <tr>
                      <th>Nomor Akun</th>
                      <th>Nama Akun</th>
                      <th>Debet</th>
                      <th>Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($neraca_saldo as $value)
                    <tr>
                      <td>{{$value->nomor}}</td>
                      <td>{{$value->nama}}</td>
                      <td class="text-right">{{format_uang($value->debet)}}</td>
                      <td class="text-right">{{format_uang($value->kredit)}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-right" colspan="2">Total</td>
                      <td class="text-light text-right">{{format_uang($debet_neraca_saldo)}}</td>
                      <td class="text-light text-right">{{format_uang($kredit_neraca_saldo)}}</td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
