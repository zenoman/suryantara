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
    public function __construct()
    {
        $this->middleware('auth');
    }
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
                ];
         $customMessages = [
        'required'  => 'Maaf, kategori Tidak Boleh Kosong',
         ];  
       // set pilihan
       $pil="";
        $this->validate($request,$rules,$customMessages);
        $kat=$request->kategori;   
        $kh=$request->khusus;
        $idc=Session::get('cabang');   
        // set Tanggal
        $tgl = str_replace('/','-',$request->tgl);
        $tgl0 = str_replace('/','-',$request->tgl0);   
        $tg1=substr($tgl,0,4);
        $tg2=substr($tgl0,0,4);
        $dy1=substr($tgl,6,1);
        $dy2=substr($tgl0,6,1);
      //   dd($tg1,$dy1);
        //  ambil setting
        $webinfo = DB::table('setting')->limit(1)->get();
        if($kat==""){
         if($kh=="pajak"){
            $data=DB::table('pajak')    
            ->whereBetween('bulan',[$dy1,$dy2])
            ->whereBetween('tahun',[$tg1,$tg2])
            ->get();
            $pil="Pajak";
            return view('laporakun/lapkhusus',['kh'=>$kh,'pil'=>$pil,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$data,'title'=>$webinfo]);            
         }else if($kh=="sj"){
            $data=DB::table('surat_jalan')    
            ->select(DB::raw('cabang.*,surat_jalan.*'))
            ->leftjoin('cabang','cabang.id','=','surat_jalan.id_cabang')            
            ->whereBetween('surat_jalan.tgl',[$tgl,$tgl0])
            ->where('id_cabang',$idc)
            ->get();
            $pil="Surat Jalan";
            return view('laporakun/lapkhusus',['kh'=>$kh,'pil'=>$pil,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$data,'title'=>$webinfo]);
         }else if($kh=="sa"){
            $data=DB::table('surat_antar')    
            ->whereBetween('tgl',[$tgl,$tgl0])
            ->where('id_cabang',$idc)
            ->get();
            $pil="Surat Antar";
            return view('laporakun/lapkhusus',['kh'=>$kh,'pil'=>$pil,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$data,'title'=>$webinfo]);
         }else if($kh=="se"){
            $data=DB::table('surat_envoice')    
            ->whereBetween('tgl',[$tgl,$tgl0])
            ->where('id_cabang',$idc)
            ->get();
            $pil="Surat Envoice";
            return view('laporakun/lapkhusus',['kh'=>$kh,'pil'=>$pil,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$data,'title'=>$webinfo]);
         }else if($kh==""){
            $this->pilihlapkun();
         }

        }else{
           //  Pilah Berdasar Status
        $jenis=DB::table('tb_kategoriakutansi')
        ->where('kode',$kat)
        ->first();
        $namkat=$jenis->nama;
        $st=$jenis->status;
         if($st=="pendapatan"){
            $data = DB::table('tb_kategoriakutansi')
            ->select(DB::raw('tb_kategoriakutansi.*,resi_pengiriman.nama_barang,resi_pengiriman.no_resi,resi_pengiriman.admin,resi_pengiriman.tgl,resi_pengiriman.total_biaya'))
            ->leftjoin('resi_pengiriman','resi_pengiriman.katakun','=','tb_kategoriakutansi.kode')            
            ->whereBetween('resi_pengiriman.tgl',[$tgl,$tgl0])            
            ->where('resi_pengiriman.batal','!=','Y')
            ->where('tb_kategoriakutansi.kode',$kat)
            ->where('resi_pengiriman.duplikat','N')
            ->where('id_cabang',$idc)
            ->get();           
            $katkat=DB::table('tb_kategoriakutansi')   
            ->where('kode',$kat)
           ->get();
            foreach($katkat as $kt){
               $katname=$kt->nama;
            }                
            return view('laporakun/laporharianakundet',['kh'=>$kh,'katn'=>$kat,'kat'=>$katkat ,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$data,'title'=>$webinfo
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
            return view('laporakun/lapdetpengeluaran',['kh'=>$kh,'katn'=>$kat,'kat'=>$katkat ,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$data,'title'=>$webinfo
            ]);
         }
        }
        
    }
    function cetaklapakundet($kat,$kh,$tgl,$tgl0){             
        $idc=Session::get('cabang');  
        $tg1=substr($tgl,0,4);
        $tg2=substr($tgl0,0,4);
        $dy1=substr($tgl,6,1);
        $dy2=substr($tgl0,6,1); 
        // Pisah untuk pendapatan dan pengeluaran
        //  Pilah Berdasar Status
        $webinfo = DB::table('setting')->limit(1)->get();
        if($kat=="0"){
         if($kh=="pajak"){
            $data=DB::table('pajak')    
            ->whereBetween('bulan',[$dy1,$dy2])
            ->whereBetween('tahun',[$tg1,$tg2])
            ->get();
            $pil="Pajak";
            return view('laporakun/cetaklapkhusus',['kh'=>$kh,'pil'=>$pil,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$data,'title'=>$webinfo]);            
         }else if($kh=="sj"){
            $data=DB::table('surat_jalan')    
            ->select(DB::raw('cabang.*,surat_jalan.*'))
            ->leftjoin('cabang','cabang.id','=','surat_jalan.id_cabang')            
            ->whereBetween('surat_jalan.tgl',[$tgl,$tgl0])
            ->where('id_cabang',$idc)
            ->get();
            $pil="Surat Jalan";
            return view('laporakun/cetaklapkhusus',['kh'=>$kh,'pil'=>$pil,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$data,'title'=>$webinfo]);
         }else if($kh=="sa"){
            $data=DB::table('surat_antar')    
            ->whereBetween('tgl',[$tgl,$tgl0])
            ->where('id_cabang',$idc)
            ->get();
            $pil="Surat Antar";
            return view('laporakun/cetaklapkhusus',['kh'=>$kh,'pil'=>$pil,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$data,'title'=>$webinfo]);
         }else if($kh=="se"){
            $data=DB::table('surat_envoice')    
            ->whereBetween('tgl',[$tgl,$tgl0])
            ->where('id_cabang',$idc)
            ->get();
            $pil="Surat Envoice";
            return view('laporakun/cetaklapkhusus',['kh'=>$kh,'pil'=>$pil,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$data,'title'=>$webinfo]);
         }else if($kh==""){
            $this->pilihlapkun();
         }

        }else{
           //  Pilah Berdasar Status
        $jenis=DB::table('tb_kategoriakutansi')
        ->where('kode',$kat)
        ->first();
        $namkat=$jenis->nama;
        $st=$jenis->status;
         if($st=="pendapatan"){
            $data = DB::table('tb_kategoriakutansi')
            ->select(DB::raw('tb_kategoriakutansi.*,resi_pengiriman.nama_barang,resi_pengiriman.no_resi,resi_pengiriman.admin,resi_pengiriman.tgl,resi_pengiriman.total_biaya'))
            ->leftjoin('resi_pengiriman','resi_pengiriman.katakun','=','tb_kategoriakutansi.id')            
            ->whereBetween('resi_pengiriman.tgl',[$tgl,$tgl0])            
            ->where('resi_pengiriman.batal','!=','Y')
            ->where('tb_kategoriakutansi.kode',$kat)
            ->where('resi_pengiriman.duplikat','N')
            ->where('id_cabang',$idc)
            ->get();           
            $katkat=DB::table('tb_kategoriakutansi')   
            ->where('kode',$kat)
           ->get();
            foreach($katkat as $kt){
               $katname=$kt->nama;
            }                
            return view('laporakun/cetaklapakundet',['kh'=>$kh,'katn'=>$kat,'kat'=>$katkat ,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$data,'title'=>$webinfo
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
            return view('laporakun/cetaklapakundet',['kh'=>$kh,'katn'=>$kat,'kat'=>$katkat ,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$data,'title'=>$webinfo
            ]);
         }
        }
    }
}
