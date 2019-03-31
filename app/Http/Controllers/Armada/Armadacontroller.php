<?php

namespace App\Http\Controllers\Armada;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Armadacontroller extends Controller
{
    public function aksibayarpajak(Request $request){
        dd(['tgl bayar'=>$request->tglbayar,'tgl kadaluarsa'=>$request->tglkadaluarsa]);
    }
    //========================================================
    public function bayarpajak($id){
        $webset = DB::table('setting')->limit(1)->get();
        $data = DB::table('armada')->where('id',$id)->get();
        return view('Armada/bayarpajak',['title'=>$webset,'armada'=>$data]);
    }
    //===========================================================
    public function index(){
    	$webset = DB::table('setting')->limit(1)->get();
    	$data = DB::table('armada')->orderby('id','desc')->paginate(20);
    	return view('Armada/index',['title'=>$webset,'armada'=>$data]);
    }
    //=================================================================
    public function create(){
    	$webset = DB::table('setting')->limit(1)->get();
    	return view('Armada/create',['title'=>$webset]);
    }
    //=================================================================
    public function store(Request $request){
    	DB::table('armada')
    	->insert([
    		'nama'			=> $request->nama,
    		'nopol'			=> $request->nopol,
    		'nomor_rangka'	=> $request->norangka,
    		'nomor_mesin'	=> $request->nomesin,
    		'warna'			=> $request->warna
    	]);
    	return redirect('armada')->with('status','Data Berhasil Di simpan');
    }
    //====================================================================
    public function edit($id){
    	$data = DB::table('armada')->where('id',$id)->get();
    	$webset = DB::table('setting')->limit(1)->get();
    	return view('Armada/edit',['armada'=>$data,'title'=>$webset]);
    }
    //==================================================================
    public function update($id, Request $request){
    	$data = DB::table('armada')
    	->where('id',$request->id)
    	->update([
    		'nama'			=> $request->nama,
    		'nopol'			=> $request->nopol,
    		'nomor_rangka'	=> $request->norangka,
    		'nomor_mesin'	=> $request->nomesin,
    		'warna'			=> $request->warna
    	]);

    return redirect('armada')->with('status','Data Berhasil Di edit');
    }
    //=====================================================================
    public function delete($id){
    	DB::table('armada')->where('id',$id)->delete();
    	return redirect('armada')->with('status','Data Berhasil Di hapus');
    }

}
