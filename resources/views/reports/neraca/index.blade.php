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
                {{-- <button type="button" class="btn btn-info mr-5" data-toggle="modal" data-target="#createModal"><i class="ik ik-filter"></i>Filter</button> --}}
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
                      <th class="text-center">Nomor Akun</th>
                      <th class="text-center">Nama Akun</th>
                      <th class="text-center">Debet</th>
                      <th class="text-center">Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($assets as $asset)
                      <tr>
                        <td class="text-center">{{$asset->nomor}}</td>
                        <td class="text-left">{{$asset->nama}}</td>
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('kredit')) > 0)
                        <td class="text-right">
                            Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('kredit')), 0, " ", ".")}}
                        </td>
                        <td class="text-right">
                        </td>
                        @else
                        <td class="text-right">
                        </td>
                        <td class="text-right">
                            Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('debet')), 0, " ", ".")}}
                        </td>
                        @endif
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-center"  colspan="2">Total Aset</td>
                      <td class="text-light text-right">
                        @php
                          $sum_tot_asset_Debet = 0
                        @endphp
                        @foreach ($assets as $asset)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('kredit')) > 0)
                          @php
                            $sum_tot_asset_Debet += ($distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('kredit'))
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_asset_Debet, 0, " ", ".")}}
                      </td>
                      <td class="text-light text-right">
                        @php
                          $sum_tot_asset_Kredit = 0
                        @endphp
                        @foreach ($assets as $asset)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('kredit')) < 0)
                          @php
                            $sum_tot_asset_Kredit += ($distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $asset->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $asset->nomor)->sum('debet'))
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_asset_Kredit, 0, " ", ".")}}
                      </td>
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
                      <th class="text-center">Nomor Akun</th>
                      <th class="text-center">Nama Akun</th>
                      <th class="text-center">Debet</th>
                      <th class="text-center">Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($liabilities as $liability)
                      <tr>
                        <td class="text-center">{{$liability->nomor}}</td>
                        <td class="text-left">{{$liability->nama}}</td>
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('kredit')) > 0)
                        <td class="text-right">
                            Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('kredit')), 0, " ", ".")}}
                        </td>
                        <td class="text-right">
                        </td>
                        @else
                        <td class="text-right">
                        </td>
                        <td class="text-right">
                            Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('debet')), 0, " ", ".")}}
                        </td>
                        @endif
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-center"  colspan="2">Total Liabilitas</td>
                      <td class="text-light text-right">
                        @php
                          $sum_tot_liability_Debet = 0
                        @endphp
                        @foreach ($liabilities as $liability)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('kredit')) > 0)
                          @php
                            $sum_tot_liability_Debet += ($distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('kredit'))
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_liability_Debet, 0, " ", ".")}}
                      </td>
                      <td class="text-light text-right">
                        @php
                          $sum_tot_liability_Kredit = 0
                        @endphp
                        @foreach ($liabilities as $liability)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('kredit')) < 0)
                          @php
                            $sum_tot_liability_Kredit += ($distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $liability->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $liability->nomor)->sum('debet'))
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_liability_Kredit, 0, " ", ".")}}
                      </td>
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
                      <th class="text-center">Nomor Akun</th>
                      <th class="text-center">Nama Akun</th>
                      <th class="text-center">Debet</th>
                      <th class="text-center">Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($equities as $equity)
                      <tr>
                        <td class="text-center">{{$equity->nomor}}</td>
                        <td class="text-left">{{$equity->nama}}</td>
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('kredit')) > 0)
                        <td class="text-right">
                            Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('kredit')), 0, " ", ".")}}
                        </td>
                        <td class="text-right">
                        </td>
                        @else
                        <td class="text-right">
                        </td>
                        <td class="text-right">
                            Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('debet')), 0, " ", ".")}}
                        </td>
                        @endif
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-center" colspan="2">Total Ekuitas</td>
                      <td class="text-light text-right">
                        @php
                          $sum_tot_equity_Debet = 0
                        @endphp
                        @foreach ($equities as $equity)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('kredit')) > 0)
                          @php
                            $sum_tot_equity_Debet += ($distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('kredit'))
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_equity_Debet, 0, " ", ".")}}
                      </td>
                      <td class="text-light text-right">
                        @php
                          $sum_tot_equity_Kredit = 0
                        @endphp
                        @foreach ($equities as $equity)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('kredit')) < 0)
                          @php
                            $sum_tot_equity_Kredit += ($distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $equity->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $equity->nomor)->sum('debet'))
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_equity_Kredit, 0, " ", ".")}}
                      </td>
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
                      <th class="text-center">Kategori</th>
                      <th class="text-center">Debet</th>
                      <th class="text-center">Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Aset</td>
                      <td class="text-right">Rp {{number_format($sum_tot_asset_Debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{number_format($sum_tot_asset_Kredit, 0, " ", ".")}}</td>
                    </tr>
                    <tr>
                      <td>Liabilitas</td>
                      <td class="text-right">Rp {{number_format($sum_tot_liability_Debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{number_format($sum_tot_liability_Kredit, 0, " ", ".")}}</td>
                    </tr>
                    <tr>
                      <td>Ekuitas</td>
                      <td class="text-right">Rp {{number_format($sum_tot_equity_Debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{number_format($sum_tot_equity_Kredit, 0, " ", ".")}}</td>
                    </tr>
                    <tr>
                      <td>Provit</td>
                      @if(($sum_tot_asset_Kredit + $sum_tot_liability_Kredit + $sum_tot_equity_Kredit) - ($sum_tot_asset_Debet + $sum_tot_liability_Debet + $sum_tot_equity_Debet) >= 0)
                        <td class="text-right">
                          Rp {{number_format(($sum_tot_asset_Kredit + $sum_tot_liability_Kredit + $sum_tot_equity_Kredit) - ($sum_tot_asset_Debet + $sum_tot_liability_Debet + $sum_tot_equity_Debet), 0, " ", ".")}}
                        </td>
                        <td class="text-right">Rp 0</td>
                      @else
                        <td class="text-right">Rp 0</td>
                        <td class="text-right">
                          Rp {{number_format(($sum_tot_asset_Debet + $sum_tot_liability_Debet + $sum_tot_equity_Debet) - ($sum_tot_asset_Kredit + $sum_tot_liability_Kredit + $sum_tot_equity_Kredit), 0, " ", ".")}}
                        </td>
                      @endif
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light">Total</td>
                      @if(($sum_tot_asset_Kredit + $sum_tot_liability_Kredit + $sum_tot_equity_Kredit) - ($sum_tot_asset_Debet + $sum_tot_liability_Debet + $sum_tot_equity_Debet) >= 0)
                        <td class="text-right text-light">
                          Rp {{number_format((($sum_tot_asset_Kredit + $sum_tot_liability_Kredit + $sum_tot_equity_Kredit) - ($sum_tot_asset_Debet + $sum_tot_liability_Debet + $sum_tot_equity_Debet)) + ($sum_tot_asset_Debet + $sum_tot_liability_Debet + $sum_tot_equity_Debet), 0, " ", ".")}}
                        </td>
                        <td class="text-right text-light">
                          Rp {{number_format($sum_tot_asset_Kredit + $sum_tot_liability_Kredit + $sum_tot_equity_Kredit, 0, " ", ".")}}
                        </td>
                      @else
                        <td class="text-right text-light">
                          Rp {{number_format($sum_tot_asset_Debet + $sum_tot_liability_Debet + $sum_tot_equity_Debet, 0, " ", ".")}}
                        </td>
                        <td class="text-right text-light">
                          Rp {{number_format((($sum_tot_asset_Debet + $sum_tot_liability_Debet + $sum_tot_equity_Debet) - ($sum_tot_asset_Kredit + $sum_tot_liability_Kredit + $sum_tot_equity_Kredit)) + ($sum_tot_asset_Kredit + $sum_tot_liability_Kredit + $sum_tot_equity_Kredit), 0, " ", ".")}}
                        </td>
                      @endif
                    </tr>
                    <tr class="bg-danger font-weight-bold">
                      <td class="text-light">Balance</td>
                      @if(($sum_tot_asset_Kredit + $sum_tot_liability_Kredit + $sum_tot_equity_Kredit) - ($sum_tot_asset_Debet + $sum_tot_liability_Debet + $sum_tot_equity_Debet) >= 0)
                        <td class="text-center text-light" colspan="2">
                          Rp {{number_format(((($sum_tot_asset_Kredit + $sum_tot_liability_Kredit + $sum_tot_equity_Kredit) - ($sum_tot_asset_Debet + $sum_tot_liability_Debet + $sum_tot_equity_Debet)) + ($sum_tot_asset_Debet + $sum_tot_liability_Debet + $sum_tot_equity_Debet)) - ($sum_tot_asset_Kredit + $sum_tot_liability_Kredit + $sum_tot_equity_Kredit), 0, " ", ".")}}
                        </td>
                      @else
                        <td class="text-center text-light" colspan="2">
                          Rp {{number_format(((($sum_tot_asset_Debet + $sum_tot_liability_Debet + $sum_tot_equity_Debet) - ($sum_tot_asset_Kredit + $sum_tot_liability_Kredit + $sum_tot_equity_Kredit)) + ($sum_tot_asset_Kredit + $sum_tot_liability_Kredit + $sum_tot_equity_Kredit)) - ($sum_tot_asset_Debet + $sum_tot_liability_Debet + $sum_tot_equity_Debet), 0, " ", ".")}}
                        </td>
                      @endif
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
