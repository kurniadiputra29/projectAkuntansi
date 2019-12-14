@extends('layouts.app')

@section('title', 'Laporan Kas Kecil')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-trending-up bg-blue"></i>
              <div class="d-inline">
                <h5>Kas Kecil</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Kas Kecil</li>
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
                <a type="button" class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="ik ik-filter"></i>Filter</a>
              </div>
              <div class="right-container">
                <a type="button" class="btn btn-success mr-5" href="/laporan"><i class="ik ik-arrow-left"></i>Back</a>
                <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#pdfModal"><i class="ik ik-printer"></i>Print</a>
              </div>
            </div>
            <div class="card-body">
              <div class="dt-responsive">
                @php
                function format_uang($angka){
                  $hasil =  number_format($angka,2, ',' , '.');
                  return $hasil;
                }
                function format_uang2($angka){
                  $hasil =  number_format($angka,0, ',' , '.');
                  return $hasil;
                }
                @endphp
                <table id="complex-dt" class="table table-bordered nowrap">
                  <thead>
                    <tr class="bg-secondary font-weight-bold">
                      <th class="col-2 text-light">Tanggal</th>
                      <th class="col-2 text-light">Deskripsi</th>
                      <th class="col-2 text-light">Nomor Akun</th>
                      <th class="col-2 text-light">Nama Akun</th>
                      <th class="col-2 text-light">Debet</th>
                      <th class="col-2 text-light">Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($pc_detail as $data)
                      <tr>
                        <td>{{date('d F Y', strtotime($data->pettycash->tanggal ))}}</td>
                        <td>{{$data->pettycash->description}}</td>
                        <td>{{$data->nomor_akun}}</td>
                        <td>{{$data->nama_akun}}</td>
                        <td class="text-right">
                          {{format_uang2($data->debet)}}
                        </td>
                        <td class="text-right">
                          {{format_uang2($data->kredit)}}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td></td>
                      <td class="text-light" colspan="3">Total</td>
                      <td class="text-light text-right">{{format_uang2($sum_debet)}}</td>
                      <td class="text-light text-right">{{format_uang2($sum_kredit)}}</td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div style="margin-bottom: 40px;"></div>
              <div class="dt-responsive">
                <table id="simpletable" class="table table-bordered nowrap">
                  <thead>
                    <tr class="bg-secondary font-weight-bold">
                      <td class="text-light text-center" colspan="4">Rekapitulasi</td>
                    </tr>
                    <tr>
                      <td>Nomor Akun</td>
                      <td>Nama Akun</td>
                      <td>Debet</td>
                      <td>Kredit</td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($distinct_pc as $rekap)
                      <tr>
                        <td>{{$rekap->nomor_akun}}</td>
                        <td>{{$rekap->nama_akun}}</td>
                        <td class="text-right">{{format_uang2($rekap->where('nomor_akun', $rekap->nomor_akun)->sum('debet'))}}</td>
                        <td class="text-right">{{format_uang2($rekap->where('nomor_akun', $rekap->nomor_akun)->sum('kredit'))}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-right" colspan="2">Total</td>
                      <td class="text-light text-right">{{format_uang2($sum_debet)}}</td>
                      <td class="text-light text-right">{{format_uang2($sum_kredit)}}</td>
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
  @include('reports.petty_cash_book.show')
  @include('reports.petty_cash_book.pdf')

@endsection
