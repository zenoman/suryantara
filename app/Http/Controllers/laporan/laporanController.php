<?php

namespace App\Http\Controllers\laporan;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Exports\LaporanPemasukanExport;
use App\Exports\LaporanPengeluaranVendorExport;
use App\Exports\LaporanPengeluaranGajiKaryawanExport;
use App\Exports\LaporanPengeluaranLainExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;


class laporanController extends Controller{
    public function tampilpengeluaran(Request $request){
        $rules = [
            'bulan' => 'required',
                ];
         $customMessages = [
        'required'  => 'Maaf, Bulan Tidak Bokeh Kosong',
         ];
        $this->validate($request,$rules,$customMessages);
        $vendor = $request->vendor;
        $bulan = explode('-', $request->bulan);
        $bln = $bulan[0];
        $thn = $bulan[1];
        if($vendor=='semua'){
            $data = DB::table('resi_pengiriman')
            ->select(DB::raw('resi_pengiriman.*,surat_jalan.tujuan,surat_jalan.kode,surat_jalan.biaya'))
            ->leftjoin('surat_jalan','surat_jalan.kode','=','resi_pengiriman.kode_jalan')
            ->where('resi_pengiriman.tgl_bayar','!=',NULL)
            ->whereMonth('tgl_bayar',$bln)
            ->whereYear('tgl_bayar',$thn)
            ->orderby('tgl_bayar','desc')
            ->paginate(40);
            
            $data2 = DB::table('resi_pengiriman')
            ->select(DB::raw('resi_pengiriman.*,surat_jalan.tujuan,surat_jalan.kode'))
            ->leftjoin('surat_jalan','surat_jalan.kode','=','resi_pengiriman.kode_jalan')
            ->where('resi_pengiriman.tgl_bayar','!=',NULL)
            ->whereMonth('tgl_bayar',$bln)
            ->whereYear('tgl_bayar',$thn)
            ->orderby('tgl_bayar','desc')
            ->get();

            $total = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(biaya_suratjalan) as totalnya'))
            ->where('resi_pengiriman.tgl_bayar','!=',NULL)
            ->whereMonth('tgl_bayar',$bln)
            ->whereYear('tgl_bayar',$thn)
            ->get();

        }else{
             $data = DB::table('resi_pengiriman')
            ->select(DB::raw('resi_pengiriman.*,surat_jalan.tujuan,surat_jalan.kode'))
            ->leftjoin('surat_jalan','surat_jalan.kode','=','resi_pengiriman.kode_jalan')
            ->where([['resi_pengiriman.tgl_bayar','!=',NULL],['surat_jalan.tujuan','=',$vendor]])
            ->whereMonth('tgl_bayar',$bln)
            ->whereYear('tgl_bayar',$thn)
            ->orderby('tgl_bayar','desc')
            ->paginate(40);

             $data2 = DB::table('resi_pengiriman')
            ->select(DB::raw('resi_pengiriman.*,surat_jalan.tujuan,surat_jalan.kode'))
            ->leftjoin('surat_jalan','surat_jalan.kode','=','resi_pengiriman.kode_jalan')
            ->where([['resi_pengiriman.tgl_bayar','!=',NULL],['surat_jalan.tujuan','=',$vendor]])
            ->whereMonth('tgl_bayar',$bln)
            ->whereYear('tgl_bayar',$thn)
            ->orderby('tgl_bayar','desc')
            ->get();

             $total = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(resi_pengiriman.biaya_suratjalan) as totalnya'))
            ->leftjoin('surat_jalan','surat_jalan.kode','=','resi_pengiriman.kode_jalan')
            ->where([['resi_pengiriman.tgl_bayar','!=',NULL],['surat_jalan.tujuan','=',$vendor]])
            ->whereMonth('resi_pengiriman.tgl_bayar',$bln)
            ->whereYear('resi_pengiriman.tgl_bayar',$thn)
            ->get();
        }
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('laporan/pengeluaran',['data'=>$data,'title'=>$webinfo,'total'=>$total,'bulanya'=>$request->bulan,'vendor'=>$vendor,'data2'=>$data2,'data3'=>$data->appends(request()->input())]);
    }
    //============================================
    public function pilihpengeluaran(){
        $bulan = DB::table('resi_pengiriman')
        ->select(DB::raw('MONTH(resi_pengiriman.tgl_bayar) as bulan, YEAR(resi_pengiriman.tgl_bayar) as tahun,surat_jalan.tujuan'))
        ->leftjoin('surat_jalan','surat_jalan.kode','=','resi_pengiriman.kode_jalan')
        ->where('resi_pengiriman.tgl_bayar','!=',NULL)
        ->groupby('bulan')
        ->groupby('tahun')
        ->orderby('resi_pengiriman.tgl_bayar','desc')
        ->get();

        $vendor = DB::table('resi_pengiriman')
        ->select(DB::raw('resi_pengiriman.kode_jalan,surat_jalan.*'))
        ->leftjoin('surat_jalan','surat_jalan.kode','=','resi_pengiriman.kode_jalan')
        ->where('resi_pengiriman.tgl_bayar','!=',NULL)
        ->groupby('tujuan')
        ->get();
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('laporan/pilihpengeluaran',['title'=>$webinfo,'bulan'=>$bulan,'vendor'=>$vendor]);
    }
    //============================================gjkw
    public function pilihpengeluarangajikaryawan(){
        $ambilbulan = DB::table('gaji_karyawan')
        ->select('bulan','tahun')
        ->groupby('bulan')
        ->groupby('tahun')
        ->get();

        $jabatan =  DB::table('karyawan')
                ->select(DB::raw('karyawan.id_jabatan,jabatan.jabatan'))
                ->leftjoin('jabatan', 'jabatan.id', '=', 'karyawan.id_jabatan')
                ->groupby('karyawan.id_jabatan')
                ->get();
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('laporan/pilihpengeluarangjkw',['title'=>$webinfo,'bulan'=>$ambilbulan,'jabatan'=>$jabatan]);
    }
    //===============================================
    public function pilihpemasukan(){
    	$bulan = DB::table('resi_pengiriman')
    	->select(DB::raw('MONTH(tgl) as bulan, YEAR(tgl) as tahun'))
    	->groupby('bulan')
    	->groupby('tahun')
    	->orderby('tgl','desc')
    	->get();
        $harian = DB::table('resi_pengiriman')
        ->select(DB::raw('DAY(tgl) as tanggal,MONTH(tgl) as bulan, YEAR(tgl) as tahun'))
        ->groupby('tanggal')
        ->groupby('bulan')
        ->groupby('tahun')
        ->orderby('tgl','desc')
        ->get();
    	$webinfo = DB::table('setting')->limit(1)->get();
    	return view('laporan/pilihpemasukan',['title'=>$webinfo,'bulan'=>$bulan,'hari'=>$harian]);
    }
    //================================================
    public function tampilpemasukan(Request $request){
        $rules = [
            'bulan' => 'required',
                ];
         $customMessages = [
        'required'  => 'Maaf, Bulan Tidak Bokeh Kosong',
         ];
        $this->validate($request,$rules,$customMessages);

    	$jalur = $request->jalur;
    	$bulan = explode('-', $request->bulan);
    	$bln = $bulan[0];
    	$thn = $bulan[1];

    	if($jalur=='darat'){
    		$data = DB::table('resi_pengiriman')
    		->whereMonth('tgl',$bln)
    		->whereYear('tgl',$thn)
    		->where('pengiriman_via','darat')
            ->orderby('tgl','desc')
    		->paginate(40);
            $data2 = DB::table('resi_pengiriman')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('pengiriman_via','darat')
            ->orderby('tgl','desc')
            ->get();
    		$total = DB::table('resi_pengiriman')
    		->select(DB::raw('SUM(total_biaya) as totalnya'))
    		->whereMonth('tgl',$bln)
    		->whereYear('tgl',$thn)
    		->where('pengiriman_via','darat')
    		->get();
    	}elseif ($jalur=='laut') {
    		$data = DB::table('resi_pengiriman')
    		->whereMonth('tgl',$bln)
    		->whereYear('tgl',$thn)
    		->where('pengiriman_via','laut')
            ->orderby('tgl','desc')
    		->paginate(40);
            $data2 = DB::table('resi_pengiriman')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('pengiriman_via','laut')
            ->orderby('tgl','desc')
            ->get();
    		$total = DB::table('resi_pengiriman')
    		->select(DB::raw('SUM(total_biaya) as totalnya'))
    		->whereMonth('tgl',$bln)
    		->whereYear('tgl',$thn)
    		->where('pengiriman_via','laut')
    		->get();
    	}elseif ($jalur=='udara'){
    		$data = DB::table('resi_pengiriman')
    		->whereMonth('tgl',$bln)
    		->whereYear('tgl',$thn)
    		->where('pengiriman_via','udara')
            ->orderby('tgl','desc')
    		->paginate(40);
            $data2 = DB::table('resi_pengiriman')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('pengiriman_via','udara')
            ->orderby('tgl','desc')
            ->get();
    		$total = DB::table('resi_pengiriman')
    		->select(DB::raw('SUM(total_biaya) as totalnya'))
    		->whereMonth('tgl',$bln)
    		->whereYear('tgl',$thn)
    		->where('pengiriman_via','udara')
    		->get();
    	}else{
    		$data = DB::table('resi_pengiriman')
    		->whereMonth('tgl',$bln)
    		->whereYear('tgl',$thn)
            ->orderby('tgl','desc')
    		->paginate(40);
            $data2 = DB::table('resi_pengiriman')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->orderby('tgl','desc')
            ->get();
    		$total = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as totalnya'))
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->get();


    	}
    	$webinfo = DB::table('setting')->limit(1)->get();


    	return view('laporan/pemasukan',['title'=>$webinfo,'data'=>$data,'data2'=>$data2,'bulanya'=>$request->bulan,'total'=>$total,'jalur'=>$jalur,'data3'=>$data->appends(request()->input())]);
    }
    public function pilihpengeluaranlain(){
        $bulan = DB::table('pengeluaran_lain')
        ->select(DB::raw('MONTH(tgl) as bulan, YEAR(tgl) as tahun'))
        ->groupby('bulan')
        ->groupby('tahun')
        ->orderby('tgl','desc')
        ->get();

        $kategori = DB::table('pengeluaran_lain')
        ->groupby('kategori')
        ->get();
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('laporan/pilihpengeluaranlain',['title'=>$webinfo,'bulan'=>$bulan,'kategori'=>$kategori]);
    }
    public function tampilpengeluaranlain(Request $request){
        $rules = [
            'bulan' => 'required',
                ];
         $customMessages = [
        'required'  => 'Maaf, Bulan Tidak Bokeh Kosong',
         ];
        $this->validate($request,$rules,$customMessages);

        $kategori = $request->kategori;
        $bulan = explode('-', $request->bulan);
        $bln = $bulan[0];
        $thn = $bulan[1];

        if($kategori=='semua'){
            $data = DB::table('pengeluaran_lain')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->orderby('tgl','desc')
            ->paginate(40);
             $data2 = DB::table('pengeluaran_lain')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->orderby('tgl','desc')
            ->get();
            $total = DB::table('pengeluaran_lain')
            ->select(DB::raw('SUM(jumlah) as totalnya'))
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->get();
        }else{
            $data = DB::table('pengeluaran_lain')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('kategori',$kategori)
            ->orderby('tgl','desc')
            ->paginate(40);
            $data2 = DB::table('pengeluaran_lain')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('kategori',$kategori)
            ->orderby('tgl','desc')
            ->get();
            $total = DB::table('pengeluaran_lain')
            ->select(DB::raw('SUM(jumlah) as totalnya'))
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('kategori',$kategori)
            ->get();
        }
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('laporan/pengeluaranlain',['title'=>$webinfo,'data'=>$data,'total'=>$total,'kategori'=>$kategori,'bulanya'=>$request->bulan,'data2'=>$data2,'data3'=>$data->appends(request()->input())]);
    }
    //------------------------------------------------------------
    public function tampilpengeluarangjkw(Request $request){
        $rules = [
            'bulan' => 'required',
                ];
         $customMessages = [
        'required'  => 'Maaf, Bulan Tidak Bokeh Kosong',
         ];
        $this->validate($request,$rules,$customMessages);
        $namajabatan = $request->jabatan;
        $bulan = explode('-', $request->bulan);
        $bln = $bulan[0];
        $thn = $bulan[1];
        
        if($namajabatan=='semua'){
            $idjabatan = 'semua';
            $jabat = 'semua';
            $data = DB::table('gaji_karyawan')
            ->select(DB::raw('gaji_karyawan.*,jabatan.jabatan'))
            ->leftjoin('jabatan','jabatan.id','=','gaji_karyawan.id_jabatan')
            ->where([['bulan','=',$bln],['tahun','=',$thn]])
            ->paginate(40);

            $data2 = DB::table('gaji_karyawan')
            ->select(DB::raw('gaji_karyawan.*,jabatan.jabatan'))
            ->leftjoin('jabatan','jabatan.id','=','gaji_karyawan.id_jabatan')
            ->where([['bulan','=',$bln],['tahun','=',$thn]])
            ->get();

            $total = DB::table('gaji_karyawan')
            ->select(DB::raw('SUM(total) as totalnya'))
            ->where([['bulan','=',$bln],['tahun','=',$thn]])
            ->get();
        }else{
        $jabatan = explode('-', $request->jabatan);
        $idjabatan = $jabatan[0];
        $jabat = $jabatan[1];
        $data = DB::table('gaji_karyawan')
            ->select(DB::raw('gaji_karyawan.*,jabatan.jabatan'))
            ->leftjoin('jabatan','jabatan.id','=','gaji_karyawan.id_jabatan')
            ->where([['bulan','=',$bln],['tahun','=',$thn],['id_jabatan','=',$idjabatan]])
            ->paginate(40);

            $data2 = DB::table('gaji_karyawan')
            ->select(DB::raw('gaji_karyawan.*,jabatan.jabatan'))
            ->leftjoin('jabatan','jabatan.id','=','gaji_karyawan.id_jabatan')
            ->where([['bulan','=',$bln],['tahun','=',$thn],['id_jabatan','=',$idjabatan]])
            ->get();

            $total = DB::table('gaji_karyawan')
            ->select(DB::raw('SUM(total) as totalnya'))
            ->where([['bulan','=',$bln],['tahun','=',$thn],['id_jabatan','=',$idjabatan]])
            ->get();
        }
        $webinfo = DB::table('setting')->limit(1)->get();
    return view('laporan/pengeluarangajikaryawan',[
        'data'=>$data,'tglnya'=>$request->bulan,'title'=>$webinfo,'total'=>$total,'bulanya'=>$bln,'tahunya'=>$thn,'jabatan'=>$jabat,'data2'=>$data2,'kodejabatan'=>$idjabatan,'data3'=>$data->appends(request()->input())
    ]);
    }
    //-------------------------------------------------------------
    public function exsportlaporanpemasukan($bulannya, $jalur){
        $bulan = explode('-', $bulannya);
        $bln = $bulan[0];
        $thn = $bulan[1];

            if ($jalur !='semua') {
        $namafile = "Export laporan pemasukan bulan ".$bln." tahun ".$thn." di jalur ".$jalur.".xlsx";
            }else{
        $namafile = "Export laporan pemasukan bulan ".$bln." tahun ".$thn." di ".$jalur." jalur.xlsx";
            }
        return Excel::download(new LaporanPemasukanExport($bln,$thn,$jalur),$namafile);

    }
    public function exsportlaporanpengluaranvendor($bulannya, $vendor){
        $bulan = explode('-', $bulannya);
        $bln = $bulan[0];
        $thn = $bulan[1];
        if ($vendor !='semua') {
            $namafile = "Export laporan pengeluaran bulan ".$bln." tahun ".$thn." vendor ".$vendor.".xlsx";
        }else{
            $namafile = "Export laporan pengeluaran bulan ".$bln." tahun ".$thn." di ".$vendor." vendor.xlsx";
        }
        return Excel::download(new LaporanPengeluaranVendorExport($bln,$thn,$vendor),$namafile);
    }
        public function exsportlaporanpengluarangjkw($bulannya, $jabatan){
        $bulan = explode('-', $bulannya);
        $bln = $bulan[0];
        $thn = $bulan[1];
        $namafile = "Export laporan pengeluaran gaji karyawan bulan ".$bln." tahun ".$thn.".xlsx";
        
        return Excel::download(new LaporanPengeluaranGajiKaryawanExport($bln,$thn,$jabatan),$namafile);
    }
        public function exsportlaporanpengeluaranlain($bulannya, $kategori){
        $bulan = explode('-', $bulannya);
        $bln = $bulan[0];
        $thn = $bulan[1];
        if ($kategori !='semua') {
            $namafile = "Export laporan pengeluaran lain bulan ".$bln." tahun ".$thn." dengan kategori ".$kategori.".xlsx";
        }else{
            $namafile = "Export laporan pengeluaran lain bulan ".$bln." tahun ".$thn." di ".$kategori." kategori.xlsx";
        }
        return Excel::download(new LaporanPengeluaranLainExport($bln,$thn,$kategori),$namafile);

    }
//=======================================================================cetak pemasukan
    public function cetakpemasukan($bulanya, $jalur){

        // $jalur = $jalur;
        $bulan = explode('-', $bulanya);
        $bln = $bulan[0];
        $thn = $bulan[1];

        if($jalur=='darat'){
            $data = DB::table('resi_pengiriman')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('pengiriman_via','darat')
            ->orderby('tgl','desc')
            ->paginate(40);
            $data2 = DB::table('resi_pengiriman')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('pengiriman_via','darat')
            ->orderby('tgl','desc')
            ->get();
            $total = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as totalnya'))
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('pengiriman_via','darat')
            ->get();
        }elseif ($jalur=='laut') {
            $data = DB::table('resi_pengiriman')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('pengiriman_via','laut')
            ->orderby('tgl','desc')
            ->paginate(40);
            $data2 = DB::table('resi_pengiriman')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('pengiriman_via','laut')
            ->orderby('tgl','desc')
            ->get();
            $total = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as totalnya'))
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('pengiriman_via','laut')
            ->get();
        }elseif ($jalur=='udara'){
            $data = DB::table('resi_pengiriman')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('pengiriman_via','udara')
            ->orderby('tgl','desc')
            ->paginate(40);
            $data2 = DB::table('resi_pengiriman')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('pengiriman_via','udara')
            ->orderby('tgl','desc')
            ->get();
            $total = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as totalnya'))
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('pengiriman_via','udara')
            ->get();
        }else{
            $data = DB::table('resi_pengiriman')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->orderby('tgl','desc')
            ->paginate(40);
            $data2 = DB::table('resi_pengiriman')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->orderby('tgl','desc')
            ->get();
            $total = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as totalnya'))
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->get();
        }
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('laporan/cetakpemasukan',['title'=>$webinfo,'data'=>$data,'data2'=>$data2,'bulan'=>$bln,'tahun'=>$thn,'total'=>$total,'jalur'=>$jalur]);
    }
//-----------------------------------------------------
        public function cetakpengeluaran($bulanya, $vendor){
        $vendor = $vendor;
        $bulan = explode('-', $bulanya);
        $bln = $bulan[0];
        $thn = $bulan[1];
        if($vendor=='semua'){
            $data2 = DB::table('resi_pengiriman')
            ->select(DB::raw('resi_pengiriman.*,surat_jalan.tujuan,surat_jalan.kode,surat_jalan.biaya'))
            ->leftjoin('surat_jalan','surat_jalan.kode','=','resi_pengiriman.kode_jalan')
            ->where('resi_pengiriman.tgl_bayar','!=',NULL)
            ->whereMonth('tgl_bayar',$bln)
            ->whereYear('tgl_bayar',$thn)
            ->orderby('tgl_bayar','desc')
            ->get();

            $total = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(resi_pengiriman.biaya_suratjalan) as totalnya'))
            ->leftjoin('surat_jalan','surat_jalan.kode','=','resi_pengiriman.kode_jalan')
            ->whereMonth('resi_pengiriman.tgl_bayar',$bln)
            ->whereYear('resi_pengiriman.tgl_bayar',$thn)
            ->get();
        }else{
            $data2 = DB::table('resi_pengiriman')
            ->select(DB::raw('resi_pengiriman.*,surat_jalan.tujuan,surat_jalan.kode'))
            ->leftjoin('surat_jalan','surat_jalan.kode','=','resi_pengiriman.kode_jalan')
            ->where([['resi_pengiriman.tgl_bayar','!=',NULL],['surat_jalan.tujuan','=',$vendor]])
            ->whereMonth('tgl_bayar',$bln)
            ->whereYear('tgl_bayar',$thn)
            ->orderby('tgl_bayar','desc')
            ->get();

            $total = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(resi_pengiriman.biaya_suratjalan) as totalnya'))
             ->where([['resi_pengiriman.tgl_bayar','!=',NULL],['surat_jalan.tujuan','=',$vendor]])
            ->leftjoin('surat_jalan','surat_jalan.kode','=','resi_pengiriman.kode_jalan')
            ->whereMonth('resi_pengiriman.tgl_bayar',$bln)
            ->whereYear('resi_pengiriman.tgl_bayar',$thn)
            ->get();
        }
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('laporan/cetakpengeluaran',['title'=>$webinfo,'total'=>$total,'bulan'=>$bln,'tahun'=>$thn,'vendor'=>$vendor,'data2'=>$data2]);
    }
        public function cetakpengeluarangjkw($tglnya,$jabatan){
        $namajabatan =$jabatan;
        $bulan = explode('-',$tglnya);
        $bln = $bulan[0];
        $thn = $bulan[1];
        
        if($namajabatan=='semua'){
            $idjabatan = 'semua';
            $jabat = 'semua';
            $data = DB::table('gaji_karyawan')
            ->select(DB::raw('gaji_karyawan.*,jabatan.jabatan'))
            ->leftjoin('jabatan','jabatan.id','=','gaji_karyawan.id_jabatan')
            ->where([['bulan','=',$bln],['tahun','=',$thn]])
            ->paginate(40);

            $data2 = DB::table('gaji_karyawan')
            ->select(DB::raw('gaji_karyawan.*,jabatan.jabatan'))
            ->leftjoin('jabatan','jabatan.id','=','gaji_karyawan.id_jabatan')
            ->where([['bulan','=',$bln],['tahun','=',$thn]])
            ->get();

            $total = DB::table('gaji_karyawan')
            ->select(DB::raw('SUM(total) as totalnya'))
            ->where([['bulan','=',$bln],['tahun','=',$thn]])
            ->get();
        }else{
        $jabatan = explode('-',$jabatan);
        $idjabatan = $jabatan[0];
        $jabat = $jabatan[1];
        $data = DB::table('gaji_karyawan')
            ->select(DB::raw('gaji_karyawan.*,jabatan.jabatan'))
            ->leftjoin('jabatan','jabatan.id','=','gaji_karyawan.id_jabatan')
            ->where([['bulan','=',$bln],['tahun','=',$thn],['id_jabatan','=',$idjabatan]])
            ->paginate(40);

            $data2 = DB::table('gaji_karyawan')
            ->select(DB::raw('gaji_karyawan.*,jabatan.jabatan'))
            ->leftjoin('jabatan','jabatan.id','=','gaji_karyawan.id_jabatan')
            ->where([['bulan','=',$bln],['tahun','=',$thn],['id_jabatan','=',$idjabatan]])
            ->get();

            $total = DB::table('gaji_karyawan')
            ->select(DB::raw('SUM(total) as totalnya'))
            ->where([['bulan','=',$bln],['tahun','=',$thn],['id_jabatan','=',$idjabatan]])
            ->get();
        }
        $webinfo = DB::table('setting')->limit(1)->get();
    return view('laporan/cetakpengeluarangjkw',[
        'data'=>$data,'title'=>$webinfo,'total'=>$total,'bulanya'=>$bln,'tahunya'=>$thn,'jabatan'=>$jabat,'data2'=>$data2,'kodejabatan'=>$idjabatan
    ]);
    }
    public function cetaklaporanpengeluaranlain($bulanya,$kategori){
        $kategori = $kategori;
        $bulan = explode('-', $bulanya);
        $bln = $bulan[0];
        $thn = $bulan[1];

        if($kategori=='semua'){
            $data = DB::table('pengeluaran_lain')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->orderby('tgl','desc')
            ->paginate(40);
             $data2 = DB::table('pengeluaran_lain')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->orderby('tgl','desc')
            ->get();
            $total = DB::table('pengeluaran_lain')
            ->select(DB::raw('SUM(jumlah) as totalnya'))
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->get();
        }else{
            $data = DB::table('pengeluaran_lain')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('kategori',$kategori)
            ->orderby('tgl','desc')
            ->paginate(40);
            $data2 = DB::table('pengeluaran_lain')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('kategori',$kategori)
            ->orderby('tgl','desc')
            ->get();
            $total = DB::table('pengeluaran_lain')
            ->select(DB::raw('SUM(jumlah) as totalnya'))
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('kategori',$kategori)
            ->get();
        }
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('laporan/cetakpengeluaranlain',['title'=>$webinfo,'data'=>$data,'total'=>$total,'bulan'=>$bln,'tahun'=>$thn,'kategori'=>$kategori,'bulanya'=>$bulanya,'data2'=>$data2]);
    }

//=======================================================Hari
    public function tampilpemasukanhari(Request $request){
        $rules = [
            'tanggal' => 'required',
                ];
         $customMessages = [
        'required'  => 'Maaf, Bulan Tidak Bokeh Kosong',
         ];
        $this->validate($request,$rules,$customMessages);
        $jalur = $request->jalur;
        $tanggal = explode('-', $request->tanggal);
        $tgl = $tanggal[0];
        $bln = $tanggal[1];
        $thn = $tanggal[2];

        if($jalur=='darat'){
            $data = DB::table('resi_pengiriman')
            ->whereDay('tgl',$tgl)
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('pengiriman_via','darat')
            ->orderby('tgl','desc')
            ->paginate(40);
            $data2 = DB::table('resi_pengiriman')
            ->whereDay('tgl',$tgl)
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('pengiriman_via','darat')
            ->orderby('tgl','desc')
            ->get();
            $total = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as totalnya'))
            ->whereDay('tgl',$tgl)
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('pengiriman_via','darat')
            ->get();
        }elseif ($jalur=='laut') {
            $data = DB::table('resi_pengiriman')
            ->whereDay('tgl',$tgl)
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('pengiriman_via','laut')
            ->orderby('tgl','desc')
            ->paginate(40);
            $data2 = DB::table('resi_pengiriman')
            ->whereDay('tgl',$tgl)
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('pengiriman_via','laut')
            ->orderby('tgl','desc')
            ->get();
            $total = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as totalnya'))
            ->whereDay('tgl',$tgl)
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('pengiriman_via','laut')
            ->get();
        }elseif ($jalur=='udara'){
            $data = DB::table('resi_pengiriman')
            ->whereDay('tgl',$tgl)
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('pengiriman_via','udara')
            ->orderby('tgl','desc')
            ->paginate(40);
            $data2 = DB::table('resi_pengiriman')
            ->whereDay('tgl',$tgl)
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('pengiriman_via','udara')
            ->orderby('tgl','desc')
            ->get();
            $total = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as totalnya'))
            ->whereDay('tgl',$tgl)
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('pengiriman_via','udara')
            ->get();
        }else{
            $data = DB::table('resi_pengiriman')
            ->whereDay('tgl',$tgl)
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->orderby('tgl','desc')
            ->paginate(40);
            $data2 = DB::table('resi_pengiriman')
            ->whereDay('tgl',$tgl)
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->orderby('tgl','desc')
            ->get();
            $total = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as totalnya'))
            ->whereDay('tgl',$tgl)
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->get();
        }
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('laporan/pemasukan',['title'=>$webinfo,'data'=>$data,'data2'=>$data2,'bulanya'=>$request->bulan,'total'=>$total,'jalur'=>$jalur,'data3'=>$data->appends(request()->input())]);
    }


}
