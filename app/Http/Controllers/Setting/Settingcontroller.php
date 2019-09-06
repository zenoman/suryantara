<?php

namespace App\Http\Controllers\Setting;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\models\Settingmodel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Settingcontroller extends Controller
{
    public function index()
    {
        if(Session::get('level') !='admin'){

        $setting = Settingmodel::get();
        $setting = DB::table('setting')->get();
        return view('setting/index',['setting'=>$setting,'title'=>$setting]);
        }else{
            return redirect('/dashboard');
        }
    }

    //==================================================================
    public function update(Request $request, $id)
    {
        $rules = [
            'namaweb'=>'required|min:3',
            'email'=>'required|min:5|email',
            'kontak'=>'required|min:5|numeric',
            'alamat'=>'required',
            'icon'=>'image|mimes:jpeg,jpg,png,gif|nullable|max:2000',
            'logo'=>'image|mimes:jpeg,jpg,png,gif|nullable|max:2000'
        ];

        $customMessages = [
            'required'  => 'Maaf, :attribute harus di isi',
            'min'       => 'Maaf, data yang anda masukan terlalu sedikit',
            'numeric'   => 'Maaf, data harus angka',
            'email'     => 'Maaf, data harus email'
         ];

        $this->validate($request,$rules,$customMessages);
        $setting=Settingmodel::find($id);
        $setting= DB::table('setting')->where('id',$id)->get();

        foreach ($setting as $row) {
            if($request->hasFile('icon')){
                File::delete('img/setting/'.$row->icon);
                $nameicon=$request->file('icon')->
                getClientOriginalname();
                $lower_file_name=strtolower($nameicon);
                $replace_space=str_replace(' ', '-', $lower_file_name);
                $nameicon=time().'-'.$replace_space;
                $destination=base_path('../public_html/img/setting');
                $request->file('icon')->move($destination,$nameicon);
            }
            if($request->hasFile('logo')){
                File::delete('img/setting/'.$row->logo);
                $namelog=$request->file('logo')->
                getClientOriginalname();
                $lower_file_name=strtolower($namelog);
                $replace_space=str_replace(' ', '-', $lower_file_name);
                $namelogo=time().'-'.$replace_space;
                $destination=base_path('../public_html/img/setting');
                $request->file('logo')->move($destination,$namelogo);
            }
        }

        if($request->hasFile('icon')){
            Settingmodel::find($id)->update([
                'namaweb'=>$request->namaweb,
                'kontak'=>$request->kontak,
                'alamat'=>$request->alamat,
                'header'=>$request->header,
                'email'=>$request->email,
                'desk'=>$request->deskripsi,
                'icon'=>$nameicon,
                'desk_udara'=>$request->desk_udara,
                'desk_darat'=>$request->desk_darat,
                'desk_laut'=>$request->desk_laut,
                'pengumuman'=>$request->pengumuman
            ]);
        }else if($request->hasFile('logo')){
            Settingmodel::find($id)->update([
                'namaweb'=>$request->namaweb,
                'kontak'=>$request->kontak,
                'header'=>$request->header,
                'email'=>$request->email,
                'desk'=>$request->deskripsi,
                'logo'=>$namelogo,
                'desk_udara'=>$request->desk_udara,
                'desk_darat'=>$request->desk_darat,
                'desk_laut'=>$request->desk_laut,
                'pengumuman'=>$request->pengumuman]);
        }else if($request->hasFile('icon','logo')){
            Settingmodel::find($id)->update([
                'namaweb'=>$request->namaweb,
                'kontak'=>$request->kontak,
                'alamat'=>$request->alamat,
                'header'=>$request->header,
                'email'=>$request->email,
                'desk'=>$request->deskripsi,
                'icon'=>$nameicon,
                'logo'=>$namelogo,
                'desk_udara'=>$request->desk_udara,
                'desk_darat'=>$request->desk_darat,
                'desk_laut'=>$request->desk_laut,
                'pengumuman'=>$request->pengumuman
            ]);
        }else{
            Settingmodel::find($id)->update([
                'namaweb'=>$request->namaweb,
                'header'=>$request->header,
                'kontak'=>$request->kontak,
                'alamat'=>$request->alamat,
                'desk'=>$request->deskripsi,
                'email'=>$request->email,
                'desk_udara'=>$request->desk_udara,
                'desk_darat'=>$request->desk_darat,
                'desk_laut'=>$request->desk_laut,
                'pengumuman'=>$request->pengumuman
            ]);
        }

        return redirect('setting')->with('status','Edit Data Sukses');
    }
}
