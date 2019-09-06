<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Dashboardcontroller extends Controller {
    public function index()
    {
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
}
