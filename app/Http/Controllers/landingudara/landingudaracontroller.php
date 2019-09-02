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
     $as = DB::table('cabang')->get();
     $select=DB::table('tarif_udara')->groupBy('airlans')->get();
     $tujuan=DB::table('tarif_udara')->groupBy('tujuan')->get();
	return view('landingudara/index',['udara'=>$tarif_udara,'select'=>$select,'des'=>$desk,'tujuan'=>$tujuan,'asal'=>$as]);
    }

    public function pencarian(Request $request)
    {
     $asal= $request->kota_asal;
     $kot = $request->tujuan;
     $brt = $request->brt;
     $psw = $request->psw;
     if ($psw=='semua') {
     $trf_udr = DB::table('tarif_udara')
     ->where([['tujuan','like','%'.$kot.'%'],['id_cabang',$asal]])
     ->get();
     }else{
     $trf_udr = DB::table('tarif_udara')
     ->where([['tujuan',$kot],['airlans',$psw],['id_cabang',$asal]])
     ->get();
     }
     $kat = DB::table('kategori_barang')->get();
     $desk=DB::table('setting')->get();
     
     return view('landingudara/pencarian',['trf_udr'=>$trf_udr ,'kot'=>$kot , 'brt'=>$brt , 'psw'=>$psw , 'des'=>$desk,'kat'=>$kat]);
    }

    public function caritujuan($id){
        $trf_udr = DB::table('tarif_udara')
     ->where('id_cabang','like','%'.$id.'%')->groupBy('tujuan')
     ->get();
     return response()->json($trf_udr);
    }
    public function carimaskapai($kode){
        $trf_udrr = DB::table('tarif_udara')
     ->where('tujuan','like','%'.$kode.'%')->groupBy('airlans')
     ->get();
     return response()->json($trf_udrr);
    }
    

}
