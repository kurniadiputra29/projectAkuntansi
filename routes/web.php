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

Route::get('cashbank', 'CashBankController@index')->name('cashbank.index');
Route::get('cashbank/create', 'CashBankController@create')->name('cashbank.create');
Route::post('cashbank', 'CashBankController@store')->name('cashbank.store');
Route::get('cashbank/{id}/edit', 'CashBankController@edit')->name('cashbank.edit');
Route::put('cashbank/{id}', 'CashBankController@update')->name('cashbank.update');
Route::delete('cashbank/{id}', 'CashBankController@destroy')->name('cashbank.destroy');

Route::resource('profile', 'ProfileController');

Route::resource('users', 'UserController');
