<?php

namespace App\Http\Controllers\Aset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Session;
class Aset extends Controller
{
    //
    function __construct(){            
        $this->setting = DB::table('setting')->limit(1)->get();
        $this->path = public_path('/tf');
        $this->idc=Session::get('cabang');
        $this->middleware('auth');
        
    }
    function index(){
        $data=DB::table('aset')
            ->get();
        return view('Aset.index',['data'=>$data,'title'=>$this->setting]);
    }
    function simpanaset(Request $request){
        $request->validate([
        'aset'=>'required',
        'tgl_beli'=>'required',
        'harga'=>'required',
        'susutan'=>'required',
        'lamasusut'=>'required',        
        ]);
        $aset=$request->aset;
        $tgl_beli=$request->tgl_beli;
        $harga=str_replace(',','',$request->harga);
        $susutan=str_replace(',','',$request->susutan);
        $lamasusut=$request->lamasusut;        
        $bul=substr($tgl_beli,5,2);
        $th=substr($tgl_beli,0,4);
        $tgl_exp=date('Y-m-d',strtotime('+'.$lamasusut.' years',strtotime($th)));
        // dd($tgl_exp);
        $bsusut=($harga-$susutan)/$lamasusut;
        $data=[$aset,$tgl_beli,$bul,$th,$harga,$susutan,$lamasusut,$bsusut,$tgl_exp];
        $si=DB::insert('insert into aset(nama,tgl_beli,bulan,tahun,nilai,susutan,masa_susut,biaya_susut,tgl_exp) values(?,?,?,?,?,?,?,?,?)',$data);        
        // get id insert terakhir
        $idas=DB::getPdo()->lastInsertId();
        // Hitung Penyusutan Dengan Masa Tahun Masing2    
        $ds=$bsusut;  
        $nam=Session::get('nama');
        $idc=Session::get('cabang');
        $tth=$th;
        $blst=date('m');
        for($i=0;$i<=$lamasusut;$i++){            
            $ss=$i*$bsusut;
            $nbk=$harga-$ss;

            $hs=[$idas,$tth++,$ds,$ss,$nbk];
            DB::insert('insert into hitung_susutan(kode_aset,tahun,b_susut,a_susut,nilai_susut) values(?,?,?,?,?)',$hs);
            DB::insert('insert into neraca(bulan,tahun,keterangan,debit,admin,id_cabang) values(?,?,?,?,?,?)',[$blst++,$tth++,'Penyusutan '.$aset,$ds,$nam,$idc]);
        }
        if($si){
            return redirect()->action('Aset\Aset@index')->with('msg', 'Data Berhasil Disimpan');
        }else{
            return redirect()->action('Aset\Aset@index')->with('msg', 'Data Gagal Disimpan');
        }
    }
    function hapusaset($id){
        $st=DB::table('aset')
            ->where('id',$id)
            ->first();
        $aset=$st->nama;
        $del=DB::delete('delete from aset where id=?',[$id]);
        DB::delete('delete from hitung_susutan where kode_aset=?',[$id]);
        DB::delete('delete from neraca where keterangan=?',['Penyusutan '.$aset]);
        if($del){
            return redirect()->action('Aset\Aset@index')->with('msg', 'Data Berhasil Dihapus');
        }else{
            return redirect()->action('Aset\Aset@index')->with('msg', 'Data Gagal Dihapus');
        }
    }
    function updateAset(Request $request){
        $request->validate([
            'aset'=>'required',
            'tgl_beli'=>'required',
            'harga'=>'required',
            'susutan'=>'required',
            'lamasusut'=>'required',         
            ]);
            $id=$request->id;
            $aset=$request->aset;
            $tgl_beli=$request->tgl_beli;
            $harga=str_replace(',','',$request->harga);
            $susutan=str_replace(',','',$request->susutan);
            $lamasusut=$request->lamasusut;            
            $bul=substr($tgl_beli,5,2);
            $th=substr($tgl_beli,0,4);
            $tgl_exp=date('Y-m-d',strtotime('+'.$lamasusut.' years',strtotime($th)));
            $bsusut=($harga-$susutan)/$lamasusut;
            $data=[$aset,$tgl_beli,$bul,$th,$harga,$susutan,$lamasusut,$bsusut,$tgl_exp,$id];
        $up=DB::update('update aset set nama=?,tgl_beli=?,bulan=?,tahun=?,nilai=?,susutan=?,masa_susut=?,biaya_susut=?,tgl_exp=? where id=?',$data);
        $ds=$bsusut;  
        $nam=Session::get('nama');
        $idc=Session::get('cabang');
        $tth=$th;
        $blst=date('m');
        for($i=0;$i<=$lamasusut;$i++){            
            $ss=$i*$bsusut;
            $nbk=$harga-$ss;

            $hs=[$tth++,$ds,$ss,$nbk,$id];
            DB::insert('update hitung_susutan set tahun=?,b_susut=?,a_susut=?,nilai_susut=? where kode_aset=?',$hs);
            DB::insert('update neraca set bulan=?,tahun=?,debit=?,admin=?,id_cabang=? where keterangan=?',[$blst++,$tth++,$ds,$nam,$idc,'Penyusutan '.$aset]);
        }
        if($up){
            return redirect()->action('Aset\Aset@index')->with('msg', 'Data Berhasil Disimpan');
        }else{
            return redirect()->action('Aset\Aset@index')->with('msg', 'Data Gagal Disimpan');
        }

    }
}
