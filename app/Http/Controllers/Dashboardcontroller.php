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
        ->where('status','!=','Y')
        ->get();
        $uanghariini = DB::table('resi_pengiriman')
        ->select(DB::raw('SUM(total_biaya) as total'))
        ->where('tgl',date('Y-m-d'))
        ->get();
        $jumlahresi = DB::table('resi_pengiriman')
        ->where('status','!=','Y')
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
                $laba = $pemasukan - $pengeluaran - $pengeluaran_lain;
                $insert = DB::table('omset')
                ->insert([
                    'bulan'=>date('m'),
                    'tahun'=>$tahun-1,
                    'pemasukan'=>$pemasukan,
                    'pengeluaran'=>$pengeluaran,
                    'pengeluaran_lainya'=>$pengeluaran_lain,
                    'laba'=>$laba
                ]);
            }else{
                $pemasukan = $this->cari_pemasukan($bulan,date('Y'),"y");
                $pengeluaran = $this->cari_pengeluaran($bulan,date('Y'),"y");
                $pengeluaran_lain = $this->cari_pengeluaranlain($bulan,date('Y'),"y");
                $laba = $pemasukan - $pengeluaran - $pengeluaran_lain;
                $insert = DB::table('omset')
                ->insert([
                    'bulan'=>date('m'),
                    'tahun'=>$tahun,
                    'pemasukan'=>$pemasukan,
                    'pengeluaran'=>$pengeluaran,
                    'pengeluaran_lainya'=>$pengeluaran_lain,
                    'laba'=>$laba
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
}
