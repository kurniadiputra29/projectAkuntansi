<html>
<head>
  <title>Buku Besar</title>
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
  <div class="text-center">
    <h1>PT OEMAR TECHNO DISTRIBUTOR</h1>
    <h2>Laporan Buku Besar</h2>
    <h3>Periode {{date('d F Y', strtotime($tanggal_mulai))}} sampai {{date('d F Y', strtotime($tanggal_akhir))}}</h3>
  </div>
  <br>
  <div class="container-fluid mt-2">
    <div id="app">
      @foreach ($accounts as $account)
        <table class="table table-bordered nowrap" width="100%" border="1">
          <thead class="report-header">
            <tr class="bg-secondary font-weight-bold">
              <th class="text-light" colspan="4">Nama Akun: {{$account->nama}} ( {{$account->nomor}} )</th>
            </tr>
            <tr class="row">
              <th class="text-center col-3">Tanggal</th>
              <th class="text-center col-3">Deskripsi</th>
              <th class="text-center col-3">Debet</th>
              <th class="text-center col-3">Kredit</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($saldo_awals as $saldo_awal)              
              @if ($saldo_awal->account_id == $account->id)
                <tr>
                  <td class="text-center">{{date('d F Y', strtotime($saldo_awal->tanggal ))}}</td>
                  <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Saldo Awal</span></td>
                  <td class="text-right">Rp {{ number_format($saldo_awal->debet, 0, " ", ".")}}</td>
                  <td class="text-right">Rp {{ number_format($saldo_awal->kredit, 0, " ", ".")}}</td>
                </tr>
              @endif              
            @endforeach
            @foreach ($CashBankIns as $CashBankIn)
              @foreach ($cbi_details as $cbi_detail)
                @if ($CashBankIn->id == $cbi_detail->cash_bank_ins_id)
                  @if ($cbi_detail->nomor_akun == $account->nomor)
                    <tr>
                      <td class="text-center">{{date('d F Y', strtotime($CashBankIn->tanggal ))}}</td>
                      <td class="text-center"><span class="badge badge-pill badge-success mb-1">Cash Bank In</span></td>
                      <td class="text-right">Rp {{ number_format($cbi_detail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($cbi_detail->kredit, 0, " ", ".")}}</td>
                    </tr>
                  @endif
                @endif
              @endforeach
            @endforeach
            @foreach ($CashBankOuts as $CashBankOut)
              @foreach ($cbo_details as $cbo_detail)
                @if ($CashBankOut->id == $cbo_detail->cash_bank_outs_id)
                  @if ($cbo_detail->nomor_akun == $account->nomor)
                    <tr>
                      <td class="text-center">{{date('d F Y', strtotime($CashBankOut->tanggal ))}}</td>
                      <td class="text-center"><span class="badge badge-pill badge-success mb-1">Cash Bank Out</span></td>
                      <td class="text-right">Rp {{ number_format($cbo_detail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($cbo_detail->kredit, 0, " ", ".")}}</td>
                    </tr>
                  @endif
                @endif
              @endforeach
            @endforeach
            @foreach ($cpjs as $cpj)
              @foreach ($cpj_details as $cpj_detail)
                @if ($cpj->id == $cpj_detail->cpj_id)
                  @if ($cpj_detail->nomor_akun == $account->nomor)
                    <tr>
                      <td class="text-center">{{date('d F Y', strtotime($cpj->tanggal ))}}</td>
                      <td class="text-center"><span class="badge badge-pill badge-success mb-1">Cash Payment Journal</span></td>
                      <td class="text-right">Rp {{ number_format($cpj_detail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($cpj_detail->kredit, 0, " ", ".")}}</td>
                    </tr>
                  @endif
                @endif
              @endforeach
            @endforeach
            @foreach ($crjs as $crj)
              @foreach ($crj_details as $crj_detail)
                @if ($crj->id == $crj_detail->crj_id)
                  @if ($crj_detail->nomor_akun == $account->nomor)
                    <tr>
                      <td class="text-center">{{date('d F Y', strtotime($crj->tanggal ))}}</td>
                      <td class="text-center"><span class="badge badge-pill badge-success mb-1">Cash Receipt Journal</span></td>
                      <td class="text-right">Rp {{ number_format($crj_detail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($crj_detail->kredit, 0, " ", ".")}}</td>
                    </tr>
                  @endif
                @endif
              @endforeach
            @endforeach
            @foreach ($PurchaseJournals as $PurchaseJournal)
              @foreach ($pj_details as $pj_detail)
                @if ($PurchaseJournal->id == $pj_detail->purchasejournal_id)
                  @if ($pj_detail->nomor_akun == $account->nomor)
                    <tr>
                      <td class="text-center">{{date('d F Y', strtotime($PurchaseJournal->tanggal ))}}</td>
                      <td class="text-center"><span class="badge badge-pill badge-success mb-1">Purchase Journal</span></td>
                      <td class="text-right">Rp {{ number_format($pj_detail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($pj_detail->kredit, 0, " ", ".")}}</td>
                    </tr>
                  @endif
                @endif
              @endforeach
            @endforeach
            @foreach ($SalesJournals as $SalesJournal)
              @foreach ($sj_details as $sj_detail)
                @if ($SalesJournal->id == $sj_detail->salesjournal_id)
                  @if ($sj_detail->nomor_akun == $account->nomor)
                    <tr>
                      <td class="text-center">{{date('d F Y', strtotime($SalesJournal->tanggal ))}}</td>
                      <td class="text-center"><span class="badge badge-pill badge-success mb-1">Sales Journal</span></td>
                      <td class="text-right">Rp {{ number_format($sj_detail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($sj_detail->kredit, 0, " ", ".")}}</td>
                    </tr>
                  @endif
                @endif
              @endforeach
            @endforeach
            @foreach ($ReturPembelians as $ReturPembelian)
              @foreach ($rpb_details as $rpb_detail)
                @if ($ReturPembelian->id == $rpb_detail->retur_pembelian_id)
                  @if ($rpb_detail->nomor_akun == $account->nomor)
                    <tr>
                      <td class="text-center">{{date('d F Y', strtotime($ReturPembelian->tanggal ))}}</td>
                      <td class="text-center"><span class="badge badge-pill badge-success mb-1">Retur Pembelian</span></td>
                      <td class="text-right">Rp {{ number_format($rpb_detail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($rpb_detail->kredit, 0, " ", ".")}}</td>
                    </tr>
                  @endif
                @endif
              @endforeach
            @endforeach
            @foreach ($ReturPenjualans as $ReturPenjualan)
              @foreach ($rpj_details as $rpj_detail)
                @if ($ReturPenjualan->id == $rpj_detail->retur_penjualan_id)
                  @if ($rpj_detail->nomor_akun == $account->nomor)
                    <tr>
                      <td class="text-center">{{date('d F Y', strtotime($ReturPenjualan->tanggal ))}}</td>
                      <td class="text-center"><span class="badge badge-pill badge-success mb-1">Retur Penjualan</span></td>
                      <td class="text-right">Rp {{ number_format($rpj_detail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($rpj_detail->kredit, 0, " ", ".")}}</td>
                    </tr>
                  @endif
                @endif
              @endforeach
            @endforeach
            @foreach ($JurnalUmums as $JurnalUmum)
              @foreach ($ju_details as $ju_detail)
                @if ($JurnalUmum->id == $ju_detail->jurnal_umums_id)
                  @if ($ju_detail->nomor_akun == $account->nomor)
                    <tr>
                      <td class="text-center">{{date('d F Y', strtotime($JurnalUmum->tanggal ))}}</td>
                      <td class="text-center"><span class="badge badge-pill badge-success mb-1">Jurnal Umum</span></td>
                      <td class="text-right">Rp {{ number_format($ju_detail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($ju_detail->kredit, 0, " ", ".")}}</td>
                    </tr>
                  @endif
                @endif
              @endforeach
            @endforeach
            @foreach ($Pettycashs as $Pettycash)
              @foreach ($pc_details as $pc_detail)
                @if ($Pettycash->id == $pc_detail->pettycash_id)
                  @if ($pc_detail->nomor_akun == $account->nomor)
                    <tr>
                      <td class="text-center">{{date('d F Y', strtotime($Pettycash->tanggal ))}}</td>
                      <td class="text-center"><span class="badge badge-pill badge-success mb-1">Kas Kecil</span></td>
                      <td class="text-right">Rp {{ number_format($pc_detail->debet, 0, " ", ".")}}</td>
                      <td class="text-right">Rp {{ number_format($pc_detail->kredit, 0, " ", ".")}}</td>
                    </tr>
                  @endif
                @endif
              @endforeach
            @endforeach
          </tbody>
          <tfoot>
            <tr class="bg-success font-weight-bold">
              <td class="text-light text-center" colspan="2">Balance</td>
              <td class="text-light text-right">
                  Rp {{number_format($distinct_laporan->where('nomor_akun', $account->nomor)->sum('debet') + $distinct_laporan->where('account_id', $account->id)->sum('debet'), 0, " ", ".")}}
              </td>
              <td class="text-light text-right">
                  Rp {{number_format($distinct_laporan->where('account_id', $account->id)->sum('kredit')  + $distinct_laporan->where('nomor_akun', $account->nomor)->sum('kredit'), 0, " ", ".")}}
              </td>
            </tr>
          </tfoot>
        </table>
        <br>
      @endforeach
    </div>
  </div>
</body>
</html>
