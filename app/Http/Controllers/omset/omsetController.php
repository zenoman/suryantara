<?php

namespace App\Http\Controllers\omset;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class omsetController extends Controller
{
    public function index(){
    	$data = DB::table('omset')
    	->orderby('tahun','desc')
    	->orderby('bulan','desc')
    	->paginate(40);

    	$data2 = DB::table('omset')
    	->orderby('tahun','desc')
    	->orderby('bulan','desc')
    	->get();
    	$webinfo = DB::table('setting')
    	->limit(1)
    	->get();
    	return view('omset/index',['data'=>$data,'title'=>$webinfo]);
    }

    
}
