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
       
        $tanggal    = date('dmy');
        $kode = DB::table('surat_jalan')
        ->where('kode','like','%-'.$kodeuser.'-%')
        ->max('kode');

        if($kode==''){
            $finalkode = "SJ".$tanggal."-".$kodeuser."-000001";
        }else{
             $caridata = DB::table('surat_jalan')
            ->where('kode',$kode)->get();
            foreach ($caridata as $row) {
                if($row->status=='N'){
                    $finalkode = $row->kode;
                }else{
                    $newkode    = explode("-", $kode);
            $nomer      = sprintf("%06s",$newkode[2]+1);
            $finalkode  = "SJ".$tanggal."-".$kodeuser."-".$nomer; 
                }
            }
           
        } return response()->json($finalkode);
    }

    public function listsuratjalan(){
        $webinfo = DB::table('setting')->limit(1)->get();
        $listdata = DB::table('surat_jalan')->where('status','!=','N')->paginate(40);
        return view('suratjalan/listjalan',['data'=>$listdata,'webinfo'=>$webinfo]);
    }

    public function caridetail($id){
        $data = DB::table('resi_pengiriman')->where('kode_jalan',$id)->get();
        return response()->json($data);
    }
    public function cariresi(Request $request){
    	if($request->has('q')){
            $cari = $request->q;
            
            $data = DB::table('resi_pengiriman')
                    ->select('no_resi','id')
                    ->where('no_resi','like','%'.$cari.'%')
                    ->whereNull('kode_jalan')
                    ->get();
            
            return response()->json($data);
        }
    }
    public function carivendor(Request $request){
        if($request->has('q')){
            $cari = $request->q;
            
            $data = DB::table('vendor')
                    ->select('vendor','id')
                    ->where('vendor','like','%'.$cari.'%')
                    ->get();
            
            return response()->json($data);
        }
    }
    public function hasilresi($id){
    	$data = DB::table('resi_pengiriman')
                    ->select('nama_barang','no_resi','jumlah','berat','id','nama_pengirim','nama_penerima','kode_tujuan')
                    ->where('id',$id)
                    ->get();
            
            return response()->json($data);
    }
    public function hasilvendor($id){
        $data = DB::table('vendor')
                    ->select('vendor','id','alamat','telp','cabang')
                    ->where('id',$id)
                    ->get();
            
            return response()->json($data);
    }
    public function tambahdetail(Request $request){
        $kode = $request->kode;
        $carikode = DB::table('surat_jalan')->where('kode',$kode)->count();
        if($carikode > 0){

        }else{
            DB::table('surat_jalan')
            ->insert([
                'kode' => $kode,
                'tgl'  => date('d-m-Y')
            ]);
        }
        DB::table('resi_pengiriman')
        ->where('id',$request->noresi)
        ->update([
            'kode_jalan'=>$request->kode,
        ]);
    }
    public function hapusdetail($id){
        DB::table('resi_pengiriman')
        ->where('id',$id)
        ->update([
            'kode_jalan'=>null,
        ]);
    }

    public function store(Request $request){
        $jumlahdata = DB::table('surat_jalan')
        ->where('kode',$request->noresi)->count();
        if($jumlahdata>0){
            DB::table('surat_jalan')
             ->where('kode',$request->noresi)
            ->update([
                'tujuan' => $request->tujuan,
                'alamat_tujuan' => $request->alamat,
                'totalkg' => $request->totalkg,
                'totalkoli' => $request->totalkoli,
                'totalcash' => $request->totalcash,
                'totalbt'   => $request->totalbt,
                'biaya'     => $request->biaya,
                'status' =>'Y',
                'tgl'=>date('d-m-Y')
            ]);
        }else{
             DB::table('surat_jalan')
            ->insert([
                'kode' => $request->noresi,
                'tujuan' => $request->tujuan,
                'alamat_tujuan' => $request->alamat,
                'totalkg' => $request->totalkg,
                'totalkoli' => $request->totalkoli,
                'totalcash' => $request->totalcash,
                'totalbt'   => $request->totalbt,
                'biaya'     => $request->biaya,
                'status' =>'Y',
                'tgl'=>date('d-m-Y')
            ]);
            
        }
    }
    
}
