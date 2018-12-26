<?php

namespace App\Http\Controllers\laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class laporanController extends Controller
{
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
