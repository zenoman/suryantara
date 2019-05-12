<?php

namespace App\Http\Controllers\Antaran;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class antarancontroller extends Controller
{
    public function create(){
    	$webset = DB::table('setting')->limit(1)->get();
    	return view('antaran/create',['webinfo'=>$webset]);
    }
    
    //======================================================
	public function carikode(){
		$kodeuser = sprintf("%02s",session::get('id'));
        $tanggal  = date('dmy');
        $lastuser = $tanggal."-".$kodeuser;
        $kode = DB::table('surat_antar')
        ->where('kode','like','%'.$lastuser.'-%')
        ->max('kode');

        	if($kode==''){
            	$finalkode = "SA".$tanggal."-".$kodeuser."-000001";
        	}else{
             $caridata = DB::table('surat_antar')
            ->where('kode',$kode)->get();
            foreach ($caridata as $row) {
                if($row->status=='N'){
                    $finalkode = $row->kode;
                }else{
                    $newkode    = explode("-", $kode);
            $nomer      = sprintf("%06s",$newkode[2]+1);
            $finalkode  = "SA".$tanggal."-".$kodeuser."-".$nomer; 
                }
            }
           
        } return response()->json($finalkode);
    }

    //===========================================================
    public function caripengirim(Request $request){
    	if($request->has('q')){
            $cari = $request->q;
            $data = DB::table('karyawan')
                    ->select('nama','id')
                    ->where('nama','like','%'.$cari.'%')
                    ->get();
            
            return response()->json($data);
        }
    }
    //============================================================
    public function caridetailpengirim($id){
    	$data = DB::table('karyawan')
                ->select('nama','id','kode','telp')
                ->where('id',$id)
                ->get();
        return response()->json($data);
    }

    //======================================================
    public function caridetail($kode){
    	 $data = DB::table('resi_pengiriman')->where('kode_antar',$kode)->get();
        return response()->json($data);
    }

    //========================================================
    public function carinoresi(Request $request){
    	if($request->has('q')){
            $cari = $request->q;
            
            $data = DB::table('resi_pengiriman')
                    ->select('no_resi','id')
                    ->where([
                        ['no_resi','like','%'.$cari.'%'],
                        ['kode_jalan','=',null],
                        ['batal','=','N'],
                        ['status_antar','=','N']
                    ])
                    ->orwhere([
                        ['no_resi','like','%'.$cari.'%'],
                        ['kode_jalan','=',null],
                        ['batal','=','N'],
                        ['status_antar','=','KL']
                    ])
                    ->whereNull('kode_jalan')
                    ->get();
            
            return response()->json($data);
        }
    }

    //======================================================
    public function tambahdetail(Request $request){
        $kode = $request->kode;
        $carikode = DB::table('surat_antar')->where('kode',$kode)->count();
        if($carikode > 0){

        }else{
            DB::table('surat_antar')
            ->insert([
                'kode' => $kode,
                'tgl'  => date('Y-m-d')
            ]);
        }
        DB::table('resi_pengiriman')
        ->where('id',$request->noresi)
        ->update([
            'kode_antar'=>$request->kode,
            'status_antar'=>'P',
            'status_pengiriman'=>'menuju alamat tujuan'
        ]);
    }

    //=============================================================
    public function hapusdetail($id){
    	DB::table('resi_pengiriman')
        ->where('id',$id)
        ->update([
            'kode_antar'=>null,
            'status_antar'=>'N'
        ]);
    }
    
    //============================================================
    public function simpansa(Request $request){
    	$jumlahdata = DB::table('surat_antar')
        ->where('kode',$request->noresi)->count();
        if($jumlahdata>0){
            DB::table('surat_antar')
             ->where('kode',$request->noresi)
            ->update([
                'id_karyawan'=>$request->idkar,
                'tgl'=>date('Y-m-d'),
                'pemegang'=>$request->nama,
                'telp'=>$request->telp,
                'status'=>'Y'
            ]);
        }else{
             DB::table('surat_antar')
            ->insert([
                'kode' => $request->noresi,
                'id_karyawan'=>$request->idkar,
                'tgl'=>date('Y-m-d'),
                'pemegang'=>$request->nama,
                'telp'=>$request->telp,
                'status'=>'Y'
            ]);
            
        }
    }

    //=============================================================
    public function index(){
    	$webinfo = 
    	DB::table('setting')
    	->limit(1)
    	->get();
        
        $listdata =
        DB::table('surat_antar')
        ->where('status','!=','N')
        ->orderby('id','desc')
        ->paginate(30);
        
        return view('antaran/index',['data'=>$listdata,'webinfo'=>$webinfo]);
    }
    
    //=============================================================
    public function hapus(Request $request){
    	 $delid = $request->delid;
        if(!$delid){
            return back()->with('statuserror','Maaf, Tidak Ada Data Yang Dipilih');
        }else{
          $nc = count($delid);
        
        for($i=0;$i<$nc;$i++)
        {
            $did = $delid[$i];
            DB::table('surat_antar')->where('id',$did)->delete();

        }
        return back()->with('status','Data Berhasil Dihapus');  
        }
    }

    //=============================================================
    public function detail($id){
    	$data = DB::table('surat_antar')
    	->where('id',$id)
    	->get();

    	$webinfo = 
    	DB::table('setting')
    	->limit(1)
    	->get();

    	return view('antaran/detail',['data'=>$data, 'title'=>$webinfo]);
    }

    //===================================================================
    public function resiantar(){
    	$webinfo = 
    	DB::table('setting')
    	->limit(1)
    	->get();

    	$data = DB::table('resi_pengiriman')
        ->select(DB::raw('resi_pengiriman.*, surat_antar.pemegang,surat_antar.telp,surat_antar.kode'))
        ->leftjoin('surat_antar','resi_pengiriman.kode_antar','=','surat_antar.kode')
    	->where([['kode_antar','!=',null],['status_antar','!=','N']])
    	->orderby('id','desc')
    	->paginate(30);

    	return view('antaran/resiantar',['data'=>$data,'webinfo'=>$webinfo]);
    }

    //=====================================================================
    public function suksesantar($id,$kode){
        DB::table('resi_pengiriman')
        ->where('id',$id)
        ->update([
            'status_antar'=>'Y',
            'status_pengiriman'=>'paket telah sampai'
        ]);

        $jumlah = DB::table('resi_pengiriman')
        ->where([['kode_antar','=',$kode],['status_antar','=','P']])
        ->count();

        if($jumlah == 0){
            DB::table('surat_antar')
            ->where('kode',$kode)
            ->update([
                'status'=>'S'
            ]);
        }
        return back()->with('status','Resi Berhasil Di Update');
    }

    //=========================================================================
    public function cancelresiantar(Request $request){
        if($request->ketlain==''){
            $keterangan = $request->keterangan;
        }else{
            $keterangan = $request->ketlain;
        }

        DB::table('resi_pengiriman')
        ->where('id',$request->id_resi)
        ->update([
            'status_antar'=>'KL',
            'status_pengiriman'=>'pengantaran ulang',
            'keterangan'=>$keterangan
        ]);

        $jumlah = DB::table('resi_pengiriman')
        ->where([['kode_antar','=',$request->kode_antar],['status_antar','=','P']])
        ->count();

        if($jumlah == 0){
            DB::table('surat_antar')
            ->where('kode',$request->kode_antar)
            ->update([
                'status'=>'S'
            ]);
        }
        return back()->with('status','Resi Berhasil Di Update');
    }

    //=======================================================================
    public function carisuratantar(Request $request){
        $cari = $request->cari;
        $listdata = DB::table('surat_antar')
            ->where('kode','like','%'.$cari.'%')
            ->orwhere('pemegang','like','%'.$cari.'%')
            ->orwhere('tgl','like','%'.$cari.'%')
            ->get();
         
        $webinfo = DB::table('setting')->limit(1)->get();

        return view('antaran/cari',['data'=>$listdata,'webinfo'=>$webinfo,'cari'=>$cari]);
    }

    //========================================================================
    public function cariresisuratantar(Request $request){
        $cari = $request->cari;
        $webinfo = 
        DB::table('setting')
        ->limit(1)
        ->get();

        $data = DB::table('resi_pengiriman')
        ->select(DB::raw('resi_pengiriman.*, surat_antar.pemegang,surat_antar.telp,surat_antar.kode'))
        ->leftjoin('surat_antar','resi_pengiriman.kode_antar','=','surat_antar.kode')
        ->where([
            ['kode_antar','!=',null],
            ['status_antar','!=','N'],
            ['status_antar','!=','G'],
            ['resi_pengiriman.tgl','like','%'.$cari.'%']
        ])
        ->orwhere([
            ['kode_antar','!=',null],
            ['status_antar','!=','N'],
            ['status_antar','!=','G'],
            ['no_resi','like','%'.$cari.'%']
        ])
        ->orwhere([
            ['kode_antar','!=',null],
            ['status_antar','!=','N'],
            ['status_antar','!=','G'],
            ['surat_antar.pemegang','like','%'.$cari.'%']
        ])
        ->orwhere([
            ['kode_antar','!=',null],
            ['status_antar','!=','N'],
            ['status_antar','!=','G'],
            ['kode_antar','like','%'.$cari.'%']
        ])
        ->orderby('id','desc')
        ->get();

        return view('antaran/cariresi',['data'=>$data,'webinfo'=>$webinfo,'cari'=>$cari]);
    }

    //=====================================================================
    public function returresi($id,$kode){
        DB::table('resi_pengiriman')
        ->where('id',$id)
        ->update([
            'status_antar'=>'G',
            'status_pengiriman'=>'dikembalikan ke pengirim'
        ]);

        $jumlah = DB::table('resi_pengiriman')
        ->where([['kode_antar','=',$kode],['status_antar','=','P']])
        ->count();

        if($jumlah == 0){
            DB::table('surat_antar')
            ->where('kode',$kode)
            ->update([
                'status'=>'S'
            ]);
        }
        return back()->with('status','Resi Berhasil Di Update');
    }

    //=======================================================================
    public function listretur(){
        $webinfo = 
        DB::table('setting')
        ->limit(1)
        ->get();

        $data = DB::table('resi_pengiriman')
        ->select(DB::raw('resi_pengiriman.*, surat_antar.pemegang,surat_antar.telp,surat_antar.kode'))
        ->leftjoin('surat_antar','resi_pengiriman.kode_antar','=','surat_antar.kode')
        ->where([['kode_antar','!=',null],['status_antar','=','G']])
        ->orderby('id','desc')
        ->get();

        return view('antaran/returresi',['data'=>$data,'webinfo'=>$webinfo]);
    }

    //==========================================================================
    public function returresinya($id){
        DB::table('resi_pengiriman')
        ->where('id',$id)
        ->update([
            'status_pengiriman'=>'sudah dikembalikan'
        ]);
        return back()->with('status','Resi Berhasil Di Update');
    }
}
