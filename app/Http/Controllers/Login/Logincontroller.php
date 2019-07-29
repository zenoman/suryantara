<?php

namespace App\Http\Controllers\Login;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Mews\Captcha\Facades\Captcha;
use App\Http\Controllers\Controller;
use App\models\Loginmodel;

class Logincontroller extends Controller
{
    public function index()
    {
        $setting = DB::table('setting')->get();
        return view('login/index',['title'=>$setting]);
    }
    //====================================================================
    public function masuk(Request $request){
       
        $rules = [
            'password' => 'required',
            'username' => 'required',
            'captcha' => 'required|captcha'
            ];
        $customMessages = [
        'required'  => 'Maaf, data harus di isi',
        'captcha'       => 'Maaf, kode captcha salah'
         ];
        $this->validate($request,$rules,$customMessages);

        $username = $request->username;
        $password =md5($request->password);

        $dataadmin = 
        DB::table('admin')
        ->select(DB::raw('admin.*,cabang.kop,cabang.kota'))
        ->leftjoin('cabang','cabang.id','=','admin.id_cabang')
        ->where([['admin.username',$username],['admin.password',$password]])
        ->get();
        foreach ($dataadmin as $dataadmin) {
            $id = $dataadmin->id;
            $level=$dataadmin->level;
            $cabang=$dataadmin->id_cabang;
            $kop=$dataadmin->kop;
            $kota=$dataadmin->kota;
        }

        $data = DB::table('admin')->where([['username',$username],['password',$password]])->count();
        if($data>0){
                Session::put('username',$request->username);
                Session::put('id',$id);
                Session::put('level',$level);
                Session::put('login',TRUE);
                Session::put('password',$password);
                Session::put('statuslogin','aktiv');
                Session::put('cabang',$cabang);
                Session::put('kop',$kop);
                Session::put('kota',$kota);
                return redirect('dashboard');
        }else{
            return back()->with('status','Maaf, Username atau Password Salah');
        }
    }
    //====================================================================
    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
    //====================================================================
    public function logout(){
        Session::flush();
        return redirect('login');
    }
    //====================================================================
    public function validatelogin(){
        Session::flush();
        return redirect('login')->with('status','Maaf, Anda Harus Login');
    }
    //====================================================================
    public function lockscreen(){
        Session::put('statuslogin','kunci');
        $setweb = DB::table('setting')->limit(1)->get();
        return view('login/ls',['title'=>$setweb]);
    }
    //====================================================================
    public function bukakunci(Request $request){
        $password = md5($request->password);
        if($password==Session::get('password')){
          Session::put('statuslogin','aktiv');
          return redirect('dashboard')->with('status','Selamat Datang Kembali');  
        }else{
            return back()->with('status','Maaf, Password Salah');
        }      

    }

    
}
