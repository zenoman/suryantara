<?php
use Illuminate\Support\Facades\Input;
//==============================================backup
Route::get('/backup','backup\backupController@index');
Route::get('/tampilbackup','backup\backupController@tampil');
Route::get('/printpendapatan/{bulan}/{tahun}','backup\backupController@cetakpendapatan');
Route::get('/exsportpendapatan/{bulan}/{tahun}','backup\backupController@exsportpendapatan');
//==============================================omset
Route::get('/omset','omset\omsetController@index');

//===============================================pengeluaran lain
Route::resource('/pengeluaranlain','pengeluaranlain\pengeluaranlainController');

//================================================resi pengiriman
Route::get('/cariresipengiriman','resipengiriman\resipengirimanController@caridataresi');
Route::post('/tambahsmu','resipengiriman\resipengirimanController@tambahnosmu');
Route::get('/resipengirimanudara','resipengiriman\resipengirimanController@resiudara');
Route::get('/uangkembali/{id}','resipengiriman\resipengirimanController@uangkembali');
Route::get('/resikembali/{id}','resipengiriman\resipengirimanController@resikembali');
Route::get('/carilistresi/{id}','resipengiriman\resipengirimanController@carilistresi');

Route::get('/carihasillaut/{id}','resipengiriman\resipengirimanController@carihasillaut');
Route::get('/carihasilkota/{id}','resipengiriman\resipengirimanController@carihasilkota');
Route::get('/listpengiriman','resipengiriman\resipengirimanController@tampil');
Route::get('/carikode','resipengiriman\resipengirimanController@carikode');
Route::resource('/residarat','resipengiriman\resipengirimanController');
Route::get('/carikota','resipengiriman\resipengirimanController@carikota');
Route::get('/carilaut','resipengiriman\resipengirimanController@carilaut');
Route::get('/carihasiludara/{id}','resipengiriman\resipengirimanController@carihasiludara');
Route::get('/cariudara','resipengiriman\resipengirimanController@cariudara');
Route::get('/resipengirimandarat','resipengiriman\resipengirimanController@residarat');
Route::post('/simpanlaut','resipengiriman\resipengirimanController@simpanlaut');
Route::post('/simpanudara','resipengiriman\resipengirimanController@simpanudara');
Route::get('/resipengirimanlaut','resipengiriman\resipengirimanController@resilaut');
//==========================================================surat jalan
Route::get('/carisuratjalan','suratjalan\suratjalanController@caridata');
Route::post('/hapuslistsj','suratjalan\suratjalanController@destroy');
Route::post('/bayarsj','suratjalan\suratjalanController@bayar');
Route::get('/listsuratjalan','suratjalan\suratjalanController@listsuratjalan');
Route::post('/tambahkansj','suratjalan\suratjalanController@store');

Route::get('/hapusdetailsj/{id}','suratjalan\suratjalanController@hapusdetail');
Route::post('/tambahdetailsj','suratjalan\suratjalanController@tambahdetail');
Route::get('/caridetailsj/{id}','suratjalan\suratjalanController@caridetail');
Route::get('/carikodesj','suratjalan\suratjalanController@carikode');

Route::get('/cariresi/{id}','suratjalan\suratjalanController@hasilresi');
Route::get('/carinoresi','suratjalan\suratjalanController@cariresi');
Route::get('/carivendor','suratjalan\suratjalanController@carivendor');
Route::get('/carivendor/{id}','suratjalan\suratjalanController@hasilvendor');
Route::get('/buatsuratjalan','suratjalan\suratjalanController@index');

//=====================================================laporan
Route::get('/tampillaporanpengeluaran','laporan\laporanController@tampilpengeluaran');
Route::get('/laporanpengeluaran','laporan\laporanController@pilihpengeluaran');
Route::get('/laporanpengeluaranlainya','laporan\laporanController@pilihpengeluaranlain');
Route::get('/tampillaporanpengeluaranlain','laporan\laporanController@tampilpengeluaranlain');
Route::get('/tampillaporanpemasukan','laporan\laporanController@tampilpemasukan');
Route::get('/laporanpemasukan','laporan\laporanController@pilihpemasukan');
Route::get('/refreshcaptcha','Login\Logincontroller@refreshCaptcha');


//===========================================


Route::get('/login','Login\Logincontroller@index');
Route::get('/','landing\landingcontroller@index');
Route::get('/landdarat','landingdarat\landingdaratcontroller@index');
Route::get('/landlaut','landinglaut\landinglautcontroller@index');
Route::get('/landudara','landingudara\landingudaracontroller@index');
Route::get('/dashboard','Dashboardcontroller@index');


//===========================================admin
Route::get('/admin','Admin\Admincontroller@index');
Route::post('/admin','Admin\Admincontroller@store');
Route::get('/admin/create','Admin\Admincontroller@create');
Route::get('/admin/{id}/edit','Admin\Admincontroller@edit');
Route::put('/admin/{id}','Admin\Admincontroller@update');
Route::post('/admin/delete','Admin\Admincontroller@destroy');
Route::get('/admin/{id}/changepas','Admin\Admincontroller@changepas');
Route::put('/admin/{id}/changepas','Admin\Admincontroller@actionchangepas');
Route::get('admin/cari','Admin\Admincontroller@caridata');
//============================================setting
Route::get('/setting','Setting\Settingcontroller@index');
Route::put('/setting/{id}','Setting\Settingcontroller@update');
//============================================trf udara
Route::get('/trfudara','Trfudara\Trfudaracontroller@index');
Route::post('/trfudara','Trfudara\Trfudaracontroller@store');
Route::get('/trfudara/create','Trfudara\Trfudaracontroller@create');
Route::get('/trfudara/{id}/edit','Trfudara\Trfudaracontroller@edit');
Route::put('/trfudara/{id}','Trfudara\Trfudaracontroller@update');
Route::post('/trfudara/delete','Trfudara\Trfudaracontroller@destroy');
Route::get('trfudara/cari','Trfudara\Trfudaracontroller@caridata');
//-----------------------export import
Route::get('/trfudara/importexcel','Trfudara\Trfudaracontroller@importexcel');
Route::post('/trfudara/prosesimportexcel','Trfudara\Trfudaracontroller@prosesimportexcel');
Route::get('/trfudara/download','Trfudara\Trfudaracontroller@downloadtemplate');
Route::get('/trfudara/exporttrfudara','Trfudara\Trfudaracontroller@exsportexcel');
//==============================================trf darat
Route::get('/trfdarat','Trfdarat\Trf_daratcontroller@index');
Route::post('/trfdarat','Trfdarat\Trf_daratcontroller@store');
Route::get('/trfdarat/create','Trfdarat\Trf_daratcontroller@create');
Route::get('/trfdarat/{id}/edit','Trfdarat\Trf_daratcontroller@edit');
Route::put('/trfdarat/{id}','Trfdarat\Trf_daratcontroller@update');
Route::post('/trfdarat/delete','Trfdarat\Trf_daratcontroller@destroy');
Route::get('trfdarat/cari','Trfdarat\Trf_daratcontroller@caridata');
//------------------------export import
Route::get('/trfdarat/importexcel','Trfdarat\Trf_daratcontroller@importexcel');
Route::post('/trfdarat/prosesimportexcel','Trfdarat\Trf_daratcontroller@prosesimportexcel');
Route::get('/trfdarat/download','Trfdarat\Trf_daratcontroller@downloadtemplate');
Route::get('/trfdarat/exporttrfdarat','Trfdarat\Trf_daratcontroller@exsportexcel');
//===============================================trf laut
Route::get('/trflaut','Trf_laut\Trf_lautcontroller@index');
Route::post('/trflaut','Trf_laut\Trf_lautcontroller@store');
Route::get('/trflaut/create','Trf_laut\Trf_lautcontroller@create');
Route::get('/trflaut/{id}/edit','Trf_laut\Trf_lautcontroller@edit');
Route::put('/trflaut/{id}','Trf_laut\Trf_lautcontroller@update');
Route::post('/trflaut/delete','Trf_laut\Trf_lautcontroller@destroy');
Route::get('trflaut/cari','Trf_laut\Trf_lautcontroller@caridata');
//------------------------export import
Route::get('/trflaut/importexcel','Trf_laut\Trf_lautcontroller@importexcel');
Route::post('/trflaut/prosesimportexcel','Trf_laut\Trf_lautcontroller@prosesimportexcel');
Route::get('/trflaut/download','Trf_laut\Trf_lautcontroller@downloadtemplate');
Route::get('/trflaut/exporttrflaut','Trf_laut\Trf_lautcontroller@exsportexcel');
//===============================================vendor
Route::get('/vendor','Vendor\Vendorcontroller@index');
Route::post('/vendor','Vendor\Vendorcontroller@store');
Route::get('/vendor/create','Vendor\Vendorcontroller@create');
Route::get('/vendor/{id}/edit','Vendor\Vendorcontroller@edit');
Route::put('/vendor/{id}','Vendor\Vendorcontroller@update');
Route::post('/vendor/delete','Vendor\Vendorcontroller@destroy');
Route::get('vendor/cari','Vendor\Vendorcontroller@caridata');
//------------------------export import 
Route::get('/vendor/importexcel','Vendor\Vendorcontroller@importexcel');
Route::post('/vendor/prosesimportexcel','Vendor\Vendorcontroller@prosesimportexcel');
Route::get('/vendor/exportvendor','Vendor\Vendorcontroller@exsportexcel');
Route::get('/vendor/download','Vendor\Vendorcontroller@downloadtemplate');
//==============================================================Login
Route::get('/login','Login\Logincontroller@index');
Route::post('/login/masuk','Login\Logincontroller@masuk');
Route::get('/login/logout','Login\Logincontroller@logout');
