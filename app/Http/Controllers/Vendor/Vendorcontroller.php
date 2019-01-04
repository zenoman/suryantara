<?php

namespace App\Http\Controllers\Vendor;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use App\models\Vendormodel;
use Illuminate\Support\Facades\DB;

use App\Imports\VendorImport;
use App\Exports\VendorExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
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
$setting = DB::table('setting')->get();
return view('vendor/index',['vendor'=>$vnd,'title'=>$setting]);
}/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
//------------------------------------
   public function importexcel (){
    $setting = DB::table('setting')->get();
        return view('vendor/importexcel',['title'=>$setting]);
    }

    public function downloadtemplate(){
         $file= public_path(). "/file/template vendor.xlsx";
            $headers = array(
              'Content-Type: application/excel',
            );
    return Response::download($file, 'template vendor.xlsx', $headers);
    return redirect('vendor/importexcel');
    }


        public function prosesimportexcel(Request $request){
        if($request->hasFile('file')){
        Excel::import(new VendorImport, request()->file('file'));
        }
        return redirect('vendor')->with('status','Import excel sukses');
    }

    public function exsportexcel(){
    return Excel::download(new VendorExport, 'Vendor.xlsx');
    return redirect('vendor/importexcel');

    }
//-----------------------------------
public function caridata(Request $request)
    {
        $ven = DB::table('vendor')->where('vendor','like','%'.$request->cari.'%')->get();
        $setting = DB::table('setting')->get();
        return view('vendor/pencarian', ['vendor'=>$ven, 'cari'=>$request->cari,'title'=>$setting]);
    }

public function create()
{
	$setting = DB::table('setting')->get();
return view('vendor/create',['title'=>$setting]);
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
return redirect('vendor')->with('status','tambah Data Sukses');
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
$setting = DB::table('setting')->get();
return view('vendor/edit',['vendor'=>$vnd,'title'=>$setting]); }
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
return redirect('vendor')->with('status','edit Data Sukses');
}
/**
* Remove the specified resource from storage.
*
* @param int $id* @return \Illuminate\Http\Response
*/
public function destroy(Request $request)
    {
        $id = $request->aid;
Vendormodel::destroy($id);
return back()->with('status','hapus Data Sukses');
}
}