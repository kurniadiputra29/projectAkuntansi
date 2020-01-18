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
                <a type="button" class="btn btn-primary mr-5" href="{{route('neraca_saldo.print')}}"><i class="ik ik-printer"></i>Print</a>
              </div>
            </div>
            <div class="card-body">
              <div class="dt-responsive">
                <table id="simpletable" class="table table-bordered nowrap">
                  <thead>
                    <tr class="bg-secondary font-weight-bold">
                      <td class="text-light text-center" colspan="4">Rekapitulasi</td>
                    </tr>
                    <tr>
                      <td class="text-center">Nomor Akun</td>
                      <td class="text-center">Nama Akun</td>
                      <td class="text-center">Debet</td>
                      <td class="text-center">Kredit</td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($accounts as $account)
                      <tr>
                        <td class="text-center">{{$account->nomor}}</td>
                        <td class="text-left">{{$account->nama}}</td>
                        @if( ($distinct_laporan->where('nomor_akun', $account->nomor)->sum('debet') + $distinct_laporan->where('account_id', $account->id)->sum('debet')) - ($distinct_laporan->where('account_id', $account->id)->sum('kredit')  + $distinct_laporan->where('nomor_akun', $account->nomor)->sum('kredit')) > 0)
                        <td class="text-right">
                            Rp {{number_format(($distinct_laporan->where('nomor_akun', $account->nomor)->sum('debet') + $distinct_laporan->where('account_id', $account->id)->sum('debet')) - ($distinct_laporan->where('account_id', $account->id)->sum('kredit')  + $distinct_laporan->where('nomor_akun', $account->nomor)->sum('kredit')), 0, " ", ".")}}
                        </td>
                        <td class="text-right">
                        </td>
                        @else
                        <td class="text-right">
                        </td>
                        <td class="text-right">
                            Rp {{number_format(($distinct_laporan->where('nomor_akun', $account->nomor)->sum('kredit') + $distinct_laporan->where('account_id', $account->id)->sum('kredit')) - ($distinct_laporan->where('account_id', $account->id)->sum('debet')  + $distinct_laporan->where('nomor_akun', $account->nomor)->sum('debet')), 0, " ", ".")}}
                        </td>
                        @endif
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-center" colspan="2">Total</td>
                      <td class="text-light text-right">
                        @php 
                          $sum_tot_Price_Debet = 0 
                        @endphp
                        @foreach ($accounts as $accoun)
                        @if( ($distinct_laporan->where('nomor_akun', $accoun->nomor)->sum('debet') + $distinct_laporan->where('account_id', $accoun->id)->sum('debet')) - ($distinct_laporan->where('account_id', $accoun->id)->sum('kredit')  + $distinct_laporan->where('nomor_akun', $accoun->nomor)->sum('kredit')) > 0)
                          @php 
                            $sum_tot_Price_Debet += ($distinct_laporan->where('nomor_akun', $accoun->nomor)->sum('debet') + $distinct_laporan->where('account_id', $accoun->id)->sum('debet')) - ($distinct_laporan->where('account_id', $accoun->id)->sum('kredit')  + $distinct_laporan->where('nomor_akun', $accoun->nomor)->sum('kredit')) 
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_Price_Debet, 0, " ", ".")}}
                      </td>
                      <td class="text-light text-right">
                        @php 
                          $sum_tot_Price_Kredit = 0 
                        @endphp
                        @foreach ($accounts as $accoun)
                        @if( ($distinct_laporan->where('nomor_akun', $accoun->nomor)->sum('debet') + $distinct_laporan->where('account_id', $accoun->id)->sum('debet')) - ($distinct_laporan->where('account_id', $accoun->id)->sum('kredit')  + $distinct_laporan->where('nomor_akun', $accoun->nomor)->sum('kredit')) < 0)
                          @php 
                            $sum_tot_Price_Kredit += ($distinct_laporan->where('nomor_akun', $accoun->nomor)->sum('kredit') + $distinct_laporan->where('account_id', $accoun->id)->sum('kredit')) - ($distinct_laporan->where('account_id', $accoun->id)->sum('debet')  + $distinct_laporan->where('nomor_akun', $accoun->nomor)->sum('debet')) 
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_Price_Kredit, 0, " ", ".")}}
                      </td>
                    </tr>
                    <tr class="bg-warning font-weight-bold">
                      <td class="text-light text-center" colspan="2">Balance</td>
                      <td class="text-light text-center" colspan="2">Rp {{number_format($distinct_laporan->sum('debet') - $distinct_laporan->sum('kredit'), 0, " ", ".")}}
                      </td>
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
