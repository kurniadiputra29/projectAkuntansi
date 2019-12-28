@extends('layouts.app')

@section('title', 'Laporan Neraca Lajur')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-trending-up bg-blue"></i>
              <div class="d-inline">
                <h5>Laporan Neraca Lajur</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Neraca Lajur</li>
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
                <h3>Laporan Neraca Lajur</h3>
                <span>use class <code>table-hover</code> inside table element</span>
              </div>
              <div class="right-container">
                <a type="button" class="btn btn-success mr-5" href="/laporan"><i class="ik ik-arrow-left"></i>Back</a>
                <button type="button" class="btn btn-info mr-5" data-toggle="modal" data-target="#createModal"><i class="ik ik-filter"></i>Filter</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pdfModal"><i class="ik ik-printer"></i>Print</button>
              </div>
            </div>
            <div class="card-body">
              <table class="table table-bordered nowrap">
                <thead>
                  <tr>
                    <td rowspan="2">Kode</td>
                    <td rowspan="2">Nama Akun</td>
                    <td colspan="2">Neraca Saldo</td>
                    <td colspan="2">Penyesuaian</td>
                    <td colspan="2">Neraca</td>
                    <td colspan="2">Laba Rugi</td>
                    <td colspan="2">Balance</td>
                  </tr>
                  <tr>
                    <td>Debet</td>
                    <td>Kredit</td>
                    <td>Debet</td>
                    <td>Kredit</td>
                    <td>Debet</td>
                    <td>Kredit</td>
                    <td>Debet</td>
                    <td>Kredit</td>
                    <td>Debet</td>
                    <td>Kredit</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
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

@endsection
