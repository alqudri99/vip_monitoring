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

Route::get('file-import-export', 'UserController@fileImportExport');
Route::post('file-import', 'UserController@fileImport')->name('file-import');
Route::get('file-export', 'UserController@fileExport')->name('file-export');
Route::get('grafikData', 'HomeController@getData');
Route::get('getKecamatan', 'HomeController@getKecamatan');

Route::resource('/', 'MainController');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/h', 'HomeController@i');


Route::get('test', 'HomeController@test');

Route::resource('jabatan', 'JabatanController');

Route::resource('karyawan', 'UserController');

Route::resource('project', 'ProjectController');

Route::resource('databts', 'DataBtsController');

Route::resource('site', 'SiteController');

Route::resource('kota', 'KotaController');

Route::resource('kecamatan', 'KecamatanController');

Route::get('error', 'ErrorController@error403');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cari', 'SiteController@cari');
Route::get('/getKota', 'HomeController@cari');
Route::get('/cetak', 'UserController@cetak');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/ews', 'HomeController@getEws');


Route::get('/qc', 'ProjectController@qcUpdate');

Route::get('/cetakuser', 'UserController@cetak');

Route::get('/cetakproject', 'ProjectController@cetak');

Route::get('/cetaksite', 'SiteController@cetak');

Route::get('/cetakbts', 'DataBtsController@cetak');
