<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Dashboardcontroller extends Controller
{

    public function index()
    {
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
        $this->hitung_omset();
        $listsj = DB::table('surat_jalan')
        ->where('status','=','Y')
        ->get();
        //============================================
        $resi = DB::table('resi_pengiriman')
        ->where([['status','!=','Y'],['total_biaya','>',0]])
        ->get(); 
        $uanghariini = DB::table('resi_pengiriman')
        ->select(DB::raw('SUM(total_biaya) as total'))
        ->where('tgl',date('Y-m-d'))
        ->get();
        $jumlahresi = DB::table('resi_pengiriman')
        ->where([['status','!=','Y'],['total_biaya','>',0]])
        ->count();
        $jumlahsj = DB::table('surat_jalan')
        ->where('status','=','Y')
        ->count();
        $dattgl=date('Y-m-d');
        $dataabsensi=DB::table('absensi')
        ->where('tanggal','=',$dattgl)
        ->count();
        $datakaryawan=DB::table('karyawan')
        ->count();

        $setting = DB::table('setting')->get();

        return view('dashboard/index',['jmlkarya'=>$datakaryawan,'jmlabsen'=>$dataabsensi,'title'=>$setting,'resi'=>$resi,'listsj'=>$listsj,'uanghariini'=>$uanghariini,'jumlahresi'=>$jumlahresi,'jumlahsj'=>$jumlahsj,'pajakarmada'=>$pajakarmada,'jumlahpajakarmada'=>$jumlahpajakarmada]);

      }

    function hitung_omset(){
        $omsetawal = $this->cari_omsetawal();
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

                $pengeluaran = $this->cari_pengeluaran($bulan,date('Y'),"ny");
                
                $pengeluaran_lain = $this->cari_pengeluaranlain($bulan,date('Y'),"ny");
                $this->masukangaji($pemasukan,$bulan,date('Y'),"ny");
                $gajikaryawan = $this->cari_gajikaryawan($bulan,date('Y'),"ny");
                $pajak = $pemasukan * 0.5/100;
                $totalpajak = $this->cari_pajaktahunan(date('Y'));
                $laba = $omsetawal + $pemasukan - $pengeluaran - $pengeluaran_lain - $gajikaryawan - $pajak;
                
                $insert = DB::table('omset')
                ->insert([
                    'bulan'=>12,
                    'omset_awal'=>$omsetawal,
                    'tahun'=>$tahun-1,
                    'pemasukan'=>$pemasukan,
                    'pengeluaran'=>$pengeluaran,
                    'pengeluaran_lainya'=>$pengeluaran_lain,
                    'laba'=>$laba,
                    'gaji_karyawan'=>$gajikaryawan,
                    'pajak'=>$pajak
                ]);
                DB::table('pajak')
                ->insert([
                    'bulan'=>12,
                    'tahun'=>$tahun-1,
                    'nama_pajak'=>'pajak',
                    'total'=>$pajak
                ]);
                DB::table('pajak')
                ->insert([
                    'tahun'=>$tahun-1,
                    'nama'=>'total_pajak',
                    'total'=>$totalpajak,
                    'status'=>'tahunan'
                ]);

            }else{
                $pemasukan = $this->cari_pemasukan($bulan,date('Y'),"y");
                $pengeluaran = $this->cari_pengeluaran($bulan,date('Y'),"y");
                $pengeluaran_lain = $this->cari_pengeluaranlain($bulan,date('Y'),"y");
                $this->masukangaji($pemasukan,$bulan,date('Y'),"y");
                $gajikaryawan = $this->cari_gajikaryawan($bulan,date('Y'),"y");
                $pajak = $pemasukan * 0.5/100;
                $laba = $omsetawal + $pemasukan - $pengeluaran - $pengeluaran_lain - $gajikaryawan - $pajak;
                $insert = DB::table('omset')
                ->insert([
                    'bulan'=>date('m')-1,
                    'omset_awal'=>$omsetawal,
                    'tahun'=>$tahun,
                    'pemasukan'=>$pemasukan,
                    'pengeluaran'=>$pengeluaran,
                    'pengeluaran_lainya'=>$pengeluaran_lain,
                    'laba'=>$laba,
                    'gaji_karyawan'=>$gajikaryawan,
                    'pajak'=>$pajak
                ]);
                DB::table('pajak')
                ->insert([
                    'bulan'=>date('m')-1,
                    'tahun'=>$tahun,
                    'nama_pajak'=>'pajak',
                    'total'=>$pajak
                ]);    
            }
                    $dattgl=date('Y-m-d');
        $bulan = explode('-', $dattgl);
         $thn = $bulan[0];
        $bln = $bulan[1];
            DB::table('setting')
            ->update([
                'bulan_sekarang'=>$bln
            ]);

        }

    }
    //======================================================
    function cari_omsetawal(){
        $data = DB::table('omset')
        ->orderby('id','desc')
        ->limit(1)
        ->get();
        foreach ($data as $row) {
            $newdata = $row->laba;
        }
        return $newdata;
    }
    //=====================================================
    function cari_pajaktahunan($tahun){
        $tahun -= 1;
         $data = DB::table('pajak')
        ->select(DB::raw('SUM(total) as totalnya'))
        ->where(['tahun','=',$tahun],['status','=','bulanan'])
        ->get();
        foreach ($data as $row) {
            $newdata = $row->totalnya;
        }
        return $newdata;
    }
    function cari_pemasukan($bulan,$tahun,$status){
        if($status=="ny"){
            $tahun -=1;
        }
        $data = DB::table('resi_pengiriman')
        ->select(DB::raw('SUM(total_biaya) as totalnya'))
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->get();
        foreach ($data as $row) {
            $newdata = $row->totalnya;
        }
        return $newdata;
    }
    //============================================================
    function cari_pengeluaran($bulan,$tahun,$status){
        if($status=="ny"){
            $tahun -=1;
        }
        $data = DB::table('resi_pengiriman')
        ->select(DB::raw('SUM(biaya_suratjalan) as totalnya'))
        ->whereMonth('tgl_bayar',$bulan)
        ->whereYear('tgl_bayar',$tahun)
        ->get();
         foreach ($data as $row) {
            $newdata = $row->totalnya;
        }
        return $newdata;
    }
    //===========================================================
    function cari_pengeluaranlain($bulan,$tahun,$status){
        if($status=="ny"){
            $tahun -=1;
        }
        $data = DB::table('pengeluaran_lain')
        ->select(DB::raw('SUM(jumlah) as totalnya'))
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->get();
         foreach ($data as $row) {
            $newdata = $row->totalnya;
        }
        return $newdata;
    }
    //===========================================================
    function masukangaji($pemasukan,$bulan,$tahun,$status){
        if($status=="ny"){
            $tahun -=1;
        }
        $datakaryawan =
        DB::table('karyawan')
        ->select(DB::raw('karyawan.*,jabatan.gaji_pokok,jabatan.uang_makan'))
        ->join('jabatan','jabatan.id','=','karyawan.id_jabatan')
        ->get();

        foreach ($datakaryawan as $row) {
            $uang_makan= DB::table('absensi')
            ->select(DB::raw('absensi.*,jabatan.jabatan,karyawan.nama,karyawan.kode'))
            ->leftjoin('jabatan','jabatan.id','=','absensi.id_jabatan')
            ->leftjoin('karyawan','karyawan.id','=','absensi.id_karyawan')
            ->whereMonth('absensi.tanggal',$bulan-1)
            ->whereYear('absensi.tanggal',$tahun)
            ->where('absensi.id_karyawan','=',$row->id)
            ->sum('absensi.uang_makan');
// dd($uang_makan);
            if ($row->id_jabatan==1) {
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
                    'bulan'=>$bulan-1,
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
                    'bulan'=>$bulan-1,
                    'tahun'=>$tahun
                ]);
            }

        }
    }

    function cari_gajikaryawan($bulan,$tahun,$status){
        if($status=="ny"){
            $tahun -=1;
        }
        $data = DB::table('gaji_karyawan')
        ->select(DB::raw('SUM(total) as totalnya'))
        ->where([['bulan','=',$bulan],['tahun','=',$tahun]])
        ->get();
         foreach ($data as $row) {
            $newdata = $row->totalnya;
        }
        return $newdata;
    }





}
