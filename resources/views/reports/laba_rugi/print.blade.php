<html>
<head>
  <title>Laporan Neraca</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

  <link rel="stylesheet" href="/ProjectAkuntan/plugins/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/ProjectAkuntan/dist/css/theme.min.css">
  <style media="screen">
  .text-right {
    text-align: right;
  }
  .text-center {
    text-align: center;
  }
  .font-weight-bold {
    font-weight: bold;
  }
  .page-break {
    margin-bottom: 50px;
  }
  </style>
</head>
<body>
  <div class="container-fluid mt-2">
    <div class="text-center">
      <h1>PT OEMAR TECHNO DISTRIBUTOR</h1>
      <h2>Laporan Laba Rugi</h2>
    </div>
    <div class="dt-responsive">
      <table class="table table-bordered nowrap" width="100%" border="1">
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
    <br>
    <div class="dt-responsive">
      <table class="table table-bordered nowrap" width="100%" border="1">
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
    <br>
    <div class="dt-responsive">
      <table class="table table-bordered nowrap" width="100%" border="1">
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
    <br>
    <div class="dt-responsive">
      <table class="table table-bordered nowrap" width="100%" border="1">
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
    <br>
    <div class="dt-responsive">
      <table class="table table-bordered nowrap" width="100%" border="1">
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
    <br>
    <div class="dt-responsive">
      <table class="table table-bordered nowrap" width="100%" border="1">
        <thead>
          <tr class="bg-secondary font-weight-bold">
            <td class="text-light text-center" colspan="3">Laba / Rugi</td>
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
</body>
</html>
