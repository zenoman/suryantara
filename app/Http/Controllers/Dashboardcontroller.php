<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboardcontroller extends Controller
{
    public function index()
    {
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
}
