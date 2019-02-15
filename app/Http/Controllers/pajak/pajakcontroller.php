<?php

namespace App\Http\Controllers\pajak;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class pajakcontroller extends Controller
{
    public function index(){
    	$data = DB::table('pajak')
    	->select(DB::raw('tahun'))
    	->where('status','=','bulanan')
    	->groupby('tahun')
		->get();
		$setting = DB::table('setting')->limit(1)->get();
    	return view('pajak/index',['data'=>$data,'title'=>$setting]);
    }

    public function tampil(Request $request){
    	$rules = ['tahun' => 'required'];
         $customMessages = [
        'required'  => 'Maaf, Bulan Tidak Bokeh Kosong',
         ];
    	$this->validate($request,$rules,$customMessages);
    	$tahun = $request->tahun;
    	$setting = DB::table('setting')->limit(1)->get();
    	if($tahun=='semua'){
    		$data = DB::table('pajak')
    		->where('status','=','bulanan')
    		->get();
    		$total = DB::table('pajak')
            ->select(DB::raw('SUM(total) as totalnya'))
            ->where('status','=','bulanan')
            ->get();
    	}else{
    		$data = DB::table('pajak')
    		->where([['status','=','bulanan'],['tahun','=',$tahun]])
    		->get();
    		$total = DB::table('pajak')
            ->select(DB::raw('SUM(total) as totalnya'))
            ->where([['status','=','bulanan'],['tahun','=',$tahun]])
            ->get();
    	}

    	return view('pajak/tampil',['data'=>$data,'title'=>$setting,'tahunya'=>$tahun,'total'=>$total]);
    }
}
