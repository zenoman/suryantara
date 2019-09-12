<?php

namespace App\Http\Controllers\SetPajak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\DB;
class setpajak extends Controller
{
    private $setting;   
    private $idc;
    function __construct(){            
        $this->setting = DB::table('setting')->limit(1)->get();
        $this->path = public_path('/tf');
    }
    function index(){
        $pj=DB::table('setting_pajak')
            ->get();
        $th=DB::table('cabang')
            ->get();
        $sal=DB::table('set_saldo')
            ->select(DB::raw('set_saldo.*,cabang.nama,cabang.id as idc'))
            ->leftjoin('cabang','cabang.id','=','set_saldo.id_cabang')
            ->get();
        return view('setpajak.index',['title'=>$this->setting,'pj'=>$pj,'cb'=>$th,'sal'=>$sal]);
    }
    function simpanpajak(Request $request){
        $request->validate([
            'pajak'=>'required',
            'besar'=>'required',
            'tempo'=>'required',
        ]);
        $data=[$request->pajak,$request->besar,$request->tempo];
        $in=DB::insert('insert into setting_pajak(pajak,besaran,tempo) values(?,?,?)',$data);
        if($in){
            return redirect()->action('SetPajak\setpajak@index')->with('msg',"Data Berhasil Disimpan");
        }else{
            return redirect()->action('SetPajak\setpajak@index')->with('msg',"Data Gagal Disimpan");
        }
    }
    function hapuspajak($id){
        $del=DB::delete('delete from setting_pajak where id=?',[$id]);
        if($del){
            return redirect()->action('SetPajak\setpajak@index')->with('msg',"Data Berhasil dihapus ");
        }else{
            return redirect()->action('SetPajak\setpajak@index')->with('msg',"Data Gagal dihapus ");
        }
    }
    function updatepajak(Request $request){
        $request->validate([
            'pajak'=>'required',
            'besar'=>'required',
            'tempo'=>'required',
        ]);        
        $up=DB::update('update setting_pajak set pajak=?,besaran=?,tempo=? where id=?',[$request->pajak,$request->besar,$request->tempo,$request->idp]);
        if($up){
            return redirect()->action('SetPajak\setpajak@index')->with('msg',"Data Berhasil Disimpan");
        }else{
            return redirect()->action('SetPajak\setpajak@index')->with('msg',"Data Gagal Disimpan");
        }
    }
    function simpansaldo(Request $request){
        $request->validate([
            'cabang'=>'required',
            'saldo'=>'required',            
        ]);
        $data=[$request->cabang,$request->saldo];
        $in=DB::insert('insert into set_saldo(id_cabang,saldo) values(?,?)',$data);
        if($in){
            return redirect()->action('SetPajak\setpajak@index')->with('msg',"Data Berhasil Disimpan");
        }else{
            return redirect()->action('SetPajak\setpajak@index')->with('msg',"Data Gagal Disimpan");
        }
    }
    function updatesaldo(Request $request){
            $request->validate([
                'cabang'=>'required',
                'saldo'=>'required',            
            ]);
            $data=[$request->cabang,$request->saldo,$request->ids];
            $in=DB::insert('update set_saldo set id_cabang=?,saldo=? where id=?',$data);
            if($in){
                return redirect()->action('SetPajak\setpajak@index')->with('msg',"Data Berhasil Disimpan");
            }else{
                return redirect()->action('SetPajak\setpajak@index')->with('msg',"Data Gagal Disimpan");
            }
    }
    function delsaldo($id){
        $del=DB::delete('delete from set_saldo where id=?',[$id]);
        if($del){
            return redirect()->action('SetPajak\setpajak@index')->with('msg',"Data Berhasil Disimpan");
        }else{
            return redirect()->action('SetPajak\setpajak@index')->with('msg',"Data Gagal Disimpan");
        }
    }
    
}
