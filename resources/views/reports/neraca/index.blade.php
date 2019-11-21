@extends('layouts.app')

@section('title', 'Laporan Neraca')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-trending-up bg-blue"></i>
              <div class="d-inline">
                <h5>Neraca</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Neraca</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="d-flex justify-content-end py-3">
            <a type="button" class="btn btn-primary" href="{{route('print.neraca')}}"><i class="ik ik-printer"></i>Print</a>
          </div>
          <div class="table-container list-table">
            <div class="table-responsive">
              <table class="report-table table">
                <thead class="bg-light">
                  <tr>
                    <th colspan="2">
                      Oemar TECH - Neraca
                    </th>
                    <th class="text-right">
                      14/10/2019
                    </th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="report-header bg-secondary text-light font-weight-bold" colspan="4">
                      Aset
                    </td>
                  </tr>
                  <tr>
                    <td class="report-subheader white-bg" colspan="4">
                      Aset Lancar
                    </td>
                  </tr>
                  <tr>
                    <td class="report-data data-col-1">
                      <div class="header-price-label">
                        <a class="text-primary" href="/accounts/17896740?q%5Btransaction_date_gteq%5D=&amp;q%5Btransaction_date_lteq%5D=14%2F10%2F2019&amp;tag_ids=&amp;tag_logic=">1-10001</a>
                      </div>
                    </td>
                    <td class="report-data width-100">
                      <div class="header-price-label">
                        <a class="text-primary" href="/accounts/17896740?q%5Btransaction_date_gteq%5D=&amp;q%5Btransaction_date_lteq%5D=14%2F10%2F2019&amp;tag_ids=&amp;tag_logic=">Kas</a>
                      </div>
                    </td>
                    <td class="header-price-label report-data text-right">
                      <div class="header-price-label">
                        100.000.000,00
                      </div>
                    </td>
                    <td class="">
                    </td>
                  </tr>
                  <tr>
                    <td class="report-subtotal" colspan="2">
                      Total Aset Lancar
                    </td>
                    <td class="report-subtotal text-right" id="assets-type-1-total-data">
                      100.000.000,00
                    </td>
                    <td class="border-top-thin">
                    </td>
                  </tr>
                  <tr class="bg-success text-light font-weight-bold">
                    <td class="grand-total no-indent" colspan="2">
                      Total Aset
                    </td>
                    <td class="grand-total text-right no-indent" id="assets-type-1-total-data">
                      100.000.000,00
                    </td>
                    <td class="no-indent grand-total">
                    </td>
                  </tr>
                  <tr>
                    <td class="report-header bg-secondary text-light font-weight-bold" colspan="4">
                      Liabilitas dan Modal
                    </td>
                  </tr>
                  <tr>
                    <td class="report-subtotal" colspan="2">
                      Total Liabilitas
                    </td>
                    <!-- / total_liabilities = (@balance_sheet_accounts.current_liability_balance_arr[i] + @balance_sheet_accounts.long_liability_balance_arr[i]) -->
                    <td class="report-subtotal text-right" id="assets-type-1-total-data">
                      0,00
                    </td>
                    <td class="border-top-thin">
                    </td>
                  </tr>
                  <tr>
                    <td class="w-border-bottom" colspan="4" height="28px"></td>
                  </tr>
                  <tr>
                    <td class="report-subheader white-bg" colspan="4">
                      Modal Pemilik
                    </td>
                  </tr>
                  <tr>
                    <td class="report-data data-col-1">
                      <div class="header-price-label">
                        <a class="text-primary" href="/accounts/17896778?q%5Btransaction_date_gteq%5D=&amp;q%5Btransaction_date_lteq%5D=14%2F10%2F2019&amp;tag_ids=&amp;tag_logic=">3-30000</a>
                      </div>
                    </td>
                    <td class="report-data width-100">
                      <div class="header-price-label">
                        <a class="text-primary" href="/accounts/17896778?q%5Btransaction_date_gteq%5D=&amp;q%5Btransaction_date_lteq%5D=14%2F10%2F2019&amp;tag_ids=&amp;tag_logic=">Modal Saham</a>
                      </div>
                    </td>
                    <td class="header-price-label report-data text-right">
                      <div class="header-price-label">
                        100.000.000,00
                      </div>
                    </td>
                    <td class="">
                    </td>
                  </tr>
                  <tr>
                    <td class="report-data data-col-1"></td>
                    <td class="report-data">
                      <div class="header-price-label">
                        Akumulasi pendapatan komprehensif lain
                      </div>
                    </td>
                    <td class="report-data text-right">
                      <div class="header-price-label">
                        0,00
                      </div>
                    </td>
                    <td class="">
                    </td>
                  </tr>
                  <tr>
                    <td class="report-data data-col-1"></td>
                    <td class="report-data">
                      <div class="header-price-label">
                        Pendapatan sampai Tahun lalu
                      </div>
                    </td>
                    <td class="report-data text-right">
                      <div class="header-price-label">
                        0,00
                      </div>
                    </td>
                    <td class="">
                    </td>
                  </tr>
                  <tr>
                    <td class="report-data data-col-1"></td>
                    <td class="report-data">
                      <div class="header-price-label">
                        Pendapatan Periode ini
                      </div>
                    </td>
                    <td class="report-data text-right">
                      <div class="header-price-label">
                        0,00
                      </div>
                    </td>
                    <td class="">
                    </td>
                  </tr>
                  <tr>
                    <td class="report-subtotal" colspan="2">
                      Total Modal Pemilik
                    </td>
                    <!-- / total_equity = (@balance_sheet_accounts.equity_balance_arr[i] + @balance_sheet_accounts.earning_up_to_last_period_balance_arr[i] + @balance_sheet_accounts.current_period_earnings_balance_arr[i] + @balance_sheet_accounts.accumulated_other_comprehensive_income_balance_arr[i]) -->
                    <td class="report-subtotal text-right" id="assets-type-1-total-data">
                      100.000.000,00
                    </td>
                    <td class="report-subtotal">
                    </td>
                  </tr>
                  <tr class="bg-success text-light font-weight-bold">
                    <td class="grand-total no-indent" colspan="2">
                      Total Liabilitas dan Modal
                    </td>
                    <td class="no-indent grand-total text-right">
                      100.000.000,00
                    </td>
                    <td class="no-indent grand-total">
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="report-notes bg-dark text-light p-2">
                Catatan: Akun persediaan barang dihitung berdasarkan metode Average
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
