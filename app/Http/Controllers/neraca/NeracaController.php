<?php

namespace App\Http\Controllers\neraca;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Exports\LaporanOmsetExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

class NeracaController extends Controller
{
    public function index(){
    	$data = DB::table('tb_neraca')
        ->where('status','=','D')
    	->orderby('bulan','desc')
    	->paginate(40);
        $hitd = DB::table('tb_neraca')
        ->select(DB::raw('SUM(total) as tot'))
        ->where('status','=','D')
        ->orderby('bulan','desc')
        ->get();

        $data0 = DB::table('tb_neraca')
        ->where('kategori','=','Laba')
        ->orderby('bulan','desc')
        ->get();
        $hitk = DB::table('tb_neraca')
        ->select(DB::raw('SUM(total) as tot'))
        ->where('status','=','k')
        ->orderby('bulan','desc')
        ->get();

        $da = DB::table('tb_neraca')
        ->where('kategori','=','Modal')
        ->orderby('bulan','desc')
        ->get();

        $total = DB::table('tb_neraca')
        ->where('kategori','!=','Modal')
        ->select(DB::raw('SUM(total) as tot'))
        ->get();

    	$webinfo = DB::table('setting')
    	->limit(1)
    	->get();

    	return view('neraca/index',['data'=>$data,'data0'=>$data0,'modal'=>$da,'hitd'=>$hitd,'hitk'=>$hitk,'tot'=>$total,'title'=>$webinfo]);
    }
    //-----------------------
        public function cetakomset(){
        $data = DB::table('tb_neraca')
        ->orderby('tahun','desc')
        ->orderby('bulan','desc')
        ->paginate(40);

        $data2 = DB::table('tb_neraca')
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
