@extends('layouts.app')

@section('title', 'Laporan Alur Kas')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-trending-up bg-blue"></i>
              <div class="d-inline">
                <h5>Laporan Alur Kas</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Laporan Alur Kas</li>
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
                <h3>Laporan Alur Kas</h3>
                <span>use class <code>table-hover</code> inside table element</span>
              </div>
              <div class="right-container">
                <a type="button" class="btn btn-success mr-5" href="/laporan"><i class="ik ik-arrow-left"></i>Back</a>
                {{-- <button type="button" class="btn btn-info mr-5" data-toggle="modal" data-target="#createModal"><i class="ik ik-filter"></i>Filter</button> --}}
                <a type="button" class="btn btn-primary mr-5" href="{{route('neraca.print')}}"><i class="ik ik-printer"></i>Print</a>
                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pdfModal"><i class="ik ik-printer"></i>Print</button> --}}
              </div>
            </div>
            <div class="card-body">
              <div class="dt-responsive">
                <table class="table table-bordered nowrap">
                  <thead>
                    <tr class="bg-secondary font-weight-bold">
                      <td class="text-light text-center" colspan="2">Arus kas dari Aktivitas Operasional</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th class="text-left" colspan="2">Cash In</th>
                    </tr>
                    <tr>
                      <td class="text-left">Penerimaan dari pelanggan</td>
                      @php
                        $sum_tot_cashin = 0;
                        $sum_tot_return_pembelian = 0;
                      @endphp
                      @foreach ($cashs as $cash)
                        @foreach ($CashBankIns as $CashBankIn)
                          @if ( $CashBankIn->diterima_dari == null)
                            @php
                              $sum_tot_cashin += ($CashBankInDetails->where('nomor_akun', $cash->nomor)->where('cash_bank_ins_id', $CashBankIn->id)->sum('debet')) - ($CashBankInDetails->where('nomor_akun', $cash->nomor)->where('cash_bank_ins_id', $CashBankIn->id)->sum('kredit'));
                            @endphp
                          @endif
                        @endforeach
                        @foreach ($ReturPembelians as $ReturPembelian)
                          @if ( $ReturPembelian->purchasejournal_id == null)
                            @php
                              $sum_tot_return_pembelian += ($ReturPembelianDetails->where('nomor_akun', $cash->nomor)->where('retur_pembelian_id', $ReturPembelian->id)->sum('debet')) - ($ReturPembelianDetails->where('nomor_akun', $cash->nomor)->where('retur_pembelian_id', $ReturPembelian->id)->sum('kredit'));
                            @endphp
                          @endif
                        @endforeach
                      @endforeach

                      @php
                        $sum_tot_crjdetails_Kredit = 0;
                      @endphp
                      @foreach ($cashs as $cash)
                        @php
                          $sum_tot_crjdetails_Kredit += ($crjdetails->where('nomor_akun', $cash->nomor)->sum('debet')) - ($crjdetails->where('nomor_akun', $cash->nomor)->sum('kredit'));
                        @endphp
                      @endforeach
                      <td class="text-right">
                        Rp {{number_format($sum_tot_crjdetails_Kredit + $sum_tot_cashin + $sum_tot_return_pembelian, 0, " ", ".")}}
                      </td>
                    </tr>
                    <tr class="bg-light font-weight-bold">
                      <td class="text-center" >Total Cash In</td>
                      <td class="text-right">
                        Rp {{number_format($sum_tot_crjdetails_Kredit + $sum_tot_cashin + $sum_tot_return_pembelian, 0, " ", ".")}}
                      </td>
                    </tr>
                    <tr>
                      <th class="text-left" colspan="2">Cash Out</th>
                    </tr>
                    <tr>
                      <td class="text-left">Pembayaran ke pemasok / Suppliers</td>
                      @php
                        $sum_tot_cashout = 0;
                        $sum_tot_return_penjualan = 0;
                      @endphp
                      @foreach ($cashs as $cash)
                        @foreach ($CashBankOuts as $CashBankOut)
                          @if ( $CashBankOut->dibayar_ke == null)
                            @php
                              $sum_tot_cashout += ($CashBankOutDetails->where('nomor_akun', $cash->nomor)->where('cash_bank_outs_id', $CashBankOut->id)->sum('kredit')) - ($CashBankOutDetails->where('nomor_akun', $cash->nomor)->where('cash_bank_outs_id', $CashBankOut->id)->sum('debet'));
                            @endphp
                          @endif
                        @endforeach
                        @foreach ($ReturPenjualans as $ReturPenjualan)
                          @if ( $ReturPenjualan->salesjournal_id == null)
                            @php
                              $sum_tot_return_penjualan += ($ReturPenjualanDetails->where('nomor_akun', $cash->nomor)->where('retur_penjualan_id', $ReturPenjualan->id)->sum('kredit')) - ($ReturPenjualanDetails->where('nomor_akun', $cash->nomor)->where('retur_penjualan_id', $ReturPenjualan->id)->sum('debet'));
                            @endphp
                          @endif
                        @endforeach
                      @endforeach

                      @php
                        $sum_tot_cpj_Kredit = 0;
                      @endphp
                      @foreach ($cashs as $cash)
                        @php
                          $sum_tot_cpj_Kredit += ($cpjdetails->where('nomor_akun', $cash->nomor)->sum('kredit')) - ($cpjdetails->where('nomor_akun', $cash->nomor)->sum('debet'));
                        @endphp
                      @endforeach
                      <td class="text-right">
                        Rp {{number_format($sum_tot_cashout + $sum_tot_cpj_Kredit + $sum_tot_return_penjualan, 0, " ", ".")}}
                      </td>
                    </tr>
                    <tr>
                      <td class="text-left">Pengeluaran operasional</td>
                      <td class="text-right">
                        Rp 0
                      </td>
                    </tr>
                    <tr class="bg-light font-weight-bold">
                      <td class="text-center" >Total Cash Out</td>
                      <td class="text-right">
                        Rp {{number_format($sum_tot_cashout + $sum_tot_cpj_Kredit + $sum_tot_return_penjualan, 0, " ", ".")}}
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-center">Total Arus kas dari Aktivitas Operasional</td>
                      <td class="text-light text-right">
                        Rp {{number_format(($sum_tot_crjdetails_Kredit + $sum_tot_cashin + $sum_tot_return_pembelian) - (($sum_tot_cashout + $sum_tot_cpj_Kredit + $sum_tot_return_penjualan)), 0, " ", ".")}}
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div style="margin-bottom: 40px;"></div>
              <div class="dt-responsive">
                <table class="table table-bordered nowrap">
                  <thead>
                    <tr class="bg-secondary font-weight-bold">
                      <td class="text-light text-center" colspan="2">Arus kas dari Aktivitas Investasi</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th class="text-left" colspan="2">Cash In</th>
                    </tr>
                    <tr>
                      <td class="text-left">Perolehan/Penjualan aset</td>
                      <td class="text-right">
                        @php
                          $sum_tot_cashin_2 = 0;
                        @endphp
                        @foreach ($cashs as $cash)
                          @foreach ($CashBankIns as $CashBankIn)
                            @if ( $CashBankIn->diterima_dari !== null)
                              @php
                                $sum_tot_cashin_2 += ($CashBankInDetails->where('nomor_akun', $cash->nomor)->where('cash_bank_ins_id', $CashBankIn->id)->sum('debet')) - ($CashBankInDetails->where('nomor_akun', $cash->nomor)->where('cash_bank_ins_id', $CashBankIn->id)->sum('kredit'));
                              @endphp
                            @endif
                          @endforeach
                        @endforeach

                        Rp {{number_format($sum_tot_cashin_2, 0, " ", ".")}}
                      </td>
                    </tr>
                    <tr class="bg-light font-weight-bold">
                      <td class="text-center" >Total Cash In</td>
                      <td class="text-right">
                        Rp {{number_format($sum_tot_cashin_2, 0, " ", ".")}}
                      </td>
                    </tr>
                    <tr>
                      <th class="text-left" colspan="2">Cash Out</th>
                    </tr>
                    <tr class="bg-light font-weight-bold">
                      <td class="text-center" >Total Cash Out</td>
                      <td class="text-right">
                        Rp 0
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-center">Total Arus kas dari Aktivitas Investasi</td>
                      <td class="text-light text-right">
                        Rp {{number_format($sum_tot_cashin_2, 0, " ", ".")}}
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div style="margin-bottom: 40px;"></div>
              <div class="dt-responsive">
                <table class="table table-bordered nowrap">
                  <thead>
                    <tr class="bg-secondary font-weight-bold">
                      <td class="text-light text-center" colspan="2">Arus kas dari Aktivitas Pendanaan</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th class="text-left" colspan="2">Cash In</th>
                    </tr>
                    <tr>
                      <td class="text-left">Penerimaan Pinjaman</td>
                      <td class="text-right">Rp 0</td>
                    </tr>
                    <tr class="bg-light font-weight-bold">
                      <td class="text-center" >Total Cash In</td>
                      <td class="text-right">
                        Rp 0
                      </td>
                    </tr>
                    <tr>
                      <th class="text-left" colspan="2">Cash Out</th>
                    </tr>
                    <tr>
                      <td class="text-left">Pembayaran Pinjaman</td>
                      <td class="text-right">
                        @php
                          $sum_tot_cashout_2 = 0;
                        @endphp
                        @foreach ($cashs as $cash)
                          @foreach ($CashBankOuts as $CashBankOut)
                            @if ( $CashBankOut->dibayar_ke !== null)
                              @php
                                $sum_tot_cashout_2 += ($CashBankOutDetails->where('nomor_akun', $cash->nomor)->where('cash_bank_outs_id', $CashBankOut->id)->sum('kredit')) - ($CashBankOutDetails->where('nomor_akun', $cash->nomor)->where('cash_bank_outs_id', $CashBankOut->id)->sum('debet'));
                              @endphp
                            @endif
                          @endforeach
                        @endforeach

                        Rp {{number_format($sum_tot_cashout_2, 0, " ", ".")}}
                      </td>
                    </tr>
                    <tr class="bg-light font-weight-bold">
                      <td class="text-center" >Total Cash Out</td>
                      <td class="text-right">
                        Rp {{number_format($sum_tot_cashout_2, 0, " ", ".")}}
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light text-center">Total Arus kas dari Aktivitas Pendanaan</td>
                      <td class="text-light text-right">
                        Rp {{number_format(0 - $sum_tot_cashout_2, 0, " ", ".")}}
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div style="margin-bottom: 40px;"></div>
              <div class="dt-responsive">
                <table class="table table-bordered nowrap">
                  <thead>
                    <tr class="bg-secondary font-weight-bold">
                      <td class="text-light text-center" colspan="2">Arus Kas</td>
                    </tr>
                    <tr>
                      <th class="text-center">Kategori</th>
                      <th class="text-center">Balance</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Kenaikan (penurunan) kas</td>
                      <td class="text-right">
                        Rp {{number_format(($sum_tot_crjdetails_Kredit + $sum_tot_cashin + $sum_tot_return_pembelian) - (($sum_tot_cashout + $sum_tot_cpj_Kredit + $sum_tot_return_penjualan)) + ($sum_tot_cashin_2) + (0 - $sum_tot_cashout_2), 0, " ", ".")}}
                      </td>
                    </tr>
                    <tr>
                      <td>Saldo kas awal</td>
                      @foreach ($cashs as $cash)
                        <td class="text-right">
                          Rp {{number_format(($saldo_awals->where('account_id', $cash->id)->sum('debet')) - ($saldo_awals->where('account_id', $cash->id)->sum('kredit')) , 0, " ", ".")}}
                        </td>
                      @endforeach
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr class="bg-success font-weight-bold">
                      <td class="text-light">Saldo kas akhir</td>
                      @foreach ($cashs as $cash)
                        <td class="text-right text-light">
                          Rp {{number_format(($saldo_awals->where('account_id', $cash->id)->sum('debet')) - ($saldo_awals->where('account_id', $cash->id)->sum('kredit')) + (($sum_tot_crjdetails_Kredit + $sum_tot_cashin + $sum_tot_return_pembelian) - (($sum_tot_cashout + $sum_tot_cpj_Kredit + $sum_tot_return_penjualan)) + ($sum_tot_cashin_2) + (0 - $sum_tot_cashout_2)), 0, " ", ".")}}
                        </td>
                      @endforeach
                    </tr>
                    <tr class="bg-danger font-weight-bold">
                      <td class="text-light">Balance</td>
                      @foreach ($cashs as $cash)
                        <td class="text-right text-light">
                          Rp {{number_format(($distinct_laporan_penyesuaian->where('nomor_akun', $cash->nomor)->sum('debet') + $distinct_laporan_penyesuaian->where('account_id', $cash->id)->sum('debet')) - ($distinct_laporan_penyesuaian->where('account_id', $cash->id)->sum('kredit')  + $distinct_laporan_penyesuaian->where('nomor_akun', $cash->nomor)->sum('kredit')), 0, " ", ".")}}
                        </td>
                      @endforeach
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
