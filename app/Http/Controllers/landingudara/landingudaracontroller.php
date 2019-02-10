<?php
namespace App\Http\Controllers\landingudara;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;


class landingudaracontroller extends Controller
{
    public function index()
    {
     $tarif_udara=DB::table('tarif_udara')->paginate(10);
     $desk=DB::table('setting')->get();
     $select=DB::table('tarif_udara')->groupBy('airlans')->get();
     $tujuan=DB::table('tarif_udara')->groupBy('tujuan')->get();
	return view('landingudara/index',['udara'=>$tarif_udara,'select'=>$select,'des'=>$desk,'tujuan'=>$tujuan]);
    }

    public function pencarian(Request $request)
    {
     $kot = $request->kota_tujuan;
     $brt = $request->brt;
     $psw = $request->psw;
     if ($psw=='semua') {
     $trf_udr = DB::table('tarif_udara')
     ->where('tujuan','like','%'.$kot.'%')
     ->get();
     }else{
     $trf_udr = DB::table('tarif_udara')
     ->where([['tujuan','like','%'.$kot.'%'],['airlans','like','%'.$psw.'%']])
     ->get();
     }
     $kat = DB::table('kategori_barang')->get();
     $desk=DB::table('setting')->get();
     
     return view('landingudara/pencarian',['trf_udr'=>$trf_udr ,'kot'=>$kot , 'brt'=>$brt , 'psw'=>$psw , 'des'=>$desk,'kat'=>$kat]);
    }

    public function carimaskapai($kode){
        $trf_udr = DB::table('tarif_udara')
     ->where('tujuan','like','%'.$kode.'%')
     ->get();
     return response()->json($trf_udr);
    }

}
