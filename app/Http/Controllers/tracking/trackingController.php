<?php
namespace App\Http\Controllers\tracking;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use App\models\Trackingmodel;


class trackingcontroller extends Controller
{
   public function index(){
    $desk=DB::table('setting')->get();
    $as = DB::table('cabang')->get();
    return view('tracking/index',['des'=>$desk,'asal'=>$as]);
    }

    //===================================================================
    public function pencarian(Request $request)
    {
        $resi = $request->resi;
        $cek=DB::table('status_pengiriman')->where('kode','=',$resi)->count();
        if($cek>0){
            $desk = DB::table('setting')->get();
            $trak = DB::table('status_pengiriman')->where('kode','=',$resi)->get(); 
            $status = "ada";
        }else{
            $desk = DB::table('setting')->get();
            $trak = DB::table('status_pengiriman')->where('kode','=',$resi)->get(); 
            $status = "kosong";
        }
        return view('tracking.pencarian',[
            'trak'=>$trak,
            'des'=>$desk,
            'kk'=>$request->resi,
            'status'=>$status]);
        }
        

    }


