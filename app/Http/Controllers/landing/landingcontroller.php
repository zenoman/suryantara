<?php
namespace App\Http\Controllers\landing;

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
	return view('landing/index',['darat'=>$tarif_darat,'laut'=>$lautan]);
    }

}
