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
                            <a data-placement="left" data-toggle="tooltop" href="{{route('petty_cash_book.index')}}">
                              Petty Cash Book / Rekapitulasi Kas Kecil
                            </a>
                          </h3>
                          <p>
                            Menampilkan laporan-laporan transaksi pengeluaran Petty Cash yang terjadi dalam periode waktu tertentu. Hal ini berguna untuk mengetahui pengeluaran dana Petty Cash untuk kegiatan apa saja secara rinci. 
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('petty_cash_book.index')}}">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('buku_besar.index')}}">
                              {{-- <i class="ik ik-check"></i> --}}
                              Ledger / Buku Besar
                            </a>
                          </h3>
                          <p>
                            Laporan ini menampilkan perubahan perubahan semua saldo tiap-tiap akun yang terjadi dalam periode waktu tertentu. Laporan ini bermanfaat jika Anda ingin mengetahui saldo masing-masing akun dari awal periode sampai akhir periode. Dan menampilkan kronologis perubahan saldo dikarenakan terjadinya transaksi yang telah dilakukan oleh perusahaan Anda.
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('buku_besar.index')}}">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('laporan.neraca_saldo')}}">
                              {{-- <i class="ik ik-check"></i> --}}
                              Trial Balance / Neraca Saldo
                            </a>
                          </h3>
                          <p>
                            Menampilan Saldo Akhir pada tiap tiap akun yang terjadi dalam periode waktu tertentu. Laporan ini bermanfaat jika Anda ingin mengetahui saldo masing-masing akun dari awal periode sampai akhir periode.
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
                              Work Sheet / Neraca Lajur
                            </a>
                          </h3>
                          <p>
                            Menampilan Trial Balance / Neraca Saldo, Menampilan Adjustment / Jurnal Penyesuaian, Menampilan Adjustment Trial Balance / Neraca Saldo Setelah Penyesuaian,
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="/reports/balance_sheet">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('laporan.laba_rugi')}}">
                              {{-- <i class="ik ik-check"></i> --}}
                              Income Statement / Laporan Laba-Rugi
                            </a>
                          </h3>
                          <p>
                            Menampilkan laporan transaksi pendapatan penjualan, hpp, biaya, pendapatan lain-lain dan biaya lain-lain.
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
                            Menampilkan laporan laba dari penjualan barang dagang.
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="/reports/balance_sheet">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('neraca.index')}}">
                              {{-- <i class="ik ik-check"></i> --}}
                              Financial Position Report / Neraca
                            </a>
                          </h3>
                          <p>
                            Menampilkan laporan Aktiva (Aset), laporan Hutang (Liabilitas), dan laporan Modal (Ekuitas).
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('neraca.index')}}">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('laporan.alur_kas')}}">
                              {{-- <i class="ik ik-check"></i> --}}
                              Cash Flow / Alur Kas
                            </a>
                          </h3>
                          <p>
                            Laporan ini mengukur kas yang telah dihasilkan atau digunakan oleh suatu perusahaan dan menunjukkan detail pergerakannya dalam suatu periode. 
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('laporan.alur_kas')}}">
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
                              Daftar Penjualan Cash & Kredit
                            </a>
                          </h3>
                          <p>
                            Menunjukkan daftar kronologis Penjualan barang dagang secara kredit dan cash.
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('laporan.daftar_penjualan')}}">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('laporan.daftar_penjualan_cash')}}">
                              Daftar Penjualan Cash
                            </a>
                          </h3>
                          <p>
                            Menunjukkan daftar kronologis Penjualan barang dagang secara Cash.
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('laporan.daftar_penjualan_cash')}}">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('laporan.daftar_penjualan_kredit')}}">
                              Daftar Penjualan Kredit
                            </a>
                          </h3>
                          <p>
                            Menunjukkan daftar kronologis Penjualan barang dagang secara Kredit.
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('laporan.daftar_penjualan_kredit')}}">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('piutang_pelanggan.index')}}">
                              Laporan Piutang Angsuran Pelanggan
                            </a>
                          </h3>
                          <p>
                            Menampilkan tagihan yang belum dibayar untuk setiap pelanggan, termasuk nomor & tanggal faktur, tanggal jatuh tempo, jumlah nilai, dan sisa tagihan yang terhutang pada Anda.
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('piutang_pelanggan.index')}}">
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
                              Daftar Pembelian Cash & Kredit
                            </a>
                          </h3>
                          <p>
                            Menunjukkan daftar kronologis Pembelian barang dagang secara kredit dan cash.
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('laporan.daftar_pembelian')}}">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('laporan.daftar_pembelian_cash')}}">
                              Daftar Pembelian Cash
                            </a>
                          </h3>
                          <p>
                            Menunjukkan daftar kronologis Pembelian barang dagang secara Cash.
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('laporan.daftar_pembelian_cash')}}">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('laporan.daftar_pembelian_kredit')}}">
                              Daftar Pembelian Kredit
                            </a>
                          </h3>
                          <p>
                            Menunjukkan daftar kronologis Pembelian barang dagang secara Kredit.
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('laporan.daftar_pembelian_kredit')}}">
                            Lihat Laporan
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="report-item">
                          <h3>
                            <a data-placement="left" data-toggle="tooltop" href="{{route('hutang.index')}}">
                              Laporan Hutang Supplier
                            </a>
                          </h3>
                          <p>
                            Menampilkan jumlah nilai yang Anda hutang pada setiap Supplier.
                          </p>
                          <a class="btn btn-outline-primary btn-rounded" href="{{route('hutang.index')}}">
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
