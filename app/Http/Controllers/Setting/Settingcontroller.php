<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\models\Settingmodel;
use Illuminate\Support\Facades\DB;

class Settingcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $setting = DB::table('setting')->where('id',1)->get();
        return view('setting/index',['setting'=>$setting,'title'=>$setting]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        $rules = [
            'namaweb'=>'required|min:3',
            'header' =>'required|min:3',
            'sapaan' =>'required|min:3',
            'alamat' =>'required|min:3',
            'desk'   =>'required',
            'email'  =>'required|min:5|email',
            'kontak' =>'required|min:5|numeric',
            'icon'   =>'image|mimes:jpeg,jpg,png,gif|nullable|max:2000',
            'logo'   =>'image|mimes:jpeg,jpg,png,gif|nullable|max:2000',
            'landing'   =>'image|mimes:jpeg,jpg,png,gif|nullable|max:2000'
        ];
        // dd($request);
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',
        'numeric'   => 'Maaf, data harus angka',
        'email'     => 'Maaf, data harus email'
         ];
        $this->validate($request,$rules,$customMessages);
         $setting = DB::table('setting')->where('id',$id)->get();
        foreach ($setting as $row) {
            if($request->hasFile('icon') && $request->hasFile('logo') && $request->hasFile('landing')){

            if($request->hasFile('icon')){
            File::delete('img/setting/'.$row->icon);
            $nameico=$request->file('icon')->
            getClientOriginalname();
            $lower_file_name=strtolower($nameico);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $nameicon=time().'-'.$replace_space;
            $destination=public_path('img/setting');
            $request->file('icon')->move($destination,$nameicon);
            }

            if($request->hasFile('logo')){
            File::delete('img/setting/'.$row->logo);
            $namelog=$request->file('logo')->
            getClientOriginalname();
            $lower_file_name=strtolower($namelog);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $namelogo=time().'-'.$replace_space;
            $destination=public_path('img/setting');
            $request->file('logo')->move($destination,$namelogo);
            }
            if($request->hasFile('landing')){
            File::delete('img/setting/'.$row->landing);
            $nameland=$request->file('landing')->
            getClientOriginalname();
            $lower_file_name=strtolower($nameland);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $namelanding=time().'-'.$replace_space;
            $destination=public_path('img/setting');
            $request->file('landing')->move($destination,$namelanding);
            }
            DB::table('setting')
            ->where('id',$id)
            ->update([
            'namaweb'=>$request->namaweb,
            'desk'=>$request->desk,
            'alamat'=>$request->alamat,
            'email'=>$request->email,
            'header'=>$request->header,
            'icon'=>$nameicon,
            'logo'=>$namelogo,
            'landing'=>$namelanding,
            'sapaan'=>$request->sapaan,
            'kontak'=>$request->kontak
            ]);

            }elseif($request->hasFile('icon')){
            if($request->hasFile('icon')){
            File::delete('img/setting/'.$row->icon);
            $nameico=$request->file('icon')->
            getClientOriginalname();
            $lower_file_name=strtolower($nameico);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $nameicon=time().'-'.$replace_space;
            $destination=public_path('img/setting');
            $request->file('icon')->move($destination,$nameicon);
            }

            DB::table('setting')
            ->where('id',$id)
            ->update([
            'namaweb'=>$request->namaweb,
            'desk'=>$request->desk,
            'alamat'=>$request->alamat,
            'email'=>$request->email,
            'header'=>$request->header,
            'icon'=>$nameicon,            
            'sapaan'=>$request->sapaan,
            'kontak'=>$request->kontak
            ]);
            }elseif ($request->hasFile('logo')) {

            if($request->hasFile('logo')){
            File::delete('img/setting/'.$row->logo);
            $namelog=$request->file('logo')->
            getClientOriginalname();
            $lower_file_name=strtolower($namelog);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $namelogo=time().'-'.$replace_space;
            $destination=public_path('img/setting');
            $request->file('logo')->move($destination,$namelogo);
            }

             DB::table('setting')
            ->where('id',$id)
            ->update([
            'namaweb'=>$request->namaweb,
            'desk'=>$request->desk,
            'alamat'=>$request->alamat,
            'email'=>$request->email,
            'header'=>$request->header,
            'logo'=>$namelogo,
            'sapaan'=>$request->sapaan,
            'kontak'=>$request->kontak
            ]);
            }elseif ($request->hasFile('landing')) {

            if($request->hasFile('landing')){
            File::delete('img/setting/'.$row->landing);
            $nameland=$request->file('landing')->
            getClientOriginalname();
            $lower_file_name=strtolower($nameland);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $namelanding=time().'-'.$replace_space;
            $destination=public_path('img/setting');
            $request->file('landing')->move($destination,$namelanding);
            }

             DB::table('setting')
            ->where('id',$id)
            ->update([
            'namaweb'=>$request->namaweb,
            'desk'=>$request->desk,
            'alamat'=>$request->alamat,
            'email'=>$request->email,
            'header'=>$request->header,
            'landing'=>$namelanding,
            'sapaan'=>$request->sapaan,
            'kontak'=>$request->kontak
            ]);
            }else{
            DB::table('setting')
            ->where('id',$id)
            ->update([
            'namaweb'=>$request->namaweb,
            'desk'=>$request->desk,
            'alamat'=>$request->alamat,
            'email'=>$request->email,
            'header'=>$request->header,
            'sapaan'=>$request->sapaan,
            'kontak'=>$request->kontak
            ]);
            }

            
        
        }
        return redirect('setting')->with('status','Edit Data Sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
