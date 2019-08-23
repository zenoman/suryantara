<?php
namespace App\Http\Controllers\Laporakun;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\models\Laporakudetnmodel;

use Illuminate\Support\Facades\Response;
use Session;
use Illuminate\Support\Facades\File;
class LaporakunDetController extends Controller
{

    public function pilihlapkun()
    {       
        $kategori=DB::table('tb_kategoriakutansi')
                ->get();
        $setting = DB::table('setting')->get(); 
        return view('laporakun/pilihlapkundet',['title'=>$setting,'kate'=>$kategori]);
    }

    public function tampilakunlapor(Request $request){
        $rules = [
            'tgl' => 'required',
            'tgl0' => 'required',
            'kategori' => 'required',
                ];
         $customMessages = [
        'required'  => 'Maaf, kategori Tidak Bokeh Kosong',
         ];        
        $this->validate($request,$rules,$customMessages);
        $kat=$request->kategori;       
        $idc=Session::get('cabang');   
        // set Tanggal
        $tgl = str_replace('/','-',$request->tgl);
        $tgl0 = str_replace('/','-',$request->tgl0);

        //  Pilah Berdasar Status
        $jenis=DB::table('tb_kategoriakutansi')
        ->where('kode',$kat)
        ->first();
        
        $st=$jenis->status;
         if($st=="pendapatan"){
            $data = DB::table('tb_kategoriakutansi')
            ->select(DB::raw('tb_kategoriakutansi.*,resi_pengiriman.nama_barang,resi_pengiriman.no_resi,resi_pengiriman.admin,resi_pengiriman.tgl,resi_pengiriman.total_biaya'))
            ->leftjoin('resi_pengiriman','resi_pengiriman.katakun','=','tb_kategoriakutansi.id')            
            ->whereBetween('resi_pengiriman.tgl',[$tgl,$tgl0])            
            ->where('resi_pengiriman.batal','!=','Y')
            ->where('tb_kategoriakutansi.kode',$kat)
            ->where('id_cabang',$idc)
            ->get();           
            $katkat=DB::table('tb_kategoriakutansi')   
            ->where('kode',$kat)
           ->get();
            foreach($katkat as $kt){
               $katname=$kt->nama;
            }
                $webinfo = DB::table('setting')->limit(1)->get();
            return view('laporakun/laporharianakundet',['katn'=>$kat,'kat'=>$katkat ,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$data,'title'=>$webinfo
            ]);
         }elseif($st=="pengeluaran"){
            $data=DB::table('pengeluaran_lain')                       
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')            
            ->where('pengeluaran_lain.kategori',$kat)
            ->where('id_cabang',$idc)
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->get();           
            $katkat=DB::table('tb_kategoriakutansi')   
            ->where('kode',$kat)
           ->get();
            foreach($katkat as $kt){
               $katname=$kt->nama;
            }
            $webinfo = DB::table('setting')->limit(1)->get();
            return view('laporakun/lapdetpengeluaran',['katn'=>$kat,'kat'=>$katkat ,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$data,'title'=>$webinfo
            ]);
         }
    }
    function cetaklapakundet($kat,$tgl,$tgl0){             
        $idc=Session::get('cabang');   
        // Pisah untuk pendapatan dan pengeluaran
        //  Pilah Berdasar Status
        $jenis=DB::table('tb_kategoriakutansi')
        ->where('kode',$kat)
        ->first();
        $katname="";
        $st=$jenis->status;
         if($st=="pendapatan"){
            $data = DB::table('tb_kategoriakutansi')
            ->select(DB::raw('tb_kategoriakutansi.*,resi_pengiriman.nama_barang,resi_pengiriman.no_resi,resi_pengiriman.admin,resi_pengiriman.tgl,resi_pengiriman.total_biaya'))
            ->leftjoin('resi_pengiriman','resi_pengiriman.katakun','=','tb_kategoriakutansi.id')            
            ->whereBetween('resi_pengiriman.tgl',[$tgl,$tgl0])            
            ->where('resi_pengiriman.batal','!=','Y')
            ->where('tb_kategoriakutansi.kode',$kat)
            ->where('id_cabang',$idc)
            ->get();           
            $katkat=DB::table('tb_kategoriakutansi')   
            ->where('kode',$kat)
           ->get();
            foreach($katkat as $kt){
               $katname=$kt->nama;
            }
                $webinfo = DB::table('setting')->limit(1)->get();
            return view('laporakun/cetaklapakundet',['katn'=>$kat,'kat'=>$katname ,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$data,'title'=>$webinfo
            ]);
         }elseif($st=="pengeluaran"){
            $data=DB::table('pengeluaran_lain')                       
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')            
            ->where('pengeluaran_lain.kategori',$kat)
            ->where('id_cabang',$idc)
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->get();           
            $katkat=DB::table('tb_kategoriakutansi')   
            ->where('kode',$kat)
           ->get();
            foreach($katkat as $kt){
               $katname=$kt->nama;
            }
            $webinfo = DB::table('setting')->limit(1)->get();
            return view('laporakun/cetakdetpengeluaran',['katn'=>$kat,'kat'=>$katname ,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$data,'title'=>$webinfo
            ]);
         }
    }
}
