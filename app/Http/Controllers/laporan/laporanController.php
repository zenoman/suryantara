<?php

namespace App\Http\Controllers\laporan;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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
            ->get();
            $total = DB::table('surat_jalan')
            ->select(DB::raw('SUM(biaya) as totalnya'))
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('tujuan',$vendor)
            ->get();

        }
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('laporan/pengeluaran',['data'=>$data,'title'=>$webinfo,'total'=>$total,'bulanya'=>$request->bulan,'vendor'=>$vendor]);
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
    		->get();
    		$total = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as totalnya'))
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->get();


    	}
    	$webinfo = DB::table('setting')->limit(1)->get();


    	return view('laporan/pemasukan',['title'=>$webinfo,'data'=>$data,'bulanya'=>$request->bulan,'total'=>$total,'jalur'=>$jalur]);

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
}
