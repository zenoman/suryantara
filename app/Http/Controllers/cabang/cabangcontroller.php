<?php
namespace App\Http\Controllers\cabang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\cabangexport;

class cabangcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function exsportdata(){
        return Excel::download(new cabangexport, 'Data cabang.xlsx');
    }
    //====================================================================
    public function index(){

        $setting = DB::table('setting')->get();
        $datacabang = DB::table('cabang')
                ->orderby('id','desc')
                ->get();
      return view('cabang/index',['datacabang'=>$datacabang,'title'=>$setting]);
    }
    //====================================================================
    public function create()
    {
        if(Session::get('level') == '1'){
             $setting = DB::table('setting')->get();
        return view('cabang/create',['title'=>$setting]);
        }else{
        return redirect('cabang');
        }
       
    }
    //====================================================================
    public function store(Request $request)
    {
        DB::table('cabang')
        ->insert([
        	'nama'=>$request->nama,
        	'alamat'=>$request->alamat,
            'kota'=>$request->kota,
            'kop'=>$request->kop,
            'koderesi'=>$request->koderesi,
            'norek'=>$request->norek,
            'ket_transfer'=>$request->ket_transfer
        ]);
        return redirect('cabang')->with('status','Data berhasil disimpan');
    }
    
    //====================================================================
    public function show($id)
    {
        $setting = DB::table('setting')->get();
        $data = DB::table('cabang')->where('id',$id)->get();
        return view('cabang/edit',['title'=>$setting,'data'=>$data]);
    }

    //====================================================================
    public function update(Request $request, $id)
    {
        DB::table('cabang')
        ->where('id',$id)
        ->update([
        	'nama'=>$request->nama,
        	'alamat'=>$request->alamat,
            'kota'=>$request->kota,
            'kop'=>$request->kop,
            'koderesi'=>$request->koderesi,
            'norek'=>$request->norek,
            'ket_transfer'=>$request->ket_transfer
        ]);
        return redirect('cabang')->with('status','Data berhasil diubah');
    }
    //====================================================================
    public function destroy($id)
    {
        if(Session::get('level') == '1'){
        DB::table('cabang')->where('id',$id)->delete();
        return redirect('cabang')->with('status','Data berhasil dihapus');
        }else{
        return redirect('cabang');
        }

    }
}
