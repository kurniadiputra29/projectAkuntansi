<html>
<head>
  <title>Petty Cash Book</title>
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
  <h1>Laporan Petty Cash Book</h1>
  <h3>Periode {{date('d F Y', strtotime($tanggal_mulai))}} sampai {{date('d F Y', strtotime($tanggal_akhir))}}</h3>
  <div class="container-fluid mt-2">
    <div class="dt-responsive">
      @php
      function format_uang($angka){
        $hasil =  number_format($angka,2, ',' , '.');
        return $hasil;
      }
      function format_uang2($angka){
        $hasil =  number_format($angka,0, ',' , '.');
        return $hasil;
      }
      @endphp
      <table id="complex-dt" class="table table-striped" width="100%" style="width:100%" border="1">
        <thead>
          <tr class="font-weight-bold">
            <th class="col-2">Tanggal</th>
            <th class="col-2">Deskripsi</th>
            <th class="col-2 text-center">Nomor Akun</th>
            <th class="col-2">Nama Akun</th>
            <th class="col-2 text-center">Debet</th>
            <th class="col-2 text-center">Kredit</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pc_detail as $data)
            <tr>
              <td>{{date('d F Y', strtotime($data->pettycash->tanggal ))}}</td>
              <td>{{$data->pettycash->description}}</td>
              <td class="text-center">{{$data->nomor_akun}}</td>
              <td>{{$data->nama_akun}}</td>
              <td class="text-center">
                {{format_uang2($data->debet)}}
              </td>
              <td class="text-center">
                {{format_uang2($data->kredit)}}
              </td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr class="font-weight-bold">
            <td></td>
            <td class="text-center" colspan="3">Total</td>
            <td class="text-center">{{format_uang2($sum_debet)}}</td>
            <td class="text-center">{{format_uang2($sum_kredit)}}</td>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="page-break"></div>
    <div class="dt-responsive">
      <table id="simpletable" class="table table-bordered nowrap" width="100%" style="width:100%" border="1">
        <thead>
          <tr class="font-weight-bold">
            <td class="text-center" colspan="4">Rekapitulasi</td>
          </tr>
          <tr class="font-weight-bold">
            <td class="col-3">Nomor Akun</td>
            <td class="col-3">Nama Akun</td>
            <td class="col-3 text-center">Debet</td>
            <td class="col-3 text-center">Kredit</td>
          </tr>
        </thead>
        <tbody>
          @foreach ($distinct_pc as $rekap)
            <tr>
              <td>{{$rekap->nomor_akun}}</td>
              <td>{{$rekap->nama_akun}}</td>
              <td class="text-center">{{format_uang2($rekap->where('nomor_akun', $rekap->nomor_akun)->whereBetween('created_at', [$tanggal_mulai,$add_day])->sum('debet'))}}</td>
              <td class="text-center">{{format_uang2($rekap->where('nomor_akun', $rekap->nomor_akun)->whereBetween('created_at', [$tanggal_mulai,$add_day])->sum('kredit'))}}</td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr class="font-weight-bold">
            <td class="text-center" colspan="2">Total</td>
            <td class="text-center">{{format_uang2($sum_debet)}}</td>
            <td class="text-center">{{format_uang2($sum_kredit)}}</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</body>
</html>
