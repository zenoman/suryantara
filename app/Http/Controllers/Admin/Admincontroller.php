<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use App\models\Adminmodel;
class Admincontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Adminmodel::get();
        return view('admin/index',['admin'=>$admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/create');
    }

    public function changepass($id)
    {
        $admin = Adminmodel::find($id);
        return view('admin/changepass',['dataadmin'=>$admin]);
    }

    public function actionchangepass(Request $request, $id){
        $rules = [
                'konfirmasi_username'       =>  'required|min:5',
                'konfirmasi_password'       =>  'required|min:5',
                'konfirmasi_password_baru'  =>  'required|min:5'
            ];
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit'
         ];
        $this->validate($request,$rules,$customMessages);
        $newpass =md5($request->konfirmasi_password);
        //dd($newpass);
        if($request->password==$newpass){
            if($request->konfirmasi_password_baru==$request->password_baru){
                 Adminmodel::find($id)->update([
            'password' => md5($request->konfirmasi_password_baru)
        ]);
        return redirect('admin')->with('status','Edit Password berhasil');
            }else{
             return redirect('admin/'.$id.'/changepass')->with('errorpass2','Maaf, Konfimasi Password Baru Anda Salah');
            }
        }else{
        return redirect('admin/'.$id.'/changepass')->with('errorpass1','Maaf, Konfimasi Password Anda Salah');
        }
       
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
                    'kode'      => 'required',
                    'username'  => 'required|min:5',
                    'password'  => 'required|min:5'
                    ];

    $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit'
    ];
        $this->validate($request,$rules,$customMessages);
        Adminmodel::create([
            'kode'  => $request->kode,
            'username'  => $request->username,
            'password'  => md5($request->password)
        ]);

        return redirect('admin')->with('status','Input Data Sukses');
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
        $admin = Adminmodel::find($id);
        return view('admin/edit',['datadmin'=>$admin]);
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
                    'kode'      => 'required',
                    'username'  => 'required|min:5',
                    'password'  => 'required|min:5'
            ];
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit'
        //'same'      => 'Maaf, Pastikan :attribute dan :other sama',
         ];
        $this->validate($request,$rules,$customMessages);
        
        Adminmodel::find($id)->update([
            'kode'=>$request->kode,
            'username'=>$request->username,
            'password'=>$request->password
            ]);
        return redirect('admin')->with('status','Edit Data Sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Adminmodel::destroy($id);
        return redirect('admin')->with('status','Hapus Data Sukses');
    }
}
