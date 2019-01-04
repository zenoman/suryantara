<?php
namespace App\Http\Controllers\backup;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Exports\backupendapatan;
use Maatwebsite\Excel\Facades\Excel;

class backupController extends Controller
{
    public function index(){
    	$webinfo = DB::table('setting')->limit(1)->get();

    	return view('backup/index',['title'=>$webinfo]);
    }

    public function tampil(Request $request){

    	Session::put('backup_step',1);
    	Session::put('backup_status','n');
    	$bulan = $request->bulan;
    	$tahun = $request->tahun;
    	$webinfo = DB::table('setting')->limit(1)->get();
    	return view('backup/tampil',['title'=>$webinfo,'bulan'=>$bulan,'tahun'=>$tahun]);
    }
    public function cetakpendapatan($bulan, $tahun){
    	dd($bulan,$tahun);
    }
    public function exsportpendapatan($bulan, $tahun){
    	return Excel::download(new backupendapatan($bulan,$tahun),'pendapatan.xlsx');
    	return back();
    }
}
