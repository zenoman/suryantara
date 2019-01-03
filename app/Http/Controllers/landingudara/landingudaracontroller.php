<?php
namespace App\Http\Controllers\landingudara;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;


class landingudaracontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
     $tarif_udara=DB::table('tarif_udara')->get();
     $desk=DB::table('setting')->get();
	return view('landingudara/index',['udara'=>$tarif_udara,'des'=>$desk]);
    }

}
