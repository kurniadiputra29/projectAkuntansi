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
    @php
      function format_uang($angka){
        $hasil =  number_format($angka,0, ',' , '.');
        return $hasil;
      }
    @endphp
    <div class="dt-responsive">
      <table class="table table-bordered nowrap" width="100%" style="width:100%" border="1">
        <thead>
          <tr class="bg-secondary font-weight-bold">
            <td class="text-light text-center" colspan="4">Akun</td>
          </tr>
          <tr>
            <th>Nomor Akun</th>
            <th>Nama Akun</th>
            <th>Debet</th>
            <th>Kredit</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($neraca_saldo as $value)
          <tr>
            <td>{{$value->nomor}}</td>
            <td>{{$value->nama}}</td>
            <td class="text-right">{{format_uang($value->debet)}}</td>
            <td class="text-right">{{format_uang($value->kredit)}}</td>
          </tr>
        @endforeach
        </tbody>
        <tfoot>
          <tr class="bg-success font-weight-bold">
            <td class="text-light text-right" colspan="2">Total</td>
            <td class="text-light text-right">{{format_uang($debet_neraca_saldo)}}</td>
            <td class="text-light text-right">{{format_uang($kredit_neraca_saldo)}}</td>
          </tr>
          <tr class="bg-danger font-weight-bold">
            <td class="text-light text-right" colspan="2">Balance</td>
            <td class="text-light text-center" colspan="2">{{format_uang(($debet_neraca_saldo)-($kredit_neraca_saldo))}}</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</body>
</html>
