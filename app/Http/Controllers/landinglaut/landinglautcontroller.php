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
     return view('landinglaut/index',['laut'=>$tarif_laut,'des'=>$desk]);
    }

    public function pencarian(Request $request)
    {
     $kot = $request->kot;
     $brt = $request->brt;
     $desk=DB::table('setting')->get();
     $trf_lt = DB::table('tarif_laut')->where('tujuan','like','%'.$kot.'%')->where('berat_min','like','%'.$brt.'%')->get();
     return view('landinglaut/pencarian',['trf_lt'=>$trf_lt ,'kot'=>$kot ,  'brt'=>$brt , 'des'=>$desk]);
    }

}
