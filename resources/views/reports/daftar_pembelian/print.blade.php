<html>
<head>
  <title>Daftar Pembelian</title>
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
    padding-bottom: 50px;
  }
  </style>
</head>
<body>
  <div class="container-fluid mt-2">
    <div class="text-center">
      <h1>PT OEMAR TECHNO DISTRIBUTOR</h1>
      <h2>Daftar Pembelian</h2>
      <h3>Periode {{date('d F Y', strtotime($tanggal_mulai))}} sampai {{date('d F Y', strtotime($tanggal_akhir))}}</h3>
    </div>
    <br>
    <div class="dt-responsive">
      <table id="complex-dt" class="table table-bordered nowrap" width="100%" border="1">
        <thead>
          <tr class="bg-secondary font-weight-bold">
            <th class="text-light">Tanggal</th>
            <th class="text-light">Transaksi</th>
            <th class="text-light">Nomor</th>
            <th class="text-light">Pelanggan</th>
            <th class="text-light">Status</th>
            <th class="text-light">Keterangan</th>
            <th class="text-light">Total tagihan</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($cpjs as $cpj)
            <tr>
              <td>{{date('d F Y', strtotime($cpj->tanggal ))}}</td>
              <td class="text-center"><span class="badge badge-pill badge-primary mb-1">CPJ</span></td>
              <td>{{$cpj->kode}}</td>
              <td>{{$cpj->data_suppliers->nama}}</td>
              <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Pembelian Tunai</span></td>
              <td>{{$cpj->description}}</td>
              <td class="text-right">
                Rp {{number_format($LaporanPembelians->where('cpj_id', $cpj->id)->sum('total'), 0, " ", ".")}}
              </td>
            </tr>
          @endforeach
          @foreach ($PurchaseJournals as $PurchaseJournal)
            <tr>
              <td>{{date('d F Y', strtotime($PurchaseJournal->tanggal ))}}</td>
              <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Sales Journal</span></td>
              <td>{{$PurchaseJournal->kode}}</td>
              <td>{{$PurchaseJournal->data_suppliers->nama}}</td>
              <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Pembelian Kredit</span></td>
              <td>{{$PurchaseJournal->description}}</td>
              <td class="text-right">
                Rp {{number_format($LaporanPembelians->where('purchasejournal_id', $PurchaseJournal->id)->sum('total'), 0, " ", ".")}}
              </td>
            </tr>
          @endforeach
          @foreach ($ReturPembelians as $ReturPembelian)
            <tr>
              <td>{{date('d F Y', strtotime($ReturPembelian->tanggal ))}}</td>
              <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Retur Pembelian</span></td>
              <td>{{$ReturPembelian->kode}}</td>
              <td>{{$ReturPembelian->data_suppliers->nama}}</td>
              <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Retur</span></td>
              <td>{{$ReturPembelian->description}}</td>
              <td class="text-right">
                Rp {{number_format($LaporanPembelians->where('retur_pembelian_id', $ReturPembelian->id)->sum('total'), 0, " ", ".")}}
              </td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr class="bg-success font-weight-bold">
            <td class="text-light text-center" colspan="7">Daftar Pembelian</td>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</body>
</html>
