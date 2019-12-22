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
      @foreach ($DataCustomers as $DataCustomer)
        <h5 style="margin-top: 30px;">Customers Name : {{ $DataCustomer->nama }}</h5>
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
            @foreach ($SaldoPiutangs as $SaldoPiutang)
              <tr>
                @if ($SaldoPiutang->customers_id == $DataCustomer->id)
                  <td class="text-center">{{date('d F Y', strtotime($DataCustomer->created_at ))}}</td>
                  <td class="text-center">{{ $DataCustomer->kode }}</td>
                  <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Saldo Awal</span></td>
                  <td class="text-center">{{ $DataCustomer->status }}</td>
                  <td class="text-center">{{ $DataCustomer->status }}</td>
                  <td class="text-right">Rp {{ number_format($SaldoPiutang->debet, 0, " ", ".")}}</td>
                  <td class="text-right">Rp {{ number_format($SaldoPiutang->kredit, 0, " ", ".")}}</td>
                @endif
              </tr>
            @endforeach
            @foreach ($SalesJournals as $SalesJournal)
              @foreach ($salesjournaldetails as $salesjournaldetail)
                <tr>
                  @if ($SalesJournal->customers_id == $DataCustomer->id)
                    @if ($salesjournaldetail->salesjournal_id == $SalesJournal->id)
                      <td class="text-center">{{date('d F Y', strtotime($SalesJournal->tanggal ))}}</td>
                      <td class="text-center">{{ $DataCustomer->kode }}</td>
                      <td class="text-center"><span class="badge badge-pill badge-success mb-1">Sales Journal</span></td>
                      <td class="text-right">Rp {{ number_format($salesjournaldetail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($salesjournaldetail->kredit, 0, " ", ".")}}</td>
                    @endif
                  @endif
                </tr>
              @endforeach
            @endforeach
            @foreach ($ReturPenjualans as $ReturPenjualan)
              @foreach ($ReturPenjualanDetails as $ReturPenjualanDetail)
                <tr>
                  @if ($ReturPenjualan->customers_id == $DataCustomer->id)
                    @if ($ReturPenjualanDetail->retur_penjualan_id == $ReturPenjualan->id)
                      <td class="text-center">{{date('d F Y', strtotime($ReturPenjualan->tanggal ))}}</td>
                      <td class="text-center">{{ $DataCustomer->kode }}</td>
                      <td class="text-center"><span class="badge badge-pill badge-warning mb-1">Retur Penjualan</span></td>
                      <td class="text-right">Rp {{ number_format($ReturPenjualanDetail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($ReturPenjualanDetail->kredit, 0, " ", ".")}}</td>
                    @endif
                  @endif
                </tr>
              @endforeach
            @endforeach
            @foreach ($CashBankIns as $CashBankIn)
              @foreach ($CashBankInDetails as $CashBankInDetail)
                <tr>
                  @if ($CashBankIn->customers_id == $DataCustomer->id)
                    @if ($CashBankInDetail->cash_bank_ins_id == $CashBankIn->id)
                      <td class="text-center">{{date('d F Y', strtotime($CashBankIn->tanggal ))}}</td>
                      <td class="text-center">{{ $DataCustomer->kode }}</td>
                      <td class="text-center"><span class="badge badge-pill badge-success mb-1">Cash & Bank</span></td>
                      <td class="text-right">Rp {{ number_format($CashBankInDetail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($CashBankInDetail->kredit, 0, " ", ".")}}</td>
                    @endif
                  @endif
                </tr>
              @endforeach
            @endforeach
            <tr class="bg-success text-light">
              <td class="text-center grand-total" colspan="10">
                {{ $DataCustomer->kode }}
              </td>
            </tr>
          </tbody>
        </table>
      @endforeach
    </div>
    <div class="dt-responsive">
      <table id="simpletable" class="table table-bordered nowrap" width="100%" style="width:100%" border="1">
        <thead>
          <tr class="bg-secondary font-weight-bold">
            <td class="text-light text-center" colspan="4">Rekapitulasi</td>
          </tr>
          <tr>
            <td>Kode</td>
            <td>Customers Name</td>
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
                Rp {{number_format($distinct_pcc->where('customers_id', $rekap->id)->sum('debet'))}}
              </td>
              <td class="text-right">
                Rp {{number_format($distinct_pcc->where('customers_id', $rekap->id)->sum('kredit'))}}
              </td>
            </tr>

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
