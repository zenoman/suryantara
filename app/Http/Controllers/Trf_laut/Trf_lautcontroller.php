<?php
namespace App\Http\Controllers\Trf_laut;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\models\Trf_lautmodel;
use App\Imports\Trf_lautImport;
use App\Exports\Trf_lautExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class trf_lautcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if( Session::get('level') == '1' || 
            Session::get('level') == '3' || 
            Session::get('level') == '2'){
            $tarif_laut=DB::table('tarif_laut')
            ->select(DB::raw('tarif_laut.*,cabang.nama as namacabang'))
            ->leftjoin('cabang','cabang.id','=','tarif_laut.id_cabang')
            ->orderby('tarif_laut.id','desc')
            ->paginate(20);
        }else{
            $tarif_laut=DB::table('tarif_laut')
            ->select(DB::raw('tarif_laut.*,cabang.nama as namacabang'))
            ->leftjoin('cabang','cabang.id','=','tarif_laut.id_cabang')
            ->where('tarif_laut.id_cabang','=',Session::get('cabang'))
            ->orderby('tarif_laut.id','desc')
            ->paginate(20);
        }

    $setting = DB::table('setting')->get();
    return view('trflaut/index',['trflaut'=>$tarif_laut,'title'=>$setting]);
    }

    //===========================================================
   public function importexcel (){
    $setting = DB::table('setting')->get();
        return view('trflaut/importexcel',['title'=>$setting]);
    }
    //===========================================================
    public function downloadtemplate(){
         // $file= base_path()."/../public_html/file/template tarif laut.xlsx";
         $file= "file/template tarif laut.xlsx";
            $headers = array(
              'Content-Type: application/excel',
            );
    return Response::download($file, 'template tarif laut.xlsx', $headers);
    }

    //===========================================================
    public function prosesimportexcel(Request $request){
        if($request->hasFile('file')){
        $status = Excel::import(new Trf_lautImport, request()->file('file'));
        }
        return redirect('trflaut')->with('status','Import excel sukses');
    }
    //===========================================================
    public function exsportexcel(){
    return Excel::download(new Trf_LautExport, 'Export Tarif Laut.xlsx');
    }
    //===========================================================

    public  function caridata(Request $request){
        $cari=$request->cari;
        if( Session::get('level') == '1' || 
            Session::get('level') == '3' || 
            Session::get('level') == '2'){
            $trflaut= DB::table('tarif_laut')
            ->select(DB::raw('tarif_laut.*,cabang.nama as namacabang'))
            ->leftjoin('cabang','cabang.id','=','tarif_laut.id_cabang')
            ->where('tarif_laut.tujuan','like','%'.$cari.'%')
            ->orwhere('tarif_laut.kode','like','%'.$cari.'%')
            ->orderby('tarif_laut.id','desc')
            ->get();
        }else{
             $trflaut= DB::table('tarif_laut')
            ->select(DB::raw('tarif_laut.*,cabang.nama as namacabang'))
            ->leftjoin('cabang','cabang.id','=','tarif_laut.id_cabang')
            ->where([
                ['tarif_laut.tujuan','like','%'.$cari.'%'],
                ['tarif_laut.id_cabang','=',Session::get('cabang')]])
            ->orwhere([
                ['tarif_laut.kode','like','%'.$cari.'%'],
                ['tarif_laut.id_cabang','=',Session::get('cabang')]])
            ->orderby('tarif_laut.id','desc')
            ->get();
        }
        $setting = DB::table('setting')->get();
    	return view('trflaut/pencarian',['trflaut' => $trflaut,'cari'=>$cari,'title'=>$setting]);
    }
    //===========================================================
    public function create()
    {
        $cabang= DB::table('cabang')->get();
        $setting = DB::table('setting')->get();
    return view('trflaut/create',['cabang'=>$cabang,'title'=>$setting]);
    }
    //===========================================================
    public function store(Request $request)
    {
    $rules = [
    'kode' => 'required|min:3',
    'tujuan' => 'required|min:3',
    'tarif' => 'required|min:3',
    'berat_minimal' => 'required',
    'estimasi' => 'required'
    ];
    $customMessages = [
            'required'  => 'Maaf, :attribute harus di isi',
            'min'       => 'Maaf, data yang anda masukan terlalu sedikit'
    ];
    $this->validate($request,$rules,$customMessages);

    $dtlam= DB::table('tarif_laut')->where('kode',$request->kode)->count();
    if($dtlam > 0){
        return redirect('trflaut/create')->with('status','Kode tujuan tarif laut yang anda masukan sudah ada!! ');
    }else{

    Trf_lautmodel::create([
    'kode' => $request->kode,
    'tujuan' => $request->tujuan,
    'tarif' => $request->tarif,
    'berat_min' => $request->berat_minimal,
    'estimasi' => $request->estimasi,
    'id_cabang'=>$request->cabang
    ]);
    return redirect('trflaut')->with('status','Tambah Data Sukses');

    }
    }
    //===========================================================
    public function edit($id)
    {
        $cabang= DB::table('cabang')->get();
        $tarif_laut = Trf_lautmodel::find($id);
        $setting = DB::table('setting')->get();
    return view('trflaut/edit',['cabang'=>$cabang,'trflaut'=>$tarif_laut,'title'=>$setting]); 
    }
     //===========================================================
    public function update(Request $request,$id)
    {
    $rules = [
    'kode' => 'required|min:3',
    'tujuan' => 'required|min:3',
    'tarif' => 'required|min:3',
    'berat_minimal' => 'required',
    'estimasi' => 'required'
    ];
    $customMessages = [
            'required'  => 'Maaf, :attribute harus di isi',
            'min'       => 'Maaf, data yang anda masukan terlalu sedikit'
    ];
    $this->validate($request,$rules,$customMessages);
    // $dtlam= DB::table('tarif_laut')->where('kode',$request->kode)->get();
    // if(!$dtlam->isEmpty()){
    //     return redirect('trflaut/'.$id.'/edit')->with('status','Kode tujuan tari laut yang anda masukan sudah ada!! ');
    // }else{
    Trf_lautmodel::find($id)->update([
    'kode' => $request->kode,
    'tujuan' => $request->tujuan,
    'tarif' => $request->tarif,
    'berat_min' => $request->berat_minimal,
    'estimasi' => $request->estimasi,
    'id_cabang'=>$request->cabang
    ]);
    return redirect('trflaut')->with('status','Edit Data Sukses');
    // }
    }
    //===========================================================

    public function destroy(Request $request)
    {
        $id = $request->aid;
    Trf_lautmodel::destroy($id);
    return back()->with('status','Hapus Data Sukses');
    }
     //===========================================================
    public function haphapus(Request $request)
        {
                if(!$request->pilihid){
                    return back()->with('statuserror','Tidak ada data yang dipilih');
                }else{
            foreach ($request->pilihid as $id) { 
                Trf_lautmodel::destroy($id);
                }
            }
    return back()->with('status','Hapus Data Sukses');
    }
     //===========================================================
    public function hapusall()
        {
            Trf_lautmodel::truncate();
            return back()->with('status','Hapus Data Sukses');
            //
        }
}