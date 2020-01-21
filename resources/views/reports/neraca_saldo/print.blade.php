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
      <h2>Neraca Saldo</h2>
    </div>
    <div class="dt-responsive">
      <table id="simpletable" class="table table-bordered nowrap" width="100%" border="1">
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
</body>
</html>
