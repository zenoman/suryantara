<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboardcontroller extends Controller
{
    public function index()
    {
        $this->hitung_omset();
        $listsj = DB::table('surat_jalan')
        ->where('status','=','Y')
        ->get();

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
        $setting = DB::table('setting')->get();
        return view('dashboard/index',['title'=>$setting,'resi'=>$resi,'listsj'=>$listsj,'uanghariini'=>$uanghariini,'jumlahresi'=>$jumlahresi,'jumlahsj'=>$jumlahsj]);
    }

    function hitung_omset(){
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
                $laba = $pemasukan - $pengeluaran - $pengeluaran_lain - $gajikaryawan;
                
                $insert = DB::table('omset')
                ->insert([
                    'bulan'=>12,
                    'tahun'=>$tahun-1,
                    'pemasukan'=>$pemasukan,
                    'pengeluaran'=>$pengeluaran,
                    'pengeluaran_lainya'=>$pengeluaran_lain,
                    'laba'=>$laba,
                    'gaji_karyawan'=>$gajikaryawan
                ]);

            }else{
                $pemasukan = $this->cari_pemasukan($bulan,date('Y'),"y");
                $pengeluaran = $this->cari_pengeluaran($bulan,date('Y'),"y");
                $pengeluaran_lain = $this->cari_pengeluaranlain($bulan,date('Y'),"y");
                $this->masukangaji($pemasukan,$bulan,date('Y'),"y");
                $gajikaryawan = $this->cari_gajikaryawan($bulan,date('Y'),"y");
                $laba = $pemasukan - $pengeluaran - $pengeluaran_lain - $gajikaryawan;
                $insert = DB::table('omset')
                ->insert([
                    'bulan'=>date('m')-1,
                    'tahun'=>$tahun,
                    'pemasukan'=>$pemasukan,
                    'pengeluaran'=>$pengeluaran,
                    'pengeluaran_lainya'=>$pengeluaran_lain,
                    'laba'=>$laba,
                    'gaji_karyawan'=>$gajikaryawan
                ]);    
            }
            DB::table('setting')
            ->update([
                'bulan_sekarang'=>date('m')
            ]);

        }

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

    function cari_pengeluaran($bulan,$tahun,$status){
        if($status=="ny"){
            $tahun -=1;
        }
        $data = DB::table('surat_jalan')
        ->select(DB::raw('SUM(biaya) as totalnya'))
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->get();
         foreach ($data as $row) {
            $newdata = $row->totalnya;
        }
        return $newdata;
    }

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
            if ($row->id_jabatan==1) {
                $gajitambahan = $pemasukan*1/100;
                $totalgaji = $row->gaji_pokok + $row->uang_makan +$gajitambahan;
                DB::table('gaji_karyawan')
                ->insert([
                    'kode_karyawan'=>$row->kode,
                    'nama_karyawan'=>$row->nama,
                    'id_jabatan'=>$row->id_jabatan,
                    'gaji_pokok'=>$row->gaji_pokok,
                    'uang_makan'=>$row->uang_makan,
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
                    'uang_makan'=>$row->uang_makan,
                    'total'=>$totalgaji,
                    'bulan'=>$bulan,
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
