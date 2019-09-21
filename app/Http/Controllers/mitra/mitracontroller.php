<?php

namespace App\Http\Controllers\mitra;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class mitracontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if( Session::get('level') == '1' || 
            Session::get('level') == '3' || 
            Session::get('level') == '2'){
          $vnd=DB::table('mitra')
            ->select(DB::raw('mitra.*,cabang.nama as namacabang'))
            ->leftjoin('cabang','cabang.id','=','mitra.id_cabang')
            ->orderby('mitra.id','desc')
            ->get();
        }else{
            $vnd=DB::table('mitra')
            ->select(DB::raw('mitra.*,cabang.nama as namacabang'))
            ->leftjoin('cabang','cabang.id','=','mitra.id_cabang')
            ->where('id_cabang',Session::get('cabang'))
            ->orderby('mitra.id','desc')
            ->get();
        }
        $setting = DB::table('setting')->get();
        return view('mitra/index',['mitra'=>$vnd,'title'=>$setting]);
        }

        //=========================================================
    public function create()
    {
        $cabang = DB::table('cabang')->get();
        $setting = DB::table('setting')->get();
        return view('mitra/create',['title'=>$setting,'cabang'=>$cabang]);
    }
    //============================================================================
    public function store(Request $request)
    {
        DB::table('mitra')
        ->insert([
        'nama' => $request->nama,
        'notelp' => $request->telp,
        'alamat' => $request->alamat,
        'id_cabang'=>$request->idcabang
        ]);
    return redirect('mitra')->with('status','tambah Data Sukses');
    }
    //====================================
    public function edit($id)
    {
        
    $cabang = DB::table('cabang')->get();
    $vnd = DB::table('mitra')->where('id',$id)->get();
    $setting = DB::table('setting')->get();
    return view('mitra/edit',['mitra'=>$vnd,'title'=>$setting,'cabang'=>$cabang]);
    }
    //============================================
    public function update(Request $request, $id)
    {
        DB::table('mitra')
        ->where('id',$id)
        ->update([
        'nama' => $request->nama,
        'notelp' => $request->telp,
        'alamat' => $request->alamat,
        'id_cabang'=>$request->idcabang
        ]);
    return redirect('mitra')->with('status','edit Data Sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('mitra')->where('id',$id)->delete();
        return redirect('mitra')->with('status','Data berhasil dihapus');
    }
}
