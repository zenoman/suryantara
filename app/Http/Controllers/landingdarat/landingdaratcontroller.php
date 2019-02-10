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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
     $tarif_darat=Landingdaratmodel::paginate(10);
      $desk=DB::table('setting')->get();
      $tujuan=DB::table('tarif_darat')->groupBy('tujuan')->get();
    return view('landingdarat/index',['darat'=>$tarif_darat,'des'=>$desk,'tujuan'=>$tujuan]);
    }

    public function pencarian(Request $request)
    {
    $brt = $request->brt;
     $kot = $request->tujuan;
     $desk=DB::table('setting')->get();
     $trf_drt = DB::table('tarif_darat')->where('tujuan','like','%'.$kot.'%')->get();
     return view('landingdarat/pencarian',['trf_drt'=>$trf_drt ,'kot'=>$kot ,'brt'=>$brt , 'des'=>$desk]);
    }
}
