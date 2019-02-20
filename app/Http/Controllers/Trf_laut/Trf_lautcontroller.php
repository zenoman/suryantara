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
class trf_lautcontroller extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
$tarif_laut=Trf_lautmodel::paginate(20);
$setting = DB::table('setting')->get();
return view('trflaut/index',['trflaut'=>$tarif_laut,'title'=>$setting]);
}/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/

//------------------------------------
   public function importexcel (){
    $setting = DB::table('setting')->get();
        return view('trflaut/importexcel',['title'=>$setting]);
    }

    public function downloadtemplate(){
         // $file= base_path()."/../public_html/file/template tarif laut.xlsx";
         $file= "file/template tarif laut.xlsx";
            $headers = array(
              'Content-Type: application/excel',
            );
    return Response::download($file, 'template tarif laut.xlsx', $headers);
    return redirect('trflaut/importexcel');
    }


        public function prosesimportexcel(Request $request){
        if($request->hasFile('file')){
        $status = Excel::import(new Trf_lautImport, request()->file('file'));
        }
        return redirect('trflaut')->with('status','Import excel sukses');
    }

    public function exsportexcel(){
    return Excel::download(new Trf_LautExport, 'Export Tarif Laut.xlsx');
    return redirect('trflaut/importexcel');

    }
//-----------------------------------

public  function caridata(Request $request){
    $cari=$request->cari;
	$trflaut= DB::table('tarif_laut')->where('tujuan','like','%'.$cari.'%')->orwhere('kode','like','%'.$cari.'%')->get();
    $setting = DB::table('setting')->get();
	return view('trflaut/pencarian',['trflaut' => $trflaut,'cari'=>$cari,'title'=>$setting]);
}
public function create()
{
    $setting = DB::table('setting')->get();
return view('trflaut/create',['title'=>$setting]);
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
'berat_min' => $request->berat_minimal,'estimasi' => $request->estimasi
]);
return redirect('trflaut')->with('status','Tambah Data Sukses');

}
}
/**
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
$tarif_laut = Trf_lautmodel::find($id);
    $setting = DB::table('setting')->get();
return view('trflaut/edit',['trflaut'=>$tarif_laut,'title'=>$setting]); 
}
/**
* Update the specified resource in storage.
** @param \Illuminate\Http\Request $request
* @param int $id
* @return \Illuminate\Http\Response
*/
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
'estimasi' => $request->estimasi
]);
return redirect('trflaut')->with('status','Edit Data Sukses');
// }
}
/**
* Remove the specified resource from storage.
*
* @param int $id* @return \Illuminate\Http\Response
*/
public function destroy(Request $request)
{
    $id = $request->aid;
Trf_lautmodel::destroy($id);
return back()->with('status','Hapus Data Sukses');
}
//-------------------------------------------
public function haphapus(Request $request)
    {
        // dd($request->pilihid);
            if(!$request->pilihid){
                return back()->with('statuserror','Tidak ada data yang dipilih');
            }else{
        foreach ($request->pilihid as $id) { 
            Trf_lautmodel::destroy($id);
            }
        }
return back()->with('status','Hapus Data Sukses');
}
public function hapusall()
    {
        Trf_lautmodel::truncate();
        return back()->with('status','Hapus Data Sukses');
        //
    }
}