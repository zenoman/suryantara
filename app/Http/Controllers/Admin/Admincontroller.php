<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\models\Adminmodel;
use Illuminate\Support\Facades\Session;
class Admincontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $admins = Adminmodel::paginate(20);
        $setting = DB::table('setting')->get();
        $id=Session::get('id');
        $datadmin = DB::table('admin')->where('id','!=',$id)->paginate(20);
        // dd($datadmin);
        return view('admin/index',['admin'=>$datadmin,'title'=>$setting]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function caridata(Request $request)
    {
        $datadmin = DB::table('admin')->where('nama','like','%'.$request->cari.'%')->get();
        $setting = DB::table('setting')->get();
        return view('admin/pencarian', ['datadmin'=>$datadmin, 'cari'=>$request->cari,'title'=>$setting]);
    }


    public function create()
    {
        $setting = DB::table('setting')->get();
        return view('admin/create',['title'=>$setting]);
    }

    public function changepas($id)
    {
        $admin = Adminmodel::find($id);
        $setting = DB::table('setting')->get();
        return view('admin/changepas',['datadmin'=>$admin,'title'=>$setting]);
    }

    public function actionchangepas(Request $request, $id){
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
            'password' =>md5($request->konfirmasi_password_baru)
        ]);
        return redirect('admin')->with('status','Edit Password berhasil');
            }else{
             return redirect('admin/'.$id.'/changepas')->with('errorpass2','Maaf, Konfimasi Password Baru Anda Salah');
            }
        }else{
        return redirect('admin/'.$id.'/changepas')->with('errorpass1','Maaf, Konfimasi Password Anda Salah');
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
                    'username'  => 'required',
                    'password'  => 'required|min:5',
                    'nama'  => 'required',
                    'email'  => 'required|min:5|email',
                    'telp'  => 'required|min:5|numeric',
                    'alamat'  => 'required|min:5',
                    'level'=>'required'
                    ];

    $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',
        'numeric'   => 'Maaf, data harus angka',
        'email'     => 'Maaf, data harus email'
    ];
        $this->validate($request,$rules,$customMessages);
        Adminmodel::create([
            'kode'  => $request->kode,
            'username'  => $request->username,
            'password'  =>md5($request->password),
            'nama'  => $request->nama,
            'email'  => $request->email,
            'telp'  => $request->telp,
            'alamat'  => $request->alamat,
            'level' => $request->level

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
        $setting = DB::table('setting')->get();
        return view('admin/edit',['datadmin'=>$admin,'title'=>$setting]);
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
        if(Session::get('id') == $request->id && Session::get('level') == 'admin'){
                    $rules = [
                    'username'  => 'required|min:5',
                    'nama'  => 'required',
                    'email'  => 'required|min:5|email',
                    'telp'  => 'required|min:5|numeric',
                    'alamat'  => 'required|min:5',
            ];
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',
        'numeric'   => 'Maaf, data harus angka',
        'email'     => 'Maaf, data harus email'

         ];
        $this->validate($request,$rules,$customMessages);
        Adminmodel::find($id)->update([
            'nama'  => $request->nama,
            'username'  => $request->username,            
            'email'  => $request->email,
            'telp'  => $request->telp,
            'alamat'  => $request->alamat
            ]);
        return redirect('/dashboard')->with('status','Edit Data Sukses');
       } else if(Session::get('id') == $request->id && Session::get('level') != 'admin') {
        $rules = [
                    'kode'      => 'required',
                    'username'  => 'required|min:5',
                    'nama'  => 'required',
                    'email'  => 'required|min:5|email',
                    'telp'  => 'required|min:5|numeric',
                    'alamat'  => 'required|min:5',
                    'level'=>'required'
            ];
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',
        'numeric'   => 'Maaf, data harus angka',
        'email'     => 'Maaf, data harus email'

         ];
        $this->validate($request,$rules,$customMessages);
            Adminmodel::find($id)->update([
            'kode'  => $request->kode,
            'nama'  => $request->nama,
            'username'  => $request->username,            
            'email'  => $request->email,
            'telp'  => $request->telp,
            'alamat'  => $request->alamat,
            'level' => $request->level
            ]);
        return redirect('/dashboard')->with('status','Edit Data Sukses');
        }else{
            $rules = [
                    'kode'      => 'required',
                    'username'  => 'required|min:5',
                    'nama'  => 'required',
                    'email'  => 'required|min:5|email',
                    'telp'  => 'required|min:5|numeric',
                    'alamat'  => 'required|min:5',
                    'level'=>'required'
            ];
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',
        'numeric'   => 'Maaf, data harus angka',
        'email'     => 'Maaf, data harus email'

         ];
        $this->validate($request,$rules,$customMessages);
            Adminmodel::find($id)->update([
            'kode'  => $request->kode,
            'nama'  => $request->nama,
            'username'  => $request->username,            
            'email'  => $request->email,
            'telp'  => $request->telp,
            'alamat'  => $request->alamat,
            'level' => $request->level
            ]);
        return redirect('admin')->with('status','Edit Data Sukses');
        }
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
