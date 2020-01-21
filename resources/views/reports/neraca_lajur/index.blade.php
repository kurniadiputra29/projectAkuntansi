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
                    <td rowspan="2" class="text-center">Kode</td>
                    <td rowspan="2" class="text-center">Nama Akun</td>
                    <td colspan="2" class="text-center">Neraca Saldo</td>
                    <td colspan="2" class="text-center">Penyesuaian</td>
                    <td colspan="2" class="text-center">Neraca Saldo Setelah Penyesuaian</td>
                    <td colspan="2" class="text-center">Laba Rugi</td>
                    <td colspan="2" class="text-center">Neraca</td>
                  </tr>
                  <tr>
                    <td class="text-center">Debet</td>
                    <td class="text-center">Kredit</td>
                    <td class="text-center">Debet</td>
                    <td class="text-center">Kredit</td>
                    <td class="text-center">Debet</td>
                    <td class="text-center">Kredit</td>
                    <td class="text-center">Debet</td>
                    <td class="text-center">Kredit</td>
                    <td class="text-center">Debet</td>
                    <td class="text-center">Kredit</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($accounts as $account)
                    <tr>
                      <td class="text-center">{{$account->nomor}}</td>
                      <td class="text-left">{{$account->nama}}</td>
                      <!-- Neraca Saldo -->
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
                      <!-- Jurnal Penyesuaian -->
                      @if( ($jurnalpenyesuaiandetails->where('nomor_akun', $account->nomor)->sum('debet')) - ($jurnalpenyesuaiandetails->where('nomor_akun', $account->nomor)->sum('kredit')) > 0)
                      <td class="text-right">
                          Rp {{number_format(($jurnalpenyesuaiandetails->where('nomor_akun', $account->nomor)->sum('debet')) - ($jurnalpenyesuaiandetails->where('nomor_akun', $account->nomor)->sum('kredit')), 0, " ", ".")}}
                      </td>
                      <td class="text-right">
                      </td>
                      @elseif ($jurnalpenyesuaiandetails->where('nomor_akun', $account->nomor)->sum('debet') == null && $jurnalpenyesuaiandetails->where('nomor_akun', $account->nomor)->sum('kredit') == null)
                      <td class="text-right">
                      </td>
                      <td class="text-right">
                      </td>
                      @else
                      <td class="text-right">
                      </td>
                      <td class="text-right">
                          Rp {{number_format(($jurnalpenyesuaiandetails->where('nomor_akun', $account->nomor)->sum('kredit')) - ($jurnalpenyesuaiandetails->where('nomor_akun', $account->nomor)->sum('debet')), 0, " ", ".")}}
                      </td>
                      @endif
                      <!-- Neraca Saldo Setelah Penyesuaian -->
                      @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $account->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $account->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $account->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $account->nomor)->sum('kredit')) > 0)
                      <td class="text-right">
                          Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $account->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $account->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $account->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $account->nomor)->sum('kredit')), 0, " ", ".")}}
                      </td>
                      <td class="text-right">
                      </td>
                      @else
                      <td class="text-right">
                      </td>
                      <td class="text-right">
                          Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $account->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $account->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $account->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $account->nomor)->sum('debet')), 0, " ", ".")}}
                      </td>
                      @endif
                      <!-- Laba Rugi -->
                      @foreach ($saless as $sales)
                        @if ($sales->nomor == $account->nomor)
                          @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('kredit')) > 0)
                          <td class="text-right">
                              Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('kredit')), 0, " ", ".")}}
                          </td>
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          @else
                          <td class="text-right"></td>
                          <td class="text-right">
                              Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('debet')), 0, " ", ".")}}
                          </td>
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          @endif
                        @endif
                      @endforeach
                      @foreach ($costs as $cost)
                        @if ($cost->nomor == $account->nomor)
                          @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('kredit')) > 0)
                          <td class="text-right">
                              Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('kredit')), 0, " ", ".")}}
                          </td>
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          @else
                          <td class="text-right"></td>
                          <td class="text-right">
                              Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('debet')), 0, " ", ".")}}
                          </td>
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          @endif
                        @endif
                      @endforeach
                      @foreach ($expenses as $expense)
                        @if ($expense->nomor == $account->nomor)
                          @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('kredit')) > 0)
                          <td class="text-right">
                              Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('kredit')), 0, " ", ".")}}
                          </td>
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          @else
                          <td class="text-right"></td>
                          <td class="text-right">
                              Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('debet')), 0, " ", ".")}}
                          </td>
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          @endif
                        @endif
                      @endforeach
                      @foreach ($other_revenues as $other_revenue)
                        @if ($other_revenue->nomor == $account->nomor)
                          @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('kredit')) > 0)
                          <td class="text-right">
                              Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('kredit')), 0, " ", ".")}}
                          </td>
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          @else
                          <td class="text-right"></td>
                          <td class="text-right">
                              Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('debet')), 0, " ", ".")}}
                          </td>
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          @endif
                        @endif
                      @endforeach
                      @foreach ($other_expenses as $other_expense)
                        @if ($other_expense->nomor == $account->nomor)
                          @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('kredit')) > 0)
                          <td class="text-right">
                              Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('kredit')), 0, " ", ".")}}
                          </td>
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          @else
                          <td class="text-right"></td>
                          <td class="text-right">
                              Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('debet')), 0, " ", ".")}}
                          </td>
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          @endif
                        @endif
                      @endforeach
                      <!-- Neraca -->
                      @foreach ($assets as $asset)
                        @if ($asset->nomor == $account->nomor)
                          @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('kredit')) > 0)
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          <td class="text-right">
                              Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('kredit')), 0, " ", ".")}}
                          </td>
                          <td class="text-right"></td>
                          @else
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          <td class="text-right">
                              Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('debet')), 0, " ", ".")}}
                          </td>
                          @endif
                        @endif
                      @endforeach
                      @foreach ($liabilities as $liability)
                        @if ($liability->nomor == $account->nomor)
                          @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('kredit')) > 0)
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          <td class="text-right">
                              Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('kredit')), 0, " ", ".")}}
                          </td>
                          <td class="text-right"></td>
                          @else
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          <td class="text-right">
                              Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('debet')), 0, " ", ".")}}
                          </td>
                          @endif
                        @endif
                      @endforeach
                      @foreach ($equities as $equity)
                        @if ($equity->nomor == $account->nomor)
                          @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('kredit')) > 0)
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          <td class="text-right">
                              Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('kredit')), 0, " ", ".")}}
                          </td>
                          <td class="text-right"></td>
                          @else
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          <td class="text-right"></td>
                          <td class="text-right">
                              Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('debet')), 0, " ", ".")}}
                          </td>
                          @endif
                        @endif
                      @endforeach
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr class="bg-success font-weight-bold">
                    <td class="text-light text-center" colspan="2">Total</td>
                    <!-- Neraca Saldo -->
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
                    <!-- Journal Penyesuaian -->
                    <td class="text-light text-right">
                      @php 
                        $sum_tot_Penyesuaian_Debet = 0 
                      @endphp
                      @foreach ($accounts as $accoun)
                      @if( ($jurnalpenyesuaiandetails->where('nomor_akun', $accoun->nomor)->sum('debet')) - ($jurnalpenyesuaiandetails->where('nomor_akun', $accoun->nomor)->sum('kredit')) > 0)
                        @php 
                          $sum_tot_Penyesuaian_Debet += ($jurnalpenyesuaiandetails->where('nomor_akun', $accoun->nomor)->sum('debet')) - ($jurnalpenyesuaiandetails->where('nomor_akun', $accoun->nomor)->sum('kredit')) 
                        @endphp
                      @endif
                      @endforeach

                      Rp {{number_format($sum_tot_Penyesuaian_Debet, 0, " ", ".")}}
                    </td>
                    <td class="text-light text-right">
                      @php 
                        $sum_tot_Penyesuaian_Kredit = 0 
                      @endphp
                      @foreach ($accounts as $accoun)
                      @if( ($jurnalpenyesuaiandetails->where('nomor_akun', $accoun->nomor)->sum('debet')) - ($jurnalpenyesuaiandetails->where('nomor_akun', $accoun->nomor)->sum('kredit')) < 0)
                        @php 
                          $sum_tot_Penyesuaian_Kredit += ($jurnalpenyesuaiandetails->where('nomor_akun', $accoun->nomor)->sum('kredit')) - ($jurnalpenyesuaiandetails->where('nomor_akun', $accoun->nomor)->sum('debet')) 
                        @endphp
                      @endif
                      @endforeach
                      Rp {{number_format($sum_tot_Penyesuaian_Kredit, 0, " ", ".")}}
                    <!-- Neraca Saldo Setelah Penyesuaian -->
                    <td class="text-light text-right">
                      @php 
                        $sum_tot_Price_Debet = 0 
                      @endphp
                      @foreach ($accounts as $accoun)
                      @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $accoun->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $accoun->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $accoun->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $accoun->nomor)->sum('kredit')) > 0)
                        @php 
                          $sum_tot_Price_Debet += ($distinct_laporan_penyesuaian->where('nomor_akun', $accoun->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $accoun->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $accoun->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $accoun->nomor)->sum('kredit')) 
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
                      @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $accoun->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $accoun->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $accoun->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $accoun->nomor)->sum('kredit')) < 0)
                        @php 
                          $sum_tot_Price_Kredit += ($distinct_laporan_penyesuaian->where('nomor_akun', $accoun->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $accoun->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $accoun->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $accoun->nomor)->sum('debet')) 
                        @endphp
                      @endif
                      @endforeach

                      Rp {{number_format($sum_tot_Price_Kredit, 0, " ", ".")}}
                    </td>
                    <!-- Laba Rugi -->
                    <td class="text-light text-right">
                        @php 
                          $sum_tot_sales_Debet = 0;
                          $sum_tot_cost_Debet = 0;
                          $sum_tot_expense_Debet = 0;
                          $sum_tot_other_revenue_Debet = 0;
                          $sum_tot_other_expense_Debet = 0;
                        @endphp
                        <!-- Sales -->
                        @foreach ($saless as $sales)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('kredit')) > 0)
                          @php 
                            $sum_tot_sales_Debet += ($distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('kredit')) 
                          @endphp
                        @endif
                        @endforeach
                        <!-- Cost Of Good Sold -->
                        @foreach ($costs as $cost)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('kredit')) > 0)
                          @php 
                            $sum_tot_cost_Debet += ($distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('kredit')) 
                          @endphp
                        @endif
                        @endforeach
                        <!-- Expenses -->
                        @foreach ($expenses as $expense)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('kredit')) > 0)
                          @php 
                            $sum_tot_expense_Debet += ($distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('kredit')) 
                          @endphp
                        @endif
                        @endforeach
                        <!-- other_revenues -->
                        @foreach ($other_revenues as $other_revenue)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('kredit')) > 0)
                          @php 
                            $sum_tot_other_revenue_Debet += ($distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('kredit')) 
                          @endphp
                        @endif
                        @endforeach
                        <!-- other_expenses -->
                        @foreach ($other_expenses as $other_expense)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('kredit')) > 0)
                          @php 
                            $sum_tot_other_expense_Debet += ($distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('kredit')) 
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_sales_Debet + $sum_tot_cost_Debet + $sum_tot_expense_Debet + $sum_tot_other_revenue_Debet + $sum_tot_other_expense_Debet, 0, " ", ".")}}
                      </td>
                      <td class="text-light text-right">
                        @php 
                          $sum_tot_sales_Kredit = 0;
                          $sum_tot_cost_Kredit = 0;
                          $sum_tot_expense_Kredit = 0;
                          $sum_tot_Revenues_Kredit = 0;
                          $sum_tot_Other_Kredit = 0 ;
                        @endphp
                        <!-- Sales -->
                        @foreach ($saless as $sales)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('kredit')) < 0)
                          @php 
                            $sum_tot_sales_Kredit += ($distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('debet')) 
                          @endphp
                        @endif
                        @endforeach
                        <!-- Cost Of Good Sold -->
                        @foreach ($costs as $cost)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('kredit')) < 0)
                          @php 
                            $sum_tot_cost_Kredit += ($distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('debet')) 
                          @endphp
                        @endif
                        @endforeach 
                        <!-- Expenses -->
                        @foreach ($expenses as $expense)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('kredit')) < 0)
                          @php 
                            $sum_tot_expense_Kredit += ($distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('debet')) 
                          @endphp
                        @endif
                        @endforeach
                        <!-- other_revenues -->
                        @foreach ($other_revenues as $other_revenue)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('kredit')) < 0)
                          @php 
                            $sum_tot_Revenues_Kredit += ($distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('debet')) 
                          @endphp
                        @endif
                        @endforeach
                        <!-- other_expenses -->
                        @foreach ($other_expenses as $other_expense)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('kredit')) < 0)
                          @php 
                            $sum_tot_Other_Kredit += ($distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('debet')) 
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_sales_Kredit + $sum_tot_cost_Kredit + $sum_tot_expense_Kredit + $sum_tot_Revenues_Kredit + $sum_tot_Other_Kredit, 0, " ", ".")}}
                      </td>
                    <!-- Neraca -->
                    <td class="text-light text-right">
                        @php 
                          $sum_tot_asset_Debet = 0;
                          $sum_tot_liability_Debet = 0;
                          $sum_tot_equity_Debet = 0;
                        @endphp
                        <!-- Assets -->
                        @foreach ($assets as $asset)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('kredit')) > 0)
                          @php 
                            $sum_tot_asset_Debet += ($distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('kredit')) 
                          @endphp
                        @endif
                        @endforeach
                        <!-- Liabilities -->
                        @foreach ($liabilities as $liability)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('kredit')) > 0)
                          @php 
                            $sum_tot_liability_Debet += ($distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('kredit')) 
                          @endphp
                        @endif
                        @endforeach
                        <!-- Equities -->
                        @foreach ($equities as $equity)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('kredit')) > 0)
                          @php 
                            $sum_tot_equity_Debet += ($distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('kredit')) 
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_asset_Debet + $sum_tot_liability_Debet + $sum_tot_equity_Debet, 0, " ", ".")}}
                    </td>
                    <td class="text-light text-right">
                        @php 
                          $sum_tot_asset_Kredit = 0;
                          $sum_tot_liability_Kredit = 0;
                          $sum_tot_equity_Kredit = 0;
                        @endphp
                        <!-- Assets -->
                        @foreach ($assets as $asset)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('kredit')) < 0)
                          @php 
                            $sum_tot_asset_Kredit += ($distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('debet')) 
                          @endphp
                        @endif
                        @endforeach
                        <!-- Liabilities -->
                        @foreach ($liabilities as $liability)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('kredit')) < 0)
                          @php 
                            $sum_tot_liability_Kredit += ($distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('debet')) 
                          @endphp
                        @endif
                        @endforeach
                        <!-- Equities -->
                        @foreach ($equities as $equity)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('kredit')) < 0)
                          @php 
                            $sum_tot_equity_Kredit += ($distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('debet')) 
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_asset_Kredit + $sum_tot_liability_Kredit + $sum_tot_equity_Kredit, 0, " ", ".")}}
                    </td>
                  </tr>
                  <tr class="bg-warning font-weight-bold">
                    <td class="text-light text-center" colspan="2">Balance</td>
                    <td class="text-light text-center" colspan="2">Rp {{number_format($distinct_laporan->sum('debet') - $distinct_laporan->sum('kredit'), 0, " ", ".")}}
                    </td>
                    <td class="text-light text-center" colspan="2">
                      Rp {{number_format($sum_tot_Penyesuaian_Debet - $sum_tot_Penyesuaian_Kredit, 0, " ", ".")}}
                    </td>
                    <td class="text-light text-center" colspan="2">Rp {{number_format($distinct_laporan_penyesuaian->sum('debet') - $distinct_laporan_penyesuaian->sum('kredit'), 0, " ", ".")}}
                    </td>
                    <td class="text-light text-center" colspan="2">Rp {{number_format( ($sum_tot_sales_Kredit + $sum_tot_cost_Kredit + $sum_tot_expense_Kredit + $sum_tot_Revenues_Kredit + $sum_tot_Other_Kredit) - ($sum_tot_sales_Debet + $sum_tot_cost_Debet + $sum_tot_expense_Debet + $sum_tot_other_revenue_Debet + $sum_tot_other_expense_Debet), 0, " ", ".")}}
                    </td>
                    <td class="text-light text-center" colspan="2">Rp {{number_format(($sum_tot_asset_Debet + $sum_tot_liability_Debet + $sum_tot_equity_Debet) - ($sum_tot_asset_Kredit + $sum_tot_liability_Kredit + $sum_tot_equity_Kredit), 0, " ", ".")}}
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

@endsection
