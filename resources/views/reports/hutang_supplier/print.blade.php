<html>
<head>
  <title>Hutang Supplier</title>
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
      <h2>Hutang Supplier</h2>
      <h3>Periode {{date('d F Y', strtotime($tanggal_mulai))}} sampai {{date('d F Y', strtotime($tanggal_akhir))}}</h3>
    </div>
    <br>
    <div class="dt-responsive">
      @foreach ($DataSuppliers as $DataSupplier)
        <table class="table table-bordered nowrap" width="100%" border="1">
          <thead class="report-header">
            <tr class="bg-secondary font-weight-bold">
              <th class="col-8 text-light" colspan="4">Customers Name: {{$DataSupplier->nama}} ( {{$DataSupplier->kode}} )</th>
            </tr>
            <tr>
              <th class="text-center">Tanggal</th>
              <th class="text-center">Deskripsi</th>
              <th class="text-center">Debet</th>
              <th class="text-center">Kredit</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($SaldoHutangs as $SaldoHutang)
              @if ($SaldoHutang->suppliers_id == $DataSupplier->id)
              <tr>
                  <td class="text-center">{{date('d F Y', strtotime($DataSupplier->created_at ))}}</td>
                  <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Saldo Awal</span></td>
                  <td class="text-right">Rp {{ number_format($SaldoHutang->debet, 0, " ", ".")}}</td>
                  <td class="text-right">Rp {{ number_format($SaldoHutang->kredit, 0, " ", ".")}}</td>
              </tr>
              @endif
            @endforeach
            @foreach ($PurchaseJournals as $PurchaseJournal)
              @foreach ($purchasejournaldetails as $purchasejournaldetail)
                @if ($PurchaseJournal->suppliers_id == $DataSupplier->id)
                  @if ($purchasejournaldetail->purchasejournal_id == $PurchaseJournal->id)
                    <tr>
                      <td class="text-center">{{date('d F Y', strtotime($PurchaseJournal->tanggal ))}}</td>
                      <td class="text-center"><span class="badge badge-pill badge-warning mb-1">Purchase Journal</span></td>
                      <td class="text-right">Rp {{ number_format($purchasejournaldetail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($purchasejournaldetail->kredit, 0, " ", ".")}}</td>
                    </tr>
                  @endif
                @endif
              @endforeach
            @endforeach
            @foreach ($ReturPembelians as $ReturPembelian)
              @foreach ($ReturPembelianDetails as $ReturPembelianDetail)
                @if ($ReturPembelian->suppliers_id == $DataSupplier->id)
                  @if ($ReturPembelianDetail->retur_pembelian_id == $ReturPembelian->id)
                    <tr>
                      <td class="text-center">{{date('d F Y', strtotime($ReturPembelian->tanggal ))}}</td>
                      <td class="text-center"><span class="badge badge-pill badge-success mb-1">Retur Pembelian</span></td>
                      <td class="text-right">Rp {{ number_format($ReturPembelianDetail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($ReturPembelianDetail->kredit, 0, " ", ".")}}</td>
                    </tr>
                  @endif
                @endif
              @endforeach
            @endforeach
            @foreach ($CashBankOuts as $CashBankOut)
              @foreach ($CashBankOutDetails as $CashBankOutDetail)
                @if ($CashBankOut->suppliers_id == $DataSupplier->id)
                  @if ($CashBankOutDetail->cash_bank_outs_id == $CashBankOut->id)
                    <tr>
                      <td class="text-center">{{date('d F Y', strtotime($CashBankOut->tanggal ))}}</td>
                      <td class="text-center"><span class="badge badge-pill badge-warning mb-1">Cash & Bank</span></td>
                      <td class="text-right">Rp {{ number_format($CashBankOutDetail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($CashBankOutDetail->kredit, 0, " ", ".")}}</td>
                    </tr>
                  @endif
                @endif
              @endforeach
            @endforeach
          </tbody>
          <tfoot>
            <tr class="bg-success font-weight-bold">
              <td class="text-light text-center" colspan="2">Total</td>
                @php
                  $sum_tot_hutang_Debet1 = 0;
                  $sum_tot_hutang_Debet2 = 0;
                  $sum_tot_hutang_Debet3 = 0;
                  $sum_tot_hutang_Debet4 = 0;

                  $sum_tot_hutang_Kredit1 = 0;
                  $sum_tot_hutang_Kredit2 = 0;
                  $sum_tot_hutang_Kredit3 = 0;
                  $sum_tot_hutang_Kredit4 = 0;
                @endphp
                @foreach ($SaldoHutangs as $SaldoHutang)
                  @if ($SaldoHutang->suppliers_id == $DataSupplier->id)
                    @php
                      $sum_tot_hutang_Debet1 += ($SaldoHutang->where('suppliers_id', $DataSupplier->id)->sum('debet'));
                      $sum_tot_hutang_Kredit1 += ($SaldoHutang->where('suppliers_id', $DataSupplier->id)->sum('kredit'));
                    @endphp
                  @endif
                @endforeach
                @foreach ($PurchaseJournals as $PurchaseJournal)
                  @foreach ($purchasejournaldetails as $purchasejournaldetail)
                    @if ($PurchaseJournal->suppliers_id == $DataSupplier->id)
                      @if ($purchasejournaldetail->purchasejournal_id == $PurchaseJournal->id)
                        @php
                          $sum_tot_hutang_Debet2 += ($purchasejournaldetail->debet);
                          $sum_tot_hutang_Kredit2 += ($purchasejournaldetail->kredit);
                        @endphp
                      @endif
                    @endif
                  @endforeach
                @endforeach
                @foreach ($ReturPembelians as $ReturPembelian)
                  @foreach ($ReturPembelianDetails as $ReturPembelianDetail)
                    @if ($ReturPembelian->suppliers_id == $DataSupplier->id)
                      @if ($ReturPembelianDetail->retur_pembelian_id == $ReturPembelian->id)
                        @php
                          $sum_tot_hutang_Debet3 += ($ReturPembelianDetail->debet);
                          $sum_tot_hutang_Kredit3 += ($ReturPembelianDetail->kredit);
                        @endphp
                      @endif
                    @endif
                  @endforeach
                @endforeach
                @foreach ($CashBankOuts as $CashBankOut)
                  @foreach ($CashBankOutDetails as $CashBankOutDetail)
                    @if ($CashBankOut->suppliers_id == $DataSupplier->id)
                      @if ($CashBankOutDetail->cash_bank_outs_id == $CashBankOut->id)
                        @php
                          $sum_tot_hutang_Debet4 += ($CashBankOutDetail->debet);
                          $sum_tot_hutang_Kredit4 += ($CashBankOutDetail->kredit);
                        @endphp
                      @endif
                    @endif
                  @endforeach
                @endforeach
              <td class="text-right text-light">
                Rp {{number_format($sum_tot_hutang_Debet1 + $sum_tot_hutang_Debet2 + $sum_tot_hutang_Debet3 + $sum_tot_hutang_Debet4, 0, " ", ".")}}
              </td>
              <td class="text-light text-right">
                Rp {{number_format($sum_tot_hutang_Kredit1 + $sum_tot_hutang_Kredit2 + $sum_tot_hutang_Kredit3 + $sum_tot_hutang_Kredit4, 0, " ", ".")}}
              </td>
            </tr>
          </tfoot>
        </table>
      @endforeach
    </div>
    <br>
    <div class="dt-responsive">
      <table id="simpletable" class="table table-bordered nowrap" width="100%" border="1">
        <thead>
          <tr class="bg-secondary font-weight-bold">
            <td class="text-light text-center" colspan="3">Rekapitulasi</td>
          </tr>
          <tr>
            <td class="text-center">Kode</td>
            <td class="text-center">Suppliers Name</td>
            <td class="text-center">Balance</td>
          </tr>
        </thead>
        <tbody>
          @foreach ($DataSuppliers as $DataSupplier)
            <tr>
              <td>{{$DataSupplier->kode}}</td>
              <td>{{$DataSupplier->nama}}</td>
                @php
                  $sum_tot_hutang_Debet1 = 0;
                  $sum_tot_hutang_Debet2 = 0;
                  $sum_tot_hutang_Debet3 = 0;
                  $sum_tot_hutang_Debet4 = 0;

                  $sum_tot_hutang_Kredit1 = 0;
                  $sum_tot_hutang_Kredit2 = 0;
                  $sum_tot_hutang_Kredit3 = 0;
                  $sum_tot_hutang_Kredit4 = 0;
                @endphp
                @foreach ($SaldoHutangs as $SaldoHutang)
                  @if ($SaldoHutang->suppliers_id == $DataSupplier->id)
                    @php
                      $sum_tot_hutang_Debet1 += ($SaldoHutang->where('suppliers_id', $DataSupplier->id)->sum('debet'));
                      $sum_tot_hutang_Kredit1 += ($SaldoHutang->where('suppliers_id', $DataSupplier->id)->sum('kredit'));
                    @endphp
                  @endif
                @endforeach
                @foreach ($PurchaseJournals as $PurchaseJournal)
                  @foreach ($purchasejournaldetails as $purchasejournaldetail)
                    @if ($PurchaseJournal->suppliers_id == $DataSupplier->id)
                      @if ($purchasejournaldetail->purchasejournal_id == $PurchaseJournal->id)
                        @php
                          $sum_tot_hutang_Debet2 += ($purchasejournaldetail->debet);
                          $sum_tot_hutang_Kredit2 += ($purchasejournaldetail->kredit);
                        @endphp
                      @endif
                    @endif
                  @endforeach
                @endforeach
                @foreach ($ReturPembelians as $ReturPembelian)
                  @foreach ($ReturPembelianDetails as $ReturPembelianDetail)
                    @if ($ReturPembelian->suppliers_id == $DataSupplier->id)
                      @if ($ReturPembelianDetail->retur_pembelian_id == $ReturPembelian->id)
                        @php
                          $sum_tot_hutang_Debet3 += ($ReturPembelianDetail->debet);
                          $sum_tot_hutang_Kredit3 += ($ReturPembelianDetail->kredit);
                        @endphp
                      @endif
                    @endif
                  @endforeach
                @endforeach
                @foreach ($CashBankOuts as $CashBankOut)
                  @foreach ($CashBankOutDetails as $CashBankOutDetail)
                    @if ($CashBankOut->suppliers_id == $DataSupplier->id)
                      @if ($CashBankOutDetail->cash_bank_outs_id == $CashBankOut->id)
                        @php
                          $sum_tot_hutang_Debet4 += ($CashBankOutDetail->debet);
                          $sum_tot_hutang_Kredit4 += ($CashBankOutDetail->kredit);
                        @endphp
                      @endif
                    @endif
                  @endforeach
                @endforeach
              <td class="text-right">
                Rp {{number_format(($sum_tot_hutang_Kredit1 + $sum_tot_hutang_Kredit2 + $sum_tot_hutang_Kredit3 + $sum_tot_hutang_Kredit4) - ($sum_tot_hutang_Debet1 + $sum_tot_hutang_Debet2 + $sum_tot_hutang_Debet3 + $sum_tot_hutang_Debet4), 0, " ", ".")}}
              </td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr class="bg-success font-weight-bold">
            <td class="text-light text-center" colspan="2">Total</td>
                @php
                  $sum_tot_hutang_Debet1 = 0;
                  $sum_tot_hutang_Debet2 = 0;
                  $sum_tot_hutang_Debet3 = 0;
                  $sum_tot_hutang_Debet4 = 0;

                  $sum_tot_hutang_Kredit1 = 0;
                  $sum_tot_hutang_Kredit2 = 0;
                  $sum_tot_hutang_Kredit3 = 0;
                  $sum_tot_hutang_Kredit4 = 0;
                @endphp
                @foreach ($DataSuppliers as $DataSupplier)
                  @foreach ($SaldoHutangs as $SaldoHutang)
                    @if ($SaldoHutang->suppliers_id == $DataSupplier->id)
                      @php
                        $sum_tot_hutang_Debet1 += ($SaldoHutang->where('suppliers_id', $DataSupplier->id)->sum('debet'));
                        $sum_tot_hutang_Kredit1 += ($SaldoHutang->where('suppliers_id', $DataSupplier->id)->sum('kredit'));
                      @endphp
                    @endif
                  @endforeach
                  @foreach ($PurchaseJournals as $PurchaseJournal)
                    @foreach ($purchasejournaldetails as $purchasejournaldetail)
                      @if ($PurchaseJournal->suppliers_id == $DataSupplier->id)
                        @if ($purchasejournaldetail->purchasejournal_id == $PurchaseJournal->id)
                          @php
                            $sum_tot_hutang_Debet2 += ($purchasejournaldetail->debet);
                            $sum_tot_hutang_Kredit2 += ($purchasejournaldetail->kredit);
                          @endphp
                        @endif
                      @endif
                    @endforeach
                  @endforeach
                  @foreach ($ReturPembelians as $ReturPembelian)
                    @foreach ($ReturPembelianDetails as $ReturPembelianDetail)
                      @if ($ReturPembelian->suppliers_id == $DataSupplier->id)
                        @if ($ReturPembelianDetail->retur_pembelian_id == $ReturPembelian->id)
                          @php
                            $sum_tot_hutang_Debet3 += ($ReturPembelianDetail->debet);
                            $sum_tot_hutang_Kredit3 += ($ReturPembelianDetail->kredit);
                          @endphp
                        @endif
                      @endif
                    @endforeach
                  @endforeach
                  @foreach ($CashBankOuts as $CashBankOut)
                    @foreach ($CashBankOutDetails as $CashBankOutDetail)
                      @if ($CashBankOut->suppliers_id == $DataSupplier->id)
                        @if ($CashBankOutDetail->cash_bank_outs_id == $CashBankOut->id)
                          @php
                            $sum_tot_hutang_Debet4 += ($CashBankOutDetail->debet);
                            $sum_tot_hutang_Kredit4 += ($CashBankOutDetail->kredit);
                          @endphp
                        @endif
                      @endif
                    @endforeach
                  @endforeach
                @endforeach
            <td class="text-light text-right">
              Rp {{number_format(($sum_tot_hutang_Kredit1 + $sum_tot_hutang_Kredit2 + $sum_tot_hutang_Kredit3 + $sum_tot_hutang_Kredit4) - ($sum_tot_hutang_Debet1 + $sum_tot_hutang_Debet2 + $sum_tot_hutang_Debet3 + $sum_tot_hutang_Debet4), 0, " ", ".")}}
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</body>
</html>
