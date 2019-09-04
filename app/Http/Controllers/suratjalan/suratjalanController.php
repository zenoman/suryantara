<?php

namespace App\Http\Controllers\suratjalan;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class suratjalanController extends Controller
{
    public function resisuratjalan(){
        $data = DB::table('resi_pengiriman')
        ->select(DB::raw('resi_pengiriman.*,surat_jalan.cabang'))
        ->leftjoin('surat_jalan','surat_jalan.kode','=','resi_pengiriman.kode_jalan')
        ->where([['resi_pengiriman.kode_jalan','!=',null],
                        ['resi_pengiriman.id_cabang','=',Session::get('cabang')]])
        ->orderby('resi_pengiriman.id','desc')
        ->paginate(30);
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('suratjalan/resi',['data'=>$data,'webinfo'=>$webinfo]);
    }

    //=========================================================================
    public function bayarsuratjalan($id){
        $data = DB::table('surat_jalan')->where('id',$id)->get();
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('suratjalan/bayar_suratjalan',['data'=>$data,'title'=>$webinfo]);
    }

    //=========================================================================
    public function bayar(Request $request){
        $data = DB::table('resi_pengiriman')
        ->where('id',$request->nomer)
        ->update([
            'biaya_suratjalan'=>$request->jumlah,
            'tgl_bayar'=>date('Y-m-d')
        ]);
        $datasj = DB::table('surat_jalan')->where('kode',$request->kode)->get();
        //----------------------------------------------
        foreach ($datasj as $row) {
            $biayanya = $row->biaya+$request->jumlah;
            DB::table('surat_jalan')
            ->where('kode',$request->kode)
            ->update([
                'biaya'=>$biayanya
            ]);
        }
        //-----------------------------------------------
        $jumlahresi = DB::table('resi_pengiriman')
        ->where([['kode_jalan','=',$request->kode],['biaya_suratjalan','=',0]])
        ->count();
        if ($jumlahresi==0) {
            DB::table('surat_jalan')
            ->where('kode',$request->kode)
            ->update([
                'status'=>'P'
            ]);
        }
        //========================================
        return back()->
        with('status','Berhasil Membayar Surat Jalan');
    }
    
    //==========================================================
    public function index(){
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('suratjalan/index',['webinfo'=>$webinfo]);
    }
    //==========================================================
    public function buatsuratjalancabang(){
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('suratjalan/suratjalancabang',['webinfo'=>$webinfo]);
    }
    //==========================================================
    public function carikode(){
        $kodeuser = sprintf("%02s",session::get('id'));
        $tanggal  = date('dmy');
        $lastuser = $tanggal."-".$kodeuser;
        $kode = DB::table('surat_jalan')
        ->where('kode','like','%'.$lastuser.'-%')
        ->max('kode');

        if($kode==''){
            $finalkode = "SJ".Session::get('koderesi')."".$tanggal."-".$kodeuser."-000001";
        }else{
             $caridata = DB::table('surat_jalan')
            ->where('kode',$kode)->get();
            foreach ($caridata as $row) {
                if($row->status=='N'){
                    $finalkode = $row->kode;
                }else{
                    $newkode    = explode("-", $kode);
            $nomer      = sprintf("%06s",$newkode[2]+1);
            $finalkode  = "SJ".Session::get('koderesi')."".$tanggal."-".$kodeuser."-".$nomer; 
                }
            }
           
        } return response()->json($finalkode);
    }

    //=========================================================================
    public function listsuratjalan(){
        $webinfo = DB::table('setting')->limit(1)->get();
        $listdata =
        DB::table('surat_jalan')
        ->where([['status','!=','N'],['id_cabang','=',Session::get('cabang')]])
        ->orderby('id','desc')
        ->paginate(40);
        return view('suratjalan/listjalan',['data'=>$listdata,'webinfo'=>$webinfo]);
    }

    //=========================================================================
    public function caridetail($id){
        $data = DB::table('resi_pengiriman')
        ->where('kode_jalan',$id)->get();
        return response()->json($data);
    }

    //=========================================================================
    public function cariresi(Request $request){
    	if($request->has('q')){
            $cari = $request->q;
            
            $data = DB::table('resi_pengiriman')
                    ->select('no_resi','id')
                    ->where([
                        ['no_resi','like','%'.$cari.'%'],
                        ['total_biaya','!=',0],
                        ['batal','=','N'],
                        ['status_antar','=','N'],
                        ['id_cabang','=',Session::get('cabang')]
                    ])
                    ->whereNull('kode_jalan')
                    ->whereNull('kode_antar')
                    ->get();
            
            return response()->json($data);
        }
    }

    //=========================================================================
    public function carivendor(Request $request){
        if($request->has('q')){
            $cari = $request->q;
            
            $data = DB::table('vendor')
                    ->select('vendor','id')
                    ->where([['vendor','like','%'.$cari.'%'],['id_cabang','=',Session::get('cabang')]])
                    ->get();
            
            return response()->json($data);
        }
    }

//=========================================================================
    public function caricabangsj(Request $request){
        if($request->has('q')){
            $cari = $request->q;
            
            $data = DB::table('cabang')
                    ->select('nama','id')
                    ->where([['nama','like','%'.$cari.'%'],['id','!=',Session::get('cabang')]])
                    ->get();
            
            return response()->json($data);
        }
    }
    //========================================================
    public function hasilresi($id){
    	$data = DB::table('resi_pengiriman')
                    ->select('nama_barang','no_resi','jumlah','berat','id','nama_pengirim','nama_penerima','kode_tujuan','total_biaya','total_bayar','kode_antar')
                    ->where('id',$id)
                    ->get();
            
            return response()->json($data);
    }

    //========================================================
    public function hasilvendor($id){
        $data = DB::table('vendor')
                    ->select('vendor','id','alamat','telp','cabang')
                    ->where('id',$id)
                    ->get();
            
            return response()->json($data);
    }
    //========================================================
    public function hasilcabang($id){
        $data = DB::table('cabang')
                    ->select('nama','id','alamat')
                    ->where('id',$id)
                    ->get();
            
            return response()->json($data);
    }
    
    //========================================================
    public function tambahdetail(Request $request){
        $kode = $request->kode;
        $carikode = DB::table('surat_jalan')->where('kode',$kode)->count();
        if($carikode > 0){
        }else{
            DB::table('surat_jalan')
            ->insert([
            'kode' => $kode,
            'tgl'  => date('Y-m-d'),
            'id_cabang' =>Session::get('cabang')
            ]);
        }
        
        //------------------------------------------------
        $datanya = DB::table('resi_pengiriman')
        ->where('id',$request->noresi)->get();
        foreach ($datanya as $row){
        DB::table('status_pengiriman')
            ->insert([
            'kode'=>$row->no_resi,
            'status'=>$request->status,
            'tgl'=>date('Y-m-d'),
            'jam'=>date('H:i:s'),
            'lokasi'=>Session::get('kota')
            ]);
            
        }

        //-----------------------------------------------
        DB::table('resi_pengiriman')
        ->where('id',$request->noresi)
        ->update([
            'kode_jalan'=>$request->kode,
            'status_pengiriman'=>$request->status
        ]);
    }

    //========================================================
    public function hapusdetail($id){
        $datanya = DB::table('resi_pengiriman')->where('id',$id)->get();
        foreach ($datanya as $row){
            DB::table('status_pengiriman')
            ->where([['kode',$row->no_resi],['status',$row->status_pengiriman]])
            ->orderby('id','desc')
            ->limit(1)
            ->delete();

            $resi=$row->no_resi;

        }

        //-------------------------------------------------------------
        $datastatus = DB::table('status_pengiriman')
            ->where('kode',$resi)
            ->orderby('id','desc')
            ->limit(1)
            ->get();
        foreach ($datastatus as $row2){
        DB::table('resi_pengiriman')
        ->where('id',$id)
        ->update([
            'kode_jalan'=>null,
            'status_pengiriman'=>$row2->status
        ]);
    }}

    //========================================================
    public function store(Request $request){
        if ($request->cabang=='Y') {
            $status='P';
        }else{
            $status='Y';
        }
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
                'cabang'    => $request->cabang,
                'status' =>$status,
                'tgl'=>date('Y-m-d'),
                'admin'=> session::get('username'),
                'id_cabang_tujuan'=>$request->idtujuan
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
                'cabang'    => $request->cabang,
                'status' =>$status,
                'tgl'=>date('Y-m-d'),
                'admin'=> session::get('username'),
                'id_cabang' =>Session::get('cabang'),
                'id_cabang_tujuan'=>$request->idtujuan
            ]);
            
        }
    }

    //=========================================================================
    public function destroy(Request $request){
        $delid = $request->delid;
        if(!$delid){
            return back()->with('statuserror','Maaf, Tidak Ada Data Yang Dipilih');
        }else{
          $nc = count($delid);
        
        for($i=0;$i<$nc;$i++)
        {
            $did = $delid[$i];
            DB::table('surat_jalan')->where('id',$did)->delete();

        }
        return back()->with('status','Data Berhasil Dihapus');  
        }
        
    }

    //=========================================================================
    public function cariresidata(Request $request){
        $cari = $request->cari;
            $listdata = DB::table('resi_pengiriman')
            ->select(DB::raw('resi_pengiriman.*,surat_jalan.cabang'))
            ->leftjoin('surat_jalan','surat_jalan.kode','=','resi_pengiriman.kode_jalan')
            ->where([['resi_pengiriman.no_resi','like','%'.$cari.'%'],['resi_pengiriman.kode_jalan','!=',NULL],
                        ['resi_pengiriman.id_cabang','=',Session::get('cabang')]])
            ->orwhere([['resi_pengiriman.no_smu','like','%'.$cari.'%'],['resi_pengiriman.kode_jalan','!=',NULL],
                        ['resi_pengiriman.id_cabang','=',Session::get('cabang')]])
            ->orwhere([['resi_pengiriman.kode_jalan','like','%'.$cari.'%'],['resi_pengiriman.kode_jalan','!=',NULL],
                        ['resi_pengiriman.id_cabang','=',Session::get('cabang')]])
            ->orwhere([['resi_pengiriman.tgl','like','%'.$cari.'%'],['resi_pengiriman.kode_jalan','!=',NULL],
                        ['resi_pengiriman.id_cabang','=',Session::get('cabang')]])
            ->get();
         
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('suratjalan/cariresi',['data'=>$listdata,'webinfo'=>$webinfo,'cari'=>$cari]);
    }

    //=========================================================================
    public function caridata(Request $request){      
        $cari = $request->cari;
            $listdata = DB::table('surat_jalan')
            ->where([['kode','like','%'.$cari.'%'],
                        ['id_cabang','=',Session::get('cabang')]])
            ->orwhere([['tujuan','like','%'.$cari.'%'],
                        ['id_cabang','=',Session::get('cabang')]])
            ->orwhere([['tgl','like','%'.$cari.'%'],
                        ['id_cabang','=',Session::get('cabang')]])
            ->get();
         
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('suratjalan/cari',['data'=>$listdata,'webinfo'=>$webinfo,'cari'=>$cari]);
    }
    
}
