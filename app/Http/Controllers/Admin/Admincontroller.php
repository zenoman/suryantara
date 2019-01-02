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
    if(Session::get('level') == 'programer') {
        //________________________________________________________________
        $datadmin = DB::table('admin')->where('id','!=',$id)->paginate(20);
    }else{
        //________________________________________________________________
        $level='admin';
        $datadmin = DB::table('admin')->where('id','!=',$id)->where('level','=',$level)->paginate(20);
    }
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
        $setting = DB::table('setting')->get();
        $id=Session::get('id');
        $cari=$request->cari;
    if(Session::get('level') == 'programer') {
        //_______________________________________________
        $datadmin = DB::table('admin')->where('id','!=',$id)
        ->where(function ($huft) use ($cari){
            $huft->where('nama','like','%'.$cari.'%')
            ->orwhere('kode','like','%'.$cari.'%')
            ->orwhere('username','like','%'.$cari.'%')
            ->orwhere('email','like','%'.$cari.'%');
        })
        ->paginate(20);
    }else{
        //_______________________________________________
        $level='admin';
        $datadmin = DB::table('admin')->where('id','!=',$id)
        ->where(function($huft) use ($cari){
            $huft->where('nama','like','%'.$cari.'%')
            ->orwhere('kode','like','%'.$cari.'%')
            ->orwhere('username','like','%'.$cari.'%')
            ->orwhere('email','like','%'.$cari.'%');
        })->where(function($huft) use ($level){
            $huft->where('level','=',$level);
        })
        ->paginate(20);
    }
        return view('admin/pencarian', ['datadmin'=>$datadmin, 'cari'=>$cari,'title'=>$setting]);
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

        if(Session::get('id') == $request->id && Session::get('level') != 'admin'){
        //_____________________________________________________________
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
    }else{
        //_____________________________________________________________
        $newpass =md5($request->konfirmasi_password);
        //dd($newpass);
        if($request->password==$newpass){
            if($request->konfirmasi_password_baru==$request->password_baru){
                 Adminmodel::find($id)->update([
            'password' =>md5($request->konfirmasi_password_baru)
        ]);
        return redirect('/')->with('status','Edit Password berhasil');
            }else{
             return redirect('admin/'.$id.'/changepas')->with('errorpass2','Maaf, Konfimasi Password Baru Anda Salah');
            }
        }else{
        return redirect('admin/'.$id.'/changepas')->with('errorpass1','Maaf, Konfimasi Password Anda Salah');
        }
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
                    $kode=$request->kode;
$dtlam= DB::table('admin')->where('kode',$kode)->count();
if($dtlam > 0){
    return redirect('admin/create')->with('status','Kode admin Yang anda masukan sudah ada!!');
}else{
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
            //_____________________________________________________________
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
       } else if(Session::get('id') == $request->id && Session::get('level') == 'programer') {
        //_____________________________________________________________
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
            //_____________________________________________________________
            $rules = [
                    'username'  => 'required|min:5',
                    'nama'  => 'required',
                    'email'  => 'required|min:5|email',
                    'telp'  => 'required|min:5|numeric',
                    'alamat'  => 'required|min:5'
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
        return redirect('admin')->with('status','Edit Data Sukses');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->aid;
         Adminmodel::destroy($id);
        // return redirect('admin')->with('status','Hapus Data Sukses');
        return back()->with('status','Hapus Data Sukses');
    }
}
