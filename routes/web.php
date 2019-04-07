<?php
use Illuminate\Support\Facades\Input;
<<<<<<< HEAD

=======
//==============================================armada
Route::post('/pajakarmada','Armada\Armadacontroller@aksibayarpajak');
Route::get('armada/{id}/bayarpajak','Armada\Armadacontroller@bayarpajak');
Route::get('/armada/{id}/delete','Armada\Armadacontroller@delete');
Route::put('/armada/{id}','Armada\Armadacontroller@update');
Route::get('/armada/{id}/edit','Armada\Armadacontroller@edit');
Route::post('/armada','Armada\Armadacontroller@store');
Route::get('/armada','Armada\Armadacontroller@index');
Route::get('/armada/create','Armada\Armadacontroller@create');
>>>>>>> master
//==============================================pajak
Route::get('/pajak','pajak\pajakcontroller@index');
Route::get('/tampilpajak','pajak\pajakcontroller@tampil');
Route::get('/printpajak/{tahunya}','pajak\pajakcontroller@cetakpajak');
//==============================================backup
Route::get('/selesai','backup\backupController@selesai');
Route::get('/printomset/{bulan}/{tahun}','backup\backupController@cetakomset');
Route::get('/exsportomset/{bulan}/{tahun}','backup\backupController@exsportomset');
Route::get('/hapuspengeluaranlain/{bulan}/{tahun}','backup\backupController@hapuspengeluaranlain');
Route::get('/printpengeluaranlain/{bulan}/{tahun}','backup\backupController@cetakpengeluaranlain');
Route::get('/exsportpengeluaranlain/{bulan}/{tahun}','backup\backupController@exsportpengeluaranlain');
Route::get('/hapuspengeluaran/{bulan}/{tahun}','backup\backupController@hapuspengeluaran');
Route::get('/printpengeluaran/{bulan}/{tahun}','backup\backupController@cetakpengeluaran');
Route::get('/exsportpengeluaran/{bulan}/{tahun}','backup\backupController@exsportpengeluaran');
Route::get('/selanjutnya','backup\backupController@selanjutnya');
Route::get('/hapuspendapatan/{bulan}/{tahun}','backup\backupController@hapuspendapatan');
Route::get('/backup','backup\backupController@index');
Route::get('/tampilbackup','backup\backupController@tampil');
Route::get('/printpendapatan/{bulan}/{tahun}','backup\backupController@cetakpendapatan');
Route::get('/exsportpendapatan/{bulan}/{tahun}','backup\backupController@exsportpendapatan');
Route::get('/exsporgajikaryawan/{bulan}/{tahun}','backup\backupController@exsporgjkw');
Route::get('/printgajikaryawan/{bulan}/{tahun}','backup\backupController@cetakgjkw');
Route::get('/hapusgajikaryawan/{bulan}/{tahun}','backup\backupController@hapusgjkw');
//==============================================omset
Route::get('/omset','omset\omsetController@index');
Route::get('/printomset','omset\omsetController@cetakomset');
//----------------------------export omset
Route::get('/omset/export','omset\omsetController@export');

//===============================================pengeluaran lain
Route::resource('/pengeluaranlain','pengeluaranlain\pengeluaranlainController');

//================================================resi pengiriman
Route::get('/listpengirimanbatal','resipengiriman\resipengirimanController@listpengirimanbatal');
Route::get('/batalpengiriman/{id}','resipengiriman\resipengirimanController@batalpengiriman');
Route::post('/simpanubahlaut','resipengiriman\resipengirimanController@simpanubahlaut');
Route::post('/simpanubahdarat','resipengiriman\resipengirimanController@simpanubahdarat');
Route::post('/simpanubahudara','resipengiriman\resipengirimanController@simpanubahudara');
Route::get('/editresi/{id}','resipengiriman\resipengirimanController@editdataresi');
Route::get('/cariresipengiriman','resipengiriman\resipengirimanController@caridataresi');
Route::post('/tambahsmu','resipengiriman\resipengirimanController@tambahnosmu');
Route::get('/resipengirimanudara','resipengiriman\resipengirimanController@resiudara');
Route::get('/uangkembali/{id}','resipengiriman\resipengirimanController@uangkembali');
Route::get('/resikembali/{id}','resipengiriman\resipengirimanController@resikembali');
Route::get('/carilistresi/{id}','resipengiriman\resipengirimanController@carilistresi');

Route::get('/cariresipengiriman_smukosong','resipengiriman\resipengirimanController@caridataresi_smukosong');
Route::get('/listpengiriman_smukosong','resipengiriman\resipengirimanController@tampilsmukosong');
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
Route::get('/resisuratjalan','suratjalan\suratjalanController@resisuratjalan');
Route::get('/bayarsuratjalan/{id}','suratjalan\suratjalanController@bayarsuratjalan');
Route::get('/cariresisuratjalan','suratjalan\suratjalanController@cariresidata');
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
Route::get('/printlaporanpengeluaran/{bulanya}/{vendor}','laporan\laporanController@cetakpengeluaran');
Route::get('/laporanpengeluarangjkw','laporan\laporanController@pilihpengeluarangajikaryawan'); 
Route::get('/tampillaporanpengeluarangjkw','laporan\laporanController@tampilpengeluarangjkw');
Route::get('/printlaporangpengeluaranjkw/{tglnya}/{kodejabatan}','laporan\laporanController@cetakpengeluarangjkw');
Route::get('/laporanpengeluaranlainya','laporan\laporanController@pilihpengeluaranlain');
Route::get('/tampillaporanpengeluaranlain','laporan\laporanController@tampilpengeluaranlain');
Route::get('/printpengeluaranlainya/{bulanya}/{kategori}','laporan\laporanController@cetaklaporanpengeluaranlain');
Route::get('/tampillaporanpemasukan','laporan\laporanController@tampilpemasukan');
Route::get('/laporanpemasukan','laporan\laporanController@pilihpemasukan');
Route::get('/printpemasukan/{bulanya}/{jalur}','laporan\laporanController@cetakpemasukan');
//---------------------------------------------------export Laporan
Route::get('/export_laporan_pemasukan/{bulanya}/{jalur}','laporan\laporanController@exsportlaporanpemasukan');
Route::get('/export_laporan_pengeluaran_vendor/{bulanya}/{vendor}','laporan\laporanController@exsportlaporanpengluaranvendor');
Route::get('/export_laporan_pengeluaran_gaji_karyawan/{bulanya}/{jabatan}','laporan\laporanController@exsportlaporanpengluarangjkw');
Route::get('/export_laporan_pengeluaran_lain/{bulanya}/{kategori}','laporan\laporanController@exsportlaporanpengeluaranlain');

//===========================================
Route::post('/login/bukakunci','Login\Logincontroller@bukakunci');
Route::get('/lockscreen','Login\Logincontroller@lockscreen');
Route::get('/login','Login\Logincontroller@index');
Route::get('/refreshcaptcha','Login\Logincontroller@refreshCaptcha');
Route::get('/','landing\landingcontroller@index');
Route::get('/landdarat','landingdarat\landingdaratcontroller@index');
Route::get('/landdarat/cari','landingdarat\landingdaratcontroller@pencarian');
Route::get('/landlaut','landinglaut\landinglautcontroller@index');
Route::get('/landlaut/cari','landinglaut\landinglautcontroller@pencarian');
Route::get('/landudara','landingudara\landingudaracontroller@index');
Route::get('/carimaskapai/{kode}','landingudara\landingudaracontroller@carimaskapai');
Route::get('/landudara/cari','landingudara\landingudaracontroller@pencarian');
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
Route::post('/trfudara/hapuspilihan','Trfudara\Trfudaracontroller@haphapus');
Route::get('/trfudara/hapussemua','Trfudara\Trfudaracontroller@hapusall');
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
Route::post('/trfdarat/hapuspilihan','Trfdarat\Trf_daratcontroller@haphapus');
Route::get('/trfdarat/{id}/delete','Trfdarat\Trf_daratcontroller@hapus');
Route::get('/trfdarat/hapussemua','Trfdarat\Trf_daratcontroller@hapusall');
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
Route::post('/trflaut/hapuspilihan','Trf_laut\Trf_lautcontroller@haphapus');
Route::get('/trflaut/hapussemua','Trf_laut\Trf_lautcontroller@hapusall');
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
//==============================================================Karyawan
Route::get('/karyawan','Karyawan\Karyawancontroller@index');
Route::post('/karyawan','Karyawan\Karyawancontroller@store');
Route::get('/karyawan/create','Karyawan\Karyawancontroller@create');
Route::get('/karyawan/{id}/edit','Karyawan\Karyawancontroller@edit');
Route::put('/karyawan/{id}','Karyawan\Karyawancontroller@update');
Route::post('/karyawan/delete','Karyawan\Karyawancontroller@destroy');
Route::get('karyawan/cari','Karyawan\Karyawancontroller@caridata');
//------------------------export import 
Route::get('/karyawan/importexcel','Karyawan\Karyawancontroller@importexcel');
Route::post('/karyawan/prosesimportexcel','Karyawan\Karyawancontroller@prosesimportexcel');
Route::get('/karyawan/karyawanexport','Karyawan\Karyawancontroller@exsportexcel');
Route::get('/karyawan/downlod','Karyawan\Karyawancontroller@downloadtemplatejbt');
Route::get('/karyawan/download','Karyawan\Karyawancontroller@downloadtemplate');
//==============================================================resi manual
Route::get('/manualbatal','Manual\Manualcontroller@manualbatal');
Route::post('/simpanmanualdarat','Manual\Manualcontroller@simpandarat');
Route::post('/simpanmanuallaut','Manual\Manualcontroller@simpanlaut');
Route::post('/simpanmanualudara','Manual\Manualcontroller@simpanudara');
Route::get('/Manual','Manual\Manualcontroller@index');
Route::post('/Manual','Manual\Manualcontroller@store');
Route::get('/Manual/create','Manual\Manualcontroller@create');
Route::get('/Manual/{id}/edit','Manual\Manualcontroller@edit');
Route::get('/Manual/{id}/ubah','Manual\Manualcontroller@ubah');
Route::put('/Manual/{id}','Manual\Manualcontroller@update');
Route::post('/Manual/delete','Manual\Manualcontroller@destroy');
Route::post('/Manual/hapuspilihan','Manual\Manualcontroller@haphapus');
Route::get('/Manual/cari','Manual\Manualcontroller@caridata');
Route::get('/manual_smukosong','Manual\Manualcontroller@tampilmanualsmukosong');
Route::get('/carismukos','Manual\Manualcontroller@carismukosong');
//---------------------------------export import
Route::get('/Manual/importexcel','Manual\Manualcontroller@importexcel');
Route::post('/Manual/prosesimportexcel','Manual\Manualcontroller@prosesimportexcel');
Route::get('/Manual/download','Manual\Manualcontroller@downloadtemplate');
Route::get('/Manual/downloadkaryawan','Manual\Manualcontroller@dowloadkaryawan');
//==============================================================jabatan
Route::get('/jabatan','Jabatan\Jabatancontroller@index');
Route::post('/jabatan','Jabatan\Jabatancontroller@store');
Route::get('/jabatan/create','Jabatan\Jabatancontroller@create');
Route::get('/jabatan/{id}/edit','Jabatan\Jabatancontroller@edit');
Route::put('/jabatan/{id}','Jabatan\Jabatancontroller@update');
Route::post('/jabatan/delete','Jabatan\Jabatancontroller@destroy');
//==============================================================kategori barang //spesial cargo
Route::get('/kat_bar','Katbar\Katbarcontroller@index');
Route::post('/kat_bar','Katbar\Katbarcontroller@store');
Route::get('/kat_bar/create','Katbar\Katbarcontroller@create');
Route::get('/kat_bar/{id}/edit','Katbar\Katbarcontroller@edit');
Route::put('/kat_bar/{id}','Katbar\Katbarcontroller@update');
Route::post('/kat_bar/delete','Katbar\Katbarcontroller@destroy');
//=======================================================Absensi
Route::get('/absen','Absensi\AbsensiController@index');
Route::post('/tamabsen','Absensi\AbsensiController@tambahdataabsen');

Route::get('/pilihabsensiharian','Absensi\AbsensiController@pilihabsenhari'); 
Route::get('/pilihabsensibulanan','Absensi\AbsensiController@pilihabsenbulan'); 
Route::get('/tampilabsensiharian','Absensi\AbsensiController@tampilabsenharian');
Route::get('/tampilabsensibulanan','Absensi\AbsensiController@tampilabsenbulanan');

//---------------------------------------------------export absensi
Route::get('/export_absensi_harian/{tanggal}/{jabatan}','Absensi\AbsensiController@exsportabsensiharian');
Route::get('/printabsensiharian/{tanggal}/{kodejabatan}','Absensi\AbsensiController@cetakabsensihrian');

Route::get('/export_absensi_bulanan/{tanggal}/{jabatan}','Absensi\AbsensiController@exsportabsensibulanan');
Route::get('/printabsensibulanan/{tanggal}/{kodejabatan}','Absensi\AbsensiController@cetakabsensibulanan');
