<?php

namespace App\Http\Controllers\Trfdarat;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use App\models\Trf_daratmodel;

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
$tarif_darat=Trf_daratmodel::get();
//dd($tarif_darat);
return view('trfdarat/index',['trf_drt'=>$tarif_darat]);
}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create(){
return view('trfdarat/create');
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
Trf_daratmodel::create([
'kode' => $request->kode,
'tujuan' => $request->tujuan,
'tarif' => $request->tarif,
'berat_min' => $request->berat_minimal,
'estimasi' => $request->estimasi
]);

return redirect('trfdarat');
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
return view('trfdarat/edit',['trf_drt'=>$tarif_darat]);
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
'berat_minimal' => 'required|min:1',
'estimasi' => 'required|min:3'
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
return redirect('trfdarat');
}
/**
* Remove the specified resource from storage.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
Trf_daratmodel::destroy($id);return redirect('trfdarat');
}
}
