<?php

namespace App\Http\Controllers\pembukuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PembukuanController extends Controller
{
    private $setting;   
    function __construct(){            
        $this->setting = DB::table('setting')->limit(1)->get();
    }

     public function index(){         
        return view('pembukuan.index',['title'=> $this->setting]);
    }
    function showtf(){
        
        return view('pembukuan.transfer',['title'=> $this->setting]);
    }
}
