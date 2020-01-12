<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', 'AuthController@login')->name('login.form');
Route::post('/enter', 'AuthController@enter')->name('login.enter');
Route::post('/logout', 'AuthController@logout')->name('login.logout');
Route::get('/register', 'AuthController@register');
Route::post('/inputregister', 'AuthController@inputregister')->name('input.register');
Route::get('addcompany', 'AddCompanyController@form');
Route::post('/postcompany', 'AddCompanyController@store')->name('co.store');

Route::group(['prefix' => 'social-media', 'namespace' => 'Auth'], function(){
    Route::get('register/{provider}', 'SocialiteController@register');
    Route::get('registered/{provider}', 'SocialiteController@registered');
});

Route::get('/resetpassword', 'AuthController@resetpassword')->name('resetpassword');
Route::post('resetpassword', 'AuthController@resetpass')->name('reset.pass');
Route::get('confirmasipassword', 'AuthController@confirmasipassword')->name('confirm');
Route::post('confirmasipassword', 'AuthController@confirmpass')->name('confirm.pass');
Route::put('reset', 'AuthController@update')->name('reset.update');

Route::get('/', function () {
    return view('welcome');
});
Route::resource('dasbor', 'DasborController');
Route::get('/dasbor/cobaChart', 'DasborController@cobaChart')->name('dasbor.cobaChart');
Route::resource('akun', 'AkunController');
Route::resource('cpj', 'CpjController');
Route::get('cpj/{id}/retur', 'CpjController@retur')->name('cpj.retur');
Route::resource('crj', 'CrjController');
Route::get('crj/{id}/retur', 'CrjController@retur')->name('crj.retur');
Route::resource('customer', 'CustomerController');
Route::resource('item', 'ItemController');
Route::resource('saldo_item', 'SaldoItemController');
Route::resource('jp', 'JpController');
Route::resource('ju', 'JuController');
Route::resource('kas_kecil', 'KasKecilController');
Route::resource('laporan', 'LaporanController');
Route::resource('purchase_journal', 'PurchaseJournalController');
Route::get('purchase_journal/{id}/retur', 'PurchaseJournalController@retur')->name('purchase_journal.retur');
Route::resource('saldo_awal', 'SaldoAwalController');
Route::resource('saldo_hutang', 'SaldoHutangController');
Route::resource('saldo_piutang', 'SaldoPiutangController');
Route::resource('sales_journal', 'SalesJournalController');
Route::get('sales_journal/{id}/retur', 'SalesJournalController@retur')->name('sales_journal.retur');
Route::resource('stock_opname', 'StockOpnameController');
Route::resource('supplier', 'SupplierController');
Route::resource('retur_penjualan', 'ReturPenjualanController');
Route::resource('retur_pembelian', 'ReturPembelianController');
Route::resource('cashbank_in', 'CashBankInController');
Route::resource('cashbank_out', 'CashBankOutController');

Route::resource('profile', 'ProfileController');

Route::resource('users', 'UserController');
Route::resource('role', 'RoleController');

// index Laporan
Route::get('/print/neraca', 'PrintController@neraca')->name('laporan.neraca');
Route::get('/print/neraca_saldo', 'PrintController@neraca_saldo')->name('laporan.neraca_saldo');
Route::get('/print/buku_besar', 'PrintController@buku_besar')->name('laporan.buku_besar');
Route::get('/print/laba_rugi', 'PrintController@laba_rugi')->name('laporan.laba_rugi');
Route::get('/print/alur_kas', 'PrintController@alur_kas')->name('laporan.alur_kas');


//for print
Route::get('/print/print_neraca', 'PrintController@print_neraca')->name('print.neraca');
Route::get('/print/print_neraca_saldo', 'PrintController@print_neraca_saldo')->name('print.neraca_saldo');

//fix
Route::get('/inventory/', 'Reports\InventoryController@index')->name('inventory.index');
Route::post('inventory/filter', 'Reports\InventoryController@filter')->name('inventory.filter');
Route::post('inventory/print', 'Reports\InventoryController@print')->name('inventory.print');
Route::get('inventory/{inventory}', 'Reports\InventoryController@show')->name('inventory.show');
Route::get('buku_besar', 'Reports\BukuBesarController@index')->name('buku_besar.index');
Route::get('buku_besar/alternative', 'Reports\BukuBesarController@alt')->name('buku_besar.alternative');
Route::get('neraca', 'Reports\NeracaController@index')->name('neraca.index');
Route::get('neraca/print', 'Reports\NeracaController@print')->name('neraca.print');
Route::get('neraca_lajur', 'Reports\NeracaLajurController@index')->name('neraca_lajur.index');
Route::get('laba_rugi', 'Reports\LabaRugiController@index')->name('laba_rugi.index');
Route::get('arus_kas', 'Reports\ArusKasController@index')->name('arus_kas.index');
Route::get('petty_cash_book', 'Reports\PettyCashBookController@index')->name('petty_cash_book.index');
Route::post('petty_cash_book/filter', 'Reports\PettyCashBookController@filter')->name('petty_cash_book.filter');
Route::post('petty_cash_book/print', 'Reports\PettyCashBookController@print')->name('petty_cash_book.print');
Route::get('petty_cash_book/{petty_cash_book}', 'Reports\PettyCashBookController@show')->name('petty_cash_book.show');


Route::get('piutang_pelanggan', 'Reports\PiutangController@index')->name('piutang_pelanggan.index');
Route::post('piutang_pelanggan/print', 'Reports\PiutangController@print')->name('piutang_pelanggan.print');
Route::post('piutang_pelanggan/filter', 'Reports\PiutangController@filter')->name('piutang_pelanggan.filter');
Route::get('hutang', 'Reports\HutangController@index')->name('hutang.index');
Route::post('hutang/print', 'Reports\HutangController@print')->name('hutang.print');
Route::post('hutang/filter', 'Reports\HutangController@filter')->name('hutang.filter');
Route::get('neraca_saldo', 'Reports\NeracaSaldoController@index')->name('neraca_saldo.index');
Route::get('neraca_saldo/print', 'Reports\NeracaSaldoController@print')->name('neraca_saldo.print');

Route::get('daftar_penjualan', 'Reports\Daftar_PenjualanController@index')->name('daftar_penjualan.index');
Route::post('daftar_penjualan/filter', 'Reports\Daftar_PenjualanController@filter')->name('daftar_penjualan.filter');
Route::post('daftar_penjualan/print', 'Reports\Daftar_PenjualanController@print')->name('daftar_penjualan.print');
Route::get('daftar_penjualan/printF', 'Reports\Daftar_PenjualanController@printFilter')->name('daftar_penjualan.printF');
Route::get('daftar_pembelian', 'Reports\Daftar_PembelianController@index')->name('daftar_pembelian.index');
