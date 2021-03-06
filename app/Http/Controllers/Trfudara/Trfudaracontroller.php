<?php

namespace App\Http\Controllers\Trfudara;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use App\models\Trfudaramodel;
use App\Imports\TrfudaraImport;
use App\Exports\TrfudaraExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class Trfudaracontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $udara = DB::table('tarif_udara')
        ->select(DB::raw('tarif_udara.*,cabang.nama as namacabang'))
        ->leftjoin('cabang','cabang.id','=','tarif_udara.id_cabang')
        ->orderby('tarif_udara.id','desc')
        ->paginate(20);
        $setting = DB::table('setting')->get();
        return view('trfudara/index',['trf_udara'=>$udara,'title'=>$setting]);
    }
    //=======================================================================
    public function importexcel (){
        $setting = DB::table('setting')->get();
        return view('trfudara/importexcel',['title'=>$setting]);
    }
    //=======================================================================
    public function downloadtemplate(){
         // $file= base_path()."/../public_html/file/template tarif Udara.xlsx";
        $file="file/template tarif Udara.xlsx";
            $headers = array(
              'Content-Type: application/excel',
            );
    return Response::download($file, 'template tarif Udara.xlsx', $headers);
    }
    //=======================================================================

    public function prosesimportexcel(Request $request){
        if($request->hasFile('file')){
        Excel::import(new TrfudaraImport, request()->file('file'));
        }
        return redirect('trfudara')->with('status','Import excel sukses');
    }
    //=======================================================================
    public function exsportexcel(){
    return Excel::download(new TrfudaraExport, 'Export Tarif Udara.xlsx');
    }
    //=======================================================================
    public function caridata(Request $request)
    {
        $cari=$request->cari;
        $trf_udr = DB::table('tarif_udara')
        ->select(DB::raw('tarif_udara.*,cabang.nama as namacabang'))
        ->leftjoin('cabang','cabang.id','=','tarif_udara.id_cabang')
        ->where('tarif_udara.tujuan','like','%'.$cari.'%')
        ->orwhere('tarif_udara.kode','like','%'.$cari.'%')
        ->orwhere('tarif_udara.airlans','like','%'.$cari.'%')
        ->orderby('tarif_udara.id','desc')
        ->get();
        $setting = DB::table('setting')->get();
        return view('trfudara/pencarian', ['trf_udr'=>$trf_udr, 'cari'=>$cari,'title'=>$setting]);
    }
    //=======================================================================
    public function create()
    {
        $cabang = DB::table('cabang')->get();
        $katebara = DB::table('kategori_barang')->get();
        $setting = DB::table('setting')->get();
        return view('trfudara/create',['cabang'=>$cabang,'title'=>$setting,'katbar'=>$katebara]);
    }
    //=======================================================================
    public function store(Request $request)
    {
        $rules = [
            'kode' => 'required',
            'tujuan' => 'required',
            'airlans' => 'required',
            'biaya_perkg' => 'required',
            'minimal_heavy' => 'required',
            'biaya_dokumen' => 'required',
                ];
         $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit'
         ];
        $this->validate($request,$rules,$customMessages);
$dtlam= DB::table('tarif_udara')->where('kode',$request->kode)->count();
if($dtlam > 0){
    return redirect('trfudara/create')->with('status','Kode tujuan tarif udara yang anda masukan sudah ada!! ');
}else{
        Trfudaramodel::create([
            'kode' => $request->kode,
            'tujuan' => $request->tujuan,
            'airlans' => $request->airlans,
            'perkg' => $request->biaya_perkg,
            'minimal_heavy' => $request->minimal_heavy,
            'biaya_dokumen' => $request->biaya_dokumen,
            'berat_minimal'=>$request->berat_min,
            'id_cabang'=>$request->cabang
]);
return redirect('trfudara')->with('status','tambah Data Sukses');
}
    }
    //=======================================================================
    public function edit($id)
    {
        $cabang = DB::table('cabang')->get();
        $trfudara = DB::table('tarif_udara')->where('id',$id)->get();
        $trfudara = 
        DB::table('tarif_udara')
        ->where('id',$id)->get();
    $kate = DB::table('kategori_barang')->get();
    $setting = DB::table('setting')->get();
        return view('trfudara/edit',['cabang'=>$cabang,'trfudara'=>$trfudara,'title'=>$setting,'katbar'=>$kate]); 
    }
    //=======================================================================
    public function update(Request $request, $id)
    {
        $rules = [
            'kode' => 'required',
            'tujuan' => 'required',
            'airlans' => 'required',
            'biaya_perkg' => 'required',
            'minimal_heavy' => 'required',
            'biaya_dokumen' => 'required'
                ];
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit'
         ];
        $this->validate($request,$rules,$customMessages);
        
        Trfudaramodel::find($id)->update([
            'kode' => $request->kode,
            'tujuan' => $request->tujuan,
            'airlans' => $request->airlans,
            'perkg' => $request->biaya_perkg,
            'minimal_heavy' => $request->minimal_heavy,
            'biaya_dokumen' => $request->biaya_dokumen,
            'berat_minimal'=>$request->berat_min,
            'id_cabang'=>$request->cabang
            ]);
        
        return redirect('trfudara')->with('status','Edit Data Sukses');
    }
    //=======================================================================
    public function destroy(Request $request)
    {
        $id = $request->aid;
        Trfudaramodel::destroy($id);
        return back()->with('status','Hapus Data Sukses');
    }
    //=======================================================================
    public function haphapus(Request $request)
    {
            if(!$request->pilihid){
                return back()->with('statuserror','Tidak ada data yang dipilih');
            }else{
        foreach ($request->pilihid as $id) { 
            Trfudaramodel::destroy($id);
            }
        }
    return back()->with('status','Hapus Data Sukses');
    }
    //=======================================================================
    public function hapusall()
        {
            $udara='tarif_udara';
            Trfudaramodel::truncate();
            return back()->with('status','Hapus Data Sukses');
        }
    //=======================================================================
}
