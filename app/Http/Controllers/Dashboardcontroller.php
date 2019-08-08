<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Dashboardcontroller extends Controller {

    public function index()
    {
        //==========================
        
        //==========================
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
        // $this->hitung_omset();
        $this->hitung_neraca();

        //============================================
        $listsj = DB::table('surat_jalan')
        ->where('status','=','Y')
        ->get();
        //============================================
        $resi = DB::table('resi_pengiriman')
        ->where([['status','!=','Y'],['total_biaya','>',0]])
        ->get(); 
        $uanghariini = DB::table('resi_pengiriman')
        ->select(DB::raw('SUM(total_biaya) as total'))
        ->where('tgl_lunas',date('Y-m-d'))
        ->get();
        $jumlahresi = DB::table('resi_pengiriman')
        ->where([['status','!=','Y'],['total_biaya','>',0]])
        ->count();
        $jumlahtotalresi = DB::table('resi_pengiriman')
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

        return view('dashboard/index',['jmlkarya'=>$datakaryawan,'jmlabsen'=>$dataabsensi,'title'=>$setting,'resi'=>$resi,'listsj'=>$listsj,'uanghariini'=>$uanghariini,'jumlahresi'=>$jumlahresi,'jumlahsj'=>$jumlahsj,'pajakarmada'=>$pajakarmada,'jumlahpajakarmada'=>$jumlahpajakarmada,'jumlahtotalresi'=>$jumlahtotalresi]);
      }
    function hitung_neraca(){
        // $omsetawal = $this->cari_omsetawal();
        $setting = DB::table('setting')
        ->limit(1)
        ->get();
            //==========================================
                   $this->gajipjk();
            //==========================================
        foreach ($setting as $st){
            $bulan = $st->bulan_sekarang;
        }
        if($bulan != date('m')){
            $tahun = date('Y');
            if(date('m')==1){
                $pemasukan = $this->cari_pemasukan($bulan,date('Y'),"ny");
                $pengeluaran = $this->cari_pengeluaran($bulan,date('Y'),"ny");

                $dapat = $this->hitung_pendapatan($bulan,date('Y'),'ny');
                $luar = $this->hitung_pengeluaran($bulan,date('Y'),'ny');
                $dap = $pemasukan+$dapat;
                $lua =$pengeluaran + $luar;

                 $jumlah = $dap - $lua ;
                 $lba = $this->hitung_laba($bulan,date('Y'),'ny');
                $lba0 = $this->hitung_laba0($bulan,date('Y'),'ny');
                $lb = $lba - $lba0;
               $modal = $this->cari_modal($bulan,date('Y'),'ny');
                $insert = DB::table('tb_neraca')
                ->insert([
                    'tahun'=>$tahun-1,
                    'bulan'=>12,
                    'kategori'=>'Kas',
                    'status'=>'D',
                    'total'=>$jumlah
                ]);
                $insert = DB::table('tb_neraca')
                ->insert([
                    'tahun'=>$tahun-1,
                    'bulan'=>12,
                    'kategori'=>'Laba',
                    'status'=>'K',
                    'total'=>$lb
                ]);
            }else{
                $pemasukan = $this->cari_pemasukan($bulan,date('Y'),"y");
                $pengeluaran = $this->cari_pengeluaran($bulan,date('Y'),"y");

                $dapat = $this->hitung_pendapatan($bulan,date('Y'),'y');
                $luar = $this->hitung_pengeluaran($bulan,date('Y'),'y');
                $dap = $pemasukan+$dapat;
                $lua =$pengeluaran + $luar;
                 $jumlah = $dap - $lua;
                 $lba = $this->hitung_laba($bulan,date('Y'),'y');
                $lba0 = $this->hitung_laba0($bulan,date('Y'),'y');
                $lb = $lba - $lba0;
                $modal = $this->cari_modal($bulan,date('Y'),'y');
                if ($modal == null) {
                    $mod =0;
                }else{
                    $mod=$modal;
                }
                $insert = DB::table('tb_neraca')
                ->insert([
                    'tahun'=>$tahun,
                    'bulan'=>date('m')-1,
                    'kategori'=>'Kas',
                    'status'=>'D',
                    'total'=>$jumlah
                ]);
                $insert = DB::table('tb_neraca')
                ->insert([
                    'tahun'=>$tahun,
                    'bulan'=>date('m')-1,
                    'kategori'=>'Laba',
                    'status'=>'K',
                    'total'=>$lb
                ]);   
            }
            // dd($jumlah.'->'.$lb.'->'.$modal);
                    $dattgl=date('Y-m-d');
        $bulan = explode('-', $dattgl);
         $thn = $bulan[0];
        $bln = $bulan[1];
            DB::table('setting')
            ->update([
                'bulan_sekarang'=>$bln,
                'status'=>'Y'
            ]);
        }
    }

//====================
    function gajipjk(){
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
                $this->masukangaji($pemasukan,$bulan,date('Y'),"ny");
                $gajikaryawan = $this->cari_gajikaryawan($bulan,date('Y'),"ny");
                $pajak = $pemasukan * 0.5/100;
                $totalpajak = $this->cari_pajaktahunan(date('Y'));
                DB::table('pengeluaran_lain')
                ->insert([
                    'admin'=>'Auto Insert',
                    'kategori'=>'211',
                    'keterangan'=>'Pajak',
                    'jumlah'=>$pajak,
                    'tgl'=>date('Y-m-d')
                ]);
                DB::table('pengeluaran_lain')
                ->insert([
                    'admin'=>'Auto Insert',
                    'kategori'=>'244',
                    'keterangan'=>'Gaji Karyawan',
                    'jumlah'=>$gajikaryawan,
                    'tgl'=>date('Y-m-d')
                ]);
                DB::table('pengeluaran_lain')
                ->insert([
                    'admin'=>'Auto Insert',
                    'kategori'=>'233',
                    'keterangan'=>'Surat Jalan',
                    'jumlah'=>$pengeluaran,
                    'tgl'=>date('Y-m-d')
                ]);
                DB::table('pajak')
                ->insert([
                    'bulan'=>12,
                    'tahun'=>$tahun-1,
                    'nama_pajak'=>'pajak',
                    'total'=>$pajak
                ]);
                // DB::table('pajak')
                // ->insert([
                //     'tahun'=>$tahun-1,
                //     'nama'=>'total_pajak',
                //     'total'=>$totalpajak,
                //     'status'=>'tahunan'
                // ]);
            }else{
                $pemasukan = $this->cari_pemasukan($bulan,date('Y'),"y");
                $pengeluaran = $this->cari_pengeluaran($bulan,date('Y'),"y");
                $this->masukangaji($pemasukan,$bulan,date('Y'),"y");
                $gajikaryawan = $this->cari_gajikaryawan($bulan,date('Y'),"y");
                $pajak = $pemasukan * 0.5/100;
                // DB::table('pengeluaran_lain')
                // ->insert([
                //     'admin'=>Session::get('username'),
                //     'kategori'=>$request->kategori,
                //     'keterangan'=>Pajak,
                //     'jumlah'=>$request->jumlah,
                //     'tgl'=>date('Y-m-d')
                //     // 'tgl'=>$request->tgl
                // ]);
                DB::table('pengeluaran_lain')
                ->insert([
                    'admin'=>'Auto Insert',
                    'kategori'=>'211',
                    'keterangan'=>'Pajak',
                    'jumlah'=>$pajak,
                    'tgl'=>date('Y-m-d')
                ]);
                DB::table('pengeluaran_lain')
                ->insert([
                    'admin'=>'Auto Insert',
                    'kategori'=>'244',
                    'keterangan'=>'Gaji Karyawan',
                    'jumlah'=>$gajikaryawan,
                    'tgl'=>date('Y-m-d')
                ]);
                DB::table('pengeluaran_lain')
                ->insert([
                    'admin'=>'Auto Insert',
                    'kategori'=>'233',
                    'keterangan'=>'Surat Jalan',
                    'jumlah'=>$pengeluaran,
                    'tgl'=>date('Y-m-d')
                ]);
               DB::table('pajak')
                ->insert([
                    'bulan'=>date('m')-1,
                    'tahun'=>$tahun,
                    'nama_pajak'=>'pajak',
                    'total'=>$pajak
                ]);    
            }
        }
    }
//======================================================
    // function cari_pemasukan($bulan,$tahun,$status){
    //     if($status=="ny"){
    //         $tahun -=1;
    //     }
    //     $data = DB::table('resi_pengiriman')
    //     ->select(DB::raw('SUM(total_biaya) as totalnya'))
    //     ->whereMonth('tgl_lunas',$bulan)
    //     ->whereYear('tgl_lunas',$tahun)
    //     ->get();
    //     foreach ($data as $row) {
    //         $newdata = $row->totalnya;
    //     }
    //     return $newdata;
    // }
    
    function masukangaji($pemasukan,$bulan,$tahun,$status){
        if($status=="ny"){
            $tahun -=1;
        }
        //==================================================================
        $datakaryawan =
        DB::table('karyawan')
        ->select(DB::raw('karyawan.*,jabatan.gaji_pokok,jabatan.uang_makan,jabatan.status'))
        ->join('jabatan','jabatan.id','=','karyawan.id_jabatan')
        ->get();
        //==================================================================
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
    function hitung_pendapatan($bulan,$tahun){
        $data = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereMonth('pengeluaran_lain.tgl',$bulan)
            ->whereYear('pengeluaran_lain.tgl',$tahun)
            ->where('tb_kategoriakutansi.status','=','pendapatan')
            ->paginate(40);
            dd($data);
        foreach ($data as $row) {
            $newdata = $row->toto;
        }
        return $newdata;
    }
    function hitung_pengeluaran($bulan,$tahun){
        $data = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereMonth('pengeluaran_lain.tgl',$bulan)
            ->whereYear('pengeluaran_lain.tgl',$tahun)
            ->where('tb_kategoriakutansi.status','=','pengeluaran')
            ->paginate(40);
        foreach ($data as $row) {
            $newdata = $row->toto;
        }
        return $newdata;
    }
    function hitung_laba($bulan,$tahun){
        $data =DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.*'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as tot'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereMonth('pengeluaran_lain.tgl',$bulan-1)
            ->whereYear('pengeluaran_lain.tgl',$tahun)
            ->where('tb_kategoriakutansi.status','=','pendapatan')
            ->paginate(40);
        foreach ($data as $row) {
            $new = $row->tot;
        }
        return $new;
    }
    function hitung_laba0($bulan,$tahun){
        $data =DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.*'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as tot'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereMonth('pengeluaran_lain.tgl',$bulan)
            ->whereYear('pengeluaran_lain.tgl',$tahun)
            ->where('tb_kategoriakutansi.status','=','pengeluaran')
            ->paginate(40);
        foreach ($data as $row) {
            $new = $row->tot;
        }
        return $new;
    }

    function cari_modal($bulan,$tahun,$thn){
            $data = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.*'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as jumlah'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereMonth('pengeluaran_lain.tgl',$bulan)
            ->whereYear('pengeluaran_lain.tgl',$tahun)
            ->where('tb_kategoriakutansi.nama','=','Modal')
            ->get();

            foreach ($data as $row) {
                    $newdata = $row->jumlah;
                }
            if ($newdata == null) {
                    $mod = 0;
                }else{
                        $mod = $newdata;
                    }
            if($bulan != date('m')){
                $tahun = date('Y');
                if(date('m')==1){
                $insert = DB::table('tb_neraca')
                    ->insert([
                        'tahun'=>$tahun-1,
                        'bulan'=>12,
                        'kategori'=>'Modal',
                        'status'=>'K',
                        'total'=>$mod
                    ]);
                }else{
                        $insert = DB::table('tb_neraca')
                        ->insert([
                            'tahun'=>$tahun,
                            'bulan'=>date('m')-1,
                            'kategori'=>'Modal',
                            'status'=>'K',
                            'total'=>$mod
                        ]);
                    }
                }
    }
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
        ->whereMonth('tgl_lunas',$bulan)
        ->whereYear('tgl_lunas',$tahun)
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
        $data = DB::table('surat_jalan')
        ->select(DB::raw('SUM(totalcash) as totalnya'))
        ->whereMonth('tgl_bayar',$bulan)
        ->whereYear('tgl_bayar',$tahun)
        ->get();
         foreach ($data as $row) {
            $newdata = $row->totalnya;
        }
        return $newdata;
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


// function hitung_omset(){
    //     $omsetawal = $this->cari_omsetawal();
    //     $setting = DB::table('setting')
    //     ->limit(1)
    //     ->get();
    //     foreach ($setting as $st){
    //         $bulan = $st->bulan_sekarang;
    //     }
    //     if($bulan != date('m')){
    //         $tahun = date('Y');
    //         if(date('m')==1){
                
    //             $pemasukan = $this->cari_pemasukan($bulan,date('Y'),"ny");

    //             $pengeluaran = $this->cari_pengeluaran($bulan,date('Y'),"ny");
                
    //             $pengeluaran_lain = $this->cari_pengeluaranlain($bulan,date('Y'),"ny");
    //             $this->masukangaji($pemasukan,$bulan,date('Y'),"ny");
    //             $gajikaryawan = $this->cari_gajikaryawan($bulan,date('Y'),"ny");
    //             $pajak = $pemasukan * 0.5/100;
    //             $totalpajak = $this->cari_pajaktahunan(date('Y'));
    //             $laba = $omsetawal + $pemasukan - $pengeluaran - $pengeluaran_lain - $gajikaryawan - $pajak;
                
    //             $insert = DB::table('omset')
    //             ->insert([
    //                 'bulan'=>12,
    //                 'omset_awal'=>$omsetawal,
    //                 'tahun'=>$tahun-1,
    //                 'pemasukan'=>$pemasukan,
    //                 'pengeluaran'=>$pengeluaran,
    //                 'pengeluaran_lainya'=>$pengeluaran_lain,
    //                 'laba'=>$laba,
    //                 'gaji_karyawan'=>$gajikaryawan,
    //                 'pajak'=>$pajak
    //             ]);
    //             DB::table('pajak')
    //             ->insert([
    //                 'bulan'=>12,
    //                 'tahun'=>$tahun-1,
    //                 'nama_pajak'=>'pajak',
    //                 'total'=>$pajak
    //             ]);
    //             DB::table('pajak')
    //             ->insert([
    //                 'tahun'=>$tahun-1,
    //                 'nama'=>'total_pajak',
    //                 'total'=>$totalpajak,
    //                 'status'=>'tahunan'
    //             ]);

    //         }else{
    //             $pemasukan = $this->cari_pemasukan($bulan,date('Y'),"y");
    //             $pengeluaran = $this->cari_pengeluaran($bulan,date('Y'),"y");
    //             $pengeluaran_lain = $this->cari_pengeluaranlain($bulan,date('Y'),"y");
    //             $this->masukangaji($pemasukan,$bulan,date('Y'),"y");
    //             $gajikaryawan = $this->cari_gajikaryawan($bulan,date('Y'),"y");
    //             $pajak = $pemasukan * 0.5/100;
    //             $laba = $omsetawal + $pemasukan - $pengeluaran - $pengeluaran_lain - $gajikaryawan - $pajak;
    //             $insert = DB::table('omset')
    //             ->insert([
    //                 'bulan'=>date('m')-1,
    //                 'omset_awal'=>$omsetawal,
    //                 'tahun'=>$tahun,
    //                 'pemasukan'=>$pemasukan,
    //                 'pengeluaran'=>$pengeluaran,
    //                 'pengeluaran_lainya'=>$pengeluaran_lain,
    //                 'laba'=>$laba,
    //                 'gaji_karyawan'=>$gajikaryawan,
    //                 'pajak'=>$pajak
    //             ]);
    //             DB::table('pajak')
    //             ->insert([
    //                 'bulan'=>date('m')-1,
    //                 'tahun'=>$tahun,
    //                 'nama_pajak'=>'pajak',
    //                 'total'=>$pajak
    //             ]);    
    //         }
    //                 $dattgl=date('Y-m-d');
    //     $bulan = explode('-', $dattgl);
    //      $thn = $bulan[0];
    //     $bln = $bulan[1];
    //         DB::table('setting')
    //         ->update([
    //             'bulan_sekarang'=>$bln,
    //             'status'=>'Y'
    //         ]);

    //     }

    // }
    // //======================================================
    // function cari_omsetawal(){
    //     $data = DB::table('omset')
    //     ->orderby('id','desc')
    //     ->limit(1)
    //     ->get();
    //     foreach ($data as $row) {
    //         $newdata = $row->laba;
    //     }
    //     return $newdata;
    // }
    // //=====================================================
    // function cari_pajaktahunan($tahun){
    //     $tahun -= 1;
    //      $data = DB::table('pajak')
    //     ->select(DB::raw('SUM(total) as totalnya'))
    //     ->where(['tahun','=',$tahun],['status','=','bulanan'])
    //     ->get();
    //     foreach ($data as $row) {
    //         $newdata = $row->totalnya;
    //     }
    //     return $newdata;
    // }
    // function cari_pemasukan($bulan,$tahun,$status){
    //     if($status=="ny"){
    //         $tahun -=1;
    //     }
    //     $data = DB::table('resi_pengiriman')
    //     ->select(DB::raw('SUM(total_biaya) as totalnya'))
    //     ->whereMonth('tgl_lunas',$bulan)
    //     ->whereYear('tgl_lunas',$tahun)
    //     ->get();
    //     foreach ($data as $row) {
    //         $newdata = $row->totalnya;
    //     }
    //     return $newdata;
    // }
    // //============================================================
    // function cari_pengeluaran($bulan,$tahun,$status){
    //     if($status=="ny"){
    //         $tahun -=1;
    //     }
    //     $data = DB::table('resi_pengiriman')
    //     ->select(DB::raw('SUM(biaya_suratjalan) as totalnya'))
    //     ->whereMonth('tgl_bayar',$bulan)
    //     ->whereYear('tgl_bayar',$tahun)
    //     ->get();
    //      foreach ($data as $row) {
    //         $newdata = $row->totalnya;
    //     }
    //     return $newdata;
    // }
    // //===========================================================
    // function cari_pengeluaranlain($bulan,$tahun,$status){
    //     if($status=="ny"){
    //         $tahun -=1;
    //     }
    //     $data = DB::table('pengeluaran_lain')
    //     ->select(DB::raw('SUM(jumlah) as totalnya'))
    //     ->whereMonth('tgl',$bulan)
    //     ->whereYear('tgl',$tahun)
    //     ->get();
    //      foreach ($data as $row) {
    //         $newdata = $row->totalnya;
    //     }
    //     return $newdata;
    // }
    // //===========================================================
    // function masukangaji($pemasukan,$bulan,$tahun,$status){
    //     if($status=="ny"){
    //         $tahun -=1;
    //     }
    //     $datakaryawan =
    //     DB::table('karyawan')
    //     ->select(DB::raw('karyawan.*,jabatan.gaji_pokok,jabatan.uang_makan'))
    //     ->join('jabatan','jabatan.id','=','karyawan.id_jabatan')
    //     ->get();

    //     foreach ($datakaryawan as $row) {
    //         $uang_makan= DB::table('absensi')
    //         ->select(DB::raw('absensi.*,jabatan.jabatan,karyawan.nama,karyawan.kode'))
    //         ->leftjoin('jabatan','jabatan.id','=','absensi.id_jabatan')
    //         ->leftjoin('karyawan','karyawan.id','=','absensi.id_karyawan')
    //         ->whereMonth('absensi.tanggal',$bulan-1)
    //         ->whereYear('absensi.tanggal',$tahun)
    //         ->where('absensi.id_karyawan','=',$row->id)
    //         ->sum('absensi.uang_makan');
    //         if ($row->id_jabatan==1) {
    //             $gajitambahan = $pemasukan*1/100;
    //             $totalgaji = $row->gaji_pokok + $uang_makan +$gajitambahan;
    //             DB::table('gaji_karyawan')
    //             ->insert([
    //                 'kode_karyawan'=>$row->kode,
    //                 'nama_karyawan'=>$row->nama,
    //                 'id_jabatan'=>$row->id_jabatan,
    //                 'gaji_pokok'=>$row->gaji_pokok,
    //                 'uang_makan'=>$uang_makan,
    //                 'gaji_tambahan'=>$gajitambahan,
    //                 'total'=>$totalgaji,
    //                 'bulan'=>$bulan-1,
    //                 'tahun'=>$tahun
    //             ]);    
    //         }else{
    //             $totalgaji = $row->gaji_pokok + $row->uang_makan;
    //             DB::table('gaji_karyawan')
    //             ->insert([
    //                 'kode_karyawan'=>$row->kode,
    //                 'nama_karyawan'=>$row->nama,
    //                 'id_jabatan'=>$row->id_jabatan,
    //                 'gaji_pokok'=>$row->gaji_pokok,
    //                 'uang_makan'=>$uang_makan,
    //                 'total'=>$totalgaji,
    //                 'bulan'=>$bulan-1,
    //                 'tahun'=>$tahun
    //             ]);
    //         }

    //     }
    // }


}
