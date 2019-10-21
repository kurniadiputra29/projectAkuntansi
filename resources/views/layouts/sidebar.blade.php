<?php
  $pagenow    = dirname($_SERVER['PHP_SELF']);
?>
<div class="sidebar-content">
    <div class="nav-container">
      <nav id="main-menu-navigation" class="navigation-main">
          <div class="nav-lavel">Umum</div>
          <div class="nav-item {{ Request::is('dasbor') ? 'active' : ''}}">
              <a href="{{ route('dasbor.index') }}"><i class="ik ik-home"></i><span>Dasbor</span></a>
          </div>
          <div class="nav-item {{ Request::is('laporan') ? 'active' : '' }}">
              <a href="{{ route('laporan.index') }}"><i class="ik ik-trending-up"></i><span>Laporan</span></a>
          </div>
          <div class="nav-lavel">Master Data</div>
          <div class="nav-item {{ Request::is('akun') ? 'active' : '' }}">
              <a href="{{ route('akun.index') }}"><i class="ik ik-menu"></i><span>Daftar Akun</span></a>
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
          <div class="nav-lavel">Transaksi</div>
          <div class="nav-item has-sub {{ Request::is('crj') || Request::is('sales_journal') ? 'active open' : '' }}">
              <a href="#"><i class="ik ik-package"></i><span>Penjualan</span></a>
              <div class="submenu-content">
                  <a href="{{ route('crj.index') }}" class="menu-item {{ Request::is('crj') ? 'active' : '' }}">Cash Receipt Journal</a>
                  <a href="{{ route('sales_journal.index') }}" class="menu-item {{Request::is('sales_journal')?'active':''}}">Sales Journal</a>
              </div>
          </div>
          <div class="nav-item has-sub {{ Request::is('cpj') || Request::is('payments_journal') ? 'active open' : '' }}">
              <a href="#"><i class="ik ik-shopping-cart"></i><span>Pembelian</span></a>
              <div class="submenu-content">
                  <a href="{{ route('cpj.index') }}" class="menu-item {{ Request::is('cpj') ? 'active' : '' }}">Cash Payment Journal</a>
                  <a href="{{ route('payments_journal.index') }}" class="menu-item {{ Request::is('payments_journal') ? 'active' : '' }}">Payments Journal</a>
              </div>
          </div>
          <div class="nav-item {{ Request::is('ju') ? 'active' : '' }}">
              <a href="{{ route('ju.index') }}"><i class="ik ik-book"></i><span>Jurnal Umum</span></a>
          </div>
          <div class="nav-item {{ Request::is('kas_kecil') ? 'active' : '' }}">
              <a href="{{ route('kas_kecil.index') }}"><i class="ik ik-briefcase"></i><span>Kas Kecil</span></a>
          </div>
          <div class="nav-item {{ Request::is('jp') ? 'active' : '' }}">
              <a href="{{ route('jp.index') }}"><i class="ik ik-activity"></i><span>Jurnal Penyesuaian</span></a>
          </div>
          <div class="nav-lavel">Inventory</div>
          <div class="nav-item {{ Request::is('item') ? 'active' : '' }}">
              <a href="{{ route('item.index') }}"><i class="ik ik-box"></i><span>Item</span></a>
          </div>
          <div class="nav-item {{ Request::is('stock_opname') ? 'active' : '' }}">
              <a href="{{ route('stock_opname.index') }}"><i class="ik ik-truck"></i><span>Stock Opname</span></a>
          </div>
      </nav>
    </div>
</div>
