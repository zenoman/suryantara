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

    }
      function index(){    
        $tglawal=date('Y-m-d',strtotime('first day of previous month'));
        $tglakhir=date('Y-m-d',strtotime('last day of previous month')); 
        $lastbul= date('n',strtotime('last day of previous month')); 
        $latth=date('Y',strtotime('last day of previous month')); 
        $dnow=date('n');
        // update Bon Setiap Akhir Bulan
        $dt=DB::table('kas_bon')
            ->where('valid','N')
            ->first();
        if(empty($dt)){   
            $cekbl=$lastbul;
        }else{
            $cekbl=substr($dt->tgl,6,1);
        }
        
        if($cekbl!==$dnow){
            DB::update("update kas_bon set valid='Y' where tgl between '".$tglawal."' and '".$tglakhir."'");
        }        
        // 
        $idc=Session::get('cabang');
        $bsaldo=DB::table('set_saldo')
                ->where('id_cabang',$idc)
                ->first();
        $in=DB::table('neraca')
        ->select(DB::raw('sum(debit) as totaldeb, sum(kredit) as totalkred'))   
        ->where('bulan',$lastbul)
        ->where('tahun',$latth)
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
        // Ambil Karyawan
        $kar=DB::table('karyawan')
            ->where('id_cabang',$idc)
            ->get();

        $totsal=$in->totaldeb;
        $tolkre=$in->totalkred;
        return view('pembukuan.home',['kar'=>$kar,'title'=> $this->setting,'sal'=>$bsaldo,'in'=>$totsal,'cab'=>$cab,'cekbul'=>$cektgl,'kred'=>$tolkre]);
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
            $ss=str_replace(',','',$req->sisal);
            $sisa=$ss-$nom;
            $tglf=date('Y-m-d');
            // dd($idp);
                // simpan ke transfer
                $tf=DB::insert('insert into transfer(bulan,tahun,tgl,id_cabang,cabang_tujuan,nominal,saldo,bukti,admin) values(?,?,?,?,?,?,?,?,?)',[$skbul,$skth,$tglf,$idc,$idp,$nom,$sisa,$nama,$adm]);
                // Simpan Transfer Ke neraca
                // cek bulan dan id cabang untuk transfer
                $jtf=DB::table('neraca')
                    ->where([
                        'id_cabang'=>$idc,
                        'bulan'=>$skbul,
                        'tahun'=>$skth,
                    ])->count();
                if($jtf>0){
                    $si=DB::update('update neraca set keterangan=?,kredit=?,admin=? where id_cabang=? and bulan=? and tahun=?) values(?,?,?,?,?,?)',['Sisa Saldo',$sisa,$adm,$idc,$skbul,$skth]);
                }else{
                    $si=DB::insert('insert into neraca(bulan,tahun,keterangan,kredit,admin,id_cabang) values(?,?,?,?,?,?)',[$skbul,$skth,'Transfer Ke Pusat',$sisa,$adm,$idc]);
                }           
                // $is=DB::insert('insert into neraca(bulan,tahun,keterangan,debit,admin,id_cabang) values(?,?,?,?,?,?)',[$skbul,$skth,'Saldo Awal Bulan',$sisa,$adm,$idc]);
                // $kis=DB::insert('insert into neraca(bulan,tahun,keterangan,kredit,admin,id_cabang) values(?,?,?,?,?,?)',[$lasbul,$lastth,'Piutang Saldo',$sisa,$adm,$idc]);

                if($tf){
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
    function ambilbon($id){        
        $d=DB::table('karyawan')
            // ->select(DB::raw('karyawan.*,as_bon'))
            // ->leftjoin('kas_bon','kas_bon.idkaryawan','=','karyawan.kode')
            ->where('karyawan.kode',$id)
            // ->where('kas_bon.valid','N')
            ->get();
        return response()->json($d);
    }
    function ambiltunggak($id){
        $bn=DB::table('kas_bon')
            ->where('idkaryawan',$id)
            ->where('kas_bon.valid','N')
            ->get();
        $cn=DB::table('kas_bon')
            ->where('idkaryawan',$id)
            ->where('kas_bon.valid','N')
            ->count();        
        return response()->json(['data'=>$bn,'cn'=>$cn]);
              
    }
    function simpanbon(Request $request){
        $idc=Session::get('cabang');
        $tgl=date('Y-m-d');
        $bul=date('n');
        $th=date('Y');
        $request->validate([
            'nbon'=>'required',
            'kar'=>'required',
        ]);
        $nama=Session::get('nama');
        $nbon=str_replace(',','',$request->nbon);
        $kar=$request->kar;

        $sim=DB::insert('insert into kas_bon(tgl,idkaryawan,bon,bayar,admin) values(?,?,?,?,?)',[$tgl,$kar,$nbon,'0',$nama]);
        if($sim){
            // update bon gaji_karyawan
             DB::update('update gaji_karyawan set bon=?, total=(total-bon) where kode_karyawan=? and  bulan=? and  tahun=? and id_cabang=?',[$nbon,$kar,$bul,$th,$idc]);
            return redirect()->action('pembukuan\PembukuanController@index')->with("msg","Data Berhasil Disimpan");
        }else{
            return redirect()->action('pembukuan\PembukuanController@index')->with("msg","Data Gagal Disimpan");
        }
    }
    // laba rugi
    function labarugi(){
        // pengeluaran harian        
        // pengeluaran pajak
        // pengeluaran gaji
        // pengeluaran suratjalan
        // pengeluaran pajak kendaraan
        // pemasukan resi lunas
        // pemasukan resi belum lunas
        // pemasukan piutang resi
        $idc=Session::get('cabang');
        $lastbul= date('n',strtotime('last day of previous month')); 
        $b1=date('n',strtotime('last day of previous month'));
        $b2=$b1; 
        $latth=date('Y',strtotime('last day of previous month')); 
        $th=date('Y');
        if($idc=='1'){
        $data=DB::table('neraca')   
            ->leftjoin('cabang','cabang.id','=','neraca.id_cabang')         
            ->where('bulan',$lastbul)            
            ->get();
        $tot=DB::table('neraca')            
            ->select(DB::raw('sum(debit) as tdebit, sum(kredit) as tkredit'))
            ->leftjoin('cabang','cabang.id','=','neraca.id_cabang')         
            ->where('bulan',$lastbul)
            ->first();
        $setting=DB::table('setting')
                ->get();
        }else{
        $data=DB::table('neraca')   
            ->leftjoin('cabang','cabang.id','=','neraca.id_cabang')         
            ->where('bulan',$lastbul)            
            ->where('id_cabang',$idc)
            ->get();
        $tot=DB::table('neraca')            
            ->select(DB::raw('sum(debit) as tdebit, sum(kredit) as tkredit'))
            ->leftjoin('cabang','cabang.id','=','neraca.id_cabang')         
            ->where('bulan',$lastbul)
            ->where('id_cabang',$idc)
            ->first();
        $setting=DB::table('setting')
                ->get();
        }
        return view('pembukuan.labarugi',['data'=>$data,'title'=>$setting,'bul1'=>$b1,'bul2'=>$b2,'th'=>$th,'tot'=>$tot]);
    }
    function carilaba(Request $request){
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
            $data=DB::table('neraca')            
                ->leftjoin('cabang','cabang.id','=','neraca.id_cabang')         
                ->whereBetween('bulan',[$b1,$b2])
                ->where('tahun',$th)            
                ->get();
            $tot=DB::table('neraca')            
                ->select(DB::raw('sum(debit) as tdebit, sum(kredit) as tkredit, neraca.*'))
                ->leftjoin('cabang','cabang.id','=','neraca.id_cabang')         
                ->whereBetween('bulan',[$b1,$b2])
                ->where('tahun',$th)            
                ->first();
            $setting=DB::table('setting')
                ->get();
        }else{
            $data=DB::table('neraca')            
                ->leftjoin('cabang','cabang.id','=','neraca.id_cabang')         
                ->whereBetween('bulan',[$b1,$b2])
                ->where('tahun',$th) 
                ->where('id_cabang',$idc)           
                ->get();
            $tot=DB::table('neraca')            
                ->select(DB::raw('sum(debit) as tdebit, sum(kredit) as tkredit, neraca.*'))
                ->leftjoin('cabang','cabang.id','=','neraca.id_cabang')         
                ->whereBetween('bulan',[$b1,$b2])
                ->where('tahun',$th)     
                ->where('id_cabang',$idc)       
                ->first();
            $setting=DB::table('setting')
                ->get();
        }
        return view('pembukuan.labarugi',['data'=>$data,'title'=>$setting,'bul1'=>$b1,'bul2'=>$b2,'th'=>$th,'tot'=>$tot]);
    }
    function cetaklb($b1,$b2,$th){
        $idc=Session::get('cabang');
        if($idc=='1'){
            $data=DB::table('neraca')            
                ->leftjoin('cabang','cabang.id','=','neraca.id_cabang')         
                ->whereBetween('bulan',[$b1,$b2])
                ->where('tahun',$th)            
                ->get();
            $tot=DB::table('neraca')            
                ->select(DB::raw('sum(debit) as tdebit, sum(kredit) as tkredit, neraca.*'))
                ->leftjoin('cabang','cabang.id','=','neraca.id_cabang')         
                ->whereBetween('bulan',[$b1,$b2])
                ->where('tahun',$th)            
                ->first();
            $setting=DB::table('setting')
                ->get();
        }else{
            $data=DB::table('neraca')            
                ->leftjoin('cabang','cabang.id','=','neraca.id_cabang')         
                ->whereBetween('bulan',[$b1,$b2])
                ->where('tahun',$th)        
                ->where('id_cabang',$idc)       
                ->get();
            $tot=DB::table('neraca')            
                ->select(DB::raw('sum(debit) as tdebit, sum(kredit) as tkredit, neraca.*'))
                ->leftjoin('cabang','cabang.id','=','neraca.id_cabang')         
                ->whereBetween('bulan',[$b1,$b2])
                ->where('tahun',$th)        
                ->where('id_cabang',$idc)       
                ->first();
            $setting=DB::table('setting')
                ->get();
        }
        return view('pembukuan.cetaklabarugi',['data'=>$data,'title'=>$setting,'bul1'=>$b1,'bul2'=>$b2,'th'=>$th,'tot'=>$tot]);
    }
}
