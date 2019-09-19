<?php

namespace App\Http\Controllers\Admin;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\models\Adminmodel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class Admincontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //======================================================================
    public function index(){
        $setting = DB::table('setting')->get();
        $datadmin = DB::table('users')
        		->select(DB::raw('users.*,cabang.nama as namacabang, roles.level as statusadmin'))
        		->leftjoin('cabang','cabang.id','=','users.id_cabang')
                ->leftjoin('roles','roles.id','=','users.level')
                ->where('users.id','!=',Auth::user()->id)
        		->get();
    	return view('admin/index',['users'=>$datadmin,'title'=>$setting]);
    }

    //======================================================================
    public function create(){
        $table="users";
        $tut="kode";
    	$cabang = DB::table('cabang')->get();
       	$setting = DB::table('setting')->get();
        $role = DB::table('roles')->get();
        $q=DB::table('users')->max('kode');

        	if(!$q){
            	$finalkode = "Admin-000001";
        	}else{
	            $newkode    = explode("-", $q);
	            $nomer      = sprintf("%06s",$newkode [1]+1);
	            $finalkode  = "Admin-".$nomer;
        	}
        return view('admin/create',['title'=>$setting,'role'=>$role,'kode'=>$finalkode,'cabang'=>$cabang]);
    }
    //======================================================================
    public function changepas($id){
        $admin = Adminmodel::find($id);
        $setting = DB::table('setting')->get();
        return view('admin/changepas',['datadmin'=>$admin,'title'=>$setting]);
    }
    //======================================================================
    public function actionchangepas(Request $request, $id){
        if($request->konfirmasi_password_baru==$request->password_baru){
            Adminmodel::find($id)->update([
                'password' =>Hash::make($request->konfirmasi_password_baru)
            ]);
        return redirect('/admin')->with('status','Edit Password berhasil');
        }else{
             return redirect('admin/'.$id.'/changepas')->with('errorpass2','Maaf, Konfimasi Password Baru Anda Salah');
            }
        
       
    }
    //===================================================================
    public function store(Request $request){
    	$rules = [ 	
    	'username'  => 'required',
        'password'  => 'required|min:4',
        'nama'  => 'required',
        'email'  => 'required|email',
        'telp'  => 'required|numeric',
        'alamat'  => 'required|min:3',
        'level'=>'required'];

    	$customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',
        'numeric'   => 'Maaf, data harus angka',
        'email'     => 'Maaf, data harus email'];

        $this->validate($request,$rules,$customMessages);
        $q=DB::table('users')->max('kode');
        	if(!$q){
            	$finalkode = "Admin-000001";
        	}else{
            	$newkode    = explode("-", $q);
            	$nomer      = sprintf("%06s",$newkode [1]+1);
            	$finalkode  = "Admin-".$nomer;
        	}
        $kode=$request->kode;
        $dtlam= DB::table('users')->where('kode',$kode)->count();
			if($dtlam > 0){
    			return redirect('admin/create')
    			->with('status','Kode admin Yang anda masukan sudah ada!!');
			}else{
		        DB::table('users')->insert([
		            'kode'  => $finalkode,
		            'username'  => $request->username,
		            'password'  =>Hash::make($request->password),
		            'nama'  => $request->nama,
		            'telp'  => $request->telp,
		            'email'  => $request->email,
		            'alamat'  => $request->alamat,
		            'level' => $request->level,
		        	'id_cabang'=>$request->cabang]);
        		return redirect('admin')
        		->with('status','Input Data Sukses');
        	}
    }
    //=================================================================
    public function edit($id)
    {
        $admin = Adminmodel::find($id);
        $role = DB::table('roles')->get();
        $cabang = DB::table('cabang')->get();
        $setting = DB::table('setting')->get();
        return view('admin/edit',['datadmin'=>$admin,'role'=>$role,'title'=>$setting,'cabang'=>$cabang]);
    }
    //======================================================================
    public function update(Request $request, $id)
    {
        
          $rules = [
            'username'  => 'required|min:5',
            'nama'  => 'required',
            'email'  => 'required|min:5|email',
            'telp'  => 'required|min:5|numeric',
            'alamat'  => 'required|min:5'];
	        $customMessages = [
	        'required'  => 'Maaf, :attribute harus di isi',
	        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',
	        'numeric'   => 'Maaf, data harus angka',
	        'email'     => 'Maaf, data harus email'];

        	$this->validate($request,$rules,$customMessages);
            Adminmodel::find($id)->update([
            'nama'  => $request->nama,
            'username'  => $request->username,            
            'email'  => $request->email,
            'telp'  => $request->telp,
            'alamat'  => $request->alamat,
            'level' => $request->level,
            'id_cabang'=>$request->cabang
            ]);
        return redirect('admin')->with('status','Edit Data Sukses');
    }
    //======================================================================
    public function destroy(Request $request)
    {
        $id = $request->aid;
         Adminmodel::destroy($id);
        return back()->with('status','Hapus Data Sukses');
    }
}
