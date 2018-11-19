<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\models\Settingmodel;

class Settingcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $setting = Settingmodel::get();
        return view('setting/index',['setting'=>$setting]);
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
            'email'=>'required|min:5|email',
            'kontak'=>'required|min:5|numeric',
            'icon'=>'image|mimes:jpeg,jpg,png,gif|nullable|max:2000',
            'logo'=>'image|mimes:jpeg,jpg,png,gif|nullable|max:2000'
        ];
        // dd($request);
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',
        'numeric'   => 'Maaf, data harus angka',
        'email'     => 'Maaf, data harus email'
         ];
        $this->validate($request,$rules,$customMessages);
        $setting=Settingmodel::find($id);
        if($request->hasFile('icon')){
            File::delete('img/setting/'.$setting->icon);
            $nameicon=$request->file('icon')->
            getClientOriginalname();
            $lower_file_name=strtolower($nameicon);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $nameicon=time().'-'.$replace_space;
            $destination=public_path('img/setting');
            $request->file('icon')->move($destination,$nameicon);
        }
        if($request->hasFile('logo')){
            File::delete('img/setting/'.$setting->logo);
            $namelog=$request->file('logo')->
            getClientOriginalname();
            $lower_file_name=strtolower($namelog);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $namelogo=time().'-'.$replace_space;
            $destination=public_path('img/setting');
            $request->file('logo')->move($destination,$namelogo);
        }
        if($request->hasFile('icon','logo')){
        Settingmodel::find($id)->update([
            'namaweb'=>$request->namaweb,
            'kontak'=>$request->kontak,
            'email'=>$request->email,
            'icon'=>$nameicon,
            'logo'=>$namelogo
        ]);
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