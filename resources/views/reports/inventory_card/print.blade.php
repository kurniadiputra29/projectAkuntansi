<html>
<head>
  <title>Inventory Card</title>
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
  <h1>Inventory Card</h1>
  <h3>Periode {{date('d F Y', strtotime($tanggal_mulai))}} sampai {{date('d F Y', strtotime($tanggal_akhir))}}</h3>
  <div class="container-fluid mt-2">
    @php
    function format_uang($angka){
      $hasil =  number_format($angka,0, ',' , '.');
      return $hasil;
    }
    @endphp
    <div class="dt-responsive">
      @foreach ($items as $item)
        <table class="table table-bordered nowrap" width="100%" border="1">
          <thead class="report-header">
            <tr class="bg-secondary font-weight-bold">
              <th class="text-light" colspan="6">Item Name : {{ $item->nama }}</th>
              <th class="text-light" colspan="1">Item Kode : {{ $item->kode }}</th>
            </tr>
            <tr>
              <th class="text-center">Date</th>
              <th class="text-center">Kode Produk</th>
              <th class="text-center">Deskripsi</th>
              <th class="text-center">Status</th>
              <th class="text-center">QTY</th>
              <th class="text-center">Price/ Unit</th>
              <th class="text-center">Amount</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($inventories as $inventory)
              <tr>
                @if ($inventory->items_id == $item->id)
                  <td class="text-center">{{date('d F Y', strtotime($inventory->created_at ))}}</td>
                  <td class="text-center">{{ $inventory->Items->kode }}</td>
                  <td class="text-center">
                    @if ($inventory->crj_id != null)
                      <span class="badge badge-pill badge-warning mb-1">CRJ</span>
                    @elseif($inventory->salesjournal_id != null)
                      <span class="badge badge-pill badge-warning mb-1">Sales Journal</span>
                    @elseif($inventory->retur_penjualan_id != null)
                      <span class="badge badge-pill badge-success mb-1">Retur Penjualan</span>
                    @elseif($inventory->cpj_id != null)
                      <span class="badge badge-pill badge-success mb-1">CPJ</span>
                    @elseif($inventory->purchasejournal_id != null)
                      <span class="badge badge-pill badge-success mb-1">Purchase Journal</span>
                    @elseif($inventory->retur_pembelian_id != null)
                      <span class="badge badge-pill badge-warning mb-1">Retur Pembelian</span>
                    @elseif($inventory->saldo_items_id != null)
                      <span class="badge badge-pill badge-primary mb-1">Saldo Awal</span>
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($inventory->saldo_items_id !== null)
                      <span class="badge badge-pill badge-primary mb-1">~ In ~</span>
                    @elseif($inventory->status == 1 )
                      <span class="badge badge-pill badge-success mb-1">~ In ~</span>
                    @elseif ($inventory->status == 0 )
                      <span class="badge badge-pill badge-warning mb-1">~ Out ~</span>
                    @endif
                  </td>
                  <td class="text-center">{{ $inventory->unit }}</td>
                  <td class="text-right">Rp {{ number_format($inventory->price, 0, " ", ".")}}</td>
                  <td class="text-right">Rp {{ number_format($inventory->total, 0, " ", ".")}}</td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>
      @endforeach
    </div>
    <div class="page-break"></div>
    <div class="simpletable">
      <table id="simpletable" class="table table-bordered nowrap" width="100%" border="1">
        <thead>
          <tr class="bg-secondary font-weight-bold">
            <td class="text-light text-center" colspan="5">Rekapitulasi</td>
          </tr>
          <tr>
            <td>Kode</td>
            <td>Item Name</td>
            <td>Qty</td>
            <td>Price</td>
            <td>Amounts</td>
          </tr>
        </thead>
        <tbody>
          @foreach ($distinct_pc as $rekap)
            <tr>
              <td>{{$rekap->kode}}</td>
              <td>{{$rekap->nama}}</td>
              <td class="text-right">
                {{$distinct_pcc->where('items_id', $rekap->id)->where('status', 1)->sum('unit')-$distinct_pcc->where('items_id', $rekap->id)->where('status', 0)->sum('unit')}}
              </td>
              <td class="text-right">
                Rp {{number_format(($distinct_pcc->where('items_id', $rekap->id)->where('status', 1)->sum('total') - $distinct_pcc->where('items_id', $rekap->id)->where('status', 0)->sum('total')) / ($distinct_pcc->where('items_id', $rekap->id)->where('status', 1)->sum('unit')-$distinct_pcc->where('items_id', $rekap->id)->where('status', 0)->sum('unit')), 0, " ", ".")}}
              </td>
              <td class="text-right">
                Rp {{number_format($distinct_pcc->where('items_id', $rekap->id)->where('status', 1)->sum('total') - $distinct_pcc->where('items_id', $rekap->id)->where('status', 0)->sum('total'), 0, " ", ".")}}
              </td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr class="bg-success font-weight-bold">
            <td class="text-light text-right" colspan="3">Total</td>
            <td class="text-light text-right"></td>
            <td class="text-light text-right"></td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</body>
</html>
