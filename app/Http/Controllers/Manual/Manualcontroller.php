<?php

namespace App\Http\Controllers\Manual;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\models\Manualmodel;
use Illuminate\Support\Facades\Session;

use App\Imports\ManualImport;
use App\Exports\KaryawanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
class Manualcontroller extends Controller
{
    public function index()
    {
        $setting = DB::table('setting')->get();
        $datmanual = DB::table('resi_pengiriman')
        ->select(DB::raw('resi_pengiriman.*,karyawan.nama'))
        ->leftjoin('karyawan','karyawan.id','=','resi_pengiriman.pemegang')
        ->where('resi_pengiriman.metode_input','manual')
        ->paginate(20);
        return view('Manual/index',['manual'=>$datmanual,'title'=>$setting]);
    }
//------------------------------------
    public function caridata(Request $request)
    {
        $cari=$request->cari;
        $manu = DB::table('kode_resimanual')->where('faktur','like','%'.$cari.'%')->get();
            $setting = DB::table('setting')->get();
        return view('Manual/pencarian', ['manual'=>$manu, 'cari'=>$cari,'title'=>$setting]);
    }
    //=========================================================
    public function importexcel(){
        $setting = DB::table('setting')->get();
        return view('Manual/importexcel',['title'=>$setting]);
    }
    //=========================================================
    public function downloadtemplate(){
         $file= "file/template resi manual.xlsx";
            $headers = array(
              'Content-Type: application/excel',
            );
    return Response::download($file, 'template resi manual.xlsx', $headers);
    }
    public function dowloadkaryawan(){
        return Excel::download(new KaryawanExport, 'karyawan.xlsx');
    }
    //========================================================
    public function prosesimportexcel(Request $request){
        if($request->hasFile('file')){
        Excel::import(new ManualImport, request()->file('file'));
        }
        return redirect('Manual')->with('status','Import excel sukses');
    }

    public function create()
    {
        $setting = DB::table('setting')->get();
        $karyawan = DB::table('karyawan')->get();
        return view('Manual/create',['title'=>$setting,'karyawan'=>$karyawan]);
    }

    public function store(Request $request)
    {
        $rules = ['kode'  =>'required'];
 
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi'];

        $this->validate($request,$rules,$customMessages);
        
        $data=$request->kode;
        for ($i=0; $i < count($data) ; $i++){ 
            if($i == count($data)-1){
                $final = $data[$i];
            }else{
                $final = $data[$i];
            }
        Manualmodel::create([
            'pemegang' => $request->pemegang,
            'no_resi'  => $final,
            'metode_input'=>'manual'

        ]);
        }
        return redirect('Manual')->with('status','Input Data Sukses');
    }
    public function destroy(Request $request)
    {
        $id = $request->aid;
        Manualmodel::destroy($id);
        return back()->with('status','Hapus Data Sukses');
    }
    public function haphapus(Request $request)
    {
        if(!$request->pilihid){
                return back()->with('statuserror','Tidak ada data yang dipilih');
            }else{
        foreach ($request->pilihid as $id) { 
            Manualmodel::destroy($id);
            }
        }
    return back()->with('status','Hapus Data Sukses');
    }
    public function edit($id){
        $karyawan = DB::table('karyawan')->get();
        $webinfo = DB::table('setting')->limit(1)->get();
        $data = DB::table('resi_pengiriman')
        ->select(DB::raw('resi_pengiriman.*,karyawan.nama'))
        ->leftjoin('karyawan','karyawan.id','=','resi_pengiriman.pemegang')
        ->where([['resi_pengiriman.metode_input','manual'],['resi_pengiriman.id','=',$id]])
        ->get();
        
        return view('manual/edit',['title'=>$webinfo,'data'=>$data,'karyawan'=>$karyawan]);
    }
}
