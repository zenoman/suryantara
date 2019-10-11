<?php

namespace App\Http\Controllers\Rekap;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
class Rekap extends Controller
{
    //
    private $setting; 
    
    function __construct(){            
        $this->setting = DB::table('setting')->limit(1)->get();
        $this->path = public_path('/tf');
        $this->idc=Session::get('cabang');
        $this->middleware('auth');
        
    }
    function index(){
        $idc=Session::get('cabang');
        $kategori=DB::table('tb_kategoriakutansi')
                ->where('status','pengeluaran')
                ->get();
        if($idc=='1'){
            $vn=DB::table('vendor')
            ->get();
        }else{
            $vn=DB::table('vendor')
            ->where('id_cabang',$idc)
            ->get();
        }        
        return view('Rekap/index',['title'=>$this->setting,'kat'=>$kategori,'vn'=>$vn]);
    }
    function showpajak(Request $request){
        $idc=Session::get('cabang');
        $request->validate([
            'th'=>'required',
        ]);
        $tg1=$request->b1;
        $tg2=$request->b2;
        $th=$request->th;
        if($idc=='1'){
            // Cari Lap
            $lap=DB::table('pajak')
            ->select(DB::raw('cabang.nama,pajak.*'))
            ->leftjoin('cabang','cabang.id','=','pajak.id_cabang')
            ->whereBetween('bulan',[$tg1,$tg2])
            ->where('tahun',$th)
            ->get();        
        }else{
            // Cari Lap
            $lap=DB::table('pajak')
            ->select(DB::raw('cabang.nama,pajak.*'))
            ->leftjoin('cabang','cabang.id','=','pajak.id_cabang')
            ->whereBetween('bulan',[$tg1,$tg2])
            ->where('id_Cabang',$idc)
            ->where('tahun',$th)
            ->get();        
        }        
        return view('Rekap.rekap_pajak',['lap'=>$lap,'bul1'=>$tg1,'bul2'=>$tg2,'th'=>$th,'title'=>$this->setting]);
    }
    function cetakpajak($tg1,$tg2,$th){
        $idc=Session::get('cabang');
        if($idc=='1'){
            $lap=DB::table('pajak')
            ->select(DB::raw('cabang.nama,pajak.*'))
            ->leftjoin('cabang','cabang.id','=','pajak.id_cabang')
            ->whereBetween('bulan',[$tg1,$tg2])
            ->where('tahun',$th)
            ->get();      
        }  else{
            $lap=DB::table('pajak')
            ->select(DB::raw('cabang.nama,pajak.*'))
            ->leftjoin('cabang','cabang.id','=','pajak.id_cabang')
            ->whereBetween('bulan',[$tg1,$tg2])
            ->where('id_cabang',$idc)
            ->where('tahun',$th)
            ->get();
        }
        return view('Rekap.print_pajak',['lap'=>$lap,'bul1'=>$tg1,'bul2'=>$tg2,'th'=>$th,'title'=>$this->setting]);
    }
    function showpengeluaran(Request $request){
        $idc=Session::get('cabang');
        $rules=[
            'tgl1'=>'required',
            'tgl2'=>'required',
            'kat'=>'required',
            ];
        $mes=['required'=>':attribute Harus Dilengkapi!'];
        $this->validate($request,$rules,$mes);
            $tgl1=$request->tgl1;
            $tgl2=$request->tgl2;
            $kat=$request->kat;
            // check untuk semua
            if($idc=='1'){
                if($kat=="semua"){
                    $kate="semua pengeluaran";                
                    $lap=DB::table('pengeluaran_lain')
                        ->leftjoin('cabang','cabang.id','=','pengeluaran_lain.id_cabang')
                        ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
                        ->select(DB::raw('pengeluaran_lain.*,cabang.nama,tb_kategoriakutansi.nama as kategori'))
                        ->whereBetween('tgl',[$tgl1,$tgl2])
                        ->get();
                    return view('Rekap.rekap_pengeluaran',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$tgl1,'bul2'=>$tgl2,'title'=>$this->setting]);
                }else{
                    $kate=$kat;
                    $lap=DB::table('pengeluaran_lain')
                        ->leftjoin('cabang','cabang.id','=','pengeluaran_lain.id_cabang')
                        ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')                    
                        ->select(DB::raw('pengeluaran_lain.*,cabang.nama,tb_kategoriakutansi.nama as kategori'))
                        ->whereBetween('tgl',[$tgl1,$tgl2])
                        ->where('kategori',$kat)
                        ->get();                   
                    return view('Rekap.rekap_pengeluaran',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$tgl1,'bul2'=>$tgl2,'title'=>$this->setting]);
                } 
            }else{
                if($kat=="semua"){
                    $kate="semua pengeluaran";                
                    $lap=DB::table('pengeluaran_lain')
                        ->leftjoin('cabang','cabang.id','=','pengeluaran_lain.id_cabang')
                        ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
                        ->select(DB::raw('pengeluaran_lain.*,cabang.nama,tb_kategoriakutansi.nama as kategori'))
                        ->whereBetween('tgl',[$tgl1,$tgl2])
                        ->where('id_cabang',$idc)
                        ->get();
                    return view('Rekap.rekap_pengeluaran',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$tgl1,'bul2'=>$tgl2,'title'=>$this->setting]);
                }else{
                    $kate=$kat;
                    $lap=DB::table('pengeluaran_lain')
                        ->leftjoin('cabang','cabang.id','=','pengeluaran_lain.id_cabang')
                        ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')                    
                        ->select(DB::raw('pengeluaran_lain.*,cabang.nama,tb_kategoriakutansi.nama as kategori'))
                        ->whereBetween('tgl',[$tgl1,$tgl2])
                        ->where('id_cabang',$idc)
                        ->where('kategori',$kat)
                        ->get();                   
                    return view('Rekap.rekap_pengeluaran',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$tgl1,'bul2'=>$tgl2,'title'=>$this->setting]);
                } 
            }
           
    }
    function showresi(Request $request){
        $idc=Session::get('cabang');
        $rules=[
            'tgl1'=>'required',
            'tgl2'=>'required',
            'kat'=>'required',
            ];
        $mes=['required'=>':attribute Harus Dilengkapi!'];
        $this->validate($request,$rules,$mes);
            $tgl1=$request->tgl1;
            $tgl2=$request->tgl2;
            $kat=$request->kat;
    if($idc=='1'){
        if($kat=='semua'){
            $kat="Semua Resi Lunas Dan Belum";
            $kate="semua";
            $lap=DB::table('resi_pengiriman')
                ->select(DB::raw('cabang.nama,resi_pengiriman.*'))
                ->leftjoin('cabang','cabang.id','=','resi_pengiriman.id_cabang')
                ->whereBetween('tgl',[$tgl1,$tgl2])
                ->where('duplikat','!=','Y')                
                ->get();
            $tot=DB::table('resi_pengiriman')
            ->select(DB::raw(' sum(total_biaya) as tbiaya, sum(total_bayar) as tbayar,sum(total_biaya-total_bayar) as tkurang'))
            ->whereBetween('tgl',[$tgl1,$tgl2])
            ->where('duplikat','!=','Y')            
            ->first();
            return view('Rekap.rekap_resi',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$tgl1,'bul2'=>$tgl2,'title'=>$this->setting,'tbiaya'=>$tot->tbiaya,'tbayar'=>$tot->tbayar,'tkur'=>$tot->tkurang]);
        }elseif($kat=='lunas'){
            $kat="Resi Lunas";
            $kate="lunas";
            $lap=DB::table('resi_pengiriman')
            ->select(DB::raw('cabang.nama,resi_pengiriman.*'))
            ->leftjoin('cabang','cabang.id','=','resi_pengiriman.id_cabang')
            ->whereBetween('tgl',[$tgl1,$tgl2])
            ->where('duplikat','!=','Y') 
            ->whereNotNull('tgl_lunas')              
            ->get();
            $tot=DB::table('resi_pengiriman')
            ->select(DB::raw(' sum(total_biaya) as tbiaya, sum(total_bayar) as tbayar,sum(total_biaya-total_bayar) as tkurang'))
            ->whereBetween('tgl',[$tgl1,$tgl2])
            ->where('duplikat','!=','Y')  
            ->whereNotNull('tgl_lunas')              
            ->first();
            return view('Rekap.rekap_resi',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$tgl1,'bul2'=>$tgl2,'title'=>$this->setting,'tbiaya'=>$tot->tbiaya,'tbayar'=>$tot->tbayar,'tkur'=>$tot->tkurang]);
        }elseif($kat=='belum'){
            $kate="belum";
            $kat="Resi Belum Lunas";
            $lap=DB::table('resi_pengiriman')
            ->select(DB::raw('cabang.nama,resi_pengiriman.*'))
            ->leftjoin('cabang','cabang.id','=','resi_pengiriman.id_cabang')
            ->whereBetween('tgl',[$tgl1,$tgl2])
            ->where('duplikat','!=','Y')  
            ->whereNull('tgl_lunas')          
            ->get();
            $tot=DB::table('resi_pengiriman')
            ->select(DB::raw(' sum(total_biaya) as tbiaya, sum(total_bayar) as tbayar,sum(total_biaya-total_bayar) as tkurang'))
            ->whereBetween('tgl',[$tgl1,$tgl2])
            ->where('duplikat','!=','Y')  
            ->whereNull('tgl_lunas')           
            ->first();
            return view('Rekap.rekap_resi',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$tgl1,'bul2'=>$tgl2,'title'=>$this->setting,'tbiaya'=>$tot->tbiaya,'tbayar'=>$tot->tbayar,'tkur'=>$tot->tkurang]);
        }
    }else{
        if($kat=='semua'){
            $kat="Semua Resi Lunas Dan Belum";
            $kate="semua";
            $lap=DB::table('resi_pengiriman')
                ->select(DB::raw('cabang.nama,resi_pengiriman.*'))
                ->leftjoin('cabang','cabang.id','=','resi_pengiriman.id_cabang')
                ->whereBetween('tgl',[$tgl1,$tgl2])
                ->where('id_cabang',$idc)
                ->where('duplikat','!=','Y')                
                ->get();
            $tot=DB::table('resi_pengiriman')
            ->select(DB::raw(' sum(total_biaya) as tbiaya, sum(total_bayar) as tbayar,sum(total_biaya-total_bayar) as tkurang'))
            ->whereBetween('tgl',[$tgl1,$tgl2])
            ->where('id_cabang',$idc)
            ->where('duplikat','!=','Y')            
            ->first();
            return view('Rekap.rekap_resi',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$tgl1,'bul2'=>$tgl2,'title'=>$this->setting,'tbiaya'=>$tot->tbiaya,'tbayar'=>$tot->tbayar,'tkur'=>$tot->tkurang]);
        }elseif($kat=='lunas'){
            $kat="Resi Lunas";
            $kate="lunas";
            $lap=DB::table('resi_pengiriman')
            ->select(DB::raw('cabang.nama,resi_pengiriman.*'))
            ->leftjoin('cabang','cabang.id','=','resi_pengiriman.id_cabang')
            ->whereBetween('tgl',[$tgl1,$tgl2])
            ->where('duplikat','!=','Y') 
            ->where('id_cabang',$idc) 
            ->whereNotNull('tgl_lunas')              
            ->get();
            $tot=DB::table('resi_pengiriman')
            ->select(DB::raw(' sum(total_biaya) as tbiaya, sum(total_bayar) as tbayar,sum(total_biaya-total_bayar) as tkurang'))
            ->whereBetween('tgl',[$tgl1,$tgl2])
            ->where('duplikat','!=','Y')  
            ->where('id_cabang',$idc)
            ->whereNotNull('tgl_lunas')              
            ->first();
            return view('Rekap.rekap_resi',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$tgl1,'bul2'=>$tgl2,'title'=>$this->setting,'tbiaya'=>$tot->tbiaya,'tbayar'=>$tot->tbayar,'tkur'=>$tot->tkurang]);
        }elseif($kat=='belum'){
            $kate="belum";
            $kat="Resi Belum Lunas";
            $lap=DB::table('resi_pengiriman')
            ->select(DB::raw('cabang.nama,resi_pengiriman.*'))
            ->leftjoin('cabang','cabang.id','=','resi_pengiriman.id_cabang')
            ->whereBetween('tgl',[$tgl1,$tgl2])
            ->where('duplikat','!=','Y')  
            ->whereNull('tgl_lunas') 
            ->where('id_cabang',$idc)             
            ->get();
            $tot=DB::table('resi_pengiriman')
            ->select(DB::raw(' sum(total_biaya) as tbiaya, sum(total_bayar) as tbayar,sum(total_biaya-total_bayar) as tkurang'))
            ->whereBetween('tgl',[$tgl1,$tgl2])
            ->where('duplikat','!=','Y')  
            ->whereNull('tgl_lunas') 
            ->where('id_cabang',$idc)             
            ->first();
            return view('Rekap.rekap_resi',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$tgl1,'bul2'=>$tgl2,'title'=>$this->setting,'tbiaya'=>$tot->tbiaya,'tbayar'=>$tot->tbayar,'tkur'=>$tot->tkurang]);
        }
    }
        
    }
    function cetakresi($kate,$bul1,$bul2,$kat){
        $idc=Session::get('cabang');  
        if($idc=='1'){
            if($kate=='semua'){
                $kat="Semua Resi Lunas Dan Belum";
                $lap=DB::table('resi_pengiriman')
                    ->select(DB::raw('cabang.nama,resi_pengiriman.*'))
                    ->leftjoin('cabang','cabang.id','=','resi_pengiriman.id_cabang')
                    ->whereBetween('tgl',[$bul1,$bul2])
                    ->where('duplikat','!=','Y')                    
                    ->get();
                    $tot=DB::table('resi_pengiriman')
                    ->select(DB::raw(' sum(total_biaya) as tbiaya, sum(total_bayar) as tbayar,sum(total_biaya-total_bayar) as tkurang'))
                    ->whereBetween('tgl',[$bul1,$bul2])
                    ->where('duplikat','!=','Y')            
                    ->first();
                return view('Rekap.print_rekap_resi',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$bul1,'bul2'=>$bul2,'title'=>$this->setting,'tbiaya'=>$tot]);
            }elseif($kate=='lunas'){
                $kat="Resi Lunas";
                $lap=DB::table('resi_pengiriman')
                    ->select(DB::raw('cabang.nama,resi_pengiriman.*'))
                    ->leftjoin('cabang','cabang.id','=','resi_pengiriman.id_cabang')
                    ->whereBetween('tgl',[$bul1,$bul2])
                    ->where('duplikat','!=','Y')  
                    ->whereNotNull('tgl_lunas')           
                    ->get();
                    $tot=DB::table('resi_pengiriman')
                    ->select(DB::raw(' sum(total_biaya) as tbiaya, sum(total_bayar) as tbayar,sum(total_biaya-total_bayar) as tkurang'))
                    ->whereBetween('tgl',[$bul1,$bul2])
                    ->where('duplikat','!=','Y')  
                    ->whereNotNull('tgl_lunas')              
                    ->first();
                return view('Rekap.print_rekap_resi',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$bul1,'bul2'=>$bul2,'title'=>$this->setting,'tbiaya'=>$tot]);
            }elseif($kate=='belum'){
                $kat="Resi Belum Lunas";
                $lap=DB::table('resi_pengiriman')
                    ->select(DB::raw('cabang.nama,resi_pengiriman.*'))
                    ->leftjoin('cabang','cabang.id','=','resi_pengiriman.id_cabang')
                    ->whereBetween('tgl',[$bul1,$bul2])
                    ->where('duplikat','!=','Y')          
                    ->whereNull('tgl_lunas')              
                    ->get();
                    $tot=DB::table('resi_pengiriman')
                    ->select(DB::raw(' sum(total_biaya) as tbiaya, sum(total_bayar) as tbayar,sum(total_biaya-total_bayar) as tkurang'))
                    ->whereBetween('tgl',[$bul1,$bul2])
                    ->where('duplikat','!=','Y')  
                    ->whereNull('tgl_lunas')           
                    ->first();
                return view('Rekap.print_rekap_resi',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$bul1,'bul2'=>$bul2,'title'=>$this->setting,'tbiaya'=>$tot]);
            }
        }else{
            if($kate=='semua'){
                $kat="Semua Resi Lunas Dan Belum";
                $lap=DB::table('resi_pengiriman')
                    ->select(DB::raw('cabang.nama,resi_pengiriman.*'))
                    ->leftjoin('cabang','cabang.id','=','resi_pengiriman.id_cabang')
                    ->whereBetween('tgl',[$bul1,$bul2])
                    ->where('duplikat','!=','Y')      
                    ->where('id_cabang',$idc)                       
                    ->get();
                    $tot=DB::table('resi_pengiriman')
                    ->select(DB::raw(' sum(total_biaya) as tbiaya, sum(total_bayar) as tbayar,sum(total_biaya-total_bayar) as tkurang'))
                    ->whereBetween('tgl',[$bul1,$bul2])
                    ->where('duplikat','!=','Y')            
                    ->first();
                return view('Rekap.print_rekap_resi',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$bul1,'bul2'=>$bul2,'title'=>$this->setting,'tbiaya'=>$tot]);
            }elseif($kate=='lunas'){
                $kat="Resi Lunas";
                $lap=DB::table('resi_pengiriman')
                    ->select(DB::raw('cabang.nama,resi_pengiriman.*'))
                    ->leftjoin('cabang','cabang.id','=','resi_pengiriman.id_cabang')
                    ->whereBetween('tgl',[$bul1,$bul2])
                    ->where('duplikat','!=','Y')  
                    ->whereNotNull('tgl_lunas')              
                    ->where('id_cabang',$idc)             
                    ->get();
                    $tot=DB::table('resi_pengiriman')
                    ->select(DB::raw(' sum(total_biaya) as tbiaya, sum(total_bayar) as tbayar,sum(total_biaya-total_bayar) as tkurang'))
                    ->whereBetween('tgl',[$bul1,$bul2])
                    ->where('duplikat','!=','Y')  
                    ->whereNotNull('tgl_lunas')              
                    ->first();
                return view('Rekap.print_rekap_resi',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$bul1,'bul2'=>$bul2,'title'=>$this->setting,'tbiaya'=>$tot]);
            }elseif($kate=='belum'){
                $kat="Resi Belum Lunas";
                $lap=DB::table('resi_pengiriman')
                    ->select(DB::raw('cabang.nama,resi_pengiriman.*'))
                    ->leftjoin('cabang','cabang.id','=','resi_pengiriman.id_cabang')
                    ->whereBetween('tgl',[$bul1,$bul2])
                    ->where('duplikat','!=','Y')  
                    ->where('id_cabang',$idc)             
                    ->whereNull('tgl_lunas')              
                    ->get();
                    $tot=DB::table('resi_pengiriman')
                    ->select(DB::raw(' sum(total_biaya) as tbiaya, sum(total_bayar) as tbayar,sum(total_biaya-total_bayar) as tkurang'))
                    ->whereBetween('tgl',[$bul1,$bul2])
                    ->where('duplikat','!=','Y')  
                    ->whereNull('tgl_lunas')           
                    ->first();
                return view('Rekap.print_rekap_resi',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$bul1,'bul2'=>$bul2,'title'=>$this->setting,'tbiaya'=>$tot]);
            }
        }
        
    }
    function cetakpengeluaran($kate,$tgl1,$tgl2,$kat){
        $idc=Session::get('cabang');  
        if($idc=='1'){
            if($kat=="semua"){
                $kate="semua pengeluaran";                
                $lap=DB::table('pengeluaran_lain')
                    ->leftjoin('cabang','cabang.id','=','pengeluaran_lain.id_cabang')
                    ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
                    ->select(DB::raw('pengeluaran_lain.*,cabang.nama,tb_kategoriakutansi.nama as kategori'))
                    ->whereBetween('tgl',[$tgl1,$tgl2])
                    ->get();
                return view('Rekap.print_rekap_pengeluaran',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$tgl1,'bul2'=>$tgl2,'title'=>$this->setting]);
            }else{
                $k=DB::table('tb_kategoriakutansi')
                    ->where('kode',$kat)
                    ->first();
                    
                $kate=$k->nama;
                $lap=DB::table('pengeluaran_lain')
                    ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
                    ->leftjoin('cabang','cabang.id','=','pengeluaran_lain.id_cabang')                
                    ->select(DB::raw('pengeluaran_lain.*,cabang.nama,tb_kategoriakutansi.nama as kategori'))
                    ->whereBetween('tgl',[$tgl1,$tgl2])
                    ->where('kategori',$kat)
                    ->get();                   
                return view('Rekap.print_rekap_pengeluaran',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$tgl1,'bul2'=>$tgl2,'title'=>$this->setting]);
            }
        }else{
            if($kat=="semua"){
                $kate="semua pengeluaran";                
                $lap=DB::table('pengeluaran_lain')
                    ->leftjoin('cabang','cabang.id','=','pengeluaran_lain.id_cabang')
                    ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
                    ->select(DB::raw('pengeluaran_lain.*,cabang.nama,tb_kategoriakutansi.nama as kategori'))
                    ->whereBetween('tgl',[$tgl1,$tgl2])
                    ->where('id_cabang',$idc)
                    ->get();
                return view('Rekap.print_rekap_pengeluaran',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$tgl1,'bul2'=>$tgl2,'title'=>$this->setting]);
            }else{
                $k=DB::table('tb_kategoriakutansi')
                    ->where('kode',$kat)
                    ->first();
                    
                $kate=$k->nama;
                $lap=DB::table('pengeluaran_lain')
                    ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
                    ->leftjoin('cabang','cabang.id','=','pengeluaran_lain.id_cabang')                
                    ->select(DB::raw('pengeluaran_lain.*,cabang.nama,tb_kategoriakutansi.nama as kategori'))
                    ->whereBetween('tgl',[$tgl1,$tgl2])
                    ->where('id_cabang',$idc)
                    ->where('kategori',$kat)
                    ->get();                   
                return view('Rekap.print_rekap_pengeluaran',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$tgl1,'bul2'=>$tgl2,'title'=>$this->setting]);
            }
        }
        
    }
    function rekapgaji(Request $request){
        $idc=Session::get('cabang');
        $request->validate([
            'b1'=>'required',
            'b2'=>'required',
            'th'=>'required',
            ]);
        $bl1=$request->b1;
        $bl2=$request->b2;
        $th=$request->th;
        if($idc=='1'){
            $lap=DB::table('gaji_karyawan')
            ->select(DB::raw('cabang.nama,gaji_karyawan.*'))
            ->leftjoin('cabang','cabang.id','=','gaji_karyawan.id_cabang')
            ->whereBetween('bulan',[$bl1,$bl2])
            ->where('tahun',$th)
            ->get();
            return view('Rekap.rekap_gaji',['lap'=>$lap,'bul1'=>$bl1,'bul2'=>$bl2,'th'=>$th,'title'=>$this->setting]);
        }else{
            $lap=DB::table('gaji_karyawan')
            ->select(DB::raw('cabang.nama,gaji_karyawan.*'))
            ->leftjoin('cabang','cabang.id','=','gaji_karyawan.id_cabang')
            ->whereBetween('bulan',[$bl1,$bl2])
            ->where('tahun',$th)
            ->where('id_cabang',$idc)
            ->get();
            return view('Rekap.rekap_gaji',['lap'=>$lap,'bul1'=>$bl1,'bul2'=>$bl2,'th'=>$th,'title'=>$this->setting]);
        }            
    }
    function cetakgaji($b1,$b2,$th){
        $idc=Session::get('cabang');  
        if($idc=='1'){
            $lap=DB::table('gaji_karyawan')
                ->select(DB::raw('cabang.nama,gaji_karyawan.*'))
                ->leftjoin('cabang','cabang.id','=','gaji_karyawan.id_cabang')
                ->whereBetween('bulan',[$b1,$b2])
                ->where('tahun',$th)
                ->get();
            return view('Rekap.print_gaji',['lap'=>$lap,'bul1'=>$b1,'bul2'=>$b2,'th'=>$th,'title'=>$this->setting]);
        }else{
            $lap=DB::table('gaji_karyawan')
                ->select(DB::raw('cabang.nama,gaji_karyawan.*'))
                ->leftjoin('cabang','cabang.id','=','gaji_karyawan.id_cabang')
                ->whereBetween('bulan',[$b1,$b2])
                ->where('tahun',$th)
                ->where('id_cabang',$idc)
                ->get();
            return view('Rekap.print_gaji',['lap'=>$lap,'bul1'=>$b1,'bul2'=>$b2,'th'=>$th,'title'=>$this->setting]);
        }
        
    }   
    function rekappk(Request $request){
        $idc=Session::get('cabang');
        $request->validate([
            'b1'=>'required',
            'b2'=>'required',
            'th'=>'required',
            ]);
        $b1=$request->b1;
        $b2=$request->b2;
        $th=$request->th;
        if($idc=='1'){
            $lap=DB::table('pajak_kendaraan')
            ->leftjoin('cabang','cabang.id','=','pajak_kendaraan.id_cabang')
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->get();
            $t=DB::table('pajak_kendaraan')
            ->select(DB::raw('sum(nominal) as tot'))
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->first();        
            // dd($lap);
            return view('Rekap.rekap_kendaraan',['lap'=>$lap,'bul1'=>$b1,'bul2'=>$b2,'th'=>$th,'title'=>$this->setting,'total'=>$t]);
        }else{
            $lap=DB::table('pajak_kendaraan')
            ->leftjoin('cabang','cabang.id','=','pajak_kendaraan.id_cabang')
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->where('id_cabang',$idc)
            ->get();
            $t=DB::table('pajak_kendaraan')
            ->select(DB::raw('sum(nominal) as tot'))
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->where('id_cabang',$idc)
            ->first();        
            // dd($lap);
            return view('Rekap.rekap_kendaraan',['lap'=>$lap,'bul1'=>$b1,'bul2'=>$b2,'th'=>$th,'title'=>$this->setting,'total'=>$t]);
        }
        
    }
    function printkendaraan($b1,$b2,$th){
        $idc=Session::get('cabang');
        if($idc=='1'){
            $lap=DB::table('pajak_kendaraan')
            ->leftjoin('cabang','cabang.id','=','pajak_kendaraan.id_cabang')
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->get();
            $t=DB::table('pajak_kendaraan')
            ->select(DB::raw('sum(nominal) as tot'))
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->first();
            return view('Rekap.print_kendaraan',['lap'=>$lap,'bul1'=>$b1,'bul2'=>$b2,'th'=>$th,'title'=>$this->setting,'total'=>$t]);
        }else{
            $lap=DB::table('pajak_kendaraan')
            ->leftjoin('cabang','cabang.id','=','pajak_kendaraan.id_cabang')
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->where('id_cabang',$idc)
            ->get();
            $t=DB::table('pajak_kendaraan')
            ->select(DB::raw('sum(nominal) as tot'))
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->where('id_cabang',$idc)
            ->first();
            return view('Rekap.print_kendaraan',['lap'=>$lap,'bul1'=>$b1,'bul2'=>$b2,'th'=>$th,'title'=>$this->setting,'total'=>$t]);
        }
       
    }
    function rekaptrans(Request $request){
        $idc=Session::get('cabang');
        $request->validate([
            'b1'=>'required',
            'b2'=>'required',
            'th'=>'required',
            ]);
        $b1=$request->b1;
        $b2=$request->b2;
        $th=$request->th;
        if($idc=='1'){
            $lap=DB::table('transfer')
            ->leftjoin('cabang','cabang.id','=','transfer.id_cabang')
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->get();
            $t=DB::table('transfer')
            ->select(DB::raw('sum(nominal) as tot'))
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->first();
            return view('Rekap.rekap_transfer',['lap'=>$lap,'bul1'=>$b1,'bul2'=>$b2,'th'=>$th,'title'=>$this->setting,'total'=>$t]);
        }else{
            $lap=DB::table('transfer')
            ->leftjoin('cabang','cabang.id','=','transfer.id_cabang')
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->where('id_cabang',$idc)
            ->get();
            $t=DB::table('transfer')
            ->select(DB::raw('sum(nominal) as tot'))
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->where('id_cabang',$idc)
            ->first();
            return view('Rekap.rekap_transfer',['lap'=>$lap,'bul1'=>$b1,'bul2'=>$b2,'th'=>$th,'title'=>$this->setting,'total'=>$t]);
        }     
    }
    function cetaktrans($b1,$b2,$th){
        $idc=Session::get('cabang');
        if($idc=='1'){
            $lap=DB::table('transfer')
            ->leftjoin('cabang','cabang.id','=','transfer.id_cabang')
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->get();
            $t=DB::table('transfer')
            ->select(DB::raw('sum(nominal) as tot'))
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->first();
            return view('Rekap.print_trans',['lap'=>$lap,'bul1'=>$b1,'bul2'=>$b2,'th'=>$th,'title'=>$this->setting,'total'=>$t]);   
        }else{
            $lap=DB::table('transfer')
            ->leftjoin('cabang','cabang.id','=','transfer.id_cabang')
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->where('id_cabang',$idc)
            ->get();
            $t=DB::table('transfer')
            ->select(DB::raw('sum(nominal) as tot'))
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->where('id_cabang',$idc)
            ->first();
            return view('Rekap.print_trans',['lap'=>$lap,'bul1'=>$b1,'bul2'=>$b2,'th'=>$th,'title'=>$this->setting,'total'=>$t]);   
        }     
    }
    function rekapneraca(Request $request){
        $idc=Session::get('cabang');
        $request->validate([
            'b1'=>'required',
            'b2'=>'required',
            'th'=>'required',
            ]);
        $b1=$request->b1;
        $b2=$request->b2;
        $th=$request->th;
        if($idc=='1'){
            $lap=DB::table('neraca')
            ->leftjoin('cabang','cabang.id','=','neraca.id_cabang')
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->get();
            $t=DB::table('neraca')
            ->select(DB::raw('sum(debit) as totdeb, sum(kredit) as totkred'))
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->first();
            return view('Rekap.rekap_neraca',['lap'=>$lap,'bul1'=>$b1,'bul2'=>$b2,'th'=>$th,'title'=>$this->setting,'total'=>$t]);
        }else{
            $lap=DB::table('neraca')
            ->leftjoin('cabang','cabang.id','=','neraca.id_cabang')
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->where('id_cabang',$idc)
            ->get();
            $t=DB::table('neraca')
            ->select(DB::raw('sum(debit) as totdeb, sum(kredit) as totkred'))
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->where('id_cabang',$idc)
            ->first();
            return view('Rekap.rekap_neraca',['lap'=>$lap,'bul1'=>$b1,'bul2'=>$b2,'th'=>$th,'title'=>$this->setting,'total'=>$t]);
        }        
    }
    function cetakneraca($b1,$b2,$th){
        $idc=Session::get('cabang');
        if($idc=='1'){
            $lap=DB::table('neraca')
            ->leftjoin('cabang','cabang.id','=','neraca.id_cabang')
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->get();
            $t=DB::table('neraca')
            ->select(DB::raw('sum(debit) as totdeb, sum(kredit) as totkred'))
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->first();
            return view('Rekap.print_neraca',['lap'=>$lap,'bul1'=>$b1,'bul2'=>$b2,'th'=>$th,'title'=>$this->setting,'total'=>$t]);
        }else{
            $lap=DB::table('neraca')
            ->leftjoin('cabang','cabang.id','=','neraca.id_cabang')
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->where('id_cabang',$idc)
            ->get();
            $t=DB::table('neraca')
            ->select(DB::raw('sum(debit) as totdeb, sum(kredit) as totkred'))
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->where('id_cabang',$idc)
            ->first();
            return view('Rekap.print_neraca',['lap'=>$lap,'bul1'=>$b1,'bul2'=>$b2,'th'=>$th,'title'=>$this->setting,'total'=>$t]);
        }        
    }
    // Surat Jalan
    function rekapsrj(Request $request){
        $idc=Session::get('cabang');
        $rules=[
            'tgl1'=>'required',
            'tgl2'=>'required',
            'kat'=>'required',
            ];
        $mes=['required'=>':attribute Harus Dilengkapi!'];
        $this->validate($request,$rules,$mes);
            $b1=$request->tgl1;
            $b2=$request->tgl2;
            $kat=$request->kat;
            // dd($kat);
            if($kat=='semua'){
                if($idc=='1'){
                    $data=DB::table('surat_jalan')
                        ->whereBetween('tgl',[$b1,$b2])
                        ->get();
                    $t=DB::table('surat_jalan')
                        ->select(DB::raw('sum(biaya) as tbiaya'))
                        ->whereBetween('tgl',[$b1,$b2])
                        ->first();
                }else{
                    $data=DB::table('surat_jalan')
                        ->whereBetween('tgl',[$b1,$b2])
                        ->where('id_cabang',$idc)
                        ->get();
                    $t=DB::table('surat_jalan')
                        ->select(DB::raw('sum(biaya) as tbiaya'))
                        ->where('id_cabang',$idc)
                        ->whereBetween('tgl',[$b1,$b2])
                        ->first();
                }
            }else{
                if($idc=='1'){
                    $data=DB::table('surat_jalan')
                        ->where('tujuan',$kat)
                        ->where('cabang','N')
                        ->whereBetween('tgl',[$b1,$b2])
                        ->get();
                        $t=DB::table('surat_jalan')
                        ->select(DB::raw('sum(biaya) as tbiaya'))
                        ->where('tujuan',$kat)
                        ->where('cabang','N')
                        ->whereBetween('tgl',[$b1,$b2])
                        ->first();
                }else{
                    $data=DB::table('surat_jalan')
                        ->where('tujuan',$kat)
                        ->where('cabang','N')
                        ->whereBetween('tgl',[$b1,$b2])
                        ->where('id_cabang',$idc)
                        ->get();
                        $t=DB::table('surat_jalan')
                        ->select(DB::raw('sum(biaya) as tbiaya'))
                        ->where('tujuan',$kat)
                        ->where('cabang','N')
                        ->where('id_cabang',$idc)
                        ->whereBetween('tgl',[$b1,$b2])
                        ->first();
                }               
            }
            return view('Rekap.rekap_srj',['data'=>$data,'bul1'=>$b1,'bul2'=>$b2,'kate'=>$kat,'title'=>$this->setting,'total'=>$t]);
    }
    function printsrj($kat,$b1,$b2){
        $kat=str_replace('_',' ',$kat);
        $idc=Session::get('cabang');       
            if($kat=='semua'){
                if($idc=='1'){
                    $data=DB::table('surat_jalan')
                        ->whereBetween('tgl',[$b1,$b2])
                        ->where('cabang','N')
                        ->get();
                    $t=DB::table('surat_jalan')
                        ->select(DB::raw('sum(biaya) as tbiaya'))
                        ->where('cabang','N')
                        ->whereBetween('tgl',[$b1,$b2])
                        ->first();
                }else{
                    $data=DB::table('surat_jalan')
                        ->whereBetween('tgl',[$b1,$b2])
                        ->where('cabang','N')
                        ->where('id_cabang',$idc)
                        ->get();
                    $t=DB::table('surat_jalan')
                        ->select(DB::raw('sum(biaya) as tbiaya'))
                        ->where('cabang','N')
                        ->where('id_cabang',$idc)
                        ->whereBetween('tgl',[$b1,$b2])
                        ->first();
                }
            }else{
                if($idc=='1'){
                    $data=DB::table('surat_jalan')
                        ->where('tujuan',$kat)
                        ->where('cabang','N')
                        ->whereBetween('tgl',[$b1,$b2])
                        ->get();
                        $t=DB::table('surat_jalan')
                        ->select(DB::raw('sum(biaya) as tbiaya'))
                        ->where('cabang','N')
                        ->where('tujuan',$kat)
                        ->whereNotNull('biaya')
                        ->whereBetween('tgl',[$b1,$b2])
                        ->first();
                }else{
                    $data=DB::table('surat_jalan')
                        ->where('tujuan',$kat)
                        ->where('cabang','N')
                        ->whereBetween('tgl',[$b1,$b2])
                        ->where('id_cabang',$idc)
                        ->get();
                        $t=DB::table('surat_jalan')
                        ->select(DB::raw('sum(biaya) as tbiaya'))
                        ->where('tujuan',$kat)
                        ->where('cabang','N')
                        ->where('id_cabang',$idc)
                        ->whereBetween('tgl',[$b1,$b2])
                        ->first();
                }               
            }
            return view('Rekap.print_srj',['data'=>$data,'bul1'=>$b1,'bul2'=>$b2,'kate'=>$kat,'title'=>$this->setting,'total'=>$t]);
    }    
}
