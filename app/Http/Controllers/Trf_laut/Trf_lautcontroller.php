<?php

namespace App\Http\Controllers\Trf_laut;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\models\Trf_lautmodel;

use App\Imports\Trf_lautImport;
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
return view('trflaut/index',['trflaut'=>$tarif_laut]);
}/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
<<<<<<< HEAD
//------------------------------------
   public function importexcel (){
        return view('trflaut/importexcel');
    }

    public function downloadtemplate(){
         $file= public_path(). "/file/template tarif laut.xlsx";
            $headers = array(
              'Content-Type: application/excel',
            );
    return Response::download($file, 'template tarif laut.xlsx', $headers);
    return redirect('trflaut/importexcel');
    }


        public function prosesimportexcel(Request $request){
        if($request->hasFile('file')){
        Excel::import(new Trf_lautImport, request()->file('file'));
        }
        return redirect('trflaut')->with('status','Import excel sukses');
    }
//-----------------------------------
=======
public  function caridata(Request $request){
	$trflaut= DB::table('tarif_laut')->where('tujuan','like','%'.$request->cari.'%')->get();
	return view('trflaut/pencarian',['trflaut' => $trflaut,'cari'=>$request->cari]);
}
>>>>>>> master
public function create()
{
return view('trflaut/create');
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
Trf_lautmodel::create([
'kode' => $request->kode,
'tujuan' => $request->tujuan,
'tarif' => $request->tarif,
'berat_min' => $request->berat_minimal,'estimasi' => $request->estimasi
]);
return redirect('trflaut')->with('status','Tambah Data Sukses');
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
return view('trflaut/edit',['trflaut'=>$tarif_laut]); 
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

Trf_lautmodel::find($id)->update([
'kode' => $request->kode,
'tujuan' => $request->tujuan,
'tarif' => $request->tarif,
'berat_min' => $request->berat_minimal,
'estimasi' => $request->estimasi
]);
return redirect('trflaut')->with('status','Edit Data Sukses');
}
/**
* Remove the specified resource from storage.
*
* @param int $id* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
Trf_lautmodel::destroy($id);
return redirect('trflaut')->with('status','Hapus Data Sukses');
}
}