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
  <div class="container-fluid mt-2">
    @php
    function format_uang($angka){
      $hasil =  number_format($angka,0, ',' , '.');
      return $hasil;
    }
    @endphp

    <div class="table-responsive">
      @foreach ($DataSuppliers as $DataSupplier)
        <h5 style="margin-top: 30px;">Customers Name : {{ $DataSupplier->nama }}</h5>
        <table class="account-transactions report-table table" id="account-entry" width="100%" style="width:100%" border="1">
          <thead class="report-header">
            <tr class="bg-secondary font-weight-bold">
              <th class="text-center text-light">Tanggal</th>
              <th class="text-center text-light">Kode Customers</th>
              <th class="text-center text-light">Deskripsi</th>
              <th class="text-center text-light">Debet</th>
              <th class="text-center text-light">Kredit</th>
              <th class="text-center text-light">Debet</th>
              <th class="text-center text-light">Kredit</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($SaldoHutangs as $SaldoHutang)
              <tr>
                @if ($SaldoHutang->suppliers_id == $DataSupplier->id)
                  <td class="text-center">{{date('d F Y', strtotime($DataSupplier->created_at ))}}</td>
                  <td class="text-center">{{ $DataSupplier->kode }}</td>
                  <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Saldo Awal</span></td>
                  <td class="text-center">{{ $DataSupplier->status }}</td>
                  <td class="text-center">{{ $DataSupplier->status }}</td>
                  <td class="text-right">Rp {{ number_format($SaldoHutang->debet, 0, " ", ".")}}</td>
                  <td class="text-right">Rp {{ number_format($SaldoHutang->kredit, 0, " ", ".")}}</td>
                @endif
              </tr>
            @endforeach
            @foreach ($PurchaseJournals as $PurchaseJournal)
              @foreach ($purchasejournaldetails as $purchasejournaldetail)
                <tr>
                  @if ($PurchaseJournal->suppliers_id == $DataSupplier->id)
                    @if ($purchasejournaldetail->purchasejournal_id == $PurchaseJournal->id)
                      <td class="text-center">{{date('d F Y', strtotime($PurchaseJournal->tanggal ))}}</td>
                      <td class="text-center">{{ $DataSupplier->kode }}</td>
                      <td class="text-center"><span class="badge badge-pill badge-warning mb-1">Purchase Journal</span></td>
                      <td class="text-right">Rp {{ number_format($purchasejournaldetail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($purchasejournaldetail->kredit, 0, " ", ".")}}</td>
                    @endif
                  @endif
                </tr>
              @endforeach
            @endforeach
            @foreach ($ReturPembelians as $ReturPembelian)
              @foreach ($ReturPembelianDetails as $ReturPembelianDetail)
                <tr>
                  @if ($ReturPembelian->suppliers_id == $DataSupplier->id)
                    @if ($ReturPembelianDetail->retur_pembelian_id == $ReturPembelian->id)
                      <td class="text-center">{{date('d F Y', strtotime($ReturPembelian->tanggal ))}}</td>
                      <td class="text-center">{{ $DataSupplier->kode }}</td>
                      <td class="text-center"><span class="badge badge-pill badge-success mb-1">Retur Pembelian</span></td>
                      <td class="text-right">Rp {{ number_format($ReturPembelianDetail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($ReturPembelianDetail->kredit, 0, " ", ".")}}</td>
                    @endif
                  @endif
                </tr>
              @endforeach
            @endforeach
            @foreach ($CashBankOuts as $CashBankOut)
              @foreach ($CashBankOutDetails as $CashBankOutDetail)
                <tr>
                  @if ($CashBankOut->suppliers_id == $DataSupplier->id)
                    @if ($CashBankOutDetail->cash_bank_outs_id == $CashBankOut->id)
                      <td class="text-center">{{date('d F Y', strtotime($CashBankOut->tanggal ))}}</td>
                      <td class="text-center">{{ $DataSupplier->kode }}</td>
                      <td class="text-center"><span class="badge badge-pill badge-warning mb-1">Cash & Bank</span></td>
                      <td class="text-right">Rp {{ number_format($CashBankOutDetail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($CashBankOutDetail->kredit, 0, " ", ".")}}</td>
                    @endif
                  @endif
                </tr>
              @endforeach
            @endforeach
            <tr class="bg-success text-light">
              <td class="text-center grand-total" colspan="10">
                {{ $DataSupplier->kode }}
              </td>
            </tr>
          </tbody>
        </table>
      @endforeach
    </div>
    <div class="page-break"></div>
    <div class="dt-responsive">
      <table id="simpletable" class="table table-bordered nowrap" width="100%" style="width:100%" border="1">
        <thead>
          <tr class="bg-secondary font-weight-bold">
            <td class="text-light text-center" colspan="4">Rekapitulasi</td>
          </tr>
          <tr>
            <td>Kode</td>
            <td>Suppliers Name</td>
            <td>Debet</td>
            <td>Kredit</td>
          </tr>
        </thead>
        <tbody>
          @foreach ($distinct_pc as $rekap)
            <tr>
              <td>{{$rekap->kode}}</td>
              <td>{{$rekap->nama}}</td>
              <td class="text-right">
                Rp {{number_format($distinct_pcc->where('suppliers_id', $rekap->id)->sum('debet'))}}
              </td>
              <td class="text-right">
                Rp {{number_format($distinct_pcc->where('suppliers_id', $rekap->id)->sum('kredit'))}}
              </td>
            </tr>
            <!-- @foreach ($PurchaseJournals as $PurchaseJournal)
            @foreach ($purchasejournaldetails as $purchasejournaldetail)
            <tr>
            @if ($PurchaseJournal->suppliers_id == $rekap->id)
            @if ($purchasejournaldetail->purchasejournal_id == $PurchaseJournal->id)
            <td>{{$rekap->kode}}</td>
            <td>{{$rekap->nama}}</td>
            <td class="text-right">Rp {{ number_format($purchasejournaldetail->where('nomor_akun', '2-1210')->where('purchasejournal_id', $PurchaseJournal->id)->sum('debet'))}}</td>
            <td class="text-right">Rp {{ number_format($purchasejournaldetail->where('nomor_akun', '2-1210')->where('purchasejournal_id', $PurchaseJournal->id)->sum('kredit'))}}</td>
          @endif
        @endif
      </tr>
    @endforeach
  @endforeach -->
@endforeach
</tbody>
<tfoot>
  <tr class="bg-success font-weight-bold">
    <td class="text-light text-right" colspan="2">Total</td>
    <td class="text-light text-right"></td>
    <td class="text-light text-right"></td>
  </tr>
</tfoot>
</table>
</div>
</div>
</body>
</html>
