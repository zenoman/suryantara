<?php
namespace App\Http\Controllers\distribusiresi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Imports\distribusiresiImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

class distribusiresicontroller extends Controller
{
    
    public function index()
    {
        $data = DB::table('resi_mentah')
        ->select(DB::raw('resi_mentah.*,cabang.nama'))
        ->leftjoin('cabang','cabang.id','=','resi_mentah.id_cabang')
        ->orderby('resi_mentah.id','desc')
        ->get();
        $setting = DB::table('setting')->get();
        return view('distribusiresi.index',['data'=>$data,'title'=>$setting]);
    }

    //===============================================================================
    public function create()
    {
        $setting = DB::table('setting')->get();
        $cabang = DB::table('cabang')->get();
        return view('distribusiresi.create',['title'=>$setting,'cabang'=>$cabang]);
    }
    
    //===============================================================================
    public function downloadtemplate(){
         // $file= base_path()."/../public_html/file/template distribusi resi.xlsx";
         $file="file/template distribusi resi.xlsx";
            $headers = array(
              'Content-Type: application/excel',
            );
    return Response::download($file, 'template distribusi resi.xlsx', $headers);
    }
    
    //==============================================================================
    public function prosesimportexcel(Request $request){
        if($request->hasFile('file')){
            Excel::import(new distribusiresiImport, request()->file('file'));
        }
        return redirect('distribusiresi')->with('status','Import excel sukses');
    }
    
    //===============================================================================
    public function store(Request $request)
    {
        $data=$request->kode;
        for ($i=0; $i < count($data) ; $i++){ 
            if($i == count($data)-1){
                $final = $data[$i];
            }else{
                $final = $data[$i];
            }
            DB::table('resi_mentah')
            ->insert([
            'pembuat' => $request->pembuat,
            'no_resi'  => $final,
            'id_cabang'=>$request->cabang,
            'status'=>$request->status
            ]);
        }
        return redirect('distribusiresi')->with('status','Data Berhasil Disimpan');
    }

    //===============================================================================
    public function exportexcel()
    {
        $setting = DB::table('setting')->get();
        return view('distribusiresi.importexcel',['title'=>$setting]);
    }

    //===============================================================================
    public function show($id)
    {
        //
    }

    //===============================================================================
    public function edit($id)
    {
        //
    }

    //===============================================================================
    public function gantistatus(Request $request)
    {
        if(!$request->pilihid){
            return back()->with('statuserror','Tidak ada data yang dipilih');
        }else{
            if($request->status=='hapus'){
                foreach ($request->pilihid as $id){ 
                    DB::table('resi_mentah')->where('id',$id)->delete();
                }
            }else{
                foreach ($request->pilihid as $id){ 
                    DB::table('resi_mentah')
                    ->where('id',$id)
                    ->update([
                        'status'=>'Y'
                    ]);
                }
            }
            return redirect('distribusiresi')->with('status','Data Berhasil Diubah');
            
        }
    }

    //===============================================================================
    public function destroy($id)
    {
        DB::table('resi_mentah')
        ->where('id',$id)
        ->delete();
        return redirect('distribusiresi')->with('status','Hapus Data Berhasil');
    }
}
