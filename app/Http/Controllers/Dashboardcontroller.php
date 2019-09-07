<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class Dashboardcontroller extends Controller {
    public function index()
    {
        $this->masukandata();
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
}
