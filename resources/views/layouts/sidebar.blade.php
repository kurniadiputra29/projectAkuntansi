@php
  $pagenow    = dirname($_SERVER['PHP_SELF']);
@endphp
<div class="sidebar-content">
    <div class="nav-container">
      <nav id="main-menu-navigation" class="navigation-main">
          <div class="nav-lavel">Umum</div>
          <div class="nav-item {{ Request::is('dasbor') ? 'active' : ''}}">
              <a href="{{ route('dasbor.index') }}"><i class="ik ik-home"></i><span>Dasbor</span></a>
          </div>
          <div class="nav-item {{ Request::is('laporan') || Request::is('print/*') ? 'active' : '' }}">
              <a href="{{ route('laporan.index') }}"><i class="ik ik-trending-up"></i><span>Laporan</span></a>
          </div>
          <div class="nav-lavel">Transaksi</div>
          <div class="nav-item has-sub {{ Request::is('crj') || Request::is('sales_journal') || Request::is('crj/create') || Request::is('crj/*') || Request::is('sales_journal/create') || Request::is('sales_journal/*') || Request::is('retur_penjualan') || Request::is('retur_penjualan/*') || Request::is('retur_penjualan/create') ? 'active open' : '' }}">
              <a href="#"><i class="ik ik-package"></i><span>Penjualan</span></a>
              <div class="submenu-content">
                  <a href="{{ route('crj.index') }}" class="menu-item {{ Request::is('crj') || Request::is('crj/create') || Request::is('crj/*') ? 'active' : '' }}">Cash Receipt Journal</a>
                  <a href="{{ route('sales_journal.index') }}" class="menu-item {{Request::is('sales_journal') || Request::is('sales_journal/create') || Request::is('sales_journal/*') ?'active':''}}">Sales Journal</a>
                  <a href="{{ route('retur_penjualan.index') }}" class="menu-item {{Request::is('retur_penjualan') || Request::is('retur_penjualan/create') || Request::is('retur_penjualan/*') ?'active':''}}">Retur Penjualan</a>
              </div>
          </div>
          <div class="nav-item has-sub {{ Request::is('cpj') || Request::is('purchase_journal') || Request::is('cpj/create') || Request::is('purchase_journal/create') || Request::is('purchase_journal/*') || Request::is('cpj/*') || Request::is('retur_pembelian') || Request::is('retur_pembelian/*') || Request::is('retur_pembelian/create') ? 'active open' : '' }}">
              <a href="#"><i class="ik ik-shopping-cart"></i><span>Pembelian</span></a>
              <div class="submenu-content">
                  <a href="{{ route('cpj.index') }}" class="menu-item {{ Request::is('cpj') || Request::is('cpj/create') || Request::is('cpj/*') ? 'active' : '' }}">Cash Payment Journal</a>
                  <a href="{{ route('purchase_journal.index') }}" class="menu-item {{ Request::is('purchase_journal') || Request::is('purchase_journal/*') ? 'active' : '' }}">Purchase Journal</a>
                  <a href="{{ route('retur_pembelian.index') }}" class="menu-item {{Request::is('retur_pembelian') || Request::is('retur_pembelian/create') || Request::is('retur_pembelian/*') ?'active':''}}">Retur Pembelian</a>
              </div>
          </div>
          <div class="nav-item has-sub {{ Request::is('cashbank_in') || Request::is('cashbank_in/*') || Request::is('cashbank_out') || Request::is('cashbank_out/*') ? 'active open' : '' }}">
              <a href="#"><i class="ik ik-credit-card"></i><span>Cash & Bank</span></a>
              <div class="submenu-content">
                  <a href="{{ route('cashbank_in.index') }}" class="menu-item {{ Request::is('cashbank_in') || Request::is('cashbank_in/*') ? 'active':'' }}">Cash & Bank In</a>
                  <a href="{{ route('cashbank_out.index') }}" class="menu-item {{ Request::is('cashbank_out') || Request::is('cashbank_out/*') ? 'active':'' }}">Cash & Bank Out</a>
              </div>
          </div>
          <div class="nav-item has-sub {{ Request::is('pelunasan_hutang') || Request::is('pelunasan_hutang/*') || Request::is('penerimaan_piutang') || Request::is('penerimaan_piutang/*') ? 'active open' : '' }}">
              <a href="#"><i class="ik ik-credit-card"></i><span>Hutang & Piutang</span></a>
              <div class="submenu-content">
                  <a href="{{ route('pelunasan_hutang.index') }}" class="menu-item {{ Request::is('pelunasan_hutang') || Request::is('pelunasan_hutang/*') ? 'active':'' }}">Pelunasan Hutang</a>
                  <a href="{{ route('penerimaan_piutang.index') }}" class="menu-item {{ Request::is('penerimaan_piutang') || Request::is('penerimaan_piutang/*') ? 'active':'' }}">Penerimaan Piutang</a>
              </div>
          </div>
          <div class="nav-item {{ Request::is('kas_kecil') || Request::is('kas_kecil/*') ? 'active' : '' }}">
              <a href="{{ route('kas_kecil.index') }}"><i class="ik ik-briefcase"></i><span>Kas Kecil</span></a>
          </div>
          <div class="nav-item {{ Request::is('jp') || Request::is('jp/*') ? 'active' : '' }}">
              <a href="{{ route('jp.index') }}"><i class="ik ik-activity"></i><span>Jurnal Penyesuaian</span></a>
          </div>
          <div class="nav-item {{ Request::is('ju') || Request::is('ju/*') ? 'active' : '' }}">
              <a href="{{ route('ju.index') }}"><i class="ik ik-book"></i><span>Jurnal Umum</span></a>
          </div>
          <div class="nav-lavel">Master Data</div>
          <div class="nav-item has-sub {{ Request::is('akun') || Request::is('akun/create') ? 'active open' : '' }}">
              <a href="#"><i class="ik ik-menu"></i><span>Akun</span></a>
              <div class="submenu-content">
                  <a href="{{ route('akun.index') }}" class="menu-item {{ Request::is('akun') ? 'active' : '' }}">Daftar Akun</a>
                  <a href="{{ route('akun.create') }}" class="menu-item {{ Request::is('akun/create') ? 'active' : '' }}">Create Akun</a>
              </div>
          </div>
          <div class="nav-item has-sub {{ Request::is('customer') || Request::is('supplier') ? 'active open' : '' }}">
              <a href="#"><i class="ik ik-phone"></i><span>Kontak</span></a>
              <div class="submenu-content">
                  <a href="{{ route('customer.index') }}" class="menu-item {{ Request::is('customer') ? 'active' : '' }}">Customer</a>
                  <a href="{{ route('supplier.index') }}" class="menu-item {{ Request::is('supplier') ? 'active' : '' }}">Supplier</a>
              </div>
          </div>
          <div class="nav-item has-sub {{ Request::is('saldo_awal') || Request::is('saldo_hutang') || Request::is('saldo_piutang') ?'active open':'' }}">
              <a href="#"><i class="ik ik-database"></i><span>Saldo Awal</span></a>
              <div class="submenu-content">
                  <a href="{{route('saldo_awal.index')}}" class="menu-item {{ Request::is('saldo_awal')?'active':'' }}">Saldo Awal</a>
                  <a href="{{route('saldo_hutang.index')}}" class="menu-item {{ Request::is('saldo_hutang')?'active':'' }}">Saldo Hutang</a>
                  <a href="{{route('saldo_piutang.index')}}" class="menu-item {{Request::is('saldo_piutang')?'active':''}}">Saldo Piutang</a>
              </div>
          </div>
          <div class="nav-lavel">Inventory</div>
          <div class="nav-item has-sub {{ Request::is('item') || Request::is('item/*') || Request::is('saldo_item') || Request::is('saldo_item/*') ? 'active open' : '' }}">
              <a href="#"><i class="ik ik-box"></i><span>Item</span></a>
              <div class="submenu-content">
                  <a href="{{ route('item.index') }}" class="menu-item {{ Request::is('item') || Request::is('item/*') ? 'active':'' }}">Daftar Item</a>
                  <a href="{{ route('saldo_item.index') }}" class="menu-item {{ Request::is('saldo_item') || Request::is('saldo_item/*') ? 'active':'' }}">Saldo Item</a>
              </div>
          </div>
          <div class="nav-item {{ Request::is('harga_jual') || Request::is('harga_jual/*') ? 'active' : '' }}">
              <a href="{{ route('harga_jual.index') }}"><i class="ik ik-clipboard"></i><span>Harga Penjualan</span></a>
          </div>
          <div class="nav-item {{ Request::is('stock_opname') ? 'active' : '' }}">
              <a href="{{ route('stock_opname.index') }}"><i class="ik ik-truck"></i><span>Stock Opname</span></a>
          </div>
          <div class="nav-lavel">Settings</div>
          <div class="nav-item {{ Request::is('pemetaan_akun') || Request::is('pemetaan_akun/*') ? 'active' : '' }}">
              <a href="{{ route('pemetaan_akun.index') }}"><i class="ik ik-settings"></i><span>Pemetaan Akun</span></a>
          </div>

          @if( auth()->user()->role_id  == 1)
            <div class="nav-lavel">Users</div>
            <div class="nav-item {{ Request::is('users') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}"><i class="ik ik-user"></i><span>Users</span></a>
            </div>
            <div class="nav-item {{ Request::is('role') ? 'active' : '' }}">
                <a href="{{ route('role.index') }}"><i class="ik ik-user-plus"></i><span>Roles</span></a>
            </div>
          @endif
      </nav>
    </div>
</div>
