<?php

namespace App\Http\Controllers\transit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class transitcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	$webinfo = DB::table('setting')->limit(1)->get();
        $listdata =
        DB::table('surat_jalan')
        ->where([['status','!=','N'],['status_transit','!=','N'],['id_cabang_transit','=',Session::get('cabang')]])
        ->orderby('id','desc')
        ->get();
        return view('transit/listtransit',['data'=>$listdata,'webinfo'=>$webinfo]);
    }
    //=====================================================
    public function create(){
    	$webinfo = DB::table('setting')->limit(1)->get();
    	return view('transit/create',['webinfo'=>$webinfo]);
    }
    //======================================================
    public function carisuratjalan(Request $request){
    	if($request->has('q')){
            $cari = $request->q;
            
            $data = DB::table('surat_jalan')
                    ->select('kode','id')
                    ->where([['kode','like','%'.$cari.'%'],['status_transit','=','N']])
                    ->get();
            
            return response()->json($data);
        }
    }
    //=========================================================================
    public function caridetailsj($id){
        $data = DB::table('surat_jalan')
        ->where('id',$id)->get();
        return response()->json($data);
    }
    //=======================================================================
    public function cariresisj($id){
        $data = DB::table('resi_pengiriman')
        ->where('kode_jalan',$id)->get();
        return response()->json($data);
    }
    //======================================================================
    public function store(Request $request){
        $dataresi = DB::table('resi_pengiriman')->where('kode_jalan',$request->kodejalan)->get();
        foreach ($dataresi as $row) {
            $data[] = [
            'kode'=>$row->no_resi,
            'status'=>'transit di KLC Cabang '.Session::get('kota'),
            'tgl'=>date('Y-m-d'),
            'jam'=>date('H:i:s'),
            'lokasi'=>Session::get('kota')
            ];
        }
        DB::table('status_pengiriman')
        ->insert($data);
        
        DB::table('resi_pengiriman')
        ->where('kode_jalan',$request->kodejalan)
        ->update([
            'status_pengiriman'=>'transit di KLC Cabang '.Session::get('kota')
        ]);

        DB::table('surat_jalan')
        ->where('kode',$request->kodejalan)
        ->update([
            'id_cabang_transit'=>Session::get('cabang'),
            'status_transit'=>'Y'
        ]);
        return redirect('listtransit')->with('status','Data Disimpan');
    }
    //=================================================================
    public function selesaitransit($kode){
        $dataresi = DB::table('resi_pengiriman')->where('kode_jalan',$kode)->get();
        foreach ($dataresi as $row) {
            $data[] = [
            'kode'=>$row->no_resi,
            'status'=>'menuju kota tujuan',
            'tgl'=>date('Y-m-d'),
            'jam'=>date('H:i:s'),
            'lokasi'=>Session::get('kota')
            ];
        }
        DB::table('status_pengiriman')
        ->insert($data);

        DB::table('resi_pengiriman')
        ->where('kode_jalan',$kode)
        ->update([
            'status'=>'menuju kota tujuan'
        ]);

        DB::table('surat_jalan')
        ->where('kode',$kode)
        ->update([
            'id_cabang_transit'=>NULL,
            'status_transit'=>'N'
        ]);
        return redirect('listtransit')->with('status','Perubahan Disimpan');
    }
}
