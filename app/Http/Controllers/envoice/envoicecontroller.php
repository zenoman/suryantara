<?php

namespace App\Http\Controllers\envoice;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class envoicecontroller extends Controller
{
    public function delete(Request $request){
        $delid = $request->delid;
        if(!$delid){
            return back()->with('statuserror','Maaf, Tidak Ada Data Yang Dipilih');
        }else{
          $nc = count($delid);
        
        for($i=0;$i<$nc;$i++)
        {
            $did = $delid[$i];
            DB::table('surat_envoice')->where('id',$did)->delete();

        }
        return back()->with('status','Data Berhasil Dihapus');  
        }
    }
    public function cari(Request $request){
        $cari = $request->cari;
            $listdata = DB::table('surat_envoice')
            ->where([['kode','like','%'.$cari.'%'],
                        ['id_cabang','=',Session::get('cabang')]])
            ->orwhere([['tujuan','like','%'.$cari.'%'],
                        ['id_cabang','=',Session::get('cabang')]])
            ->orwhere([['tgl','like','%'.$cari.'%'],
                        ['id_cabang','=',Session::get('cabang')]])
            ->get();
         
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('envoice/pencarian',['data'=>$listdata,'webinfo'=>$webinfo,'cari'=>$cari]);
    }

    //======================================================================
    public function index(){
    	$webinfo = DB::table('setting')->limit(1)->get();
        $listdata =
        DB::table('surat_envoice')
        ->where([['status','!=','N'],['id_cabang','=',Session::get('cabang')]])
        ->orderby('id','desc')
        ->paginate(40);
        return view('envoice/index',['data'=>$listdata,'webinfo'=>$webinfo]);
    }

    //======================================================================
    public function create(){
    	$webinfo = DB::table('setting')->limit(1)->get();
        return view('envoice/create',['webinfo'=>$webinfo]);
    }

    //======================================================================
    public function carikode($value='')
    {
        $kodeuser = sprintf("%02s",session::get('id'));
        $tanggal  = date('dmy');
        $lastuser = $tanggal."-".$kodeuser;
        $kode = DB::table('surat_envoice')
        ->where('kode','like','%'.$lastuser.'-%')
        ->max('kode');

        if($kode==''){
            $finalkode = "EN".Session::get('koderesi')."".$tanggal."-".$kodeuser."-000001";
        }else{
             $caridata = DB::table('surat_envoice')
            ->where('kode',$kode)->get();
            foreach ($caridata as $row) {
                if($row->status=='N'){
                    $finalkode = $row->kode;
                }else{
                    $newkode    = explode("-", $kode);
            $nomer      = sprintf("%06s",$newkode[2]+1);
            $finalkode  = "EN".Session::get('koderesi')."".$tanggal."-".$kodeuser."-".$nomer; 
                }
            }
           
        } return response()->json($finalkode);
    }

    //======================================================================
    public function carimitra(Request $request){
        if($request->has('q')){
            $cari = $request->q;
            
            $data = DB::table('mitra')
                    ->select('nama','id')
                    ->where([['nama','like','%'.$cari.'%'],['id_cabang','=',Session::get('cabang')]])
                    ->get();
            
            return response()->json($data);
        }
    }

    //======================================================================
    public function caridetailmitra($id)
    {
        $data = DB::table('mitra')
                    ->select('nama','id','alamat','notelp')
                    ->where('id',$id)
                    ->get();
            
            return response()->json($data);
    }

    //======================================================================
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
                        ['id_cabang','=',Session::get('cabang')],
                        ['pengiriman_via','=','city kurier'],
                        ['status_company','=','Y']
                    ])
                    ->whereNull('kode_jalan')
                    ->whereNull('kode_antar')
                    ->whereNull('kode_envoice')
                    ->get();
            
            return response()->json($data);
        }
    }

    //======================================================================
    public function tambahdetail(Request $request){
        $kode = $request->kode;
        $carikode = DB::table('surat_envoice')->where('kode',$kode)->count();
        if($carikode > 0){

        }else{
            DB::table('surat_envoice')
            ->insert([
                'kode' => $kode,
                'tgl'  => date('Y-m-d'),
                'id_cabang' =>Session::get('cabang')
            ]);
        }
        DB::table('resi_pengiriman')
        ->where('id',$request->noresi)
        ->update([
            'kode_envoice'=>$request->kode,
        ]);
    }

    //======================================================================
    public function caridetail($id){
         $data = DB::table('resi_pengiriman')
        ->where('kode_envoice',$id)->get();
        return response()->json($data);
    }

    //======================================================================
    public function hapusdetail($id){
         DB::table('resi_pengiriman')
        ->where('id',$id)
        ->update([
            'kode_envoice'=>null,
        ]);
    }

    //======================================================================
    public function store(Request $request){
    	$jumlahdata = DB::table('surat_envoice')
        ->where('kode',$request->noresi)->count();
        if($jumlahdata>0){
            DB::table('surat_envoice')
             ->where('kode',$request->noresi)
            ->update([
                'tujuan' => $request->tujuan,
                'alamat' => $request->alamat,
                'totalkg' => $request->totalkg,
                'totalkoli' => $request->totalkoli,
                'totalcash' => $request->totalcash,
                'totalbt'   => $request->totalbt,
                'status' =>'Y',
                'tgl'=>date('Y-m-d'),
                'pembuat'=> session::get('username')
            ]);
        }else{
             DB::table('surat_envoice')
            ->insert([
                'kode' => $request->noresi,
                'tujuan' => $request->tujuan,
                'alamat' => $request->alamat,
                'totalkg' => $request->totalkg,
                'totalkoli' => $request->totalkoli,
                'totalcash' => $request->totalcash,
                'totalbt'   => $request->totalbt,
                'status' =>'Y',
                'tgl'=>date('Y-m-d'),
                'pembuat'=> session::get('username'),
                'id_cabang' =>Session::get('cabang')
            ]);
            
        }
    }

}
