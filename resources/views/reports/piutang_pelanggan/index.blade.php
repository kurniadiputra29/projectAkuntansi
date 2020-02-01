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
          <div class="card">
            <div class="card-header d-flex justify-content-between flex-row">
              <div class="left-container">
                <h3>Piutang Pelanggan</h3>
                <span>use class <code>table-hover</code> inside table element</span>
              </div>
              <div class="right-container">
                <a type="button" class="btn btn-success mr-5" href="/laporan"><i class="ik ik-arrow-left"></i>Back</a>
                <button type="button" class="btn btn-info mr-5" data-toggle="modal" data-target="#createModal"><i class="ik ik-filter"></i>Filter</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pdfModal"><i class="ik ik-printer"></i>Print</button>
              </div>
            </div>
            <div class="card-body">
              <div class="dt-responsive">
                @foreach ($DataCustomers as $DataCustomer)
                  <table class="table table-bordered nowrap">
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
                        <tr>
                          @if ($SaldoPiutang->customers_id == $DataCustomer->id)
                            <td class="text-center">{{date('d F Y', strtotime($DataCustomer->created_at ))}}</td>
                            <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Saldo Awal</span></td>
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
                                <td class="text-center"><span class="badge badge-pill badge-success mb-1">Cash & Bank</span></td>
                                <td class="text-right">Rp {{ number_format($CashBankInDetail->debet, 0, " ", ".")}}</td>
                                <td class="text-right">Rp {{ number_format($CashBankInDetail->kredit, 0, " ", ".")}}</td>
                              @endif
                            @endif
                          </tr>
                        @endforeach
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr class="bg-success font-weight-bold">
                        <td class="text-light text-center" colspan="2">Total</td>
                        <td class="text-right text-light">
                          @php
                            $sum_tot_piutang_Debet1 = 0;
                            $sum_tot_piutang_Debet2 = 0;
                            $sum_tot_piutang_Debet3 = 0;
                            $sum_tot_piutang_Debet4 = 0;
                          @endphp
                          @foreach ($SaldoPiutangs as $SaldoPiutang)
                            @if ($SaldoPiutang->customers_id == $DataCustomer->id)
                              @php
                                $sum_tot_piutang_Debet1 += ($SaldoPiutang->where('customers_id', $DataCustomer->id)->sum('debet'));
                              @endphp
                            @endif
                          @endforeach
                          @foreach ($SalesJournals as $SalesJournal)
                            @foreach ($salesjournaldetails as $salesjournaldetail)
                              @if ($SalesJournal->customers_id == $DataCustomer->id)
                                @if ($salesjournaldetail->salesjournal_id == $SalesJournal->id)
                                  @php
                                    $sum_tot_piutang_Debet2 += ($salesjournaldetail->debet);
                                  @endphp
                                @endif
                              @endif
                            @endforeach
                          @endforeach
                          @foreach ($ReturPenjualans as $ReturPenjualan)
                            @foreach ($ReturPenjualanDetails as $ReturPenjualanDetail)
                              @if ($ReturPenjualan->customers_id == $DataCustomer->id)
                                @if ($ReturPenjualanDetail->retur_penjualan_id == $ReturPenjualan->id)
                                  @php
                                    $sum_tot_piutang_Debet3 += ($ReturPenjualanDetail->debet);
                                  @endphp
                                @endif
                              @endif
                            @endforeach
                          @endforeach
                          @foreach ($CashBankIns as $CashBankIn)
                            @foreach ($CashBankInDetails as $CashBankInDetail)
                              @if ($CashBankIn->customers_id == $DataCustomer->id)
                                @if ($CashBankInDetail->cash_bank_ins_id == $CashBankIn->id)
                                  @php
                                    $sum_tot_piutang_Debet4 += ($CashBankInDetail->debet);
                                  @endphp
                                @endif
                              @endif
                            @endforeach
                          @endforeach

                          Rp {{number_format($sum_tot_piutang_Debet1 + $sum_tot_piutang_Debet2 + $sum_tot_piutang_Debet3 + $sum_tot_piutang_Debet4, 0, " ", ".")}}
                        </td>
                        <td class="text-light text-right">
                          @php
                            $sum_tot_piutang_Kredit1 = 0;
                            $sum_tot_piutang_Kredit2 = 0;
                            $sum_tot_piutang_Kredit3 = 0;
                            $sum_tot_piutang_Kredit4 = 0;
                          @endphp
                          @foreach ($SaldoPiutangs as $SaldoPiutang)
                            @if ($SaldoPiutang->customers_id == $DataCustomer->id)
                              @php
                                $sum_tot_piutang_Kredit1 += ($SaldoPiutang->where('customers_id', $DataCustomer->id)->sum('kredit'));
                              @endphp
                            @endif
                          @endforeach
                          @foreach ($SalesJournals as $SalesJournal)
                            @foreach ($salesjournaldetails as $salesjournaldetail)
                              @if ($SalesJournal->customers_id == $DataCustomer->id)
                                @if ($salesjournaldetail->salesjournal_id == $SalesJournal->id)
                                  @php
                                    $sum_tot_piutang_Kredit2 += ($salesjournaldetail->kredit);
                                  @endphp
                                @endif
                              @endif
                            @endforeach
                          @endforeach
                          @foreach ($ReturPenjualans as $ReturPenjualan)
                            @foreach ($ReturPenjualanDetails as $ReturPenjualanDetail)
                              @if ($ReturPenjualan->customers_id == $DataCustomer->id)
                                @if ($ReturPenjualanDetail->retur_penjualan_id == $ReturPenjualan->id)
                                  @php
                                    $sum_tot_piutang_Kredit3 += ($ReturPenjualanDetail->kredit);
                                  @endphp
                                @endif
                              @endif
                            @endforeach
                          @endforeach
                          @foreach ($CashBankIns as $CashBankIn)
                            @foreach ($CashBankInDetails as $CashBankInDetail)
                              @if ($CashBankIn->customers_id == $DataCustomer->id)
                                @if ($CashBankInDetail->cash_bank_ins_id == $CashBankIn->id)
                                  @php
                                    $sum_tot_piutang_Kredit4 += ($CashBankInDetail->kredit);
                                  @endphp
                                @endif
                              @endif
                            @endforeach
                          @endforeach

                          Rp {{number_format($sum_tot_piutang_Kredit1 + $sum_tot_piutang_Kredit2 + $sum_tot_piutang_Kredit3 + $sum_tot_piutang_Kredit4, 0, " ", ".")}}
                        </td>
                      </tr>
                    </tfoot>
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
                      <td class="text-center">Kode</td>
                      <td class="text-center">Customers Name</td>
                      <td class="text-center">Balance</td>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach ($DataCustomers as $DataCustomer)
                      <tr>
                        <td>{{$DataCustomer->kode}}</td>
                        <td>{{$DataCustomer->nama}}</td>
                        <td class="text-right">
                          @php
                            $sum_tot_piutang_Debet1 = 0;
                            $sum_tot_piutang_Debet2 = 0;
                            $sum_tot_piutang_Debet3 = 0;
                            $sum_tot_piutang_Debet4 = 0;
                          @endphp
                          @foreach ($SaldoPiutangs as $SaldoPiutang)
                            @if ($SaldoPiutang->customers_id == $DataCustomer->id)
                              @php
                                $sum_tot_piutang_Debet1 += ($SaldoPiutang->where('customers_id', $DataCustomer->id)->sum('debet'));
                              @endphp
                            @endif
                          @endforeach
                          @foreach ($SalesJournals as $SalesJournal)
                            @foreach ($salesjournaldetails as $salesjournaldetail)
                              @if ($SalesJournal->customers_id == $DataCustomer->id)
                                @if ($salesjournaldetail->salesjournal_id == $SalesJournal->id)
                                  @php
                                    $sum_tot_piutang_Debet2 += ($salesjournaldetail->debet);
                                  @endphp
                                @endif
                              @endif
                            @endforeach
                          @endforeach
                          @foreach ($ReturPenjualans as $ReturPenjualan)
                            @foreach ($ReturPenjualanDetails as $ReturPenjualanDetail)
                              @if ($ReturPenjualan->customers_id == $DataCustomer->id)
                                @if ($ReturPenjualanDetail->retur_penjualan_id == $ReturPenjualan->id)
                                  @php
                                    $sum_tot_piutang_Debet3 += ($ReturPenjualanDetail->debet);
                                  @endphp
                                @endif
                              @endif
                            @endforeach
                          @endforeach
                          @foreach ($CashBankIns as $CashBankIn)
                            @foreach ($CashBankInDetails as $CashBankInDetail)
                              @if ($CashBankIn->customers_id == $DataCustomer->id)
                                @if ($CashBankInDetail->cash_bank_ins_id == $CashBankIn->id)
                                  @php
                                    $sum_tot_piutang_Debet4 += ($CashBankInDetail->debet);
                                  @endphp
                                @endif
                              @endif
                            @endforeach
                          @endforeach

                          @php
                            $sum_tot_piutang_Kredit1 = 0;
                            $sum_tot_piutang_Kredit2 = 0;
                            $sum_tot_piutang_Kredit3 = 0;
                            $sum_tot_piutang_Kredit4 = 0;
                          @endphp
                          @foreach ($SaldoPiutangs as $SaldoPiutang)
                            @if ($SaldoPiutang->customers_id == $DataCustomer->id)
                              @php
                                $sum_tot_piutang_Kredit1 += ($SaldoPiutang->where('customers_id', $DataCustomer->id)->sum('kredit'));
                              @endphp
                            @endif
                          @endforeach
                          @foreach ($SalesJournals as $SalesJournal)
                            @foreach ($salesjournaldetails as $salesjournaldetail)
                              @if ($SalesJournal->customers_id == $DataCustomer->id)
                                @if ($salesjournaldetail->salesjournal_id == $SalesJournal->id)
                                  @php
                                    $sum_tot_piutang_Kredit2 += ($salesjournaldetail->kredit);
                                  @endphp
                                @endif
                              @endif
                            @endforeach
                          @endforeach
                          @foreach ($ReturPenjualans as $ReturPenjualan)
                            @foreach ($ReturPenjualanDetails as $ReturPenjualanDetail)
                              @if ($ReturPenjualan->customers_id == $DataCustomer->id)
                                @if ($ReturPenjualanDetail->retur_penjualan_id == $ReturPenjualan->id)
                                  @php
                                    $sum_tot_piutang_Kredit3 += ($ReturPenjualanDetail->kredit);
                                  @endphp
                                @endif
                              @endif
                            @endforeach
                          @endforeach
                          @foreach ($CashBankIns as $CashBankIn)
                            @foreach ($CashBankInDetails as $CashBankInDetail)
                              @if ($CashBankIn->customers_id == $DataCustomer->id)
                                @if ($CashBankInDetail->cash_bank_ins_id == $CashBankIn->id)
                                  @php
                                    $sum_tot_piutang_Kredit4 += ($CashBankInDetail->kredit);
                                  @endphp
                                @endif
                              @endif
                            @endforeach
                          @endforeach

                          Rp {{number_format(($sum_tot_piutang_Debet1 + $sum_tot_piutang_Debet2 + $sum_tot_piutang_Debet3 + $sum_tot_piutang_Debet4) - ($sum_tot_piutang_Kredit1 + $sum_tot_piutang_Kredit2 + $sum_tot_piutang_Kredit3 + $sum_tot_piutang_Kredit4), 0, " ", ".")}}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-center" colspan="2">Total</td>
                      <td class="text-light text-right">
                          @php
                            $sum_tot_piutang_Debet_sum1 = 0;
                            $sum_tot_piutang_Debet_sum2 = 0;
                            $sum_tot_piutang_Debet_sum3 = 0;
                            $sum_tot_piutang_Debet_sum4 = 0;

                            $sum_tot_piutang_Kredit_sum1 = 0;
                            $sum_tot_piutang_Kredit_sum2 = 0;
                            $sum_tot_piutang_Kredit_sum3 = 0;
                            $sum_tot_piutang_Kredit_sum4 = 0;
                          @endphp
                          @foreach ($DataCustomers as $DataCustomer)
                            @foreach ($SaldoPiutangs as $SaldoPiutang)
                              @if ($SaldoPiutang->customers_id == $DataCustomer->id)
                                @php
                                  $sum_tot_piutang_Debet_sum1 += ($SaldoPiutang->where('customers_id', $DataCustomer->id)->sum('debet'));
                                  $sum_tot_piutang_Kredit_sum1 += ($SaldoPiutang->where('customers_id', $DataCustomer->id)->sum('kredit'));
                                @endphp
                              @endif
                            @endforeach

                            @foreach ($SalesJournals as $SalesJournal)
                              @foreach ($salesjournaldetails as $salesjournaldetail)
                                @if ($SalesJournal->customers_id == $DataCustomer->id)
                                  @if ($salesjournaldetail->salesjournal_id == $SalesJournal->id)
                                    @php
                                      $sum_tot_piutang_Debet_sum2 += ($salesjournaldetail->debet);
                                      $sum_tot_piutang_Kredit_sum2 += ($salesjournaldetail->kredit);
                                    @endphp
                                  @endif
                                @endif
                              @endforeach
                            @endforeach
                            @foreach ($ReturPenjualans as $ReturPenjualan)
                              @foreach ($ReturPenjualanDetails as $ReturPenjualanDetail)
                                @if ($ReturPenjualan->customers_id == $DataCustomer->id)
                                  @if ($ReturPenjualanDetail->retur_penjualan_id == $ReturPenjualan->id)
                                    @php
                                      $sum_tot_piutang_Debet_sum3 += ($ReturPenjualanDetail->debet);
                                      $sum_tot_piutang_Kredit_sum3 += ($ReturPenjualanDetail->kredit);
                                    @endphp
                                  @endif
                                @endif
                              @endforeach
                            @endforeach
                            @foreach ($CashBankIns as $CashBankIn)
                              @foreach ($CashBankInDetails as $CashBankInDetail)
                                @if ($CashBankIn->customers_id == $DataCustomer->id)
                                  @if ($CashBankInDetail->cash_bank_ins_id == $CashBankIn->id)
                                    @php
                                      $sum_tot_piutang_Debet_sum4 += ($CashBankInDetail->debet);
                                      $sum_tot_piutang_Kredit_sum4 += ($CashBankInDetail->kredit);
                                    @endphp
                                  @endif
                                @endif
                              @endforeach
                            @endforeach
                          @endforeach

                          Rp {{number_format(($sum_tot_piutang_Debet_sum1 + $sum_tot_piutang_Debet_sum2 + $sum_tot_piutang_Debet_sum3 + $sum_tot_piutang_Debet_sum4) - ($sum_tot_piutang_Kredit_sum1 + $sum_tot_piutang_Kredit_sum2 + $sum_tot_piutang_Kredit_sum3 + $sum_tot_piutang_Kredit_sum4), 0, " ", ".")}}
                      </td>
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
  @include('reports.piutang_pelanggan.show')
  @include('reports.piutang_pelanggan.pdf')

@endsection
