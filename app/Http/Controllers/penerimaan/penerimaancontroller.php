<?php

namespace App\Http\Controllers\penerimaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class penerimaancontroller extends Controller
{
    public function index(){
    	$webinfo = DB::table('setting')->limit(1)->get();
        $listdata =
        DB::table('surat_jalan')
        ->where([['status','!=','N'],['id_cabang_tujuan','=',Session::get('cabang')]])
        ->orderby('id','desc')
        ->get();
        return view('penerimaan/listpenerimaan',['data'=>$listdata,'webinfo'=>$webinfo]);
    }
}
