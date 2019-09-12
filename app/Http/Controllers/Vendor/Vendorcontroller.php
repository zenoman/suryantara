<?php
namespace App\Http\Controllers\Vendor;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use App\models\Vendormodel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Imports\VendorImport;
use App\Exports\VendorExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

class Vendorcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
    $vnd=DB::table('vendor')
        ->select(DB::raw('vendor.*,cabang.nama as namacabang'))
        ->leftjoin('cabang','cabang.id','=','vendor.id_cabang')
        ->orderby('vendor.id','desc')
        ->get();
    $setting = DB::table('setting')->get();
    return view('vendor/index',['vendor'=>$vnd,'title'=>$setting]);
    }
    //=========================================================
    public function importexcel (){
    $setting = DB::table('setting')->get();
        return view('vendor/importexcel',['title'=>$setting]);
    }
     //=========================================================
    public function downloadtemplate(){
        // $file= base_path()."/../public_html/file/template vendor.xlsx";
        $file="file/template vendor.xlsx";
            $headers = array(
              'Content-Type: application/excel',
            );
    return Response::download($file, 'template vendor.xlsx', $headers);
    }

     //=========================================================
    public function prosesimportexcel(Request $request){
        if($request->hasFile('file')){
        Excel::import(new VendorImport, request()->file('file'));
        }
        return redirect('vendor')->with('status','Import excel sukses');
    }
     //=========================================================
    public function exsportexcel(){
    return Excel::download(new VendorExport, ' Export Vendor.xlsx');
    } 
     //=========================================================
    public function caridata(Request $request)
    {
        $ven = DB::table('vendor')
        ->select(DB::raw('vendor.*,cabang.nama as namacabang'))
        ->leftjoin('cabang','cabang.id','=','vendor.id_cabang')
        ->where('vendor','like','%'.$request->cari.'%')
        ->orwhere('idvendor','like','%'.$request->cari.'%')
        ->get();

        $setting = DB::table('setting')->get();
        return view('vendor/pencarian', ['vendor'=>$ven, 'cari'=>$request->cari,'title'=>$setting]);
    }
    //=========================================================
    public function create()
    {
        $cabang = DB::table('cabang')->get();
    	$setting = DB::table('setting')->get();
        return view('vendor/create',['title'=>$setting,'cabang'=>$cabang]);
    }
     //=========================================================
    public function store(Request $request)
    {
    $rules = [
    'idvendor' => 'required|min:3',
    'vendor' => 'required|min:3',
    'telp' => 'required|min:3',
    'alamat' => 'required|min:1'
    ];
    $this->validate($request,$rules);
    Vendormodel::create([
    'idvendor' => $request->idvendor,
    'vendor' => $request->vendor,
    'telp' => $request->telp,
    'alamat' => $request->alamat,
    'id_cabang'=>$request->idcabang
    ]);
    return redirect('vendor')->with('status','tambah Data Sukses');
    }
    //=========================================================

    public function edit($id){
    $cabang = DB::table('cabang')->get();
    $vnd = Vendormodel::find($id);
    $setting = DB::table('setting')->get();
    return view('vendor/edit',['vendor'=>$vnd,'title'=>$setting,'cabang'=>$cabang]); }
    //=========================================================
    public function update(Request $request,$id)
    {
    $rules = [
            'idvendor' => 'required|min:3',
            'vendor' => 'required|min:3',
            'telp' => 'required|min:3',
            'alamat' => 'required|min:1'
    ];
    $this->validate($request,$rules);
    Vendormodel::find($id)->update([
            'idvendor' => $request->idvendor,
            'vendor' => $request->vendor,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
            'id_cabang'=>$request->idcabang
    ]);
    return redirect('vendor')->with('status','edit Data Sukses');
    }
    //=========================================================
    public function destroy(Request $request){
    $id = $request->aid;
    Vendormodel::destroy($id);
    return back()->with('status','hapus Data Sukses');
    }
}