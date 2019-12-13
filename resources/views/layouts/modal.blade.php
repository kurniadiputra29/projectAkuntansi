<div class="modal fade apps-modal" id="appsModal" tabindex="-1" role="dialog" aria-labelledby="appsModalLabel" aria-hidden="true" data-backdrop="false">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ik ik-x-circle"></i></button>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="quick-search">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 ml-auto mr-auto">
                            <div class="input-wrap">
                                <input type="text" id="quick-search" class="form-control" placeholder="Search..." />
                                <i class="ik ik-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div class="container">
                    <div class="apps-wrap">
                        <div class="app-item">
                            <a href="{{route('dasbor.index')}}"><i class="ik ik-home"></i><span>Dasbor</span></a>
                        </div>
                        <div class="app-item">
                          <a href="{{route('laporan.index')}}"><i class="ik ik-trending-up"></i><span>Laporan</span></a>
                        </div>
                        <div class="app-item">
                          <a href="{{route('akun.index')}}"><i class="ik ik-menu"></i><span>Daftar Akun</span></a>
                        </div>
                        <div class="app-item dropdown">
                            <a href="#" class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-phone"></i><span>Kontak</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{route('customer.index')}}">Customer</a>
                                <a class="dropdown-item" href="{{route('supplier.index')}}">Supplier</a>
                            </div>
                        </div>
                        {{-- <div class="app-item">
                            <a href="http://localhost/ProjectAkuntan/views/pages/satuan"><i class="ik ik-compass"></i><span>Satuan</span></a>
                        </div> --}}
                        <div class="app-item dropdown">
                            <a href="#" class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><a href="#"><i class="ik ik-database"></i><span>Saldo Awal</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{route('saldo_awal.index')}}">Saldo Awal</a>
                                <a class="dropdown-item" href="{{route('saldo_hutang.index')}}">Saldo Hutang</a>
                                <a class="dropdown-item" href="{{route('saldo_piutang.index')}}">Saldo Piutang</a>
                            </div>
                        </div>
                        <div class="app-item dropdown">
                            <a href="#" class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><a href="#"><i class="ik ik-package"></i><span>Penjualan</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{route('crj.index')}}">Cash Receipt Journal</a>
                                <a class="dropdown-item" href="{{route('sales_journal.index')}}">Sales Journal</a>
                            </div>
                        </div>
                        <div class="app-item dropdown">
                            <a href="#" class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><a href="#"><i class="ik ik-shopping-cart"></i><span>Pembelian</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{route('cpj.index')}}">Cash Payment Journal</a>
                                <a class="dropdown-item" href="{{route('purchase_journal.index')}}">Payments Journal</a>
                            </div>
                        </div>
                        <div class="app-item">
                            <a href="{{route('ju.index')}}"><i class="ik ik-book"></i><span>Jurnal Umum</span></a>
                        </div>
                        <div class="app-item">
                            <a href="{{route('cashbank_in.index')}}"><i class="ik ik-credit-card"></i><span>Cash & Bank In</span></a>
                        </div>
                        <div class="app-item">
                            <a href="{{route('cashbank_out.index')}}"><i class="ik ik-credit-card"></i><span>Cash & Bank Out</span></a>
                        </div>
                        <div class="app-item">
                            <a href="{{route('kas_kecil.index')}}"><i class="ik ik-briefcase"></i><span>Kas Kecil</span></a>
                        </div>
                        <div class="app-item">
                            <a href="{{route('jp.index')}}"><i class="ik ik-activity"></i><span>Jurnal Penyesuaian</span></a>
                        </div>
                        <div class="app-item">
                            <a href="{{route('item.index')}}"><i class="ik ik-box"></i><span>Item</span></a>
                        </div>
                        <div class="app-item">
                            <a href="{{route('stock_opname.index')}}"><i class="ik ik-truck"></i><span>Stock Opname</span></a>
                        </div>
                        <div class="app-item">
                            <a href="#"><i class="ik ik-pie-chart"></i><span>Reports</span></a>
                        </div>
                        <div class="app-item">
                            <a href="#"><i class="ik ik-layers"></i><span>Tasks</span></a>
                        </div>
                        <div class="app-item">
                            <a href="#"><i class="ik ik-edit"></i><span>Blogs</span></a>
                        </div>
                        <div class="app-item">
                            <a href="#"><i class="ik ik-settings"></i><span>Settings</span></a>
                        </div>
                        <div class="app-item">
                            <a href="#"><i class="ik ik-more-horizontal"></i><span>More</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
