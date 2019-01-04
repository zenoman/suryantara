<?php
namespace App\Http\Controllers\landing;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use App\models\Landingmodel;
use App\models\Daratanmodel;


class landingcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
     $tarif_darat=Landingmodel::get();
     $lautan=DB::table('tarif_laut')->get();
     $desk=DB::table('setting')->get();
	return view('landing/index',['darat'=>$tarif_darat,'laut'=>$lautan,'des'=>$desk]);
    }

}
