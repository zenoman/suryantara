<?php

namespace App\Http\Controllers\pembukuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Session;
class PembukuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    private $setting;   
    private $idc;
    function __construct(){            
        $this->setting = DB::table('setting')->limit(1)->get();
        $this->path = public_path('/tf');
    }

     public function index(){         
        return view('pembukuan.home',['title'=> $this->setting]);
    }
    function showtf(){
        // -set date
        
        // 
        $idc=Session::get('cabang');   
        $in=DB::table('resi_pengiriman')
        ->select(DB::raw('sum(resi_pengiriman.total_biaya) as totalres'))                         
        ->where('resi_pengiriman.batal','!=','Y')
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
        
        if($req->hasFile('bukti')){
            $img=$req->file('bukti');
            $nama=date('Y-m-d').'-'.$img->getClientOriginalName();
            $path=$this->path;
            $img->move($path,$nama);        
            $adm=$req->admin;
            $kod=$req->kokat;
            $tlg=$req->tgl;
            $kat=$req->kat;
            $idc=Session::get('cabang');
            $ung=$req->nominal;
            $nom=str_replace(',','',$req->nominal);
            $sal=$req->sal;

            if($nom>$sal){
                return redirect()->action('pembukuan\PembukuanController@showtf')->with("msg","Nominal Transfer Lebih dari Saldo");
            }else{
                dd($nom);
                // simpan ke transfer
                $tf=DB::insert('insert into transfer(tgl_tf,id_cabang,cabang_tujuan,nominal,admin) values(?,?,?,?,?)',[$tlg,$idc,'1',$nom,$adm]);
                // Simpan Transfer Ke pengeluaran Lain
                $si=DB::insert('insert into pengeluaran_lain(admin,kategori,keterangan,tgl,gambar,id_cabang,tf) values(?,?,?,?,?,?,?)',[$adm,$kod,$kat,$tlg,$nama,$idc,'t']);
                if($si){
                    return redirect()->action('pembukuan\PembukuanController@showtf')->with("msg","Data Berhasil Disimpan");
                }else{
                    return redirect()->action('pembukuan\PembukuanController@showtf')->with("msg","Data Gagal Disimpan");
                }
            }
        }
           
    }
    
}
