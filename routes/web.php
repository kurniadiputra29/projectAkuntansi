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

Route::get('/jijal', function () {
    return view('pages.dasbor.index');
});
Route::resource('dasbor', 'DasborController');
Route::resource('akun', 'AkunController');
Route::resource('cpj', 'CpjController');
Route::resource('crj', 'CrjController');
Route::resource('customer', 'CustomerController');
Route::resource('item', 'ItemController');
Route::resource('jp', 'JpController');
Route::resource('ju', 'JuController');
Route::resource('kas_kecil', 'KasKecilController');
Route::resource('laporan', 'LaporanController');
Route::resource('payments_journal', 'PaymentJournalController');
Route::resource('saldo_awal', 'SaldoAwalController');
Route::resource('saldo_hutang', 'SaldoHutangController');
Route::resource('saldo_piutang', 'SaldoPiutangController');
Route::resource('sales_journal', 'SalesJournalController');
Route::resource('stock_opname', 'StockOpnameController');
Route::resource('supplier', 'SupplierController');



Route::resource('profile', 'ProfileController');
