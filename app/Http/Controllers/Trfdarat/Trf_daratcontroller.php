<?php
namespace App\Http\Controllers\Trfdarat;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\models\Trf_daratmodel;
use App\Exports\TrfdaratExport;
use App\Imports\TrfDaratImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class Trf_daratcontroller extends Controller{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        if( Session::get('level') == '1' || 
            Session::get('level') == '3' || 
            Session::get('level') == '2'){

                $tarif_darat=DB::table('tarif_darat')
                ->select(DB::raw('tarif_darat.*,cabang.nama as namacabang'))
                ->leftjoin('cabang','cabang.id','=','tarif_darat.id_cabang')
                ->where('tarif_darat.tarif_city','=','N')
                ->orderby('tarif_darat.id','desc')
                ->paginate(20);
        
        }else{
                $tarif_darat=DB::table('tarif_darat')
                ->select(DB::raw('tarif_darat.*,cabang.nama as namacabang'))
                ->leftjoin('cabang','cabang.id','=','tarif_darat.id_cabang')
                ->where([
                    ['tarif_darat.tarif_city','=','N'],
                    ['tarif_darat.id_cabang','=',Session::get('cabang')]])
                ->orderby('tarif_darat.id','desc')
                ->paginate(20);
        }
        

        $setting = DB::table('setting')->get();
        return view('trfdarat/index',['trf_drt'=>$tarif_darat,'title'=>$setting]);
    }
    //=========================================================
    public function importexcel (){
    $setting = DB::table('setting')->get();
        return view('trfdarat/importexcel',['title'=>$setting]);
    }
      //=========================================================
    public function downloadtemplate(){
         // $file= base_path()."/../public_html/file/template tarif darat.xlsx";
         $file="file/template tarif darat.xlsx";
            $headers = array(
              'Content-Type: application/excel',
            );
    return Response::download($file, 'template tarif darat.xlsx', $headers);
    }

    //=========================================================
    public function prosesimportexcel(Request $request){
        if($request->hasFile('file')){
        Excel::import(new TrfDaratImport, request()->file('file'));
        }
        return redirect('trfdarat')->with('status','Import excel sukses');
    }
    //=========================================================
    public function exsportexcel(){
    return Excel::download(new TrfdaratExport, 'Export Tarif Darat.xlsx');
    

    }
    //=========================================================

    public function caridata(Request $request)
    {
        $url = $request->fullurl();
        $cari=$request->cari;
        if( Session::get('level') == '1' || 
            Session::get('level') == '3' || 
            Session::get('level') == '2'){
            $trf_drt = DB::table('tarif_darat')
            ->select(DB::raw('tarif_darat.*,cabang.nama as namacabang'))
            ->leftjoin('cabang','cabang.id','=','tarif_darat.id_cabang')
            ->where([['tarif_darat.tujuan','like','%'.$cari.'%'],['tarif_darat.tarif_city','=','N']])
            ->orwhere([['tarif_darat.kode','like','%'.$cari.'%'],['tarif_darat.tarif_city','=','N']])
            ->orderby('tarif_darat.id','desc')
        ->get();
        }else{
            $trf_drt = DB::table('tarif_darat')
            ->select(DB::raw('tarif_darat.*,cabang.nama as namacabang'))
            ->leftjoin('cabang','cabang.id','=','tarif_darat.id_cabang')
            ->where([
                ['tarif_darat.tujuan','like','%'.$cari.'%'],
                ['tarif_darat.tarif_city','=','N'],
                ['tarif_darat.id_cabang','=',Session::get('cabang')]])
            ->orwhere([
                ['tarif_darat.kode','like','%'.$cari.'%'],
                ['tarif_darat.tarif_city','=','N'],
                ['tarif_darat.id_cabang','=',Session::get('cabang')]])
            ->orderby('tarif_darat.id','desc')
            ->get();
        }
        
        $setting = DB::table('setting')->get();
        return view('trfdarat/pencarian', ['trf_drt'=>$trf_drt, 'cari'=>$cari,'title'=>$setting,'url'=>$url]);
    }
    //=========================================================
    public function create(){
        $cabang = DB::table('cabang')->get();
        $setting = DB::table('setting')->get();
    return view('trfdarat/create',['title'=>$setting,'cabang'=>$cabang]);
    }
    //=========================================================
    public function store(Request $request)
    {
    $rules = [
    'kode' => 'required|min:2',
    'tujuan' => 'required|min:3',
    'tarif' => 'required',
    'berat_minimal' => 'required',
    'estimasi' => 'required'
    ];
    $customMessages = [
            'required'  => 'Maaf, :attribute harus di isi',
            'min'       => 'Maaf, data yang anda masukan terlalu sedikit'
    ];
    $this->validate($request,$rules,$customMessages);
    $dtlam= DB::table('tarif_darat')->where('kode',$request->kode)->count();
    if($dtlam > 0){
        return redirect('trfdarat/create')->with('status','Maaf,Kode tujuan tarif darat yang anda masukan sudah ada');
    }else{
    Trf_daratmodel::create([
    'kode' => $request->kode,
    'tujuan' => $request->tujuan,
    'tarif' => $request->tarif,
    'berat_min' => $request->berat_minimal,
    'estimasi' => $request->estimasi,
    'id_cabang'=>$request->cabang
    ]);

    return redirect('trfdarat')->with('status','Input Data Sukses');
    }
    }

    //=========================================================
    public function edit($id)
    {
    $cabang = DB::table('cabang')->get();
    $tarif_darat = Trf_daratmodel::find($id);
    $setting = DB::table('setting')->get();
    return view('trfdarat/edit',['cabang'=>$cabang,'trf_drt'=>$tarif_darat,'title'=>$setting]);
    }
    //=========================================================
    public function update(Request $request,$id){
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

    Trf_daratmodel::find($id)->update([
    'kode' => $request->kode,
    'tujuan' => $request->tujuan,
    'tarif' => $request->tarif,
    'berat_min' => $request->berat_minimal,
    'estimasi' => $request->estimasi,
    'id_cabang'=>$request->cabang
    ]);
    return redirect('trfdarat')->with('status','Edit Data Sukses');
    }
    //=========================================================
    public function destroy(Request $request)
        {
            $id = $request->aid;
    Trf_daratmodel::destroy($id);
    return back()->with('status','Hapus Data Sukses');
    }
    //=========================================================
    public function hapus($id)
        {
             Trf_daratmodel::destroy($id);
            return redirect('/trfdarat')->with('status','Hapus Data Sukses');
        }
    //=========================================================
    public function haphapus(Request $request)
        {
            if(!$request->pilihid){
                    return back()->with('statuserror','Tidak ada data yang dipilih');
                }else{
            foreach ($request->pilihid as $id) { 
                Trf_daratmodel::destroy($id);
                }
            }
    return back()->with('status','Hapus Data Sukses');
    }
    //=========================================================
    public function hapusall()
    {
        DB::table('tarif_darat')->where('tarif_city','N')->delete();
        return back()->with('status','Hapus Data Sukses');
    }
}
