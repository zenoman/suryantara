<?php
use Illuminate\Support\Facades\Input;
Route::get('/laporan','laporan\laporandarat@index');
Route::get('/','Login\Logincontroller@index');
Route::get('/dashboard','Dashboardcontroller@index');
//==============================================resi pengiriman
Route::resource('/residarat','resipengiriman\resipengirimanController');
Route::get('/carikota','resipengiriman\resipengirimanController@carikota');
Route::get('/resipengirimandarat','resipengiriman\resipengirimanController@residarat');
//===========================================admin
Route::get('/admin','Admin\Admincontroller@index');
Route::post('/admin','Admin\Admincontroller@store');
Route::get('/admin/create','Admin\Admincontroller@create');
Route::get('/admin/{id}','Admin\Admincontroller@edit');
Route::put('/admin/{id}','Admin\Admincontroller@update');
Route::get('/admin/{id}/delete','Admin\Admincontroller@destroy');
//============================================setting
Route::get('/setting','Setting\Settingcontroller@index');
Route::put('/setting/{id}','Setting\Settingcontroller@update');
//============================================trf udara
Route::get('/trfudara','Trfudara\Trfudaracontroller@index');
Route::post('/trfudara','Trfudara\Trfudaracontroller@store');
Route::get('/trfudara/create','Trfudara\Trfudaracontroller@create');
Route::get('/trfudara/{id}','Trfudara\Trfudaracontroller@edit');
Route::put('/trfudara/{id}','Trfudara\Trfudaracontroller@update');
Route::get('/trfudara/{id}/delete','Trfudara\Trfudaracontroller@destroy');
//==============================================trf darat
Route::get('/trfdarat','Trfdarat\Trf_daratcontroller@index');
Route::post('/trfdarat','Trfdarat\Trf_daratcontroller@store');
Route::get('/trfdarat/create','Trfdarat\Trf_daratcontroller@create');
Route::get('/trfdarat/{id}','Trfdarat\Trf_daratcontroller@edit');
Route::put('/trfdarat/{id}','Trfdarat\Trf_daratcontroller@update');
Route::get('/trfdarat/{id}/delete','Trfdarat\Trf_daratcontroller@destroy');
//===============================================trf laut
Route::get('/trflaut','Trf_laut\Trf_lautcontroller@index');
Route::post('/trflaut','Trf_laut\Trf_lautcontroller@store');
Route::get('/trflaut/create','Trf_laut\Trf_lautcontroller@create');
Route::get('/trflaut/{id}','Trf_laut\Trf_lautcontroller@edit');
Route::put('/trflaut/{id}','Trf_laut\Trf_lautcontroller@update');
Route::get('/trflaut/{id}/delete','Trf_laut\Trf_lautcontroller@destroy');
//===============================================vendor
Route::get('/vendor','Vendor\Vendorcontroller@index');
Route::post('/vendor','Vendor\Vendorcontroller@store');
Route::get('/vendor/create','Vendor\Vendorcontroller@create');
Route::get('/vendor/{id}','Vendor\Vendorcontroller@edit');
Route::put('/vendor/{id}','Vendor\Vendorcontroller@update');
Route::get('/vendor/{id}/delete','Vendor\Vendorcontroller@destroy');
//================================================udara kargo
Route::get('/udrkargo','Udrcargo\Udrcargocontroller@index');
Route::post('/udrkargo','Udrcargo\Udrcargocontroller@store');
Route::get('/udrkargo/create','Udrcargo\Udrcargocontroller@create');
Route::get('/udrkargo/{id}','Udrcargo\Udrcargocontroller@edit');
Route::put('/udrkargo/{id}','Udrcargo\Udrcargocontroller@update');
Route::get('/udrkargo/{id}/delete','Udrcargo\Udrcargocontroller@destroy');
//==============================================================Login
Route::get('/login','Login\Logincontroller@index');
Route::post('/login/masuk','Login\Logincontroller@masuk');
Route::get('/login/logout','Login\Logincontroller@logout');
