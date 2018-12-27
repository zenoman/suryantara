<?php
namespace App\Http\Controllers\landingdarat;

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
     $tarif_darat=Landingdaratmodel::get();
	return view('landingdarat/index',['darat'=>$tarif_darat]);
    }

}
