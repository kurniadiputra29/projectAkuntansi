@extends('layouts.app')

@section('title', 'Laporan Laba Rugi')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-trending-up bg-blue"></i>
              <div class="d-inline">
                <h5>Laba Rugi</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Laba Rugi</li>
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
                <h3>Laporan Laba Rugi</h3>
                <span>use class <code>table-hover</code> inside table element</span>
              </div>
              <div class="right-container">
                <a type="button" class="btn btn-success mr-5" href="/laporan"><i class="ik ik-arrow-left"></i>Back</a>
                <button type="button" class="btn btn-info mr-5" data-toggle="modal" data-target="#createModal"><i class="ik ik-filter"></i>Filter</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pdfModal"><i class="ik ik-printer"></i>Print</button>
              </div>
            </div>
            <div class="card-body">
              <div class="dt-responsive">
                <table class="table table-bordered nowrap">
                  <thead>
                    <tr class="bg-secondary font-weight-bold">
                      <td class="text-light text-center" colspan="4">Sales</td>
                    </tr>
                    <tr>
                      <th class="text-center">Nomor Akun</th>
                      <th class="text-center">Nama Akun</th>
                      <th class="text-center">Debet</th>
                      <th class="text-center">Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($saless as $sales)
                      <tr>
                        <td class="text-center">{{$sales->nomor}}</td>
                        <td class="text-left">{{$sales->nama}}</td>
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('kredit')) > 0)
                        <td class="text-right">
                            Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('kredit')), 0, " ", ".")}}
                        </td>
                        <td class="text-right">
                        </td>
                        @else
                        <td class="text-right">
                        </td>
                        <td class="text-right">
                            Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('debet')), 0, " ", ".")}}
                        </td>
                        @endif
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-center" colspan="2">Total Sales</td>
                      <td class="text-light text-right">
                        @php 
                          $sum_tot_sales_Debet = 0 
                        @endphp
                        @foreach ($saless as $sales)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('kredit')) > 0)
                          @php 
                            $sum_tot_sales_Debet += ($distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('kredit')) 
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_sales_Debet, 0, " ", ".")}}
                      </td>
                      <td class="text-light text-right">
                        @php 
                          $sum_tot_sales_Kredit = 0 
                        @endphp
                        @foreach ($saless as $sales)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('kredit')) < 0)
                          @php 
                            $sum_tot_sales_Kredit += ($distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $sales->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $sales->nomor)->sum('debet')) 
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_sales_Kredit, 0, " ", ".")}}
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
                      <td class="text-light text-center" colspan="4">Costs of Sales</td>
                    </tr>
                    <tr>
                      <th class="text-center">Nomor Akun</th>
                      <th class="text-center">Nama Akun</th>
                      <th class="text-center">Debet</th>
                      <th class="text-center">Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($costs as $cost)
                      <tr>
                        <td class="text-center">{{$cost->nomor}}</td>
                        <td class="text-left">{{$cost->nama}}</td>
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('kredit')) > 0)
                        <td class="text-right">
                            Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('kredit')), 0, " ", ".")}}
                        </td>
                        <td class="text-right">
                        </td>
                        @else
                        <td class="text-right">
                        </td>
                        <td class="text-right">
                            Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('debet')), 0, " ", ".")}}
                        </td>
                        @endif
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-center" colspan="2">Total Costs of Sales</td>
                      <td class="text-light text-right">
                        @php 
                          $sum_tot_cost_Debet = 0 
                        @endphp
                        @foreach ($costs as $cost)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('kredit')) > 0)
                          @php 
                            $sum_tot_cost_Debet += ($distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('kredit')) 
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_cost_Debet, 0, " ", ".")}}
                      </td>
                      <td class="text-light text-right">
                        @php 
                          $sum_tot_cost_Kredit = 0 
                        @endphp
                        @foreach ($costs as $cost)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('kredit')) < 0)
                          @php 
                            $sum_tot_cost_Kredit += ($distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $cost->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $cost->nomor)->sum('debet')) 
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_cost_Kredit, 0, " ", ".")}}
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
                      <td class="text-light text-center" colspan="4">Expenses</td>
                    </tr>
                    <tr>
                      <th class="text-center">Nomor Akun</th>
                      <th class="text-center">Nama Akun</th>
                      <th class="text-center">Debet</th>
                      <th class="text-center">Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($expenses as $expense)
                      <tr>
                        <td class="text-center">{{$expense->nomor}}</td>
                        <td class="text-left">{{$expense->nama}}</td>
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('kredit')) > 0)
                        <td class="text-right">
                            Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('kredit')), 0, " ", ".")}}
                        </td>
                        <td class="text-right">
                        </td>
                        @else
                        <td class="text-right">
                        </td>
                        <td class="text-right">
                            Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('debet')), 0, " ", ".")}}
                        </td>
                        @endif
                      </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-center" colspan="2">Total Expenses</td>
                      <td class="text-light text-right">
                        @php 
                          $sum_tot_expenses_Debet = 0 
                        @endphp
                        @foreach ($expenses as $expense)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('kredit')) > 0)
                          @php 
                            $sum_tot_expenses_Debet += ($distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('kredit')) 
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_expenses_Debet, 0, " ", ".")}}
                      </td>
                      <td class="text-light text-right">
                        @php 
                          $sum_tot_expenses_Kredit = 0 
                        @endphp
                        @foreach ($expenses as $expense)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('kredit')) < 0)
                          @php 
                            $sum_tot_expenses_Kredit += ($distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $expense->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $expense->nomor)->sum('debet')) 
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_expenses_Kredit, 0, " ", ".")}}
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
                      <td class="text-light text-center" colspan="4">Other Revenues</td>
                    </tr>
                    <tr>
                      <th class="text-center">Nomor Akun</th>
                      <th class="text-center">Nama Akun</th>
                      <th class="text-center">Debet</th>
                      <th class="text-center">Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($other_revenues as $other_revenue)
                      <tr>
                        <td class="text-center">{{$other_revenue->nomor}}</td>
                        <td class="text-left">{{$other_revenue->nama}}</td>
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('kredit')) > 0)
                        <td class="text-right">
                            Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('kredit')), 0, " ", ".")}}
                        </td>
                        <td class="text-right">
                        </td>
                        @else
                        <td class="text-right">
                        </td>
                        <td class="text-right">
                            Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('debet')), 0, " ", ".")}}
                        </td>
                        @endif
                      </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-right" colspan="2">Total Other Revenues</td>
                      <td class="text-light text-right">
                        @php 
                          $sum_tot_Revenues_Debet = 0 
                        @endphp
                        @foreach ($other_revenues as $other_revenue)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('kredit')) > 0)
                          @php 
                            $sum_tot_Revenues_Debet += ($distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('kredit')) 
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_Revenues_Debet, 0, " ", ".")}}
                      </td>
                      <td class="text-light text-right">
                        @php 
                          $sum_tot_Revenues_Kredit = 0 
                        @endphp
                        @foreach ($other_revenues as $other_revenue)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('kredit')) < 0)
                          @php 
                            $sum_tot_Revenues_Kredit += ($distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $other_revenue->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_revenue->nomor)->sum('debet')) 
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_Revenues_Kredit, 0, " ", ".")}}
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
                      <td class="text-light text-center" colspan="4">Other Expenses</td>
                    </tr>
                    <tr>
                      <th class="text-center">Nomor Akun</th>
                      <th class="text-center">Nama Akun</th>
                      <th class="text-center">Debet</th>
                      <th class="text-center">Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($other_expenses as $other_expense)
                      <tr>
                        <td class="text-center">{{$other_expense->nomor}}</td>
                        <td class="text-left">{{$other_expense->nama}}</td>
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('kredit')) > 0)
                        <td class="text-right">
                            Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('kredit')), 0, " ", ".")}}
                        </td>
                        <td class="text-right">
                        </td>
                        @else
                        <td class="text-right">
                        </td>
                        <td class="text-right">
                            Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('debet')), 0, " ", ".")}}
                        </td>
                        @endif
                      </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-right" colspan="2">Total Other Expenses</td>
                      <td class="text-light text-right">
                        @php 
                          $sum_tot_Other_Debet = 0 
                        @endphp
                        @foreach ($other_expenses as $other_expense)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('kredit')) > 0)
                          @php 
                            $sum_tot_Other_Debet += ($distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('kredit')) 
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_Other_Debet, 0, " ", ".")}}
                      </td>
                      <td class="text-light text-right">
                        @php 
                          $sum_tot_Other_Kredit = 0 
                        @endphp
                        @foreach ($other_expenses as $other_expense)
                        @if( ($distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('kredit')) < 0)
                          @php 
                            $sum_tot_Other_Kredit += ($distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('kredit') + $distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('kredit')) - ($distinct_laporan_penyesuaian->where('account_id', $other_expense->id)->sum('debet')  + $distinct_laporan_penyesuaian->where('nomor_akun', $other_expense->nomor)->sum('debet')) 
                          @endphp
                        @endif
                        @endforeach

                        Rp {{number_format($sum_tot_Other_Kredit, 0, " ", ".")}}
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
                      <td class="text-light text-center" colspan="4">Laba / Rugi</td>
                    </tr>
                    <tr>
                      <th>Kategori</th>
                      <th class="text-center">Debet</th>
                      <th class="text-center">Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Sales</td>
                      <td class="text-right">
                        Rp {{number_format($sum_tot_sales_Debet, 0, " ", ".")}}
                      </td>
                      <td class="text-right">
                        Rp {{number_format($sum_tot_sales_Kredit, 0, " ", ".")}}
                      </td>
                    </tr>
                    <tr>
                      <td>Costs of Sales</td>
                      <td class="text-right">
                        Rp {{number_format($sum_tot_cost_Debet, 0, " ", ".")}}
                      </td>
                      <td class="text-right">
                        Rp {{number_format($sum_tot_cost_Kredit, 0, " ", ".")}}
                      </td>
                    </tr>
                    <tr>
                      <td>Expenses</td>
                      <td class="text-right">
                        Rp {{number_format($sum_tot_expenses_Debet, 0, " ", ".")}}
                      </td>
                      <td class="text-right">
                        Rp {{number_format($sum_tot_expenses_Kredit, 0, " ", ".")}}
                      </td>
                    </tr>
                    <tr>
                      <td>Other Revenues</td>
                      <td class="text-right">
                        Rp {{number_format($sum_tot_Revenues_Debet, 0, " ", ".")}}
                      </td>
                      <td class="text-right">
                        Rp {{number_format($sum_tot_Revenues_Kredit, 0, " ", ".")}}
                      </td>
                    </tr>
                    <tr>
                      <td>Other Expenses</td>
                      <td class="text-right">
                        Rp {{number_format($sum_tot_Other_Debet, 0, " ", ".")}}
                      </td>
                      <td class="text-right">
                        Rp {{number_format($sum_tot_Other_Kredit, 0, " ", ".")}}
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light">Total</td>
                      <td class="text-light text-right">Rp {{number_format($sum_tot_sales_Debet + $sum_tot_cost_Debet + $sum_tot_expenses_Debet + $sum_tot_Revenues_Debet + $sum_tot_Other_Debet, 0, " ", ".")}}</td>
                      <td class="text-light text-right">Rp {{number_format($sum_tot_sales_Kredit + $sum_tot_cost_Kredit + $sum_tot_expenses_Kredit + $sum_tot_Revenues_Kredit + $sum_tot_Other_Kredit, 0, " ", ".")}}</td>
                    </tr>
                    <tr class="bg-danger font-weight-bold">
                      <td class="text-light">Laba/Rugi</td>
                      <td class="text-light text-center" colspan="2">Rp {{number_format( ($sum_tot_sales_Kredit + $sum_tot_cost_Kredit + $sum_tot_expenses_Kredit + $sum_tot_Revenues_Kredit + $sum_tot_Other_Kredit) - ($sum_tot_sales_Debet + $sum_tot_cost_Debet + $sum_tot_expenses_Debet + $sum_tot_Revenues_Debet + $sum_tot_Other_Debet), 0, " ", ".")}}</td>
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
