<?php
namespace App\Http\Controllers\landinglaut;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;


class landinglautcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
     $tarif_laut = DB::table('tarif_laut')->paginate(10);
     $desk=DB::table('setting')->get();
     $as = DB::table('cabang')->get();
     $tujuan=DB::table('tarif_laut')->groupBy('tujuan')->get();
     return view('landinglaut/index',['laut'=>$tarif_laut,'des'=>$desk,'tujuan'=>$tujuan,'asal'=>$as]);
    }

    public function pencarian(Request $request)
    {
    $brt = $request->brt;
     $tuj = $request->tujuan;
     $asal = $request->kota_asal;
     if ($tuj == 'semua') {
     $trf_lt = DB::table('tarif_laut')->where('id_cabang','like','%'.$asal.'%')->get();
     }else{
     $trf_lt = DB::table('tarif_laut')->where('tujuan','like','%'.$tuj.'%')->where('id_cabang','like','%'.$asal.'%')->get();
     }
     $desk=DB::table('setting')->get();
     
     return view('landinglaut/pencarian',['trf_lt'=>$trf_lt ,'kot'=>$tuj,'brt'=>$brt , 'des'=>$desk]);
    }
    public function caritujuan($id){
        $trf_lt = DB::table('tarif_laut')
     ->where('id_cabang','like','%'.$id.'%')->get();
     return response()->json($trf_lt);
    }

}
