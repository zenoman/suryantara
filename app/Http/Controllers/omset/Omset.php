<?php

namespace App\Http\Controllers\Omset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
class Omset extends Controller
{
    function __construct(){            
        $this->setting = DB::table('setting')->limit(1)->get();
        $this->path = public_path('/tf');
        $this->idc=Session::get('cabang');
        $this->middleware('auth');
        
    }
    function index(){
        if(Session::get('cabang')=='1'){
            $cab=DB::table('cabang')
                ->get();        
        }else{
            $cab=DB::table('cabang')
                ->where('id',Session::get('cabang'))
                ->get();        
        }
        return view('omset.index',['cab'=>$cab,'title'=>$this->setting]);

    }
}
