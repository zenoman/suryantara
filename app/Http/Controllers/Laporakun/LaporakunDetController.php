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
<<<<<<< HEAD
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
=======
        $kate=$request->kategori;
        $tgl = $request->tgl;
        $tgl0 = $request->tgl0;

        $am = explode('-', $tgl);
        $thn = $am[0];
        $bln = $am[1];

        $amb = explode('-', $tgl0);
        $thn0 = $amb[0];
        $bln0 = $amb[1];

        if($kate == 233){
//============================================================================suratjalan
            $kategor = "Surat Jalan";
            $peng = DB::table('surat_jalan')
            ->select(DB::raw('surat_jalan.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.id','=','surat_jalan.katakun')
            ->groupby('surat_jalan.katakun')
            ->whereYear('tgl',[$tgl])
            ->paginate(40);

            foreach ($peng as $r) {
            $totalsr[]  = DB::table('surat_jalan')
            ->select(DB::raw('SUM(totalcash) as totalnya'))
            ->where('katakun','=',$r->katakun)
            ->get();
            }
            $pengoto = DB::table('surat_jalan')
            ->select(DB::raw('SUM(totalcash) as totalnya'))
            ->whereYear('tgl',[$tgl])
            ->whereYear('tgl',$tgl)
            ->get();
            $katkat = DB::table('tb_kategoriakutansi')
            ->select(DB::raw('nama'))
            ->where('kode','=',$kate)
            ->get();
        $webinfo = DB::table('setting')->limit(1)->get();
    return view('laporakun/laporharianakundet',['nama'=>$katkat,'kat'=>$kate,'kate'=>$kategor ,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$peng,'totsurat'=>$totalsr,'totsuratthn'=>$pengoto,'title'=>$webinfo]);

            }else if($kate==211){
//==============================================================================pajak
                $kategor = "pjk";
            $pengpj = DB::table('Pajak')
            ->select(DB::raw('pajak.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.id','=','pajak.katakun')
            ->groupby('pajak.katakun')
            ->whereBetween('bulan',[$bln,$bln0])
            ->whereBetween('tahun',[$thn,$thn0])
            ->paginate(40);

            foreach ($pengpj as $ra) {
            $totalpj[]  = DB::table('pajak')
            ->select(DB::raw('SUM(total) as totalnya'))
            ->whereBetween('bulan',[$bln,$bln0])
            ->whereBetween('tahun',[$thn,$thn0])
            ->where('katakun','=',$ra->katakun)
            ->get();
            }
            $pengotopj = DB::table('pajak')
            ->select(DB::raw('SUM(total) as totalnya'))
            ->whereBetween('bulan',[$bln,$bln0])
            ->whereBetween('tahun',[$thn,$thn0])
            ->get();
            $katkat = DB::table('tb_kategoriakutansi')
            ->select(DB::raw('nama'))
            ->where('kode','=',$kate)
            ->get();
        $webinfo = DB::table('setting')->limit(1)->get();
    return view('laporakun/laporharianakundet',['nama'=>$katkat,'kat'=>$kate,'kate'=>$kategor ,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$pengpj,'totpajak'=>$totalpj,'totpajakthn'=>$pengotopj,'title'=>$webinfo]);

        }else if($kate == 122){
                $kategor = "Resi Pengiriman";
            $dapatrp = DB::table('resi_pengiriman')
            ->select(DB::raw('resi_pengiriman.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.id','=','resi_pengiriman.katakun')
            ->groupby('resi_pengiriman.katakun')
            ->whereYear('tgl_lunas',$tgl)
            ->paginate(40);

            foreach ($dapatrp as $ras) {
            $totalrp[]  = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as totalnya'))
            ->whereYear('tgl_lunas',$tgl)
            ->where('katakun','=',$ras->katakun)
            ->get();
            }
            $dapatoto = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as totalnya'))
            ->whereYear('tgl_lunas',$tgl)
            ->get();
            $katkat = DB::table('tb_kategoriakutansi')
            ->select(DB::raw('nama'))
            ->where('kode','=',$kate)
            ->get();
        $webinfo = DB::table('setting')->limit(1)->get();
    return view('laporakun/laporharianakundet',['nama'=>$katkat,'kat'=>$kate,'kate'=>$kategor ,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$dapatrp,'totresi'=>$totalrp,'totresithn'=>$dapatoto,'title'=>$webinfo]);
        }else{
//=============================================================pengeluaran lain
            $kate=$request->kategori;
                $kategor = "lain";
            $data = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('pengeluaran_lain.kategori','=',$kate)
            ->paginate(40);

            foreach ($data as $ros) {
                # code...
            $total[]  = DB::table('pengeluaran_lain')
            ->select(DB::raw('SUM(jumlah) as totalnya'))
            ->where([['pengeluaran_lain.tgl','=',$ros->tgl],['kategori','=',$ros->kategori]])
            ->get();
>>>>>>> master
            }
            $webinfo = DB::table('setting')->limit(1)->get();
            return view('laporakun/lapdetpengeluaran',['katn'=>$kat,'kat'=>$katkat ,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$data,'title'=>$webinfo
            ]);
         }
    }
<<<<<<< HEAD
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
=======

        public function cetaklapakundet($kate,$tgl,$tgl0){
        $am = explode('-', $tgl);
        $thn = $am[0];
        $bln = $am[1];

        $amb = explode('-', $tgl0);
        $thn0 = $amb[0];
        $bln0 = $amb[1];
            if($kate == 233){
//============================================================================suratjalan
            $kategor = "Surat Jalan";
            $peng = DB::table('surat_jalan')
            ->select(DB::raw('surat_jalan.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.id','=','surat_jalan.katakun')
            ->groupby('surat_jalan.katakun')
            ->whereYear('tgl',[$tgl])
            ->paginate(40);

            foreach ($peng as $r) {
            $totalsr  = DB::table('surat_jalan')
            ->select(DB::raw('SUM(totalcash) as totalnya'))
            ->where('katakun','=',$r->katakun)
            ->get();
            }
            $pengoto = DB::table('surat_jalan')
            ->select(DB::raw('SUM(totalcash) as totalnya'))
            ->whereYear('tgl',[$tgl])
            ->whereYear('tgl',$tgl)
            ->get();
            $katkat = DB::table('tb_kategoriakutansi')
            ->select(DB::raw('nama'))
            ->where('kode','=',$kate)
            ->get();
        $webinfo = DB::table('setting')->limit(1)->get();
    return view('laporakun/cetaklapakundet',['kat'=>$katkat ,'tgl'=>$tgl,'tgl0'=>$tgl0,'tose'=>$pengoto,'tot'=>$totalsr,'data'=>$peng,'title'=>$webinfo
    ]);

            }else if($kate==211){
//==============================================================================pajak
                $kategor = "pjk";
            $pengpj = DB::table('Pajak')
            ->select(DB::raw('pajak.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.id','=','pajak.katakun')
            ->groupby('pajak.katakun')
            ->whereBetween('bulan',[$bln,$bln0])
            ->whereBetween('tahun',[$thn,$thn0])
            ->paginate(40);

            foreach ($pengpj as $ra) {
            $totalpj  = DB::table('pajak')
            ->select(DB::raw('SUM(total) as totalnya'))
            ->whereBetween('bulan',[$bln,$bln0])
            ->whereBetween('tahun',[$thn,$thn0])
            ->where('katakun','=',$ra->katakun)
            ->get();
            }
            $pengotopj = DB::table('pajak')
            ->select(DB::raw('SUM(total) as totalnya'))
            ->whereBetween('bulan',[$bln,$bln0])
            ->whereBetween('tahun',[$thn,$thn0])
            ->get();
            $katkat = DB::table('tb_kategoriakutansi')
            ->select(DB::raw('nama'))
            ->where('kode','=',$kate)
            ->get();
        $webinfo = DB::table('setting')->limit(1)->get();
    return view('laporakun/cetaklapakundet',['kat'=>$katkat ,'tgl'=>$tgl,'tgl0'=>$tgl0,'tose'=>$pengotopj,'tot'=>$totalpj,'data'=>$pengpj,'title'=>$webinfo
    ]);

        }else if($kate ==122){
                $kategor = "Resi Pengiriman";
            $dapatrp = DB::table('resi_pengiriman')
            ->select(DB::raw('resi_pengiriman.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.id','=','resi_pengiriman.katakun')
            ->groupby('resi_pengiriman.katakun')
            ->whereYear('tgl_lunas',$tgl)
            ->paginate(40);

            foreach ($dapatrp as $ras) {
            $totalrp  = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as totalnya'))
            ->whereYear('tgl_lunas',$tgl)
            ->where('katakun','=',$ras->katakun)
            ->get();
            }
            $dapatoto = DB::table('resi_pengiriman')
            ->select(DB::raw('SUM(total_biaya) as totalnya'))
            ->whereYear('tgl_lunas',$tgl)
            ->get();
            $katkat = DB::table('tb_kategoriakutansi')
            ->select(DB::raw('nama'))
            ->where('kode','=',$kate)
            ->get();
        $webinfo = DB::table('setting')->limit(1)->get();
    return view('laporakun/cetaklapakundet',['kat'=>$katkat ,'tgl'=>$tgl,'tgl0'=>$tgl0,'tose'=>$dapatoto,'tot'=>$totalrp,'data'=>$dapatrp,'title'=>$webinfo
    ]);
        }else{
        $data = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('pengeluaran_lain.kategori','=',$kate)
            ->paginate(40);

            foreach ($data as $ros) {
                # code...
            $total  = DB::table('pengeluaran_lain')
            ->select(DB::raw('SUM(jumlah) as totalnya'))
            ->where([['pengeluaran_lain.tgl','=',$ros->tgl],['kategori','=',$ros->kategori]])
            ->get();
            
>>>>>>> master
            }
            $webinfo = DB::table('setting')->limit(1)->get();
            return view('laporakun/cetakdetpengeluaran',['katn'=>$kat,'kat'=>$katname ,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$data,'title'=>$webinfo
            ]);
         }
    }
}
