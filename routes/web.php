<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
	return view('auth.login');
});

Auth::routes([
	'register' => false, // disable register
  	'reset' => false, // disable reset password
  	'verify' => false, // disable verifikasi email saat pendaftaran
]);

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/akun', 'HomeController@akun')->name('akun');
Route::post('/akun/aksi', 'HomeController@akun_aksi')->name('akun.aksi');
Route::put('/akun/update/{id}', 'HomeController@akun_update')->name('akun.update');
Route::delete('/akun/delete/{id}', 'HomeController@akun_delete')->name('akun.delete');

Route::get('/supplier', 'HomeController@supplier')->name('supplier');
Route::post('/supplier/aksi', 'HomeController@supplier_aksi')->name('supplier.aksi');
Route::put('/supplier/update/{id}', 'HomeController@supplier_update')->name('supplier.update');
Route::delete('/supplier/delete/{id}', 'HomeController@supplier_delete')->name('supplier.delete');

Route::get('/customer', 'HomeController@customer')->name('customer');
Route::post('/customer/aksi', 'HomeController@customer_aksi')->name('customer.aksi');
Route::put('/customer/update/{id}', 'HomeController@customer_update')->name('customer.update');
Route::delete('/customer/delete/{id}', 'HomeController@customer_delete')->name('customer.delete');

Route::get('/password', 'HomeController@password')->name('password');
Route::post('/password/update', 'HomeController@password_update')->name('password.update');


Route::get('/jurnal', 'HomeController@jurnal')->name('jurnal');
Route::get('/jurnal/tambah', 'HomeController@jurnal_add')->name('jurnal.tambah');
Route::post('/jurnal/aksi', 'HomeController@jurnal_aksi')->name('jurnal.aksi');
Route::get('/jurnal/edit/{id}', 'HomeController@jurnal_edit')->name('jurnal.edit');
Route::put('/jurnal/update/{id}', 'HomeController@jurnal_update')->name('jurnal.update');
Route::delete('/jurnal/delete/{id}', 'HomeController@jurnal_delete')->name('jurnal.delete');

Route::get('/penjualan', 'HomeController@penjualan')->name('penjualan');
Route::get('/penjualan/tambah', 'HomeController@penjualan_add')->name('penjualan.tambah');
Route::post('/penjualan/aksi', 'HomeController@penjualan_aksi')->name('penjualan.aksi');
Route::get('/penjualan/edit/{id}', 'HomeController@penjualan_edit')->name('penjualan.edit');
Route::put('/penjualan/update/{id}', 'HomeController@penjualan_update')->name('penjualan.update');
Route::delete('/penjualan/delete/{id}', 'HomeController@penjualan_delete')->name('penjualan.delete');

Route::get('/pembelian', 'HomeController@pembelian')->name('pembelian');
Route::get('/pembelian/tambah', 'HomeController@pembelian_add')->name('pembelian.tambah');
Route::post('/pembelian/aksi', 'HomeController@pembelian_aksi')->name('pembelian.aksi');
Route::get('/pembelian/edit/{id}', 'HomeController@pembelian_edit')->name('pembelian.edit');
Route::put('/pembelian/update/{id}', 'HomeController@pembelian_update')->name('pembelian.update');
Route::delete('/pembelian/delete/{id}', 'HomeController@pembelian_delete')->name('pembelian.delete');

Route::get('/rekapdata', 'HomeController@rekapdata')->name('rekapdata');
Route::get('/rekapdata/cetak', 'HomeController@rekapdata_cetak')->name('rekapdata_cetak');
Route::get('/rekapdata/excel', 'HomeController@rekapdata_excel')->name('rekapdata_excel');


Route::get('/pengguna', 'HomeController@user')->name('user');
Route::get('/pengguna/tambah', 'HomeController@user_add')->name('user.tambah');
Route::post('/pengguna/aksi', 'HomeController@user_aksi')->name('user.aksi');
Route::get('/pengguna/edit/{id}', 'HomeController@user_edit')->name('user.edit');
Route::put('/pengguna/update/{id}', 'HomeController@user_update')->name('user.update');
Route::delete('/user/delete/{id}', 'HomeController@user_delete')->name('user.delete');

Route::get('/jurnalumum', 'HomeController@jurnalumum')->name('jurnalumum');
Route::get('/jurnalumum/cetak', 'HomeController@jurnalumum_cetak')->name('jurnalumum_cetak');

Route::get('/bukubesar', 'HomeController@bukubesar')->name('bukubesar');
Route::get('/bukubesar/cetak', 'HomeController@bukubesar_cetak')->name('bukubesar_cetak');

Route::get('/neracasaldo', 'HomeController@neracasaldo')->name('neracasaldo');
Route::get('/neracasaldo/cetak', 'HomeController@neracasaldo_cetak')->name('neracasaldo_cetak');

