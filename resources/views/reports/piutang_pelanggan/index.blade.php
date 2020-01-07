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
                <a type="button" class="btn btn-primary mr-5" href="{{route('hutang.print')}}"><i class="ik ik-printer"></i>Print</a>
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
