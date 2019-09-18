<?php

namespace App\Http\Controllers\pembukuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Session;
class PembukuanController extends Controller
{
    
    private $setting;   
    private $idc;
    function __construct(){            
        $this->setting = DB::table('setting')->limit(1)->get();
        $this->path = public_path('/tf');
        $this->middleware('auth');
        if(!Session::get('nama')){
            return redirect()->action('Dashboardcontroller@index');
    }

     public function index(){    
        $tglawal=date('Y-m-d',strtotime('first day of previous month'));
        $tglakhir=date('Y-m-d',strtotime('last day of previous month')); 
        $lastbul= date('n',strtotime('last day of previous month')); 
        $latth=date('Y',strtotime('last day of previous month')); 
        $idc=Session::get('cabang');
        $bsaldo=DB::table('set_saldo')
                ->where('id_cabang',$idc)
                ->first();
        $in=DB::table('resi_pengiriman')
        ->select(DB::raw('sum(resi_pengiriman.total_bayar) as totalres'))   
        ->where('resi_pengiriman.duplikat','!=','Y')
        ->where('transfer','N')
        ->whereBetween('tgl',[$tglawal,$tglakhir])
        ->whereNotNull('tgl_lunas')
        ->where('id_cabang',$idc)        
        ->first();
        $cab=DB::table('cabang')
            ->where('id','1')
            ->limit(1)
            ->get();
        $cektgl=DB::table('transfer')                
                ->where('id_cabang',$idc)
                ->where('bulan',$lastbul)
                ->where('tahun',$latth)
                ->count();        
        $totsal=$in->totalres;
        return view('pembukuan.home',['title'=> $this->setting,'sal'=>$bsaldo,'in'=>$totsal,'cab'=>$cab,'cekbul'=>$cektgl]);
    }
    function showtf(){
        // -set date
        
        // 
        $idc=Session::get('cabang');   
        $in=DB::table('resi_pengiriman')
        ->select(DB::raw('sum(resi_pengiriman.total_biaya) as totalres'))                         
        // ->where('resi_pengiriman.batal','!=','Y')
        ->where('resi_pengiriman.duplikat','N')
        ->where('id_cabang',$idc)        
        ->get();
        $inlain=DB::table('tb_kategoriakutansi')
        ->select(DB::raw('sum(pengeluaran_lain.jumlah) as totalin'))
        ->leftjoin('pengeluaran_lain','pengeluaran_lain.kategori','=','tb_kategoriakutansi.kode')
        ->where('tb_kategoriakutansi.status',"pendapatan")
        ->where('id_cabang',$idc)
        ->get();
        $peng=DB::table('tb_kategoriakutansi')
        ->select(DB::raw('sum(pengeluaran_lain.jumlah) as total'))
        ->leftjoin('pengeluaran_lain','pengeluaran_lain.kategori','=','tb_kategoriakutansi.kode')
        ->where('tb_kategoriakutansi.status',"pengeluaran")
        ->where('id_cabang',$idc)
        ->get();
        $gaj=DB::table('gaji_karyawan')
            ->select(DB::raw('sum(total) as total'))
            ->where('id_cabang',$idc)
            ->get();
        $tf=DB::table('transfer')
            ->limit(5)
            ->orderBy('id','DESC')
            ->get();
        $ttf=DB::table('transfer')
        ->select(DB::raw('sum(nominal) as total'))
        ->where('id_cabang',$idc)
        ->get();
        $kat=DB::table('tb_kategoriakutansi')->where('kode','090')->get();
        return view('pembukuan.tf',['title'=> $this->setting,'inresi'=>$in,'peng'=>$peng,'inpen'=>$inlain,'tf'=>$tf,'kat'=>$kat,'gaj'=>$gaj,'ttf'=>$ttf]);
    }
    function simpantf(Request $req){         
        $lasbul=date('n',strtotime('last day of previous month'));
        $lastth=date('Y',strtotime('last day of previous month'));
        $skbul=date('n');
        $skth=date('Y');
        if($req->hasFile('bukti')){
            $img=$req->file('bukti');
            $nama=date('Y-m-d').'-'.$img->getClientOriginalName();
            $path=$this->path;
            $img->move($path,$nama);        
            $adm=$req->admin;            
            $tlg=$req->tgl;
            $idp=$req->idc;            
            $idc=Session::get('cabang');
            $ung=$req->nominal;
            $nom=str_replace(',','',$req->nominal);
            $sal=$req->sal;
            $sisa=$req->sisal;
            // dd($idp);
                // simpan ke transfer
                $tf=DB::insert('insert into transfer(bulan,tahun,id_cabang,cabang_tujuan,nominal,bukti,admin) values(?,?,?,?,?,?,?)',[$lasbul,$lastth,$idc,$idp,$nom,$nama,$adm]);
                // Simpan Transfer Ke neraca
                $si=DB::insert('insert into neraca(bulan,tahun,keterangan,kredit,admin,id_cabang) values(?,?,?,?,?,?)',[$lasbul,$lastth,'Transfer Ke Pusat',$nom,$adm,$idc]);
                $is=DB::insert('insert into neraca(bulan,tahun,keterangan,debit,admin,id_cabang) values(?,?,?,?,?,?)',[$skbul,$skth,'Saldo Awal Bulan',$sisa,$adm,$idc]);
                $kis=DB::insert('insert into neraca(bulan,tahun,keterangan,kredit,admin,id_cabang) values(?,?,?,?,?,?)',[$lasbul,$lastth,'Piutang Saldo',$sisa,$adm,$idc]);
                if($si){
                    return redirect()->action('pembukuan\PembukuanController@index')->with("msg","Data Berhasil Disimpan");
                }else{
                    return redirect()->action('pembukuan\PembukuanController@index')->with("msg","Data Gagal Disimpan");
                }
            
        }
           
    }
    function simpanmodal(Request $request){
        $idc=Session::get('cabang');
        $request->validate([
            'modal'=>'required',
        ]);
        $bul=$request->bl;
        $th=$request->th;        
        $mod=str_replace(',','',$request->modal);  
        $ket="Modal Usaha";
        $admin=Session::get('nama');
        
        // Simpan Modal
        $data=[$bul,$th,$ket,$mod,$admin,$idc];
        $in=DB::insert('insert into neraca(bulan,tahun,keterangan,kredit,admin,id_cabang) values(?,?,?,?,?,?)',$data);
        if($in){
            return redirect()->action('pembukuan\PembukuanController@index')->with("msg","Data Berhasil Disimpan");
        }else{
            return redirect()->action('pembukuan\PembukuanController@index')->with("msg","Data Gagal Disimpan");
        }
    }
    
}
