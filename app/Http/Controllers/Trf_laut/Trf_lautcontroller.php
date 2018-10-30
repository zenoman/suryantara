<?php

namespace App\Http\Controllers\Trf_laut;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use App\models\Trf_lautmodel;

class trf_lautcontroller extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
$tarif_laut=Trf_lautmodel::get();
return view('trflaut/index',['trflaut'=>$tarif_laut]);
}/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
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
'berat_minimal' => 'required|min:1',
'estimasi' => 'required|min:3'
];
$this->validate($request,$rules);
Trf_lautmodel::create([
'kode' => $request->kode,
'tujuan' => $request->tujuan,
'tarif' => $request->tarif,
'berat_min' => $request->berat_minimal,'estimasi' => $request->estimasi
]);
return redirect('trflaut');
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
return view('trflaut/edit',['trflaut'=>$tarif_laut]); }
/**
* Update the specified resource in storage.
** @param \Illuminate\Http\Request $request
* @param int $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request)
{
$rules = [
'kode' => 'required|min:3',
'tujuan' => 'required|min:3',
'tarif' => 'required|min:3',
'berat_minimal' => 'required|min:1',
'estimasi' => 'required|min:3'
];
$this->validate($request,$rules);
$id=$request->id_laut;
Trf_lautmodel::find($id)->update([
'kode' => $request->kode,
'tujuan' => $request->tujuan,
'tarif' => $request->tarif,
'berat_min' => $request->berat_minimal,
'estimasi' => $request->estimasi
]);
return redirect('trflaut');
}
/**
* Remove the specified resource from storage.
*
* @param int $id* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
Trf_lautmodel::destroy($id);
return redirect('trflaut');
}
}