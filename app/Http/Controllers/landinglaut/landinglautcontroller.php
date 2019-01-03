<?php
namespace App\Http\Controllers\landinglaut;

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
     $tarif_laut = DB::table('tarif_laut')->get();
     $desk=DB::table('setting')->get();
     return view('landinglaut/index',['laut'=>$tarif_laut,'des'=>$desk]);
    }

}
