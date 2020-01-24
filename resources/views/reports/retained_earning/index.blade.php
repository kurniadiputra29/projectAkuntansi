@extends('layouts.app')

@section('title', 'Laporan Retained Earning')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-trending-up bg-blue"></i>
              <div class="d-inline">
                <h5>Retained Earning</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Retained Earning</li>
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
                <h3>Laporan Retained Earning</h3>
                <span>use class <code>table-hover</code> inside table element</span>
              </div>
              <div class="right-container">
                <a type="button" class="btn btn-success mr-5" href="/laporan"><i class="ik ik-arrow-left"></i>Back</a>
                {{-- <button type="button" class="btn btn-info mr-5" data-toggle="modal" data-target="#createModal"><i class="ik ik-filter"></i>Filter</button> --}}
                <a type="button" class="btn btn-primary" href="{{route('retained_earning.print')}}"><i class="ik ik-printer"></i>Print</a>
              </div>
            </div>
            <div class="card-body">
              <div class="dt-responsive">
                <table class="table table-bordered nowrap">
                  <thead>
                    <tr class="bg-secondary font-weight-bold">
                      <td class="text-light text-center" colspan="2">Laporan Retained Earning</td>
                    </tr>
                    <tr>
                      <th>Keterangan</th>
                      <th class="text-center">Balance</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Saldo Awal</td>
                      @foreach ($retained_earnings as $retained_earning)
                        <td class="text-right">
                          Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $retained_earning->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $retained_earning->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $retained_earning->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $retained_earning->nomor)->sum('debet')), 0, " ", ".")}}
                        </td>
                      @endforeach
                    </tr>
                    <tr>
                      <td>Provit</td>
                      <td class="text-right">
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

                        Rp {{number_format(($sum_tot_asset_Debet + $sum_tot_liability_Debet + $sum_tot_equity_Debet) - ($sum_tot_asset_Kredit + $sum_tot_liability_Kredit + $sum_tot_equity_Kredit), 0, " ", ".")}}
                      </td>
                    </tr>
                    <tr>
                      <td>Devidend</td>
                      <td class="text-right">Rp 0</td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-center">Total</td>
                      <td class="text-light text-right">
                        Rp {{number_format((($distinct_laporan_penyesuaian->where('nomor_akun', $retained_earning->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $retained_earning->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $retained_earning->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $retained_earning->nomor)->sum('debet'))) + (($sum_tot_asset_Debet + $sum_tot_liability_Debet + $sum_tot_equity_Debet) - ($sum_tot_asset_Kredit + $sum_tot_liability_Kredit + $sum_tot_equity_Kredit)), 0, " ", ".")}}
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
