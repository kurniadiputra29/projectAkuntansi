@extends('layouts.app')

@section('title', 'Laporan Neraca')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-trending-up bg-blue"></i>
              <div class="d-inline">
                <h5>Neraca</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Neraca</li>
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
                <h3>Neraca</h3>
                <span>use class <code>table-hover</code> inside table element</span>
              </div>
              <div class="right-container">
                <a type="button" class="btn btn-success mr-5" href="/laporan"><i class="ik ik-arrow-left"></i>Back</a>
                <button type="button" class="btn btn-info mr-5" data-toggle="modal" data-target="#createModal"><i class="ik ik-filter"></i>Filter</button>
                <a type="button" class="btn btn-primary mr-5" href="{{route('neraca.print')}}"><i class="ik ik-printer"></i>Print</a>
                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pdfModal"><i class="ik ik-printer"></i>Print</button> --}}
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
                      <td class="text-light text-center" colspan="4">Aset</td>
                    </tr>
                    <tr>
                      <th>Nomor Akun</th>
                      <th>Nama Akun</th>
                      <th>Debet</th>
                      <th>Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($asset as $aset)
                    <tr>
                      <td>{{$aset->nomor}}</td>
                      <td>{{$aset->nama}}</td>
                      <td class="text-right">{{format_uang($aset->debet)}}</td>
                      <td class="text-right">{{format_uang($aset->kredit)}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-right" colspan="2">Total Aset</td>
                      <td class="text-light text-right">{{format_uang($sum_debet_asset)}}</td>
                      <td class="text-light text-right">{{format_uang($sum_kredit_asset)}}</td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div style="margin-bottom: 40px;"></div>
              <div class="dt-responsive">
                <table class="table table-bordered nowrap">
                  <thead>
                    <tr class="bg-secondary font-weight-bold">
                      <td class="text-light text-center" colspan="4">Liabilitas</td>
                    </tr>
                    <tr>
                      <th>Nomor Akun</th>
                      <th>Nama Akun</th>
                      <th>Debet</th>
                      <th>Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($liability as $liabilitas)
                    <tr>
                      <td>{{$liabilitas->nomor}}</td>
                      <td>{{$liabilitas->nama}}</td>
                      <td class="text-right">{{format_uang($liabilitas->debet)}}</td>
                      <td class="text-right">{{format_uang($liabilitas->kredit)}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-right" colspan="2">Total Aset</td>
                      <td class="text-light text-right">{{format_uang($sum_debet_liability)}}</td>
                      <td class="text-light text-right">{{format_uang($sum_kredit_liability)}}</td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div style="margin-bottom: 40px;"></div>
              <div class="dt-responsive">
                <table class="table table-bordered nowrap">
                  <thead>
                    <tr class="bg-secondary font-weight-bold">
                      <td class="text-light text-center" colspan="4">Ekuitas</td>
                    </tr>
                    <tr>
                      <th>Nomor Akun</th>
                      <th>Nama Akun</th>
                      <th>Debet</th>
                      <th>Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($equity as $ekuitas)
                    <tr>
                      <td>{{$ekuitas->nomor}}</td>
                      <td>{{$ekuitas->nama}}</td>
                      <td class="text-right">{{format_uang($ekuitas->debet)}}</td>
                      <td class="text-right">{{format_uang($ekuitas->kredit)}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-right" colspan="2">Total Aset</td>
                      <td class="text-light text-right">{{format_uang($sum_debet_equity)}}</td>
                      <td class="text-light text-right">{{format_uang($sum_kredit_equity)}}</td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div style="margin-bottom: 40px;"></div>
              <div class="dt-responsive">
                <table class="table table-bordered nowrap">
                  <thead>
                    <tr class="bg-secondary font-weight-bold">
                      <td class="text-light text-center" colspan="4">Neraca</td>
                    </tr>
                    <tr>
                      <th>Kategori</th>
                      <th>Debet</th>
                      <th>Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Aset</td>
                      <td class="text-right">{{format_uang($sum_debet_asset)}}</td>
                      <td class="text-right">{{format_uang($sum_kredit_asset)}}</td>
                    </tr>
                    <tr>
                      <td>Liabilitas</td>
                      <td class="text-right">{{format_uang($sum_debet_liability)}}</td>
                      <td class="text-right">{{format_uang($sum_kredit_liability)}}</td>
                    </tr>
                    <tr>
                      <td>Ekuitas</td>
                      <td class="text-right">{{format_uang($sum_debet_equity)}}</td>
                      <td class="text-right">{{format_uang($sum_kredit_equity)}}</td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light">Total Aset</td>
                      <td class="text-light text-right">{{format_uang($sum_debet_asset+$sum_debet_liability+$sum_debet_equity)}}</td>
                      <td class="text-light text-right">{{format_uang($sum_kredit_asset+$sum_kredit_liability+$sum_kredit_equity)}}</td>
                    </tr>
                    <tr class="bg-danger font-weight-bold">
                      <td class="text-light">Balance</td>
                      <td class="text-light text-center" colspan="2">{{format_uang(($sum_debet_asset+$sum_debet_liability+$sum_debet_equity)-($sum_kredit_asset+$sum_kredit_liability+$sum_kredit_equity))}}</td>
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
  @include('reports.neraca.pdf')

@endsection
