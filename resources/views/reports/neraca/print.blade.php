<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Laporan Neraca</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="/ProjectAkuntan/plugins/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/ProjectAkuntan/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/ProjectAkuntan/plugins/icon-kit/dist/css/iconkit.min.css">
  <link rel="stylesheet" href="/ProjectAkuntan/plugins/ionicons/dist/css/ionicons.min.css">
  <link rel="stylesheet" href="/ProjectAkuntan/dist/css/theme.min.css">
  <link rel="stylesheet" href="/ProjectAkuntan/dist/css/custom.css">
  <style media="screen" type="text/css">
  #myTab li a {
    padding: 10px 20px;
    font-size: 14px;
  }

  .this-tab {
    display: flex;
    flex-wrap: wrap;
  }

  .report-item {
    margin-bottom: 2em;
    padding-bottom: 1em;
  }

  .nav-tabs {
    width: 100%;
  }

  .report-header, .grand-total {
    padding-left: 2em!important;
  }

  .report-subheader, .report-subtotal {
    padding-left: 4em!important;
  }

  .report-data {
    padding-left: 6em!important;
  }

  .report-notes {
    font-size: 10px;
  }
  </style>
</head>
<body>
  <div class="row">
    <div class="col-xl-12">
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
              </tr>
              <tr>
                <td class="report-subtotal" colspan="2">
                  Total Aset Lancar
                </td>
                <td class="report-subtotal text-right" id="assets-type-1-total-data">
                  100.000.000,00
                </td>
              </tr>
              <tr class="bg-success text-light font-weight-bold">
                <td class="grand-total no-indent" colspan="2">
                  Total Aset
                </td>
                <td class="grand-total text-right no-indent" id="assets-type-1-total-data">
                  100.000.000,00
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
              </tr>
              <tr>
                <td class="report-subtotal" colspan="2">
                  Total Modal Pemilik
                </td>
                <!-- / total_equity = (@balance_sheet_accounts.equity_balance_arr[i] + @balance_sheet_accounts.earning_up_to_last_period_balance_arr[i] + @balance_sheet_accounts.current_period_earnings_balance_arr[i] + @balance_sheet_accounts.accumulated_other_comprehensive_income_balance_arr[i]) -->
                <td class="report-subtotal text-right" id="assets-type-1-total-data">
                  100.000.000,00
                </td>
              </tr>
              <tr class="bg-success text-light font-weight-bold">
                <td class="grand-total no-indent" colspan="2">
                  Total Liabilitas dan Modal
                </td>
                <td class="no-indent grand-total text-right">
                  100.000.000,00
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
</body>
</html>
