<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class Dashboardcontroller extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $this->buatsession();
        $this->masukandata();
        $idc=Session::get('cabang');
        $nam=Session::get('nama');
        // ==========================================
        // jumlah Penghasilan Resi penggiriman
        $tglawal=date('Y-m-d',strtotime('first day of previous month'));
        $tglakhir=date('Y-m-d',strtotime('last day of previous month'));
        $lasbul=date('n',strtotime('last day of previous month'));
        $lastth=date('Y',strtotime('last day of previous month'));
        $tot=DB::table('resi_pengiriman')
            ->select(DB::raw('sum(total_biaya) as total'))
            ->whereBetween('tgl',[$tglawal,$tglakhir])
            ->where('duplikat','!=','Y')
            ->where('id_cabang',$idc)
            ->first(); 
        $tresi=$tot->total;        
        // ambil Persen pajak dari setting
        $persen=DB::table('setting_pajak')
                ->where('tempo','bulan')
                ->first();
        $pjsen=$persen->besaran;
        // Cek Bulan sebelumnya
        $ckbul=DB::table('pajak')
            ->where('bulan',$lasbul)
            ->where('tahun',$lastth)
            ->where('id_cabang',$idc)
            ->count();
        // Cek bulan neraca
        $cbln=DB::table('neraca')
            ->where('bulan',$lasbul)
            ->where('tahun',$lastth)
            ->where('id_cabang',$idc)
            ->count();
        // total pemasukan resi lunas
        $presi=DB::table('resi_pengiriman')
            ->select(DB::raw('sum(total_bayar) as totresi'))    
            ->whereBetween('tgl',[$tglawal,$tglakhir])
            ->where('id_cabang',$idc)
            ->whereNotNull('tgl_lunas')
            ->where('duplikat','!=','Y')
            ->first();        
        $penresi=$presi->totresi;
        // total pemasukan resi belum lunas
        $pires=DB::table('resi_pengiriman')
        ->select(DB::raw('sum(total_bayar) as totresi,sum(total_biaya) as totsemua'))    
        ->whereBetween('tgl',[$tglawal,$tglakhir])
        ->whereNull('tgl_lunas')
        ->where('duplikat','!=','Y')
        ->where('id_cabang',$idc)
        ->first();   
        $tpr=$pires->totresi;
        $tps=$pires->totsemua;
        $piuresi=$tps-$tpr;
        // total pajak
        $pajakbayar=$tresi*$pjsen/100;

        //  pengeluaran harian
        $pl=DB::table('pengeluaran_lain')
            ->whereBetween('tgl',[$tglawal,$tglakhir])
            ->select(DB::raw('sum(jumlah) as tpl'))
            ->where('id_cabang',$idc)
            ->first();
        $tpl=$pl->tpl;
        if($tpl==null){
            $tpl=0;
        }
        // hitung Gaji karayawan
        $gj=DB::table('gaji_karyawan')
            ->select(DB::raw('sum(total) as totalgj'))
            ->where('bulan',$lasbul)
            ->where('tahun',$lastth)
            ->where('id_cabang',$idc)
            ->first();
        $totalgj=$gj->totalgj;
        
        if($ckbul<=0){            
            // simpan ke tabel pajak 
            $inpjk=DB::insert('insert into pajak(bulan,tahun,nama_pajak,total,id_cabang) values(?,?,?,?,?)',[$lasbul,$lastth,'Pajak Pendapatan',$pajakbayar,$idc]);            
        }
        if($cbln<=0){
            // Simpan Ke tabel neraca
            // insert pajak
            $ner=DB::insert('insert into neraca(bulan,tahun,keterangan,kredit,admin,id_cabang) values(?,?,?,?,?,?)',[$lasbul,$lastth,'Pajak Pemasukan Resi',$pajakbayar,$nam,$idc]);
            // simpan pemasukan resi lunas
            $xresl=DB::insert('insert into neraca(bulan,tahun,keterangan,debit,admin,id_cabang) values(?,?,?,?,?,?)',[$lasbul,$lastth,'Pemasukan resi lunas',$penresi,$nam,$idc]);
            // simpan resi belum lunas
            $xresn=DB::insert('insert into neraca(bulan,tahun,keterangan,debit,admin,id_cabang) values(?,?,?,?,?,?)',[$lasbul,$lastth,'Pemasukan resi belum lunas',$tpr,$nam,$idc]);
            // simpan piutang resi
            $xpiures=DB::insert('insert into neraca(bulan,tahun,keterangan,debit,admin,id_cabang) values(?,?,?,?,?,?)',[$lasbul,$lastth,'Pemasukan Piutang resi ',$piuresi,$nam,$idc]);            
            // simpan pengeluaran Harian
            $inpl=DB::insert('insert into neraca(bulan,tahun,keterangan,kredit,admin,id_cabang) values(?,?,?,?,?,?)',[$lasbul,$lastth,'Pengeluaran Harian',$tpl,$nam,$idc]);
            // insert total gaji 
            $gaj=DB::insert('insert into neraca(bulan,tahun,keterangan,kredit,admin,id_cabang) values(?,?,?,?,?,?)',[$lasbul,$lastth,'Gaji Karyawan',$totalgj,$nam,$idc]);
            // backup resi pengiriman
            
        }
        //============================================
        $pajakarmada = 
        DB::table('pajak_armada')
        ->select(DB::raw('pajak_armada.*,armada.*'))
        ->leftjoin('armada','armada.id','=','pajak_armada.id_armada')
        ->wheredate('tgl_peringatan','<',date('Y-m-d'))
        ->get();

        //============================================
        $jumlahpajakarmada = 
        DB::table('pajak_armada')
        ->wheredate('tgl_peringatan','<',date('Y-m-d'))
        ->count();

        //============================================
        $listsj = DB::table('surat_jalan')
        ->where('status','=','Y')
        ->get();

        //============================================
        $resi = DB::table('resi_pengiriman')
        ->where([['status','!=','Y'],['total_biaya','>',0]])
        ->get();

        //============================================
        $uanghariini = DB::table('resi_pengiriman')
        ->select(DB::raw('SUM(total_biaya) as total'))
        ->where('tgl_lunas',date('Y-m-d'))
        ->get();

        //============================================
        $jumlahresi = DB::table('resi_pengiriman')
        ->where([['status','!=','Y'],['total_biaya','>',0]])
        ->count();

        //============================================
        $jumlahtotalresi = DB::table('resi_pengiriman')
        ->count();

        //============================================
        $jumlahsj = DB::table('surat_jalan')
        ->where('status','=','Y')
        ->count();

        //============================================
        $dattgl=date('Y-m-d');

        //============================================
        $dataabsensi=DB::table('absensi')
        ->where('tanggal','=',$dattgl)
        ->count();

        //============================================
        $datakaryawan=DB::table('karyawan')
        ->count();

        //============================================
        $setting = DB::table('setting')->get();

        return view('dashboard/index',['jmlkarya'=>$datakaryawan,'jmlabsen'=>$dataabsensi,'title'=>$setting,'resi'=>$resi,'listsj'=>$listsj,'uanghariini'=>$uanghariini,'jumlahresi'=>$jumlahresi,'jumlahsj'=>$jumlahsj,'pajakarmada'=>$pajakarmada,'jumlahpajakarmada'=>$jumlahpajakarmada,'jumlahtotalresi'=>$jumlahtotalresi]);
      }

      //===============================================================
      function masukandata(){
        $setting = DB::table('setting')
        ->limit(1)
        ->get();

        foreach ($setting as $st){
            $bulan = $st->bulan_sekarang;
        }

        if($bulan != date('m')){
            $tahun = date('Y');
            if(date('m')==1){
                $pemasukan = $this->cari_pemasukan($bulan,date('Y'),"ny");
                $this->inputgaji($pemasukan,$bulan,date('Y'),"ny");
            }else{
                $pemasukan = $this->cari_pemasukan($bulan,date('Y'),"ny");
                $this->inputgaji($pemasukan,$bulan,date('Y'),"y");
            }
        }
        $dattgl=date('Y-m-d');
        $bulan = explode('-', $dattgl);
        $bln = $bulan[1];
            DB::table('setting')
            ->update([
                'bulan_sekarang'=>$bln,
                'status'=>'Y'
            ]);
      }

      //============================================================
      function inputgaji($pemasukan,$bulan,$tahun,$status){
        if($status=="ny"){ $tahun -=1; }
        
        //---------------------------------------------------------------
        $datakaryawan =
        DB::table('karyawan')
        ->select(DB::raw('karyawan.*,jabatan.gaji_pokok,jabatan.uang_makan,jabatan.status'))
        ->join('jabatan','jabatan.id','=','karyawan.id_jabatan')
        ->where('karyawan.id_cabang',Session::get('cabang'))
        ->get();

        //---------------------------------------------------------------
        foreach ($datakaryawan as $row){
            $uang_makan= DB::table('absensi')
            ->select(DB::raw('absensi.*,jabatan.jabatan,jabatan.status,karyawan.nama,karyawan.kode'))
            ->leftjoin('jabatan','jabatan.id','=','absensi.id_jabatan')
            ->leftjoin('karyawan','karyawan.id','=','absensi.id_karyawan')
            ->whereMonth('absensi.tanggal',$bulan)
            ->whereYear('absensi.tanggal',$tahun)
            ->where('absensi.id_karyawan','=',$row->id)
            ->sum('absensi.uang_makan');

            if ($row->status == 1) {
                $gajitambahan = $pemasukan*1/100;
                $totalgaji = $row->gaji_pokok + $uang_makan +$gajitambahan;
                DB::table('gaji_karyawan')
                ->insert([
                    'kode_karyawan'=>$row->kode,
                    'nama_karyawan'=>$row->nama,
                    'id_jabatan'=>$row->id_jabatan,
                    'gaji_pokok'=>$row->gaji_pokok,
                    'uang_makan'=>$uang_makan,
                    'gaji_tambahan'=>$gajitambahan,
                    'total'=>$totalgaji,
                    'bulan'=>$bulan,
                    'tahun'=>$tahun
                ]);    
            }else{
                $totalgaji = $row->gaji_pokok + $row->uang_makan;
                DB::table('gaji_karyawan')
                ->insert([
                    'kode_karyawan'=>$row->kode,
                    'nama_karyawan'=>$row->nama,
                    'id_jabatan'=>$row->id_jabatan,
                    'gaji_pokok'=>$row->gaji_pokok,
                    'uang_makan'=>$uang_makan,
                    'total'=>$totalgaji,
                    'bulan'=>$bulan,
                    'tahun'=>$tahun
                ]);
            }
        }

        
      }
      //============================================================
        function cari_pemasukan($bulan,$tahun,$status){
        if($status=="ny"){
            $tahun -=1;
        }
        $data = DB::table('resi_pengiriman')
        ->select(DB::raw('SUM(total_biaya) as totalnya'))
        ->where([['pengiriman_via','darat'],['duplikat','!=','Y']])
        ->orwhere([['pengiriman_via','laut'],['duplikat','!=','Y']])
        ->whereMonth('tgl_lunas',$bulan)
        ->whereYear('tgl_lunas',$tahun)
        ->get();
        foreach ($data as $row) {
            $newdata = $row->totalnya;
        }
        return $newdata;
        }

    //================================================
    function buatsession(){
        if(!session::get('username')){
            $dataadmin = 
        DB::table('users')
        ->select(DB::raw('users.*,cabang.kop,cabang.kota,cabang.koderesi,cabang.norek,roles.level as statusadmin'))

        ->leftjoin('cabang','cabang.id','=','users.id_cabang')
        ->leftjoin('roles','roles.id','=','users.level')
        ->where([['users.username',Auth::user()->username],['users.password',Auth::user()->password]])
        ->get();
        foreach ($dataadmin as $dataadmin) {
            $id = $dataadmin->id;
            $level=$dataadmin->level;
            $cabang=$dataadmin->id_cabang;
            $kop=$dataadmin->kop;
            $nama=$dataadmin->nama;
            $kota=$dataadmin->kota;
            $koderesi=$dataadmin->koderesi;
            $norek = $dataadmin->norek;
            $statusadmin = $dataadmin->statusadmin;
        }

        $data = DB::table('users')->where([['username',Auth::user()->username],['password',Auth::user()->password]])->count();
        if($data>0){
                Session::put('username',Auth::user()->username);
                Session::put('id',$id);
                Session::put('nama',$nama);
                Session::put('level',$level);
                Session::put('statusadmin',$statusadmin);
                Session::put('login',TRUE);
                Session::put('statuslogin','aktiv');
                Session::put('cabang',$cabang);
                Session::put('kop',$kop);
                Session::put('kota',$kota);
                Session::put('koderesi',$koderesi);
                Session::put('norek',$norek);
        }

        
        }        
        
    }        
}
