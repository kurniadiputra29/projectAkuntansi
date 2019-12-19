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
      <table class="table table-striped" width="100%" style="width:100%" border="1">
        <thead>
          <tr class="bg-secondary font-weight-bold">
            <td class="text-light text-center" colspan="4">Aset</td>
          </tr>
          <tr>
            <th>Nomor Akun</th>
            <th>Nama Akun</th>
            <th>Debet</th>
            <th>Kredit</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($asset as $aset)
          <tr>
            <td>{{$aset->nomor}}</td>
            <td>{{$aset->nama}}</td>
            <td class="text-right">{{format_uang($aset->debet)}}</td>
            <td class="text-right">{{format_uang($aset->kredit)}}</td>
          </tr>
        @endforeach
        </tbody>
        <tfoot>
          <tr class="bg-success font-weight-bold">
            <td class="text-light text-right" colspan="2">Total Aset</td>
            <td class="text-light text-right">{{format_uang($sum_debet_asset)}}</td>
            <td class="text-light text-right">{{format_uang($sum_kredit_asset)}}</td>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="page-break"></div>
    <div class="dt-responsive">
      <table class="table table-striped" width="100%" style="width:100%" border="1">
        <thead>
          <tr class="bg-secondary font-weight-bold">
            <td class="text-light text-center" colspan="4">Liabilitas</td>
          </tr>
          <tr>
            <th>Nomor Akun</th>
            <th>Nama Akun</th>
            <th>Debet</th>
            <th>Kredit</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($liability as $liabilitas)
          <tr>
            <td>{{$liabilitas->nomor}}</td>
            <td>{{$liabilitas->nama}}</td>
            <td class="text-right">{{format_uang($liabilitas->debet)}}</td>
            <td class="text-right">{{format_uang($liabilitas->kredit)}}</td>
          </tr>
        @endforeach
        </tbody>
        <tfoot>
          <tr class="bg-success font-weight-bold">
            <td class="text-light text-right" colspan="2">Total Aset</td>
            <td class="text-light text-right">{{format_uang($sum_debet_liability)}}</td>
            <td class="text-light text-right">{{format_uang($sum_kredit_liability)}}</td>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="page-break"></div>
    <div class="dt-responsive">
      <table class="table table-striped" width="100%" style="width:100%" border="1">
        <thead>
          <tr class="bg-secondary font-weight-bold">
            <td class="text-light text-center" colspan="4">Ekuitas</td>
          </tr>
          <tr>
            <th>Nomor Akun</th>
            <th>Nama Akun</th>
            <th>Debet</th>
            <th>Kredit</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($equity as $ekuitas)
          <tr>
            <td>{{$ekuitas->nomor}}</td>
            <td>{{$ekuitas->nama}}</td>
            <td class="text-right">{{format_uang($ekuitas->debet)}}</td>
            <td class="text-right">{{format_uang($ekuitas->kredit)}}</td>
          </tr>
        @endforeach
        </tbody>
        <tfoot>
          <tr class="bg-success font-weight-bold">
            <td class="text-light text-right" colspan="2">Total Aset</td>
            <td class="text-light text-right">{{format_uang($sum_debet_equity)}}</td>
            <td class="text-light text-right">{{format_uang($sum_kredit_equity)}}</td>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="page-break"></div>
    <div class="dt-responsive">
      <table class="table table-striped" width="100%" style="width:100%" border="1">
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
            <td>Aset</td>
            <td class="text-right">{{format_uang($sum_debet_asset)}}</td>
            <td class="text-right">{{format_uang($sum_kredit_asset)}}</td>
          </tr>
          <tr>
            <td>Liabilitas</td>
            <td class="text-right">{{format_uang($sum_debet_liability)}}</td>
            <td class="text-right">{{format_uang($sum_kredit_liability)}}</td>
          </tr>
          <tr>
            <td>Ekuitas</td>
            <td class="text-right">{{format_uang($sum_debet_equity)}}</td>
            <td class="text-right">{{format_uang($sum_kredit_equity)}}</td>
          </tr>
        </tbody>
        <tfoot>
          <tr class="bg-success font-weight-bold">
            <td class="text-light">Total Aset</td>
            <td class="text-light text-right">{{format_uang($sum_debet_asset+$sum_debet_liability+$sum_debet_equity)}}</td>
            <td class="text-light text-right">{{format_uang($sum_kredit_asset+$sum_kredit_liability+$sum_kredit_equity)}}</td>
          </tr>
          <tr class="bg-danger font-weight-bold">
            <td class="text-light">Balance</td>
            <td class="text-light text-center" colspan="2">{{format_uang(($sum_debet_asset+$sum_debet_liability+$sum_debet_equity)-($sum_kredit_asset+$sum_kredit_liability+$sum_kredit_equity))}}</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</body>
</html>
