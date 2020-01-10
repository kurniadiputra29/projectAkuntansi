@extends('layouts.app')

@section('title', 'Laporan Hutang Supplier')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-trending-up bg-blue"></i>
              <div class="d-inline">
                <h5>Hutang Supplier</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Hutang Supplier</li>
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
                <h3>Hutang Supplier</h3>
                <span>use class <code>table-hover</code> inside table element</span>
              </div>
              <div class="right-container">
                <a type="button" class="btn btn-success mr-5" href="/hutang"><i class="ik ik-arrow-left"></i>Back</a>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pdfModal"><i class="ik ik-printer"></i>Print</button>
              </div>
            </div>
            <div class="card-body">
              <div class="dt-responsive">
                @foreach ($DataSuppliers as $DataSupplier)
                  <table class="table table-bordered nowrap">
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
                        <tr>
                          @if ($SaldoHutang->suppliers_id == $DataSupplier->id)
                            <td class="text-center">{{date('d F Y', strtotime($DataSupplier->created_at ))}}</td>
                            <td class="text-center"><span class="badge badge-pill badge-primary mb-1">Saldo Awal</span></td>
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
                                <td class="text-center"><span class="badge badge-pill badge-warning mb-1">Cash & Bank</span></td>
                                <td class="text-right">Rp {{ number_format($CashBankOutDetail->debet, 0, " ", ".")}}</td>
                                <td class="text-right">Rp {{ number_format($CashBankOutDetail->kredit, 0, " ", ".")}}</td>
                              @endif
                            @endif
                          </tr>
                        @endforeach
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr class="bg-success font-weight-bold">

                          <td class="text-light text-center" colspan="2">Total</td>
                          <td class="text-light text-right">
                            Rp {{number_format($distinct_laporan->where('suppliers_id', $DataSupplier->id)->sum('debet'), 0, " ", ".")}}
                          </td>
                          <td class="text-light text-right">
                            Rp {{number_format($distinct_laporan->where('suppliers_id', $DataSupplier->id)->sum('kredit'), 0, " ", ".")}}
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
                      <td class="text-center">Suppliers Name</td>
                      <td class="text-center">Balance</td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($distinct_pc as $rekap)
                      <tr>
                        <td>{{$rekap->kode}}</td>
                        <td>{{$rekap->nama}}</td>
                        <td class="text-right">
                          Rp {{number_format($distinct_laporan->where('suppliers_id', $rekap->id)->sum('kredit') - $distinct_laporan->where('suppliers_id', $rekap->id)->sum('debet'), 0, " ", ".")}}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-center" colspan="2">Total</td>
                      <td class="text-light text-right">
                        Rp {{number_format($distinct_laporan->sum('kredit') - $distinct_laporan->sum('debet'), 0, " ", ".")}}
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
  @include('reports.hutang_supplier.show')
  {{-- @include('reports.hutang_supplier.pdf') --}}

@endsection
