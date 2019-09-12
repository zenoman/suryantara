<?php

namespace App\Http\Controllers\Rekap;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
class Rekap extends Controller
{
    //
    private $setting; 
    
    function __construct(){            
        $this->setting = DB::table('setting')->limit(1)->get();
        $this->path = public_path('/tf');
        $idc=Session::get('cabang');
    }
    function index(){
        $kategori=DB::table('tb_kategoriakutansi')
                ->where('status','pengeluaran')
                ->get();
        return view('Rekap/index',['title'=>$this->setting,'kat'=>$kategori]);
    }
    function showpajak(Request $request){
        $request->validate([
            'th'=>'required',
        ]);
        $tg1=$request->b1;
        $tg2=$request->b2;
        $th=$request->th;
        
        // Cari Lap
        $lap=DB::table('pajak')
            ->whereBetween('bulan',[$tg1,$tg2])
            ->where('tahun',$th)
            ->get();        
        return view('Rekap.rekap_pajak',['lap'=>$lap,'bul1'=>$tg1,'bul2'=>$tg2,'th'=>$th,'title'=>$this->setting]);
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
        if($kat=='semua'){
            $kat="Semua Resi Lunas Dan Belum";
            $kate="semua";
            $lap=DB::table('resi_pengiriman')
                ->whereBetween('tgl',[$tgl1,$tgl2])
                ->where('duplikat','!=','N')                
                ->get();
            return view('Rekap.rekap_resi',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$tgl1,'bul2'=>$tgl2,'title'=>$this->setting]);
        }elseif($kat=='lunas'){
            $kat="Resi Lunas";
            $kate="lunas";
            $lap=DB::table('resi_pengiriman')
            ->whereBetween('tgl',[$tgl1,$tgl2])
            ->where('duplikat','!=','N')  
            ->whereNotNull('tgl_lunas')              
            ->get();
        return view('Rekap.rekap_resi',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$tgl1,'bul2'=>$tgl2,'title'=>$this->setting]);
        }elseif($kat=='belum'){
            $kate="belum";
            $kat="Resi Belum Lunas";
            $lap=DB::table('resi_pengiriman')
            ->whereBetween('tgl',[$tgl1,$tgl2])
            ->where('duplikat','!=','N')  
            ->whereNull('tgl_lunas')              
            ->get();
        return view('Rekap.rekap_resi',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$tgl1,'bul2'=>$tgl2,'title'=>$this->setting]);
        }
    }
    function cetakresi($kate,$bul1,$bul2,$kat){
        $idc=Session::get('cabang');  
        if($kate=='semua'){
            $kat="Semua Resi Lunas Dan Belum";
            $lap=DB::table('resi_pengiriman')
                ->whereBetween('tgl',[$bul1,$bul2])
                ->where('duplikat','!=','N')                
                ->get();
            return view('Rekap.print_rekap_resi',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$bul1,'bul2'=>$bul2,'title'=>$this->setting]);
        }elseif($kate=='lunas'){
            $kat="Resi Lunas";
            $lap=DB::table('resi_pengiriman')
            ->whereBetween('tgl',[$bul1,$bul2])
            ->where('duplikat','!=','N')  
            ->whereNotNull('tgl_lunas')              
            ->get();
        return view('Rekap.print_rekap_resi',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$bul1,'bul2'=>$bul2,'title'=>$this->setting]);
        }elseif($kate=='belum'){
            $kat="Resi Belum Lunas";
            $lap=DB::table('resi_pengiriman')
            ->whereBetween('tgl',[$bul1,$bul2])
            ->where('duplikat','!=','N')  
            ->whereNull('tgl_lunas')              
            ->get();
        return view('Rekap.print_rekap_resi',['kate'=>$kate,'kat'=>$kat,'lap'=>$lap,'bul1'=>$bul1,'bul2'=>$bul2,'title'=>$this->setting]);
        }
    }
    function cetakpengeluaran($kate,$tgl1,$tgl2,$kat){
        $idc=Session::get('cabang');  
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
        $lap=DB::table('gaji_karyawan')
            ->whereBetween('bulan',[$bl1,$bl2])
            ->where('tahun',$th)
            ->where('id_cabang',$idc)
            ->get();
        return view('Rekap.rekap_gaji',['lap'=>$lap,'bul1'=>$bl1,'bul2'=>$bl2,'th'=>$th,'title'=>$this->setting]);
    }
    function cetakgaji($b1,$b2,$th){
        $idc=Session::get('cabang');              
        $lap=DB::table('gaji_karyawan')
            ->whereBetween('bulan',[$b1,$b2])
            ->where('tahun',$th)
            ->where('id_cabang',$idc)
            ->get();
        return view('Rekap.print_gaji',['lap'=>$lap,'bul1'=>$b1,'bul2'=>$b2,'th'=>$th,'title'=>$this->setting]);
    }
    function bayarpajak(Request $request){
        $request->validate([
            'bul'=>'required',
            'th'=>'required',
            'ket'=>'required',
            'tot'=>'required',
        ]);
        $bul=$request->bul;
        $th=$request->th;
        $ket=$request->ket;
        $tot=$request->total;
        $data=[$bul,$th,$ket,$tot];
        $in=DB::insert('insert into pajak(bulan,tahun,nama_pajak,total) values(?,?,?,?)',$data);
        if($in){

        }
    }
}
