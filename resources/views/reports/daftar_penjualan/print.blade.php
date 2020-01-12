<html>
<head>
  <title>Daftar Penjualan</title>
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
      <h2>Daftar Penjualan</h2>
      <h3>Periode {{date('d F Y', strtotime($tanggal_mulai))}} sampai {{date('d F Y', strtotime($tanggal_akhir))}}</h3>
    </div>
    <div class="page-break"></div>
    <div class="dt-responsive">
      <table id="complex-dt" class="table table-bordered nowrap" width="100%" border="1">
        <thead>
          <tr class="bg-secondary font-weight-bold">
            <th class="col-2 text-light">Tanggal</th>
            <th class="col-2 text-light">Transaksi</th>
            <th class="col-2 text-light">Nomor</th>
            <th class="col-2 text-light">Pelanggan</th>
            <th class="col-2 text-light">Status</th>
            <th class="col-2 text-light">Keterangan</th>
            <th class="col-2 text-light">Total tagihan</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($crjs as $crj)
            <tr>
              <td>{{date('d F Y', strtotime($crj->tanggal ))}}</td>
              <td class="text-center"><span class="badge badge-pill badge-primary mb-1">CRJ</span></td>
              <td>{{$crj->kode}}</td>
              <td>{{$crj->data_customers->nama}}</td>
              <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Penjualan Tunai</span></td>
              <td>{{$crj->description}}</td>
              <td class="text-right">
                Rp {{number_format($LaporanPenjualans->where('crj_id', $crj->id)->sum('total'), 0, " ", ".")}}
              </td>
            </tr>
          @endforeach
          @foreach ($SalesJournals as $SalesJournal)
            <tr>
              <td>{{date('d F Y', strtotime($SalesJournal->tanggal ))}}</td>
              <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Sales Journal</span></td>
              <td>{{$SalesJournal->kode}}</td>
              <td>{{$SalesJournal->data_customers->nama}}</td>
              <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Penjualan Kredit</span></td>
              <td>{{$SalesJournal->description}}</td>
              <td class="text-right">
                Rp {{number_format($LaporanPenjualans->where('salesjournal_id', $SalesJournal->id)->sum('total'), 0, " ", ".")}}
              </td>
            </tr>
          @endforeach
          @foreach ($ReturPenjualans as $ReturPenjualan)
            <tr>
              <td>{{date('d F Y', strtotime($ReturPenjualan->tanggal ))}}</td>
              <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Retur Penjualan</span></td>
              <td>{{$ReturPenjualan->kode}}</td>
              <td>{{$ReturPenjualan->data_customers->nama}}</td>
              <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Retur</span></td>
              <td>{{$ReturPenjualan->description}}</td>
              <td class="text-right">
                Rp {{number_format($LaporanPenjualans->where('retur_penjualan_id', $ReturPenjualan->id)->sum('total'), 0, " ", ".")}}
              </td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr class="bg-success font-weight-bold">
            <td class="text-light text-center" colspan="7">Daftar Penjualan</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</body>
</html>
