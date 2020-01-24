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
      <h2>Laporan Laba Ditahan</h2>
    </div>
    <div class="dt-responsive">
      <table class="table table-bordered nowrap" width="100%" border="1">
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
</body>
</html>
