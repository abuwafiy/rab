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

Route::get('chart','DashboardController@getChart');
Route::get('/','LoginController@index');
Route::post('attempt','LoginController@attempt')->name('attempt');
Route::get('destroy','LoginController@destroy')->name('destroy');
Route::group(['middleware' => 'usersession'], function () {
	
	Route::resource('proyek','ProyekController');
	Route::resource('bahan','BahanController');
	Route::resource('satuan','SatuanController');
	Route::resource('kategori','KategoriController');
	Route::resource('jabatan','JabatanController');
	Route::resource('karyawan','KaryawanController');
	Route::resource('rab','RabController');

	Route::resource('realisasi','RealisasiController');
	Route::resource('pengajuan','PengajuanController');
	Route::resource('approval','ApprovalController');

	Route::get('dashboard','DashboardController@index');
	Route::get('menu','FrontController@index');
	
//API

	Route::get('api/headerrab','RabController@get_datas')->name('api.headerrab');
	Route::get('api/detailrab','RabController@get_data')->name('api.detailrab');
	Route::get('api/getdetailrab','RabController@getDetail')->name('api.getdetailrab');
	Route::post('api/detailrab','RabController@storeDetail')->name('api.store.detailrab');
	Route::post('api/detailbahan','RabController@storeDetailBahan')->name('api.store.detailbahan');
	Route::delete('api/detailrab/{id}','RabController@destroyDetail')->name('api.destroy.detailrab');
	Route::delete('api/detailbahan/{id}','RabController@destroyDetailBahan')->name('api.destroy.detailbahan');
	Route::get('api/getbahan','BahanController@get_data')->name('api.getbahan');
	Route::get('api/getdetailbahan','RabController@getDetailBahan')->name('api.getdetailbahan');
	Route::get('api/show','RabController@show')->name('api.show');
	Route::get('api/getdetailrealisasi','RealisasiController@get_data')->name('api.getdetailrealisasi');
	Route::get('api/finddetailrealisasi','RealisasiController@getDetail')->name('api.finddetailrealisasi');
	Route::get('api/getdetailbahanrealisasi','RealisasiController@getDetailBahan')->name('api.getdetailbahanrealisasi');
	Route::delete('api/detailbahanrealisasi/{id}','RealisasiController@destroyDetailBahan')->name('api.destroy.detailbahanrealisasi');


	Route::get('api/show','RabController@get_data')->name('api.detailrealisasi');
	Route::get('api/peringatan','RealisasiController@peringatanBiaya')->name('api.peringatan');
	Route::get('api/hitungperencanaan','RealisasiController@hitungPerencanan')->name('api.hitungperencanaan');

	//rpeort
	Route::get('report/selisih','ReportController@index')->name('report.selisih');
	Route::get('pdf/selisih/', 'ReportController@generatePDF');

	Route::get('periode/realisasi','PeriodeController@index')->name('periode.realisasi');
	Route::get('pdf/realisasi/', 'PeriodeController@generatePDF');

	Route::get('laporanbhn/laporan','LaporanbhnController@index')->name('laporanbhn.laporan');
	Route::get('pdf/laporan/', 'LaporanbhnController@generatePDF');
});