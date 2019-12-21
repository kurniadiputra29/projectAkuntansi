@extends('layouts.app')

@section('title', 'Laporan Piutang Angsuran Pelanggan')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-trending-up bg-blue"></i>
              <div class="d-inline">
                <h5>Piutang Angsuran Pelanggan</h5>
                <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="/dasbor"><i class="ik ik-home"></i></a>
                </li>
                <li class="breadcrumb-item">
                  <a href="/laporan">Laporan</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Piutang Angsuran Pelanggan</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="row py-3">
            <div class="col-md-6">
              <form class="forms-sample" action="#" method="post">
                <label for="filter">Tanggal Mulai</label>
                <input type="date" name="tanggal" id="filter">
                <label for="filter2">Tanggal Akhir</label>
                <input type="date" name="tanggal" id="filter2">
                <button class="btn btn-primary" type="submit" name="button">Filter</button>
              </form>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
              <a type="button" class="btn btn-success mr-5" href="/laporan"><i class="ik ik-arrow-left"></i>Back</a>
              <a type="button" class="btn btn-primary" href="#"><i class="ik ik-printer"></i>Print</a>
            </div>
          </div>
          <div class="table-container list-table">
            <div class="report-title">
              <div class="table-responsive">
                @foreach ($DataCustomers as $DataCustomer)
                <h5 style="margin-top: 30px;">Customers Name : {{ $DataCustomer->nama }}</h5>
                <table class="account-transactions report-table table" id="account-entry">
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
                <table id="simpletable" class="table table-bordered nowrap">
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
                      <!-- @foreach ($SalesJournals as $SalesJournal)
                        @foreach ($salesjournaldetails as $salesjournaldetail)
                          <tr>
                            @if ($SalesJournal->customers_id == $rekap->id)
                              @if ($salesjournaldetail->salesjournal_id == $SalesJournal->id)
                                <td>{{$rekap->kode}}</td>
                                <td>{{$rekap->nama}}</td>
                                <td class="text-right">Rp {{ number_format($salesjournaldetail->where('nomor_akun', '1-1220')->where('salesjournal_id', $SalesJournal->id)->sum('debet'))}}</td>
                                <td class="text-right">Rp {{ number_format($salesjournaldetail->where('nomor_akun', '1-1220')->where('salesjournal_id', $SalesJournal->id)->sum('kredit'))}}</td>
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
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
