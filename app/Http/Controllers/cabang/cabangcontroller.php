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
        $setting = DB::table('setting')->get();
        return view('cabang/create',['title'=>$setting]);
    }
    //====================================================================
    public function store(Request $request)
    {
        DB::table('cabang')
        ->insert([
        	'nama'=>$request->nama,
        	'alamat'=>$request->alamat,
            'kota'=>$request->kota,
            'kop'=>$request->kop
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
            'kop'=>$request->kop
        ]);
        return redirect('cabang')->with('status','Data berhasil diubah');
    }
    //====================================================================
    public function destroy($id)
    {
        DB::table('cabang')->where('id',$id)->delete();
        return redirect('cabang')->with('status','Data berhasil dihapus');
    }
}
