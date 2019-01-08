<?php

namespace App\Http\Controllers\laporan;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Exports\LaporanPemasukanExport;
use App\Exports\LaporanPengeluaranVendorExport;
use App\Exports\LaporanPengeluaranLainExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;


class laporanController extends Controller
{
    public function tampilpengeluaran(Request $request){
        $vendor = $request->vendor;
        $bulan = explode('-', $request->bulan);
        $bln = $bulan[0];
        $thn = $bulan[1];
        if($vendor=='semua'){
            $data = DB::table('surat_jalan')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->orderby('tgl','desc')
            ->paginate(40);
            $data2 = DB::table('surat_jalan')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->orderby('tgl','desc')
            ->get();
            $total = DB::table('surat_jalan')
            ->select(DB::raw('SUM(biaya) as totalnya'))
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->get();

        }else{
             $data = DB::table('surat_jalan')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('tujuan',$vendor)
            ->orderby('tgl','desc')
            ->paginate(40);
            $data2 = DB::table('surat_jalan')
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('tujuan',$vendor)
            ->orderby('tgl','desc')
            ->get();

            $total = DB::table('surat_jalan')
            ->select(DB::raw('SUM(biaya) as totalnya'))
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('tujuan',$vendor)
            ->get();

        }
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('laporan/pengeluaran',['data'=>$data,'title'=>$webinfo,'total'=>$total,'bulanya'=>$request->bulan,'vendor'=>$vendor,'data2'=>$data2,'data3'=>$data->appends(request()->input())]);
    }
    //============================================
    public function pilihpengeluaran(){
        $bulan = DB::table('surat_jalan')
        ->select(DB::raw('MONTH(tgl) as bulan, YEAR(tgl) as tahun'))
        ->groupby('bulan')
        ->groupby('tahun')
        ->orderby('tgl','desc')
        ->get();

        $vendor = DB::table('surat_jalan')
        ->groupby('tujuan')
        ->get();
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('laporan/pilihpengeluaran',['title'=>$webinfo,'bulan'=>$bulan,'vendor'=>$vendor]);
    }
    //===============================================
    public function pilihpemasukan(){
    	$bulan = DB::table('resi_pengiriman')
    	->select(DB::raw('MONTH(tgl) as bulan, YEAR(tgl) as tahun'))
    	->groupby('bulan')
    	->groupby('tahun')
    	->orderby('tgl','desc')
    	->get();
    	$webinfo = DB::table('setting')->limit(1)->get();
    	return view('laporan/pilihpemasukan',['title'=>$webinfo,'bulan'=>$bulan]);
    }
    //================================================
    public function tampilpemasukan(Request $request){
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
    public function exsportlaporanpemasukan($bulannya, $jalur){
        $bulan = explode('-', $bulannya);
        $bln = $bulan[0];
        $thn = $bulan[1];

            if ($jalur !='semua') {
        $namafile = "Export laporan pemasukan pada bulan ".$bln." tahun ".$thn." di jalur ".$jalur.".xlsx";
            }else{
        $namafile = "Export laporan pemasukan pada bulan ".$bln." tahun ".$thn." di ".$jalur." jalur.xlsx";
            }
        return Excel::download(new LaporanPemasukanExport($bln,$thn,$jalur),$namafile);

    }
    public function exsportlaporanpengluaranvendor($bulannya, $vendor){
        $bulan = explode('-', $bulannya);
        $bln = $bulan[0];
        $thn = $bulan[1];
        if ($vendor !='semua') {
            $namafile = "Export laporan pengeluaran pada bulan ".$bln." tahun ".$thn." vendor ".$vendor.".xlsx";
        }else{
            $namafile = "Export laporan pengeluaran pada bulan ".$bln." tahun ".$thn." di ".$vendor." vendor.xlsx";
        }
        return Excel::download(new LaporanPengeluaranVendorExport($bln,$thn,$vendor),$namafile);
    }
        public function exsportlaporanpengeluaranlain($bulannya, $kategori){
        $bulan = explode('-', $bulannya);
        $bln = $bulan[0];
        $thn = $bulan[1];
        if ($kategori !='semua') {
            $namafile = "Export laporan pengeluaran lain pada bulan ".$bln." tahun ".$thn." dengan kategori ".$kategori.".xlsx";
        }else{
            $namafile = "Export laporan pengeluaran lain pada bulan ".$bln." tahun ".$thn." di ".$kategori." kategori.xlsx";
        }
        return Excel::download(new LaporanPengeluaranLainExport($bln,$thn,$kategori),$namafile);

    }


}
