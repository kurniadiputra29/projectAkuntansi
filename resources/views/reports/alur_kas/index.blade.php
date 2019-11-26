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
                <h5>Alur Kas</h5>
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
                <li class="breadcrumb-item active" aria-current="page">Alur Kas</li>
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
          <div class="table-container list-table bg-white">
            <div class="report-title">
              <div class="table-responsive dragscroll">
                <table class="report-table table">
                  <thead class="report-header new-report">
                    <tr class="bg-light">
                      <th class="fit-content">Akun &amp; Kategori
                        <div class="pull-right inliner icon-period-order tooltip_new descending hidden" title_name="Urutkan periode: dari Awal ke akhir atau Akhir ke awal"></div>
                      </th>
                      <th class="text-right">25/11/2019</th>
                      <th class="text-right" style="width: 40px;"></th>
                    </tr>
                  </thead>
                  <tbody class="light-roboto">
                    <tr class="activity-header">
                      <td class="text-left" colspan="100%">Arus kas dari Aktivitas Operasional</td>
                    </tr>
                    <tr class="activity-content hide_top_border">
                      <td class="text-left indent">Penerimaan dari pelanggan</td>
                      <td class="text-right"> 0,00</td>
                      <td class="text-right padding-left-0 "></td>
                    </tr>
                    <tr class="activity-content ">
                      <td class="text-left indent">Aset lancar lainnya</td>
                      <td class="text-right"> 0,00</td>
                      <td class="text-right padding-left-0 "></td></tr>
                    <tr class="activity-content ">
                      <td class="text-left indent">Pembayaran ke pemasok</td>
                      <td class="text-right"> 0,00</td>
                      <td class="text-right padding-left-0 "></td>
                    </tr>
                    <tr class="activity-content ">
                      <td class="text-left indent">Kartu kredit dan liabilitas jangka pendek lainnya</td>
                      <td class="text-right"> 0,00</td>
                      <td class="text-right padding-left-0 "></td>
                    </tr>
                    <tr class="activity-content ">
                      <td class="text-left indent">Pendapatan lainnya</td>
                      <td class="text-right"> 0,00</td>
                      <td class="text-right padding-left-0 "></td>
                    </tr>
                    <tr class="activity-content ">
                      <td class="text-left indent">Pengeluaran operasional</td>
                      <td class="text-right"> 0,00</td>
                      <td class="text-right padding-left-0 "></td>
                    </tr>
                    <tr class="activity-footer">
                      <td class="text-left">Kas bersih yang diperoleh dari Aktivitas Operasional</td>
                      <td class="text-right"> 0,00</td>
                      <td class="text-right padding-left-0 "></td>
                    </tr>
                  </tbody>
                  <tbody class="light-roboto">
                    <tr>
                      <td style="border: medium none;">&nbsp;</td>
                    </tr>
                    <tr class="activity-header">
                      <td class="text-left" colspan="100%">Arus kas dari Aktivitas Investasi</td>
                    </tr>
                    <tr class="activity-content hide_top_border">
                      <td class="text-left indent">Perolehan/Penjualan aset</td>
                      <td class="text-right"> 0,00</td>
                      <td class="text-right padding-left-0 "></td>
                    </tr>
                    <tr class="activity-content ">
                      <td class="text-left indent">Aktivitas investasi lainnya</td>
                      <td class="text-right"> 0,00</td>
                      <td class="text-right padding-left-0 "></td>
                    </tr>
                    <tr class="activity-footer">
                      <td class="text-left">Kas bersih yang diperoleh dari Aktivitas Investasi</td>
                      <td class="text-right"> 0,00</td>
                      <td class="text-right padding-left-0 "></td></tr>
                  </tbody>
                  <tbody class="light-roboto">
                    <tr>
                      <td style="border: medium none;">&nbsp;</td>
                    </tr>
                    <tr class="activity-header">
                      <td class="text-left" colspan="100%">Arus kas dari Aktivitas Pendanaan</td>
                    </tr>
                    <tr class="activity-content hide_top_border">
                      <td class="text-left indent">Pembayaran/Penerimaan pinjaman</td>
                      <td class="text-right"> 0,00</td>
                      <td class="text-right padding-left-0 "></td>
                    </tr>
                    <tr class="activity-content ">
                      <td class="text-left indent">Ekuitas/Modal</td>
                      <td class="text-right"> 0,00</td>
                      <td class="text-right padding-left-0 "></td>
                    </tr>
                    <tr class="activity-footer">
                      <td class="text-left">Kas bersih yang diperoleh dari Aktivitas Pendanaan</td>
                      <td class="text-right"> 0,00</td>
                      <td class="text-right padding-left-0 "></td>
                    </tr>
                  </tbody>
                  <tbody class="light-roboto">
                    <tr>
                      <td style="border: medium none;">&nbsp;</td>
                    </tr>
                    <tr class="activity-header">
                      <td class="text-left">Kenaikan (penurunan) kas</td>
                      <td class="text-right"> 0,00</td>
                      <td class="text-right padding-left-0 "></td>
                    </tr>
                    <tr class="activity-header">
                      <td class="text-left padding-top-grey">Total revaluasi bank</td>
                      <td class="text-right padding-top-grey"> 0,00</td>
                      <td class="text-right padding-left-0 padding-top-grey"></td>
                    </tr>
                    <tr class="activity-header">
                      <td class="text-left padding-top-grey">Saldo kas awal</td>
                      <td class="text-right padding-top-grey"> 10.500.000,00</td>
                      <td class="text-right padding-left-0 padding-top-grey"></td>
                    </tr>
                    <tr class="activity-header">
                      <td class="text-left padding-top-grey">Saldo kas akhir</td>
                      <td class="text-right padding-top-grey"> 10.500.000,00</td>
                      <td class="text-right padding-left-0 padding-top-grey"></td>
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
