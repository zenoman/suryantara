<?php

namespace App\Http\Controllers\suratjalan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class suratjalanController extends Controller
{
    public function index(){
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('suratjalan/index',['webinfo'=>$webinfo]);
    }

    public function cariresi(Request $request){
    	if($request->has('q')){
            $cari = $request->q;
            
            $data = DB::table('resi_pengiriman')
                    ->select('no_resi','id')
                    ->where('no_resi','like','%'.$cari.'%')
                    ->get();
            
            return response()->json($data);
        }
    }
    public function hasilresi($id){
    	$data = DB::table('resi_pengiriman')
                    ->select('nama_barang','no_resi','jumlah','berat','id')
                    ->where('id',$id)
                    ->get();
            
            return response()->json($data);
    }
    
}
