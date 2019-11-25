@extends('layouts.app')

@section('title', 'Laporan Neraca Saldo')

@section('content')

  <div class="main-content">
    <div class="container-fluid">
      <div class="page-header">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title">
              <i class="ik ik-trending-up bg-blue"></i>
              <div class="d-inline">
                <h5>Neraca Saldo</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Neraca Saldo</li>
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
                <label for="filter">Per Tanggal</label>
                <input type="date" name="tanggal" id="filter">
                <button class="btn btn-primary" type="submit" name="button">Filter</button>
              </form>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
              <a type="button" class="btn btn-success mr-5" href="/laporan"><i class="ik ik-arrow-left"></i>Back</a>
              <a type="button" class="btn btn-primary" href="{{route('print.neraca_saldo')}}"><i class="ik ik-printer"></i>Print</a>
            </div>
          </div>
          <div class="table-container list-table">
            <div class="report-title">
              <div class="table-responsive">
                <table class="table ctb-worksheet trial-balance-table report-table">
                  <thead class="bg-light">
                    <tr>
                      <th class="bg-secondary text-light border-bottom border-sides in-the-middle" colspan="2" rowspan="2">
                        Daftar Akun
                      </th>
                      <th class="bg-secondary text-light text-center border-bottom border-sides" colspan="2">
                        Saldo Awal
                      </th>
                      <th class="bg-secondary text-light text-center border-bottom border-sides" colspan="2">
                        Pergerakan
                      </th>
                      <th class="bg-secondary text-light text-center border-bottom border-sides" colspan="2">
                        Saldo Akhir
                      </th>
                    </tr>
                    <tr>
                      <th class="bg-secondary text-light text-center border-bottom border-sides">
                        Debit
                      </th>
                      <th class="bg-secondary text-light text-center border-bottom border-sides">
                        Credit
                      </th>
                      <th class="bg-secondary text-light text-center border-bottom border-sides">
                        Debit
                      </th>
                      <th class="bg-secondary text-light text-center border-bottom border-sides">
                        Credit
                      </th>
                      <th class="bg-secondary text-light text-center border-bottom border-sides">
                        Debit
                      </th>
                      <th class="bg-secondary text-light text-center border-bottom border-sides">
                        Credit
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- ASSET ACCOUNT -->
                    <tr class="account-type-label">
                      <td class="border-sides report-subheader-noindent" colspan="2">
                        Aset
                      </td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                    </tr>
                    <tr account_id="18884986">
                      <td class="border-left text-right">
                        <a class="text-primary" href="#">(1-10001)</a>
                      </td>
                      <td class="text-left lines-on-top">
                        <a class="text-primary" href="#">Cash</a>
                      </td>
                      <td class="opening-balance debit text-right border-sides" data-value="10500000.0">
                        10.500.000,00
                      </td>
                      <td class="opening-balance credit text-right border-sides" data-value="0.0">
                        0,00
                      </td>
                      <td class="balance-movement debit text-right border-sides" data-value="0.0">
                        0,00
                      </td>
                      <td class="balance-movement credit text-right border-sides" data-value="0.0">
                        0,00
                      </td>
                      <td class="ending-balance debit text-right border-sides" data-value="10500000.0">
                        10.500.000,00
                      </td>
                      <td class="ending-balance credit text-right border-sides" data-value="0.0">
                        0,00
                      </td>
                    </tr>
                    <!-- LIABILITY ACCOUNT -->
                    <tr class="account-type-label">
                      <td class="border-sides report-subheader-noindent" colspan="2">
                        Kewajiban
                      </td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                    </tr>
                    <tr account_id="18885043">
                      <td class="border-left text-right">
                        <a class="text-primary" href="#">(2-20100)</a>
                      </td>
                      <td class="text-left lines-on-top">
                        <a class="text-primary" href="#">Trade Payable</a>
                      </td>
                      <td class="opening-balance debit text-right border-sides" data-value="500000.0">
                        500.000,00
                      </td>
                      <td class="opening-balance credit text-right border-sides" data-value="0.0">
                        0,00
                      </td>
                      <td class="balance-movement debit text-right border-sides" data-value="0.0">
                        0,00
                      </td>
                      <td class="balance-movement credit text-right border-sides" data-value="0.0">
                        0,00
                      </td>
                      <td class="ending-balance debit text-right border-sides" data-value="500000.0">
                        500.000,00
                      </td>
                      <td class="ending-balance credit text-right border-sides" data-value="0.0">
                        0,00
                      </td>
                    </tr>
                    <tr account_id="18885045">
                      <td class="border-left text-right">
                        <a class="text-primary" href="#">(2-20500)</a>
                      </td>
                      <td class="text-left lines-on-top">
                        <a class="text-primary" href="#">VAT Out</a>
                      </td>
                      <td class="opening-balance debit text-right border-sides" data-value="0.0">
                        0,00
                      </td>
                      <td class="opening-balance credit text-right border-sides" data-value="1000000.0">
                        1.000.000,00
                      </td>
                      <td class="balance-movement debit text-right border-sides" data-value="0.0">
                        0,00
                      </td>
                      <td class="balance-movement credit text-right border-sides" data-value="0.0">
                        0,00
                      </td>
                      <td class="ending-balance debit text-right border-sides" data-value="0.0">
                        0,00
                      </td>
                      <td class="ending-balance credit text-right border-sides" data-value="1000000.0">
                        1.000.000,00
                      </td>
                    </tr>
                    <!-- EQUITY ACCOUNT -->
                    <tr class="account-type-label">
                      <td class="border-sides report-subheader-noindent" colspan="2">
                        Ekuitas
                      </td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                    </tr>
                    <tr class="account-type-label">
                      <td class="border-sides report-subheader-noindent" colspan="2">
                        Pendapatan
                      </td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                    </tr>
                    <!-- EXPENSE ACCOUNT -->
                    <tr class="account-type-label">
                      <td class="border-sides report-subheader-noindent" colspan="2">
                        Beban
                      </td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                      <td class="border-sides report-subheader-noindent"></td>
                    </tr>
                    <tr account_id="18885109">
                      <td class="border-left text-right">
                        <a class="text-primary" href="#">(5-50000)</a>
                      </td>
                      <td class="text-left lines-on-top">
                        <a class="text-primary" href="#">Cost of Sales</a>
                      </td>
                      <td class="opening-balance debit text-right border-sides" data-value="0.0">
                        0,00
                      </td>
                      <td class="opening-balance credit text-right border-sides" data-value="10000000.0">
                        10.000.000,00
                      </td>
                      <td class="balance-movement debit text-right border-sides" data-value="0.0">
                        0,00
                      </td>
                      <td class="balance-movement credit text-right border-sides" data-value="0.0">
                        0,00
                      </td>
                      <td class="ending-balance debit text-right border-sides" data-value="0.0">
                        0,00
                      </td>
                      <td class="ending-balance credit text-right border-sides" data-value="10000000.0">
                        10.000.000,00
                      </td>
                    </tr>
                    <!-- GRAND TOTAL -->
                    <tr class="bg-success text-light font-weight-bold">
                      <td class="border-sides border-bottom bold lines-on-top text-left" colspan="2">
                        Total
                      </td>
                      <td class="text-right border-sides lines-on-top border-bottom tl-total-debit bold" data-value="0.0">
                        11.000.000,00
                      </td>
                      <td class="text-right border-sides lines-on-top border-bottom tl-total-credit bold" data-value="0.0">
                        11.000.000,00
                      </td>
                      <td class="text-right border-sides lines-on-top border-bottom tl-total-debit bold" data-value="0.0">
                        0,00
                      </td>
                      <td class="text-right border-sides lines-on-top border-bottom tl-total-credit bold" data-value="0.0">
                        0,00
                      </td>
                      <td class="text-right border-sides lines-on-top border-bottom tl-total-debit bold" data-value="0.0">
                        11.000.000,00
                      </td>
                      <td class="text-right border-sides lines-on-top border-bottom tl-total-credit bold" data-value="0.0">
                        11.000.000,00
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
