<?php

namespace App\Http\Controllers\neraca;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
// use App\Exports\LaporanOmsetExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

class NeracaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $bulan = DB::table('tb_neraca')
        ->groupby('tahun')
        ->orderby('tahun','desc')
        ->get();

        $webinfo = DB::table('setting')
        ->limit(1)
        ->get();

        return view('neraca/pilihneraca',['bulan'=>$bulan,'title'=>$webinfo]);
    }
    public function tampilneraca(Request $request){
        $rules = [
            'tgl' => 'required',
                ];
         $customMessages = [
        'required'  => 'Maaf, Bulan Tidak Bokeh Kosong',
         ];
        $this->validate($request,$rules,$customMessages);
        $tgl = $request->tgl;

        $ambil = explode('-',$tgl);
        $bln = $ambil[0];
        $thn = $ambil[1];

        $data = DB::table('tb_neraca')
        ->where([['status','=','D'],['bulan','=',$bln],['tahun','=',$thn]])
        ->orderby('bulan','desc')
        ->paginate(40);
        $hitd = DB::table('tb_neraca')
        ->select(DB::raw('SUM(total) as tot'))
        ->where([['status','=','D'],['bulan','=',$bln],['tahun','=',$thn]])
        ->orderby('bulan','desc')
        ->get();

        $data0 = DB::table('tb_neraca')
        ->where([['kategori','=','Laba'],['bulan','=',$bln],['tahun','=',$thn]])
        ->orderby('bulan','desc')
        ->get();
        $hitk = DB::table('tb_neraca')
        ->select(DB::raw('SUM(total) as tot'))
        ->where([['status','=','k'],['bulan','=',$bln],['tahun','=',$thn]])
        ->orderby('bulan','desc')
        ->get();

        $da = DB::table('tb_neraca')
        ->where([['kategori','=','Modal'],['bulan','=',$bln],['tahun','=',$thn]])
        ->orderby('bulan','desc')
        ->get();

        $total = DB::table('tb_neraca')
        ->where([['kategori','!=','Modal'],['bulan','=',$bln],['tahun','=',$thn]])
        ->select(DB::raw('SUM(total) as tot'))
        ->get();


        $webinfo = DB::table('setting')
        ->limit(1)
        ->get();

        return view('neraca/index',['data'=>$data,'data0'=>$data0,'modal'=>$da,'hitd'=>$hitd,'hitk'=>$hitk,'tot'=>$total,'title'=>$webinfo]);
    }
    public function tampilneracathn(Request $request){
        $rules = [
            'tgl' => 'required',
                ];
         $customMessages = [
        'required'  => 'Maaf, Bulan Tidak Bokeh Kosong',
         ];
        $this->validate($request,$rules,$customMessages);
        $tahun = $request->tgl;

        $data = DB::table('tb_neraca')
        ->where([['status','=','D'],['tahun','=',$tahun]])
        ->orderby('bulan','desc')
        ->paginate(40);
        $hitd = DB::table('tb_neraca')
        ->select(DB::raw('SUM(total) as tot'))
        ->where([['status','=','D'],['tahun','=',$tahun]])
        ->orderby('bulan','desc')
        ->get();

        $data0 = DB::table('tb_neraca')
        ->where([['kategori','=','Laba'],['tahun','=',$tahun]])
        ->orderby('bulan','desc')
        ->get();
        $hitk = DB::table('tb_neraca')
        ->select(DB::raw('SUM(total) as tot'))
        ->where([['status','=','k'],['tahun','=',$tahun]])
        ->orderby('bulan','desc')
        ->get();

        $da = DB::table('tb_neraca')
        ->where([['kategori','=','Modal'],['tahun','=',$tahun]])
        ->orderby('bulan','desc')
        ->get();

        $total = DB::table('tb_neraca')
        ->where([['kategori','!=','Modal'],['tahun','=',$tahun]])
        ->select(DB::raw('SUM(total) as tot'))
        ->get();


        $webinfo = DB::table('setting')
        ->limit(1)
        ->get();

        return view('neraca/index0',['data'=>$data,'data0'=>$data0,'modal'=>$da,'hitd'=>$hitd,'hitk'=>$hitk,'tot'=>$total,'thn'=>$tahun,'title'=>$webinfo]);
    }
    //-----------------------
        public function cetakneraca($tahun){

        $data = DB::table('tb_neraca')
        ->where([['status','=','D'],['tahun','=',$tahun]])
        ->orderby('bulan','desc')
        ->paginate(40);
        $hitd = DB::table('tb_neraca')
        ->select(DB::raw('SUM(total) as tot'))
        ->where([['status','=','D'],['tahun','=',$tahun]])
        ->orderby('bulan','desc')
        ->get();

        $data0 = DB::table('tb_neraca')
        ->where([['kategori','=','Laba'],['tahun','=',$tahun]])
        ->orderby('bulan','desc')
        ->get();
        $hitk = DB::table('tb_neraca')
        ->select(DB::raw('SUM(total) as tot'))
        ->where([['status','=','k'],['tahun','=',$tahun]])
        ->orderby('bulan','desc')
        ->get();

        $da = DB::table('tb_neraca')
        ->where([['kategori','=','Modal'],['tahun','=',$tahun]])
        ->orderby('bulan','desc')
        ->get();

        $total = DB::table('tb_neraca')
        ->where([['kategori','!=','Modal'],['tahun','=',$tahun]])
        ->select(DB::raw('SUM(total) as tot'))
        ->get();


        $webinfo = DB::table('setting')
        ->limit(1)
        ->get();

        return view('neraca/cetakneraca',['data'=>$data,'data0'=>$data0,'modal'=>$da,'hitd'=>$hitd,'hitk'=>$hitk,'tot'=>$total,'thn'=>$tahun,'title'=>$webinfo]);
    }
    public function export(){
            $namafile = "Export laporan omset.xlsx";
        return Excel::download(new LaporanOmsetExport,$namafile);

    }

    
}
