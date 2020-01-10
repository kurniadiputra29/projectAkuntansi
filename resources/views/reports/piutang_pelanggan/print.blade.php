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
  <div class="container-fluid mt-2">

    <div class="dt-responsive">
      @foreach ($DataCustomers as $DataCustomer)
        <table class="table table-bordered nowrap" width="100%" border="1">
          <thead class="report-header">
            <tr class="bg-secondary font-weight-bold">
              <th class="col-8 text-light" colspan="4">Customers Name: {{$DataCustomer->nama}} ( {{$DataCustomer->kode}} )</th>
            </tr>
            <tr>
              <th class="text-center">Tanggal</th>
              <th class="text-center">Deskripsi</th>
              <th class="text-center">Debet</th>
              <th class="text-center">Kredit</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($SaldoPiutangs as $SaldoPiutang)
              @if ($SaldoPiutang->customers_id == $DataCustomer->id)
                <tr>
                  <td class="text-center">{{date('d F Y', strtotime($DataCustomer->created_at ))}}</td>
                  <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Saldo Awal</span></td>
                  <td class="text-right">Rp {{ number_format($SaldoPiutang->debet, 0, " ", ".")}}</td>
                  <td class="text-right">Rp {{ number_format($SaldoPiutang->kredit, 0, " ", ".")}}</td>
                </tr>
              @endif
            @endforeach
            @foreach ($SalesJournals as $SalesJournal)
              @foreach ($salesjournaldetails as $salesjournaldetail)
                @if ($SalesJournal->customers_id == $DataCustomer->id)
                  @if ($salesjournaldetail->salesjournal_id == $SalesJournal->id)
                    <tr>
                      <td class="text-center">{{date('d F Y', strtotime($SalesJournal->tanggal ))}}</td>
                      <td class="text-center"><span class="badge badge-pill badge-success mb-1">Sales Journal</span></td>
                      <td class="text-right">Rp {{ number_format($salesjournaldetail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($salesjournaldetail->kredit, 0, " ", ".")}}</td>
                    </tr>
                  @endif
                @endif
              @endforeach
            @endforeach
            @foreach ($ReturPenjualans as $ReturPenjualan)
              @foreach ($ReturPenjualanDetails as $ReturPenjualanDetail)
                @if ($ReturPenjualan->customers_id == $DataCustomer->id)
                  @if ($ReturPenjualanDetail->retur_penjualan_id == $ReturPenjualan->id)
                    <tr>
                      <td class="text-center">{{date('d F Y', strtotime($ReturPenjualan->tanggal ))}}</td>
                      <td class="text-center"><span class="badge badge-pill badge-warning mb-1">Retur Penjualan</span></td>
                      <td class="text-right">Rp {{ number_format($ReturPenjualanDetail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($ReturPenjualanDetail->kredit, 0, " ", ".")}}</td>
                    </tr>
                  @endif
                @endif
              @endforeach
            @endforeach
            @foreach ($CashBankIns as $CashBankIn)
              @foreach ($CashBankInDetails as $CashBankInDetail)
                @if ($CashBankIn->customers_id == $DataCustomer->id)
                  @if ($CashBankInDetail->cash_bank_ins_id == $CashBankIn->id)
                    <tr>
                      <td class="text-center">{{date('d F Y', strtotime($CashBankIn->tanggal ))}}</td>
                      <td class="text-center"><span class="badge badge-pill badge-success mb-1">Cash & Bank</span></td>
                      <td class="text-right">Rp {{ number_format($CashBankInDetail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($CashBankInDetail->kredit, 0, " ", ".")}}</td>
                    </tr>
                  @endif
                @endif
              @endforeach
            @endforeach
          </tbody>
          <tfoot>
            <tr class="bg-success font-weight-bold">
              <td class="text-light text-center" colspan="2">Total</td>
              <td class="text-light text-right">
                Rp {{number_format($distinct_laporan->where('customers_id', $DataCustomer->id)->sum('debet'), 0, " ", ".")}}
              </td>
              <td class="text-light text-right">
                Rp {{number_format($distinct_laporan->where('customers_id', $DataCustomer->id)->sum('kredit'), 0, " ", ".")}}
              </td>
            </tr>
          </tfoot>
        </table>
      @endforeach
    </div>
    <div class="page-break"></div>
    <div class="dt-responsive">
      <table id="simpletable" class="table table-bordered nowrap" width="100%" border="1">
        <thead>
          <tr class="bg-secondary font-weight-bold">
            <td class="text-light text-center" colspan="3">Rekapitulasi</td>
          </tr>
          <tr>
            <td class="text-center">Kode</td>
            <td class="text-center">Customers Name</td>
            <td class="text-center">Balance</td>
          </tr>
        </thead>
        <tbody>
          @foreach ($distinct_pc as $rekap)
            <tr>
              <td>{{$rekap->kode}}</td>
              <td>{{$rekap->nama}}</td>
              <td class="text-right">
                Rp {{number_format($distinct_laporan->where('customers_id', $rekap->id)->sum('debet') - $distinct_laporan->where('customers_id', $rekap->id)->sum('kredit'), 0, " ", ".")}}
              </td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr class="bg-success font-weight-bold">
            <td class="text-light text-center" colspan="2">Total</td>
            <td class="text-light text-right">
              Rp {{number_format($distinct_laporan->sum('debet') - $distinct_laporan->sum('kredit'), 0, " ", ".")}}
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</body>
</html>
