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
    public function carikode(){
        $kodeuser = sprintf("%02s",session::get('id'));
        $carikodedulu = DB::table('detail_sj')
        ->select('kode')
        ->where('kode','like','%-'.$kodeuser.'-%')
        ->groupBy('kode')
        ->get();
        // dd($carikodedulu);
        if($carikodedulu){
          foreach ($carikodedulu as $rows) {
              $finalkode = $rows->kode;
          }
            
        }else{
           $tanggal    = date('dmy');
        $kode = DB::table('surat_jalan')
        ->where('kode','like','%-'.$kodeuser.'-%')
        ->max('kode');

        if(!$kode){
            
            $finalkode = "SJ".$tanggal."-".$kodeuser."-000001";
        }else{
            $newkode    = explode("-", $kode);
        $nomer      = sprintf("%06s",$newkode[2]+1);
        $finalkode  = "SJ".$tanggal."-".$kodeuser."-".$nomer;
        } 
        }

        
        return response()->json($finalkode);
    }
    public function caridetail($id){
        $data = DB::table('detail_sj')->where('kode',$id)->get();
        return response()->json($data);
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
    public function tambahdetail(Request $request){
        DB::table('detail_sj')
        ->insert([
            'kode'=>$request->kode,
            'no_resi'=> $request->noresi,
            'penerima' => $request->penerima,
            'jumlah' => $request->jumlah,
            'berat' => $request->berat,
            'alamat' => $request->tujuan,
            'isi' => $request->isipaket
        ]);
    }
    public function hapusdetail($id){
        DB::table('detail_sj')->where('id',$id)->delete();
    }
    
}
