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

class Trf_daratcontroller extends Controller
{
    /**
* Display a listing of the resource.
* 
* @return \Illuminate\Http\Response
*/
public function index()
{
// dd("index");
$tarif_darat=Trf_daratmodel::paginate(20);
//dd($tarif_darat);
$setting = DB::table('setting')->get();
return view('trfdarat/index',['trf_drt'=>$tarif_darat,'title'=>$setting]);
}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/

//------------------------------------
   public function importexcel (){
$setting = DB::table('setting')->get();
        return view('trfdarat/importexcel',['title'=>$setting]);
    }

    public function downloadtemplate(){
         // $file= base_path()."/../public_html/file/template tarif darat.xlsx";
         $file="file/template tarif darat.xlsx";
            $headers = array(
              'Content-Type: application/excel',
            );
    return Response::download($file, 'template tarif darat.xlsx', $headers);
    return redirect('trfdarat/importexcel');
    }


        public function prosesimportexcel(Request $request){
        if($request->hasFile('file')){
        Excel::import(new TrfDaratImport, request()->file('file'));
        }
        return redirect('trfdarat')->with('status','Import excel sukses');
    }

    public function exsportexcel(){
    return Excel::download(new TrfdaratExport, 'Export Tarif Darat.xlsx');
    return redirect('trfdarat/importexcel');

    }
//-----------------------------------

public function caridata(Request $request)
    {
        $url = $request->fullurl();
        // dd($url);
        $cari=$request->cari;
        $trf_drt = DB::table('tarif_darat')->where('tujuan','like','%'.$cari.'%')->orwhere('kode','like','%'.$cari.'%')->get();
        $setting = DB::table('setting')->get();
        return view('trfdarat/pencarian', ['trf_drt'=>$trf_drt, 'cari'=>$cari,'title'=>$setting,'url'=>$url]);
    }

public function create(){
    $setting = DB::table('setting')->get();
return view('trfdarat/create',['title'=>$setting]);
}
/**
* Store a newly created resource in storage.
*
* @param \Illuminate\Http\Request $request
* @return \Illuminate\Http\Response
*/
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
    return redirect('trfdarat/create')->with('status','Kode tujuan tarif darat yang anda masukan sudah ada!! ');
}else{
Trf_daratmodel::create([
'kode' => $request->kode,
'tujuan' => $request->tujuan,
'tarif' => $request->tarif,
'berat_min' => $request->berat_minimal,
'estimasi' => $request->estimasi
]);

return redirect('trfdarat')->with('status','Input Data Sukses');
}
}/**
* Display the specified resource.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{ }
/**
* Show the form for editing the specified resource.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
$tarif_darat = Trf_daratmodel::find($id);
$setting = DB::table('setting')->get();
return view('trfdarat/edit',['trf_drt'=>$tarif_darat,'title'=>$setting]);
}
/**
* Update the specified resource in storage.
*
* @param \Illuminate\Http\Request $request
* @param int $id
* @return \Illuminate\Http\Response
*/
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
'estimasi' => $request->estimasi
]);
return redirect('trfdarat')->with('status','Edit Data Sukses');
}
/**
* Remove the specified resource from storage.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function destroy(Request $request)
    {
        $id = $request->aid;
Trf_daratmodel::destroy($id);
return back()->with('status','Hapus Data Sukses');
}
//------------------------------------
public function hapus($id)
    {
         Trf_daratmodel::destroy($id);
        return redirect('/trfdarat')->with('status','Hapus Data Sukses');
    }
//-------------------------------------------
public function haphapus(Request $request)
    {
        // dd($request->pilihid);
            if(!$request->pilihid){
                return back()->with('statuserror','Tidak ada data yang dipilih');
            }else{
        foreach ($request->pilihid as $id) { 
            Trf_daratmodel::destroy($id);
            }
        }
return back()->with('status','Hapus Data Sukses');
}

}
