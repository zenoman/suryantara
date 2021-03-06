<?php
namespace App\Http\Controllers\landingdarat;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use App\models\Landingdaratmodel;


class landingdaratcontroller extends Controller
{
   public function index(){
    $tarif_darat=Landingdaratmodel::paginate(10);
    $desk=DB::table('setting')->get();
    $as = DB::table('cabang')->get();
    $tujuan=DB::table('tarif_darat')
    ->where('tarif_city','!=','Y')
    ->groupBy('tujuan')
    ->get();
    return view('landingdarat/index',['darat'=>$tarif_darat,'des'=>$desk,'tujuan'=>$tujuan ,'asal'=>$as]);
    }

    //===================================================================
    public function pencarian(Request $request)
    {
        $brt = $request->brt;
        $kot = $request->tujuan;
        $asal = $request->kota_asal;
        
        if ($kot=='semua'){
        
            $trf_drt = DB::table('tarif_darat')
            ->where([
                ['id_cabang','like','%'.$asal.'%'],
                ['tarif_city','!=','Y']])
            ->get();
        
        }else{
            $trf_drt = DB::table('tarif_darat')
            
            ->where([
            ['tujuan','like','%'.$kot.'%'],
            ['id_cabang','like','%'.$asal.'%'],
            ['tarif_city','!=','Y']])
            ->get();
     }
     $desk = DB::table('setting')->get();
    
     return view('landingdarat/pencarian',['trf_drt'=>$trf_drt ,'kot'=>$kot ,'brt'=>$brt , 'des'=>$desk]);
    }

    //===================================================================
    public function caritujuan($id){
        $trf_drt = DB::table('tarif_darat')
        ->where('id_cabang','like','%'.$id.'%')
        ->where('tarif_city','!=','Y')
        ->get();
        return response()->json($trf_drt);
    }
}
