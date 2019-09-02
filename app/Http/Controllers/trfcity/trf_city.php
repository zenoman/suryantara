<?php

namespace App\Http\Controllers\trfcity;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Exports\trfcityexport;
use App\Imports\trfcity;
use Maatwebsite\Excel\Facades\Excel;

class trf_city extends Controller
{
    
    public function index()
    {
        $tarif_darat=DB::table('tarif_darat')
        ->select(DB::raw('tarif_darat.*,cabang.nama as namacabang'))
        ->leftjoin('cabang','cabang.id','=','tarif_darat.id_cabang')
        ->where('tarif_darat.tarif_city','=','Y')
        ->orderby('tarif_darat.id','desc')
        ->paginate(20);

        $setting = DB::table('setting')->get();
        return view('trfcity/index',['trf_drt'=>$tarif_darat,'title'=>$setting]);
    }

    //=============================================================================
    public function create()
    {
        $cabang = DB::table('cabang')->get();
        $setting = DB::table('setting')->get();
        return view('trfcity/create',['title'=>$setting,'cabang'=>$cabang]);
    }

    //=============================================================================
    public function store(Request $request)
    {
        $dtlam= DB::table('tarif_darat')->where('kode',$request->kode)->count();
        if($dtlam > 0){
            return redirect('trfcity/create')->with('status','Maaf,Kode tujuan tarif darat yang anda masukan sudah ada');
        }else{
        DB::table('tarif_darat')
        ->insert([
        'kode' => $request->kode,
        'tujuan' => $request->tujuan,
        'tarif' => $request->tarif,
        'berat_min' => $request->berat_minimal,
        'estimasi' => $request->estimasi,
        'id_cabang'=>$request->cabang,
        'tarif_city'=>'Y',
        'company'=>$request->status_tarif
        ]);

    return redirect('trfcity')->with('status','Input Data Sukses');
    }}

    //==============================================================================
    public function edit($id)
    {
        $cabang = DB::table('cabang')->get();
        $tarif_darat = DB::table('tarif_darat')->where('id','=',$id)->get();
        $setting = DB::table('setting')->get();
        return view('trfcity/edit',['cabang'=>$cabang,'trf_drt'=>$tarif_darat,'title'=>$setting]);
    }

    //==============================================================================
    public function update(Request $request, $id)
    {
        DB::table('tarif_darat')
        ->where('id',$id)
        ->update([
        'kode' => $request->kode,
        'tujuan' => $request->tujuan,
        'tarif' => $request->tarif,
        'berat_min' => $request->berat_minimal,
        'estimasi' => $request->estimasi,
        'id_cabang'=>$request->cabang,
        'tarif_city'=>'Y',
        'company'=>$request->status_tarif
        ]);
    return redirect('trfcity')->with('status','Edit Data Sukses');
    }

     //============================================================================
    public function haphapus(Request $request){
        if(!$request->pilihid){
            return back()->with('statuserror','Tidak ada data yang dipilih');
        }else{
            foreach ($request->pilihid as $id) { 
                DB::table('tarif_darat')->where('id',$id)->delete();
                }
        }
    return back()->with('status','Hapus Data Sukses');
    }
    //============================================================================
    public function hapusall()
    {
        DB::table('tarif_darat')->where('tarif_city','Y')->delete();
        return back()->with('status','Hapus Data Sukses');
    }
    //============================================================================
    public function caridata(Request $request)
    {
        $url = $request->fullurl();
        $cari=$request->cari;
        $trf_drt = DB::table('tarif_darat')
        ->select(DB::raw('tarif_darat.*,cabang.nama as namacabang'))
        ->leftjoin('cabang','cabang.id','=','tarif_darat.id_cabang')
        ->where([['tarif_darat.tujuan','like','%'.$cari.'%'],['tarif_darat.tarif_city','=','Y']])
        ->orwhere([['tarif_darat.kode','like','%'.$cari.'%'],['tarif_darat.tarif_city','=','Y']])
        ->orderby('tarif_darat.id','desc')
        ->get();
        $setting = DB::table('setting')->get();
        return view('trfcity/pencarian', ['trf_drt'=>$trf_drt, 'cari'=>$cari,'title'=>$setting,'url'=>$url]);
    }

    //=======================================================================
    public function importexcel(){
        $setting = DB::table('setting')->get();
        return view('trfcity/importexcel',['title'=>$setting]);
    }

    //========================================================================
    public function downloadtemplate(){
        $file="file/template tarif city kurir.xlsx";
            $headers = array(
              'Content-Type: application/excel',
            );
        return Response::download($file, 'template tarif city kurir.xlsx', $headers);
    }

    //=========================================================
    public function prosesimportexcel(Request $request){
        if($request->hasFile('file')){
        Excel::import(new trfcity, request()->file('file'));
        }
        return redirect('trfcity')->with('status','Import excel sukses');
    }

    //=================================================================
    public function exporttarif(){
         return Excel::download(new trfcityexport, 'Export Tarif City Kurir.xlsx');
    }
}
