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
     $kot = $request->kot;
     $brt = $request->brt;
     $psw = $request->psw;
     $desk=DB::table('setting')->get();
     $trf_udr = DB::table('tarif_udara')->where('tujuan','like','%'.$kot.'%')->where('minimal_heavy','like','%'.$brt.'%')->where('airlans','like','%'.$psw.'%')->get();
     return view('landingudara/pencarian',['trf_udr'=>$trf_udr ,'kot'=>$kot ,  'brt'=>$brt , 'psw'=>$psw , 'des'=>$desk]);
    }

}
