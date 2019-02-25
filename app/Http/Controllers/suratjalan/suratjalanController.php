<?php

namespace App\Http\Controllers\suratjalan;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class suratjalanController extends Controller
{
    public function bayarsuratjalan($id){
        $data = DB::table('surat_jalan')->where('id',$id)->get();
         $webinfo = DB::table('setting')->limit(1)->get();
        return view('suratjalan/bayar_suratjalan',['data'=>$data,'title'=>$webinfo]);
    }
    public function bayar(Request $request){
        $data = DB::table('resi_pengiriman')
        ->where('id',$request->nomer)
        ->update([
            'biaya_suratjalan'=>$request->jumlah
        ]);
        $datasj = DB::table('surat_jalan')->where('kode',$request->kode)->get();
        //=======================================
        foreach ($datasj as $row) {
            $biayanya = $row->biaya+$request->jumlah;
            DB::table('surat_jalan')
            ->where('kode',$request->kode)
            ->update([
                'biaya'=>$biayanya
            ]);
        }
        //=======================================
        $jumlahresi = DB::table('resi_pengiriman')
        ->where([['kode_jalan','=',$request->kode],['biaya_suratjalan','=',0]])
        ->count();
        if ($jumlahresi>0) {
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
    public function carikode(){
        $kodeuser = sprintf("%02s",session::get('id'));
        $tanggal  = date('dmy');
        $lastuser = $tanggal."-".$kodeuser;
        $kode = DB::table('surat_jalan')
        ->where('kode','like','%'.$lastuser.'-%')
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
        $listdata =
        DB::table('surat_jalan')
        ->where('status','!=','N')
        ->orderby('id','desc')
        ->paginate(40);
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
                    ->where([['no_resi','like','%'.$cari.'%'],['total_biaya','!=',0]])
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
                'tgl'  => date('Y-m-d')
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
                'status' =>'Y',
                'tgl'=>date('Y-m-d'),
                'admin'=> session::get('username')
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
                'status' =>'Y',
                'tgl'=>date('Y-m-d'),
                'admin'=> session::get('username')
            ]);
            
        }
    }

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

    public function caridata(Request $request){      
        $cari = $request->cari;
            $listdata = DB::table('surat_jalan')
            ->where('kode','like','%'.$cari.'%')
            ->orwhere('tujuan','like','%'.$cari.'%')
            ->orwhere('tgl','like','%'.$cari.'%')
            ->get();
         
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('suratjalan/cari',['data'=>$listdata,'webinfo'=>$webinfo,'cari'=>$cari]);
    }
    
}
