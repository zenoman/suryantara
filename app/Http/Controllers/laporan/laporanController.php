<?php

namespace App\Http\Controllers\laporan;

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
            ->select(DB::raw('surat_jalan.*,admin.username'))
            ->join('admin','admin.id','=','surat_jalan.id_admin')
            ->whereMonth('surat_jalan.tgl',$bln)
            ->whereYear('surat_jalan.tgl',$thn)
            ->get();
            $total = DB::table('surat_jalan')
            ->select(DB::raw('SUM(biaya) as totalnya'))
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->get();

        }else{
             $data = DB::table('surat_jalan')
            ->select(DB::raw('surat_jalan.*,admin.username'))
            ->join('admin','admin.id','=','surat_jalan.id_admin')
            ->whereMonth('surat_jalan.tgl',$bln)
            ->whereYear('surat_jalan.tgl',$thn)
            ->where('surat_jalan.tujuan',$vendor)
            ->get();
            $total = DB::table('surat_jalan')
            ->select(DB::raw('SUM(biaya) as totalnya'))
            ->whereMonth('tgl',$bln)
            ->whereYear('tgl',$thn)
            ->where('surat_jalan.tujuan',$vendor)
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
        ->select(DB::raw('surat_jalan.*'))
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
    		->select(DB::raw('resi_pengiriman.*,admin.username'))
    		->join('admin','admin.id','=','resi_pengiriman.id_admin')
    		->whereMonth('resi_pengiriman.tgl',$bln)
    		->whereYear('resi_pengiriman.tgl',$thn)
    		->where('resi_pengiriman.pengiriman_via','darat')
    		->get();
    		$total = DB::table('resi_pengiriman')
    		->select(DB::raw('SUM(total_biaya) as totalnya'))
    		->whereMonth('tgl',$bln)
    		->whereYear('tgl',$thn)
    		->where('pengiriman_via','darat')
    		->get();
    	}elseif ($jalur=='laut') {
    		$data = DB::table('resi_pengiriman')
    		->select(DB::raw('resi_pengiriman.*,admin.username'))
    		->join('admin','admin.id','=','resi_pengiriman.id_admin')
    		->whereMonth('resi_pengiriman.tgl',$bln)
    		->whereYear('resi_pengiriman.tgl',$thn)
    		->where('resi_pengiriman.pengiriman_via','laut')
    		->get();
    		$total = DB::table('resi_pengiriman')
    		->select(DB::raw('SUM(total_biaya) as totalnya'))
    		->whereMonth('tgl',$bln)
    		->whereYear('tgl',$thn)
    		->where('pengiriman_via','laut')
    		->get();
    	}elseif ($jalur=='udara'){
    		$data = DB::table('resi_pengiriman')
    		->select(DB::raw('resi_pengiriman.*,admin.username'))
    		->join('admin','admin.id','=','resi_pengiriman.id_admin')
    		->whereMonth('resi_pengiriman.tgl',$bln)
    		->whereYear('resi_pengiriman.tgl',$thn)
    		->where('resi_pengiriman.pengiriman_via','udara')
    		->get();
    		$total = DB::table('resi_pengiriman')
    		->select(DB::raw('SUM(total_biaya) as totalnya'))
    		->whereMonth('tgl',$bln)
    		->whereYear('tgl',$thn)
    		->where('pengiriman_via','udara')
    		->get();
    	}else{
    		$data = DB::table('resi_pengiriman')
    		->select(DB::raw('resi_pengiriman.*,admin.username'))
    		->join('admin','admin.id','=','resi_pengiriman.id_admin')
    		->whereMonth('resi_pengiriman.tgl',$bln)
    		->whereYear('resi_pengiriman.tgl',$thn)
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
}
