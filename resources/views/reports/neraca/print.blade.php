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
  <h1>Laporan Neraca</h1>
  <div class="container-fluid mt-2">
    <div class="text-center">
      <h1>PT OEMAR TECHNO DISTRIBUTOR</h1>
      <h2>Laporan Laba Ditahan</h2>
    </div>
    <div class="dt-responsive">
      <table class="table table-bordered nowrap" style="width:100%" border="1">
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
    <br>
    <div class="dt-responsive">
      <table class="table table-bordered nowrap" style="width:100%" border="1">
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
    <br>
    <div class="dt-responsive">
      <table class="table table-bordered nowrap" style="width:100%" border="1">
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
    <br>
    <div class="dt-responsive">
      <table class="table table-bordered nowrap" style="width:100%" border="1">
        <thead>
          <tr class="bg-secondary font-weight-bold">
            <td class="text-light text-center" colspan="3">Neraca</td>
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
</body>
</html>
