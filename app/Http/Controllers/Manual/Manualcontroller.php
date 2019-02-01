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
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
class Manualcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $Manuals = Manualmodel::paginate(20);
        $setting = DB::table('setting')->get();
        $datmanual = DB::table('kode_resimanual')->paginate(20);
        // dd($datManual);
        return view('Manual/index',['manual'=>$datmanual,'title'=>$setting]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//------------------------------------
    public function caridata(Request $request)
    {
        $cari=$request->cari;
        $manu = DB::table('kode_resimanual')->where('faktur','like','%'.$cari.'%')->get();
            $setting = DB::table('setting')->get();
        return view('Manual/pencarian', ['manual'=>$manu, 'cari'=>$cari,'title'=>$setting]);
    }
   public function importexcel (){
$setting = DB::table('setting')->get();
        return view('Manual/importexcel',['title'=>$setting]);
    }
        public function downloadtemplate(){
         $file= base_path()."/../public_html/file/template resi manual.xlsx";
            $headers = array(
              'Content-Type: application/excel',
            );
    return Response::download($file, 'template tarif darat.xlsx', $headers);
    return redirect('trfdarat/importexcel');
    }
        public function prosesimportexcel(Request $request){
        if($request->hasFile('file')){
        Excel::import(new ManualImport, request()->file('file'));
        }
        return redirect('Manual')->with('status','Import excel sukses');
    }
//-----------------------------------

    public function create()
    {
        $setting = DB::table('setting')->get();
        return view('Manual/create',['title'=>$setting]);
    }

    public function store(Request $request)
    {
        $rules = [
                    'kode'  =>'required'
                    ];
 
    $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
    ];
        $this->validate($request,$rules,$customMessages);
        //
        $data=$request->kode;
        for ($i=0; $i < count($data) ; $i++) { 
            if($i == count($data)-1){
                $final = $data[$i];
            }else{
                $final = $data[$i];
            }
        Manualmodel::create([
            'faktur'  => $final

        ]);
        }
        // dd($final);
        
        return redirect('Manual')->with('status','Input Data Sukses');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->aid;
         Manualmodel::destroy($id);
        // return redirect('Manual')->with('status','Hapus Data Sukses');
        return back()->with('status','Hapus Data Sukses');
    }
    public function haphapus(Request $request)
    {
        // dd($request->pilihid);
            if(!$request->pilihid){
                return back()->with('statuserror','Tidak ada data yang dipilih');
            }else{
        foreach ($request->pilihid as $id) { 
            Manualmodel::destroy($id);
            }
        }
return back()->with('status','Hapus Data Sukses');
}
}
