<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use App\models\Vendormodel;

class Vendorcontroller extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
$vnd=Vendormodel::get();
return view('vendor/index',['vendor'=>$vnd]);
}/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
return view('vendor/create');
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
'alamat' => $request->alamat
]);
return redirect('vendor');
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
$vnd = Vendormodel::find($id);
return view('vendor/edit',['vendor'=>$vnd]); }
/**
* Update the specified resource in storage.
** @param \Illuminate\Http\Request $request
* @param int $id
* @return \Illuminate\Http\Response
*/
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
        'alamat' => $request->alamat
]);
return redirect('vendor');
}
/**
* Remove the specified resource from storage.
*
* @param int $id* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
Vendormodel::destroy($id);
return redirect('vendor');
}
}