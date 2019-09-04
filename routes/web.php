<?php
use Illuminate\Support\Facades\Input;
//================================================transit
Route::get('selesaitransit/{kode}','transit\transitcontroller@selesaitransit');
Route::post('simpantransit','transit\transitcontroller@store');
Route::get('cariresisj/{id}','transit\transitcontroller@cariresisj');
Route::get('carisuratjln/{id}','transit\transitcontroller@caridetailsj');
Route::get('carisuratjln','transit\transitcontroller@carisuratjalan');
Route::get('tambahtransit','transit\transitcontroller@create');
Route::get('listtransit','transit\transitcontroller@index');
//==============================================penerimaan
Route::get('listpenerimaan','penerimaan\penerimaancontroller@index');
Route::get('terimasuratjalan/{kode}','penerimaan\penerimaancontroller@terima');
//============================================ envoice
Route::post('/hapuslistenv','envoice\envoicecontroller@delete');
Route::get('/carisuratenvoice','envoice\envoicecontroller@cari');
Route::post('/tambahkanenv','envoice\envoicecontroller@store');
Route::get('/hapusdetailen/{id}','envoice\envoicecontroller@hapusdetail');
Route::get('/caridetailen/{id}','envoice\envoicecontroller@caridetail');
Route::post('/tambahdetailen','envoice\envoicecontroller@tambahdetail');
Route::get('/carinoresicmp','envoice\envoicecontroller@cariresi');
Route::get('/carimitra/{id}','envoice\envoicecontroller@caridetailmitra');
Route::get('/carimitra','envoice\envoicecontroller@carimitra');
Route::get('carikodeenvoice','envoice\envoicecontroller@carikode');
Route::get('envoice','envoice\envoicecontroller@index');
Route::get('envoice/tambah','envoice\envoicecontroller@create');
//============================================mitra
Route::resource('mitra','mitra\mitracontroller');
//=============================================tarif_citykurier
Route::post('/trfcity/hapuspilihan','trfcity\trf_city@haphapus');
Route::get('/trfcity/hapussemua','trfcity\trf_city@hapusall');
Route::get('/caritrfcity','trfcity\trf_city@caridata');
Route::get('trfcity/importexcel','trfcity\trf_city@importexcel');
Route::get('trfcity/downloadtemplate','trfcity\trf_city@downloadtemplate');
Route::post('/trfcity/prosesimportexcel','trfcity\trf_city@prosesimportexcel');
Route::get('trfcity/exporttarif','trfcity\trf_city@exporttarif');
Route::resource('/trfcity','trfcity\trf_city');


//=============================================cabang
Route::resource('/cabang','cabang\cabangcontroller');
Route::get('/exsportcabang','cabang\cabangcontroller@exsportdata');

//==============================================antaran
Route::post('/updateinputpod','Antaran\antarancontroller@updateinputpod');
Route::get('/carinoresipod','Antaran\antarancontroller@carinoresipod');
Route::get('/inputpod','Antaran\antarancontroller@inputpod');
Route::get('/tambahantaran','Antaran\antarancontroller@create');
Route::get('/listantaran','Antaran\antarancontroller@index');
Route::get('/carikodeantar','Antaran\antarancontroller@carikode');
Route::get('/caridetailsa/{kode}','Antaran\antarancontroller@caridetail');
Route::get('/caripengirimpa','Antaran\antarancontroller@caripengirim');
Route::get('/caripengirimpa/{id}','Antaran\antarancontroller@caridetailpengirim');
Route::get('/carinoresisa','Antaran\antarancontroller@carinoresi');
Route::post('/tambahdetailsa','Antaran\antarancontroller@tambahdetail');
Route::get('/hapusdetailsa/{id}','Antaran\antarancontroller@hapusdetail');
Route::post('/tambahkansa','Antaran\antarancontroller@simpansa');
Route::post('/hapuslistsa','Antaran\antarancontroller@hapus');
Route::get('/detailsa/{id}','Antaran\antarancontroller@detail');
Route::get('/resisuratantar','Antaran\antarancontroller@resiantar');
Route::post('/suksesantar/{id}/{kode}','Antaran\antarancontroller@suksesantar');
Route::post('/cancelresiantar','Antaran\antarancontroller@cancelresiantar');
Route::get('/carisuratantar','Antaran\antarancontroller@carisuratantar');
Route::get('/cariresisuratantar','Antaran\antarancontroller@cariresisuratantar');
Route::get('/returresi/{id}/{kode}','Antaran\antarancontroller@returresi');
Route::get('/resiretur','Antaran\antarancontroller@listretur');
Route::get('/returresinya/{id}','Antaran\antarancontroller@returresinya');

//=======================================================armada
Route::get('/hapuspajakunit/{id}','Armada\Armadacontroller@hapuspajakunit');
Route::post('/tambahpajakunit','Armada\Armadacontroller@tambahpajakunit');
Route::post('/editpajakunit','Armada\Armadacontroller@editpajakunit');
Route::post('/pajakarmada','Armada\Armadacontroller@aksibayarpajak');
Route::get('armada/{id}/bayarpajak','Armada\Armadacontroller@bayarpajak');
Route::get('/armada/{id}/delete','Armada\Armadacontroller@delete');
Route::put('/armada/{id}','Armada\Armadacontroller@update');
Route::get('/armada/{id}/edit','Armada\Armadacontroller@edit');
Route::post('/armada','Armada\Armadacontroller@store');
Route::get('/armada','Armada\Armadacontroller@index');
Route::get('/armada/create','Armada\Armadacontroller@create');

//==============================================pajak
Route::resource('/pajak','pajak\pajakcontroller');
// Route::get('/pajak','pajak\pajakcontroller@tampil');
// Route::get('/printpajak/{tahunya}','pajak\pajakcontroller@cetakpajak');
//===============================================pengeluaran lain
Route::resource('/pengeluaranlain','pengeluaranlain\pengeluaranlainController');
//===============================================Modal Usaha
Route::resource('/modal','modal\modalController');

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
Route::get('/printomset','omset\omsetController@cetakomset');
//----------------------------export omset
Route::get('/omset/export','omset\omsetController@export');
//================================================neraca
Route::get('/neraca','neraca\NeracaController@index'); 
Route::get('/tampilneraca','neraca\NeracaController@tampilneraca');
Route::get('/tampilneracathn','neraca\NeracaController@tampilneracathn');
Route::get('/printneraca/{tgl}','neraca\NeracaController@cetakneraca');

//================================================resi pengiriman
Route::post('updatepembayaran','resipengiriman\resipengirimanController@aksiupdatepembayaran');
Route::get('carinoresibelumlunas','resipengiriman\resipengirimanController@carinoresibelumlunas');
Route::get('updatepembayaranresi','resipengiriman\resipengirimanController@updatepembayaran');
Route::get('/listpengirimanbatal','resipengiriman\resipengirimanController@listpengirimanbatal');
Route::get('/batalpengiriman/{id}','resipengiriman\resipengirimanController@batalpengiriman');
Route::post('/simpanubahlaut','resipengiriman\resipengirimanController@simpanubahlaut');
Route::post('/simpanubahdarat','resipengiriman\resipengirimanController@simpanubahdarat');
Route::post('/simpanubahudara','resipengiriman\resipengirimanController@simpanubahudara');
Route::get('/editresi/{id}','resipengiriman\resipengirimanController@editdataresi');

Route::get('/cariresipengiriman','resipengiriman\resipengirimanController@caridataresi');
Route::post('/tambahsmu','resipengiriman\resipengirimanController@tambahnosmu');
Route::get('/resipengirimanudara','resipengiriman\resipengirimanController@resiudara');
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
Route::get('/carikotacity','resipengiriman\resipengirimanController@carikotacity');
Route::get('/carikotacitycmd','resipengiriman\resipengirimanController@carikotacitycmd');
Route::get('/carilaut','resipengiriman\resipengirimanController@carilaut');
Route::get('/carihasiludara/{id}','resipengiriman\resipengirimanController@carihasiludara');
Route::get('/cariudara','resipengiriman\resipengirimanController@cariudara');
Route::get('/resipengirimandarat','resipengiriman\resipengirimanController@residarat');

Route::get('/resicitykurier','resipengiriman\resipengirimanController@resicitykurier');
Route::get('/resicitykuriercompany','resipengiriman\resipengirimanController@resicitykuriercmp');
//resicitykurier
Route::post('/simpanlaut','resipengiriman\resipengirimanController@simpanlaut');
Route::post('/simpanudara','resipengiriman\resipengirimanController@simpanudara');
Route::get('/resipengirimanlaut','resipengiriman\resipengirimanController@resilaut');
Route::post('simpancity','resipengiriman\resipengirimanController@tambahcity');
Route::post('simpancitycmp','resipengiriman\resipengirimanController@tambahcitycmp');
Route::post('simpanubahck','resipengiriman\resipengirimanController@simpancity');
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
Route::get('/caricabangsj','suratjalan\suratjalanController@caricabangsj');
Route::get('/carivendor/{id}','suratjalan\suratjalanController@hasilvendor');
Route::get('/caricabangsj/{id}','suratjalan\suratjalanController@hasilcabang');
Route::get('/buatsuratjalan','suratjalan\suratjalanController@index');
Route::get('/buatsuratjalancabang','suratjalan\suratjalanController@buatsuratjalancabang');

//=====================================================laporan
Route::get('/tampillaporanpengeluaran','laporan\laporanController@tampilpengeluaran');
Route::get('/laporanpengeluaran','laporan\laporanController@pilihpengeluaran'); 
Route::get('/laporanpengeluarangjkw','laporan\laporanController@pilihpengeluarangajikaryawan'); 
Route::get('/tampillaporanpengeluarangjkw','laporan\laporanController@tampilpengeluarangjkw');
Route::get('/printlaporangpengeluaranjkw/{tglnya}/{kodejabatan}','laporan\laporanController@cetakpengeluarangjkw');
Route::get('/printslipgajikaryawan/{tglnya}/{kodejabatan}','laporan\laporanController@cetakslipgjkw');

Route::get('/laporanpengeluaranlainya','laporan\laporanController@pilihpengeluaranlain');
Route::get('/tampillaporanpengeluaranlain','laporan\laporanController@tampilpengeluaranlain');

Route::get('/tampillaporanpemasukan','laporan\laporanController@tampilpemasukan');
Route::get('/laporanpemasukan','laporan\laporanController@pilihpemasukan');
//-----------hari
Route::get('/tampillaporanpemasukanharian','laporan\laporanController@tampilpemasukanhari');
Route::get('/tampillaporanpengeluaranharian','laporan\laporanController@tampilpengeluaranhari');
Route::get('/tampillaporanpengeluarangjkwharian','laporan\laporanController@tampilpengeluarangjkwhari');
//---------------------------------------------------cetak && export Laporan
Route::get('/printpemasukan/{habu}/{bulanya}/{jalur}','laporan\laporanController@cetakpemasukan');
Route::get('/printpengeluaranlainya/{habu}/{bulanya}/{kategori}','laporan\laporanController@cetaklaporanpengeluaranlain');
Route::get('/printlaporanpengeluaran/{habu}/{bulanya}/{vendor}','laporan\laporanController@cetakpengeluaran');

Route::get('/export_laporan_pemasukan/{habu}/{bulanya}/{jalur}','laporan\laporanController@exsportlaporanpemasukan');
Route::get('/export_laporan_pengeluaran_lain/{habu}/{bulanya}/{kategori}','laporan\laporanController@exsportlaporanpengeluaranlain');
Route::get('/export_laporan_pengeluaran_vendor/{habu}/{bulanya}/{vendor}','laporan\laporanController@exsportlaporanpengluaranvendor');
Route::get('/export_laporan_pengeluaran_gaji_karyawan/{bulanya}/{jabatan}','laporan\laporanController@exsportlaporanpengluarangjkw');

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
Route::get('/caritujuan/{id}','landingdarat\landingdaratcontroller@caritujuan');
Route::get('/caritujuanlaut/{id}','landinglaut\landinglautcontroller@caritujuan');
Route::get('/caritujuankurir/{id}','landingkurir\landingkurircontroller@caritujuan');
Route::get('/caritujuanudara/{id}','landingudara\landingudaracontroller@caritujuan');
Route::get('/landudara/cari','landingudara\landingudaracontroller@pencarian');
Route::get('/landkurir' , 'landingkurir\landingkurircontroller@index');
Route::get('/landkurir/cari','landingkurir\landingkurircontroller@pencarian');
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
//Route::post('/trfdarat/delete','Trfdarat\Trf_daratcontroller@destroy');
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
// Route::post('/trflaut/delete','Trf_laut\Trf_lautcontroller@destroy');
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
Route::post('/simpanmanualcity','Manual\Manualcontroller@simpancity');
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
Route::post('/tamabsensel','Absensi\AbsensiController@tambahabsenselesai');
Route::get('/pilihabsensi','Absensi\AbsensiController@pilihabsensi');
Route::get('/tampilabsensiharian','Absensi\AbsensiController@tampilabsenharian');
Route::get('/tampilabsensibulanan','Absensi\AbsensiController@tampilabsenbulanan');
//---------------------------------------------------export absensi
Route::get('/export_absensi_harian/{tanggal}/{jabatan}','Absensi\AbsensiController@exsportabsensiharian');
Route::get('/printabsensiharian/{tanggal}/{kodejabatan}','Absensi\AbsensiController@cetakabsensihrian');
Route::get('/export_absensi_bulanan/{tanggal}/{jabatan}','Absensi\AbsensiController@exsportabsensibulanan');
Route::get('/printabsensibulanan/{tanggal}/{kodejabatan}','Absensi\AbsensiController@cetakabsensibulanan');
//==============================================================Kategori akutansi
Route::get('/kat_akut','Kategoriakutansi\Kategoriakutansicontroller@index');
Route::get('/kat_akut/create','Kategoriakutansi\Kategoriakutansicontroller@create');
Route::post('/kat_akut','Kategoriakutansi\Kategoriakutansicontroller@store');
Route::get('/kat_akut/{id}/edit','Kategoriakutansi\Kategoriakutansicontroller@edit');
Route::put('/kat_akut/{id}','Kategoriakutansi\Kategoriakutansicontroller@update');
Route::post('/kat_akut/delete','Kategoriakutansi\Kategoriakutansicontroller@destroy');
//===========================================================laporan akutansi
// Route::get('/lapakun','Laporakun/LaporakunController@index');
Route::get('/laporakun','Laporakun\LaporakunController@pilihlapkun');
Route::get('/tampillaporanakun','Laporakun\LaporakunController@tampilakunlapor');
Route::get('/laporakundet','Laporakun\LaporakunDetController@pilihlapkun');
Route::get('/tampillaporanakundet','Laporakun\LaporakunDetController@tampilakunlapor');

Route::get('/printlapoakun/{kat}/{tgl}/{tgl0}','Laporakun\LaporakunController@cetaklapakun');
Route::get('/printlapoakundet/{kate}/{kh}/{tgl}/{tgl0}','Laporakun\LaporakunDetController@cetaklapakundet');
Route::get('pembukuan','pembukuan\PembukuanController@index');
Route::get('pembukuan-transfer','pembukuan\PembukuanController@showtf');
//===========================================================Laba Rugi
Route::get('/labarugi','Labarugi\LabarugiController@pilihlapkun');
Route::get('/tampillabarugi','Labarugi\LabarugiController@tampilakunlapor');
Route::get('/labarugi','Labarugi\LabarugiController@pilihllaba');
Route::get('/tampillabarugi','Labarugi\LabarugiController@tampillaba');
Route::get('/tampillabarugithn','Labarugi\LabarugiController@tampillabathn');

Route::get('/printlabarugi/{tgl}','Labarugi\LabarugiController@cetaklaba');
//===============================================================penyusutan
Route::get('/nyusut','Penyusutan\Penyusutancontroller@index');
Route::get('/nyusut/create','Penyusutan\Penyusutancontroller@create');
Route::post('/nyusut','Penyusutan\Penyusutancontroller@store');
Route::get('/nyusut/{id}/edit','Penyusutan\Penyusutancontroller@edit');
Route::put('/nyusut/{id}','Penyusutan\Penyusutancontroller@update');
Route::post('/nyusut/delete','Penyusutan\Penyusutancontroller@destroy');











