<?php

namespace App\Http\Controllers\omset;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Exports\LaporanOmsetExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

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
    //-----------------------
        public function cetakomset(){
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
        return view('omset/cetakomset',['data'=>$data,'title'=>$webinfo]);
    }
    public function export(){
            $namafile = "Export laporan omset.xlsx";
        return Excel::download(new LaporanOmsetExport,$namafile);

    }

    
}
