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

Route::get('/jijal', function () {
    return view('pages.dasbor.index');
});
Route::resource('dasbor', 'DasborController');
Route::get('/dasbor/cobaChart', 'DasborController@cobaChart')->name('dasbor.cobaChart');
Route::resource('akun', 'AkunController');
Route::resource('cpj', 'CpjController');
Route::resource('crj', 'CrjController');
Route::resource('customer', 'CustomerController');
Route::resource('item', 'ItemController');
Route::resource('jp', 'JpController');
Route::resource('ju', 'JuController');
Route::resource('kas_kecil', 'KasKecilController');
Route::resource('laporan', 'LaporanController');
Route::resource('purchase_journal', 'PurchaseJournalController');
Route::resource('saldo_awal', 'SaldoAwalController');
Route::resource('saldo_hutang', 'SaldoHutangController');
Route::resource('saldo_piutang', 'SaldoPiutangController');
Route::resource('sales_journal', 'SalesJournalController');
Route::resource('stock_opname', 'StockOpnameController');
Route::resource('supplier', 'SupplierController');
Route::resource('retur_penjualan', 'ReturPenjualanController');
Route::resource('retur_pembelian', 'ReturPembelianController');

Route::get('cashbank', 'CashBankController@index')->name('cashbank.index');
Route::get('cashbank/create', 'CashBankController@create')->name('cashbank.create');
Route::post('cashbank', 'CashBankController@store')->name('cashbank.store');
Route::get('cashbank/{id}/edit', 'CashBankController@edit')->name('cashbank.edit');
Route::get('cashbank/{id}', 'CashBankController@show')->name('cashbank.show');
Route::put('cashbank/{id}', 'CashBankController@update')->name('cashbank.update');
Route::delete('cashbank/{id}', 'CashBankController@destroy')->name('cashbank.destroy');

Route::resource('profile', 'ProfileController');

Route::resource('users', 'UserController');

// index Laporan
Route::get('/print/neraca', 'PrintController@neraca')->name('laporan.neraca');
Route::get('/print/neraca_saldo', 'PrintController@neraca_saldo')->name('laporan.neraca_saldo');
Route::get('/print/buku_besar', 'PrintController@buku_besar')->name('laporan.buku_besar');
Route::get('/print/laba_rugi', 'PrintController@laba_rugi')->name('laporan.laba_rugi');
Route::get('/print/alur_kas', 'PrintController@alur_kas')->name('laporan.alur_kas');
Route::get('/print/daftar_penjualan', 'PrintController@daftar_penjualan')->name('laporan.daftar_penjualan');
Route::get('/print/piutang_pelanggan', 'PrintController@piutang_pelanggan')->name('laporan.piutang_pelanggan');
Route::get('/print/penjualan_per_produk', 'PrintController@penjualan_per_produk')->name('laporan.penjualan_per_produk');
Route::get('/print/daftar_pembelian', 'PrintController@daftar_pembelian')->name('laporan.daftar_pembelian');
Route::get('/print/pembelian_per_produk', 'PrintController@pembelian_per_produk')->name('laporan.pembelian_per_produk');
Route::get('/print/hutang_supplier', 'PrintController@hutang_supplier')->name('laporan.hutang_supplier');

//for print
Route::get('/print/print_neraca', 'PrintController@print_neraca')->name('print.neraca');
Route::get('/print/print_neraca_saldo', 'PrintController@print_neraca_saldo')->name('print.neraca_saldo');


Route::get('/inventory/', 'InventoryController@index')->name('inventory.index');

