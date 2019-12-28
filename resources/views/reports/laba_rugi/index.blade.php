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
                      <td class="text-light text-center" colspan="4">Sales</td>
                    </tr>
                    <tr>
                      <th class="col-3">Nomor Akun</th>
                      <th class="col-3">Nama Akun</th>
                      <th class="col-3">Debet</th>
                      <th class="col-3">Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($sales as $sale)
                    <tr>
                      <td>{{$sale->nomor}}</td>
                      <td>{{$sale->nama}}</td>
                      <td class="text-right">{{format_uang($sale->debet)}}</td>
                      <td class="text-right">{{format_uang($sale->kredit)}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-right" colspan="2">Total Sales</td>
                      <td class="text-light text-right">{{format_uang($sales->sum('debet'))}}</td>
                      <td class="text-light text-right">{{format_uang($sales->sum('kredit'))}}</td>
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
                      <th class="col-3">Nomor Akun</th>
                      <th class="col-3">Nama Akun</th>
                      <th class="col-3">Debet</th>
                      <th class="col-3">Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($costs as $cost)
                    <tr>
                      <td>{{$cost->nomor}}</td>
                      <td>{{$cost->nama}}</td>
                      <td class="text-right">{{format_uang($cost->debet)}}</td>
                      <td class="text-right">{{format_uang($cost->kredit)}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-right" colspan="2">Total Costs of Sales</td>
                      <td class="text-light text-right">{{format_uang($costs->sum('debet'))}}</td>
                      <td class="text-light text-right">{{format_uang($costs->sum('kredit'))}}</td>
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
                      <th class="col-3">Nomor Akun</th>
                      <th class="col-3">Nama Akun</th>
                      <th class="col-3">Debet</th>
                      <th class="col-3">Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($expenses as $expense)
                    <tr>
                      <td>{{$expense->nomor}}</td>
                      <td>{{$expense->nama}}</td>
                      <td class="text-right">{{format_uang($expense->debet)}}</td>
                      <td class="text-right">{{format_uang($expense->kredit)}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-right" colspan="2">Total Expenses</td>
                      <td class="text-light text-right">{{format_uang($expenses->sum('debet'))}}</td>
                      <td class="text-light text-right">{{format_uang($expenses->sum('kredit'))}}</td>
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
                      <th class="col-3">Nomor Akun</th>
                      <th class="col-3">Nama Akun</th>
                      <th class="col-3">Debet</th>
                      <th class="col-3">Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($other_revenues as $other_revenue)
                    <tr>
                      <td>{{$other_revenue->nomor}}</td>
                      <td>{{$other_revenue->nama}}</td>
                      <td class="text-right">{{format_uang($other_revenue->debet)}}</td>
                      <td class="text-right">{{format_uang($other_revenue->kredit)}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-right" colspan="2">Total Other Revenues</td>
                      <td class="text-light text-right">{{format_uang($other_revenues->sum('debet'))}}</td>
                      <td class="text-light text-right">{{format_uang($other_revenues->sum('kredit'))}}</td>
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
                      <th class="col-3">Nomor Akun</th>
                      <th class="col-3">Nama Akun</th>
                      <th class="col-3">Debet</th>
                      <th class="col-3">Kredit</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($other_expenses as $other_expense)
                    <tr>
                      <td>{{$other_expense->nomor}}</td>
                      <td>{{$other_expense->nama}}</td>
                      <td class="text-right">{{format_uang($other_expense->debet)}}</td>
                      <td class="text-right">{{format_uang($other_expense->kredit)}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-right" colspan="2">Total Other Expenses</td>
                      <td class="text-light text-right">{{format_uang($other_expenses->sum('debet'))}}</td>
                      <td class="text-light text-right">{{format_uang($other_expenses->sum('kredit'))}}</td>
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
                      <td>Sales</td>
                      <td class="text-right">{{format_uang($sales->sum('debet'))}}</td>
                      <td class="text-right">{{format_uang($sales->sum('kredit'))}}</td>
                    </tr>
                    <tr>
                      <td>Costs of Sales</td>
                      <td class="text-right">{{format_uang($costs->sum('debet'))}}</td>
                      <td class="text-right">{{format_uang($costs->sum('kredit'))}}</td>
                    </tr>
                    <tr>
                      <td>Expenses</td>
                      <td class="text-right">{{format_uang($expenses->sum('debet'))}}</td>
                      <td class="text-right">{{format_uang($expenses->sum('kredit'))}}</td>
                    </tr>
                    <tr>
                      <td>Other Revenues</td>
                      <td class="text-right">{{format_uang($other_revenues->sum('debet'))}}</td>
                      <td class="text-right">{{format_uang($other_revenues->sum('kredit'))}}</td>
                    </tr>
                    <tr>
                      <td>Other Expenses</td>
                      <td class="text-right">{{format_uang($other_expenses->sum('debet'))}}</td>
                      <td class="text-right">{{format_uang($other_expenses->sum('kredit'))}}</td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light">Total</td>
                      <td class="text-light text-right">{{format_uang($debet_total)}}</td>
                      <td class="text-light text-right">{{format_uang($kredit_total)}}</td>
                    </tr>
                    <tr class="bg-danger font-weight-bold">
                      <td class="text-light">Laba/Rugi</td>
                      <td class="text-light text-center" colspan="2">{{format_uang($debet_total-$kredit_total)}}</td>
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
