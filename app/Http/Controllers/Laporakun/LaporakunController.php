<?php
namespace App\Http\Controllers\Laporakun;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\models\Laporakunmodel;
use Illuminate\Support\Facades\Response;
use Session;
use Illuminate\Support\Facades\File;
class LaporakunController extends Controller
{

    public function pilihlapkun()
    {
        $setting = DB::table('setting')->get();        
        
        return view('laporakun/pilihlapkun',['title'=>$setting]);
    }

    public function tampilakunlapor(Request $request){
        $total=0;
        $rules = [
            'tgl' => 'required',
            'tgl0' => 'required',
                ];
         $customMessages = [
        'required'  => 'Maaf, Bulan Tidak Boleh Kosong',
         ];
        $this->validate($request,$rules,$customMessages);
        $kate=$request->kategori;
        $tgl = str_replace('/','-',$request->tgl);
        $tgl0 = str_replace('/','-',$request->tgl0);
        $idc=Session::get('cabang');        
        //  dd($tgl);
        
        if($kate=='pendapatan'){
            $kat = 'pendapatan';                     
            $peng=DB::table('tb_kategoriakutansi')
                ->select(DB::raw('tb_kategoriakutansi.*,pengeluaran_lain.kategori,pengeluaran_lain.keterangan,pengeluaran_lain.admin,pengeluaran_lain.tgl,pengeluaran_lain.jumlah'))
                ->leftjoin('pengeluaran_lain','pengeluaran_lain.kategori','=','tb_kategoriakutansi.kode')
                ->where('tb_kategoriakutansi.status',$kat)
                ->where('id_cabang',$idc)
                ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0]);
                
            $data = DB::table('tb_kategoriakutansi')
            ->select(DB::raw('tb_kategoriakutansi.*,resi_pengiriman.nama_barang,resi_pengiriman.no_resi,resi_pengiriman.admin,resi_pengiriman.tgl,resi_pengiriman.total_biaya'))
            ->leftjoin('resi_pengiriman','resi_pengiriman.katakun','=','tb_kategoriakutansi.kode')            
            ->whereBetween('resi_pengiriman.tgl',[$tgl,$tgl0])            
            ->where('resi_pengiriman.batal','!=','Y')
            ->where('resi_pengiriman.duplikat','N')
            ->where('id_cabang',$idc)
            ->union($peng)
            ->get();           
            $webinfo = DB::table('setting')->limit(1)->get();
            return view('laporakun/laporharianakun',['kat'=>$kate ,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$data,'title'=>$webinfo]);
        }elseif($kate=="pengeluaran"){
        $data = DB::table('tb_kategoriakutansi')
        ->select(DB::raw('tb_kategoriakutansi.*,pengeluaran_lain.kategori,pengeluaran_lain.keterangan,pengeluaran_lain.admin,pengeluaran_lain.tgl,pengeluaran_lain.jumlah'))
        ->leftjoin('pengeluaran_lain','pengeluaran_lain.kategori','=','tb_kategoriakutansi.kode')
        ->where('tb_kategoriakutansi.status',$kate)
        ->where('id_cabang',$idc)
        ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
        ->get();
            foreach ($data as $ros) {
                # code...
            $total= DB::table('pengeluaran_lain')
            ->select(DB::raw('SUM(jumlah) as totalnya'))
            ->where([['pengeluaran_lain.tgl','=',$ros->tgl],['kategori','=',$ros->kategori]])
            ->get();
            
            }            
            $webinfo = DB::table('setting')->limit(1)->get();
            return view('laporakun/lappengeluaran',['kat'=>$kate ,'tgl'=>$tgl,'tgl0'=>$tgl0,'data'=>$data,'title'=>$webinfo]);
        }

        // dd($total);
       
    }

        public function exsportabsensibulanan($kat,$tgl,$tgl0){

            $namafile = "Export laporan ".$kat." tanggal ".$tgl." sampai ".$tgl0." .xlsx";
        return Excel::download(new LaporakunExport($kat,$tgl,$tgl0),$namafile);
    }

        public function cetaklapakun($kat,$tgl,$tgl0){
            $idc=Session::get('cabang'); 
            $total=0;
        if($kat=='pendapatan'){
            $kat = 'pendapatan';
            $peng=DB::table('tb_kategoriakutansi')
                ->select(DB::raw('tb_kategoriakutansi.*,pengeluaran_lain.kategori,pengeluaran_lain.keterangan,pengeluaran_lain.admin,pengeluaran_lain.tgl,pengeluaran_lain.jumlah'))
                ->leftjoin('pengeluaran_lain','pengeluaran_lain.kategori','=','tb_kategoriakutansi.kode')
                ->where('tb_kategoriakutansi.status',$kat)
                ->where('id_cabang',$idc)
                ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0]);                
            $data = DB::table('tb_kategoriakutansi')
            ->select(DB::raw('tb_kategoriakutansi.*,resi_pengiriman.nama_barang,resi_pengiriman.no_resi,resi_pengiriman.admin,resi_pengiriman.tgl,resi_pengiriman.total_biaya'))
            ->leftjoin('resi_pengiriman','resi_pengiriman.katakun','=','tb_kategoriakutansi.kode')            
            ->whereBetween('resi_pengiriman.tgl',[$tgl,$tgl0])            
            ->where('resi_pengiriman.batal','!=','Y')
            ->where('resi_pengiriman.duplikat','N')
            ->where('id_cabang',$idc)
            ->union($peng)
            ->get();      
            $webinfo = DB::table('setting')->limit(1)->get();
            return view('laporakun/cetaklapakun',['kat'=>$kat ,'tgl'=>$tgl,'tgl0'=>$tgl0,'tot'=>$total,'data'=>$data,'title'=>$webinfo
            ]);   
        }else{
        $data =  DB::table('tb_kategoriakutansi')
        ->select(DB::raw('tb_kategoriakutansi.*,pengeluaran_lain.kategori,pengeluaran_lain.keterangan,pengeluaran_lain.admin,pengeluaran_lain.tgl,pengeluaran_lain.jumlah'))
        ->leftjoin('pengeluaran_lain','pengeluaran_lain.kategori','=','tb_kategoriakutansi.kode')
        ->where('tb_kategoriakutansi.status',"pengeluaran")
        ->where('id_cabang',$idc)
        ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
        ->get();
            foreach ($data as $ros) {
                # code...
            $total= DB::table('pengeluaran_lain')
            ->select(DB::raw('SUM(jumlah) as totalnya'))
            ->where([['pengeluaran_lain.tgl','=',$ros->tgl],['kategori','=',$ros->kategori]])
            ->get();            
            } 
            $webinfo = DB::table('setting')->limit(1)->get();
        return view('laporakun/cetakpeng',['kat'=>$kat ,'tgl'=>$tgl,'tgl0'=>$tgl0,'tot'=>$total,'data'=>$data,'title'=>$webinfo
        ]); 
        }
       
    }





}
