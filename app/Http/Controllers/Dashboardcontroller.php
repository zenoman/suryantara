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
         // 
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
                $tambah_gjkw = $this->tambahgjkw($pemasukan,$bulan,date('Y'),"ny");
                $gaji_karyawan = $this->cari_gajikaryawan($bulan,date('Y'),"ny");
                $gajitambahan = $this->cari_gajikaryawantambahan($bulan,date('Y'),"ny");
                $laba = $pemasukan - $pengeluaran - $pengeluaran_lain - $gaji_karyawan;
                $gajikaryawan=$gaji_karyawan + $gajitambahan;
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
                $tambah_gjkw = $this->tambahgjkw($pemasukan,$bulan,date('Y'),"y");
                $gaji_karyawan = $this->cari_gajikaryawan($bulan,date('Y'),"y");
                $gajitambahan = $this->cari_gajikaryawantambahan($bulan,date('Y'),"y");
                $laba = $pemasukan - $pengeluaran - $pengeluaran_lain - $gaji_karyawan;
                $gajikaryawan=$gaji_karyawan + $gajitambahan;
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
    function tambahgjkw($pemasukan,$bulan,$tahun,$status){
                $datKaryawan = DB::table('karyawan')
                ->join('jabatan', 'jabatan.id', '=', 'karyawan.id_jabatan')
                 ->select('karyawan.kode','karyawan.nama','jabatan.id','jabatan.gaji_pokok','jabatan.uang_makan')
                 ->get();
                 
        if($bulan != date('m')){
            $tahun = date('Y');
                 foreach ($datKaryawan as $roz) {
                    if($roz->id ==1){
                    $ambilgajitambahan=$pemasukan*1/100;
                    
            if(date('m')==1){
                $total=$roz->gaji_pokok + $roz->uang_makan;
                DB::table('gaji_karyawan')
                ->insert([
                    'kode_karyawan'=>$roz->kode,
                    'nama_karyawan'=>$roz->nama,
                    'bulan'=>12,
                    'tahun'=>$tahun-1,
                    'id_jabatan'=>$roz->id,
                    'gaji_pokok'=>$roz->gaji_pokok,
                    'uang_makan'=>$roz->uang_makan,
                    'total'=>$total,
                    'gaji_tambahan'=>$ambilgajitambahan
                ]); 
                 
            }else{
                 
                    $total=$roz->gaji_pokok + $roz->uang_makan;
                DB::table('gaji_karyawan')
                ->insert([
                    'kode_karyawan'=>$roz->kode,
                    'nama_karyawan'=>$roz->nama,
                    'bulan'=>date('m')-1,
                    'tahun'=>$tahun,
                    'id_jabatan'=>$roz->id,
                    'gaji_pokok'=>$roz->gaji_pokok,
                    'uang_makan'=>$roz->uang_makan,
                    'total'=>$total,
                    'gaji_tambahan'=>$ambilgajitambahan
                ]); 
                 }
                }else{
                    if(date('m')==1){
                    $total=$roz->gaji_pokok + $roz->uang_makan;
                DB::table('gaji_karyawan')
                ->insert([
                    'kode_karyawan'=>$roz->kode,
                    'nama_karyawan'=>$roz->nama,
                    'bulan'=>12,
                    'tahun'=>$tahun-1,
                    'id_jabatan'=>$roz->id,
                    'gaji_pokok'=>$roz->gaji_pokok,
                    'uang_makan'=>$roz->uang_makan,
                    'total'=>$total
                ]); 
                 
            }else{
                 
                    $total=$roz->gaji_pokok + $roz->uang_makan;
                DB::table('gaji_karyawan')
                ->insert([
                    'kode_karyawan'=>$roz->kode,
                    'nama_karyawan'=>$roz->nama,
                    'bulan'=>date('m')-1,
                    'tahun'=>$tahun,
                    'id_jabatan'=>$roz->id,
                    'gaji_pokok'=>$roz->gaji_pokok,
                    'uang_makan'=>$roz->uang_makan,
                    'total'=>$total
                ]); 
                 }
                }
            }

    }
}
function cari_gajikaryawan($bulan,$tahun,$status){
        if($status=="ny"){
            $tahun -=1;
        }
        $data = DB::table('gaji_karyawan')
        ->select(DB::raw('SUM(total) as totalnya'))
        ->where('bulan',$bulan)
        ->where('tahun',$tahun)
        ->get();
         foreach ($data as $row) {
            $newdata = $row->totalnya;
        }
        return $newdata;
    }
    function cari_gajikaryawantambahan($bulan,$tahun,$status){
        if($status=="ny"){
            $tahun -=1;
        }
        $data = DB::table('gaji_karyawan')
        ->select(DB::raw('SUM(gaji_tambahan) as totalnya'))
        ->where('bulan',$bulan)
        ->where('tahun',$tahun)
        ->get();
         foreach ($data as $row) {
            $newdata = $row->totalnya;
        }
        return $newdata;
    }
}
