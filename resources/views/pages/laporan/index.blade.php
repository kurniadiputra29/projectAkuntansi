@extends('layouts.app')

@section('title', 'AccountMin - Laporan')

@section('content')

  <div class="main-content">
      <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-trending-up bg-blue"></i>
                        <div class="d-inline">
                            <h5>Laporan</h5>
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
                            <li class="breadcrumb-item active" aria-current="page">Laporan</li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="umum-tab" data-toggle="tab" href="#umum" role="tab" aria-controls="umum" aria-selected="true">Umum</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="penjualan-tab" data-toggle="tab" href="#penjualan" role="tab" aria-controls="penjualan" aria-selected="false">Penjualan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pembelian-tab" data-toggle="tab" href="#pembelian" role="tab" aria-controls="pembelian" aria-selected="false">Pembelian</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="produk-tab" data-toggle="tab" href="#produk" role="tab" aria-controls="produk" aria-selected="false">Produk</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="umum" role="tabpanel" aria-labelledby="umum-tab">
                    <div class="d-flex flex-wrap">
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('laporan.neraca')}}">
                              <i class="ik ik-check"></i>
                              Balance Sheet / Neraca
                            </a>
                          </h3>
                          <p>
                            Menampilan apa yang anda miliki (aset), apa yang anda hutang (liabilitas), dan apa yang anda sudah investasikan pada perusahaan anda (ekuitas).
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('laporan.neraca')}}">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('laporan.neraca_saldo')}}">
                              <i class="ik ik-check"></i>
                              Trial Balance / Neraca Saldo
                            </a>
                          </h3>
                          <p>
                            Menampilan apa yang anda miliki (aset), apa yang anda hutang (liabilitas), dan apa yang anda sudah investasikan pada perusahaan anda (ekuitas).
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('laporan.neraca_saldo')}}">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="/reports/balance_sheet">
                              Adjusted Trial Balance / Neraca Saldo Penyesuaian
                            </a>
                          </h3>
                          <p>
                            Menampilan apa yang anda miliki (aset), apa yang anda hutang (liabilitas), dan apa yang anda sudah investasikan pada perusahaan anda (ekuitas).
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="/reports/balance_sheet">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="/reports/balance_sheet">
                              Work Sheet / Neraca Lajur
                            </a>
                          </h3>
                          <p>
                            Menampilan apa yang anda miliki (aset), apa yang anda hutang (liabilitas), dan apa yang anda sudah investasikan pada perusahaan anda (ekuitas).
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="/reports/balance_sheet">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('buku_besar.index')}}">
                              <i class="ik ik-check"></i>
                              Ledger / Buku Besar
                            </a>
                          </h3>
                          <p>
                            Laporan ini menampilkan semua transaksi yang telah dilakukan untuk suatu periode. Laporan ini bermanfaat jika Anda memerlukan daftar kronologis untuk semua transaksi yang telah dilakukan oleh perusahaan Anda.
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('buku_besar.index')}}">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('laporan.alur_kas')}}">
                              <i class="ik ik-check"></i>
                              Cash Flow / Alur Kas
                            </a>
                          </h3>
                          <p>
                            Laporan ini menampilkan semua transaksi yang telah dilakukan untuk suatu periode. Laporan ini bermanfaat jika Anda memerlukan daftar kronologis untuk semua transaksi yang telah dilakukan oleh perusahaan Anda.
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('laporan.alur_kas')}}">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('laporan.laba_rugi')}}">
                              <i class="ik ik-check"></i>
                              Income Statement / Laporan Laba-Rugi
                            </a>
                          </h3>
                          <p>
                            Menampilkan setiap tipe transaksi dan jumlah total untuk pendapatan dan pengeluaran anda.
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('laporan.laba_rugi')}}">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="/reports/balance_sheet">
                              Retained Earning / Laba yang Ditahan
                            </a>
                          </h3>
                          <p>
                            Daftar semua jurnal per transaksi yang terjadi dalam periode waktu. Hal ini berguna untuk melacak di mana transaksi Anda masuk ke masing-masing rekening
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="/reports/balance_sheet">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="penjualan" role="tabpanel" aria-labelledby="penjualan-tab">
                    <div class="d-flex flex-wrap">
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('laporan.daftar_penjualan')}}">
                              Daftar Penjualan
                            </a>
                          </h3>
                          <p>
                            Menunjukkan daftar kronologis dari semua faktur, pemesanan, penawaran, dan pembayaran Anda untuk rentang tanggal yang dipilih.
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('laporan.daftar_penjualan')}}">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('laporan.piutang_pelanggan')}}">
                              Laporan Piutang Pelanggan
                            </a>
                          </h3>
                          <p>
                            Menampilkan tagihan yang belum dibayar untuk setiap pelanggan, termasuk nomor & tanggal faktur, tanggal jatuh tempo, jumlah nilai, dan sisa tagihan yang terhutang pada Anda.
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('laporan.piutang_pelanggan')}}">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('laporan.penjualan_per_produk')}}">
                              Penjualan per Produk
                            </a>
                          </h3>
                          <p>
                            Menampilkan daftar kuantitas penjualan per produk, termasuk jumlah retur, net penjualan, dan harga penjualan rata-rata.
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('laporan.penjualan_per_produk')}}">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="pembelian" role="tabpanel" aria-labelledby="pembelian-tab">
                    <div class="d-flex flex-wrap">
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('laporan.daftar_pembelian')}}">
                              Daftar Pembelian
                            </a>
                          </h3>
                          <p>
                            Menunjukkan daftar kronologis dari semua pembelian, pemesanan, penawaran, dan pembayaran Anda untuk rentang tanggal yang dipilih.
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('laporan.daftar_pembelian')}}">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('laporan.hutang_supplier')}}">
                              Laporan Hutang Supplier
                            </a>
                          </h3>
                          <p>
                            Menampilkan jumlah nilai yang Anda hutang pada setiap Supplier.
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('laporan.hutang_supplier')}}">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('laporan.pembelian_per_produk')}}">
                              Pembelian per Produk
                            </a>
                          </h3>
                          <p>
                            Menampilkan daftar kuantitas pembelian per produk, termasuk jumlah retur, net pembelian, dan harga pembelian rata-rata.
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('laporan.pembelian_per_produk')}}">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="produk" role="tabpanel" aria-labelledby="produk-tab">
                    <div class="d-flex flex-wrap">
                      <div class="col-sm-12 col-md-12">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('inventory.index')}}">
                              Laporan Inventory Card
                            </a>
                          </h3>
                          <p>
                            Menampilkan daftar kuantitas inventory per produk/item, termasuk jumlah retur, net pembelian, net penjualan, dan harga pokok penjualan (Mothod: rata-rata).
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('inventory.index')}}">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>

@endsection
