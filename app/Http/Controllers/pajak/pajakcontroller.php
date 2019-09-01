<?php

namespace App\Http\Controllers\pajak;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;
class pajakcontroller extends Controller
{
  //   public function index(){
  //   	$data = DB::table('pajak')
  //   	->select(DB::raw('tahun'))
  //   	->where('status','=','bulanan')
  //   	->groupby('tahun')
		// ->get();
		// $setting = DB::table('setting')->limit(1)->get();
  //   	return view('pajak/index',['data'=>$data,'title'=>$setting]);
  //   }

    public function index(){
    	$setting = DB::table('setting')->limit(1)->get();
    		 $data = DB::table('pengeluaran_lain')
        ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
        ->join('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
        ->where('tb_kategoriakutansi.kode','=','013')
        ->orderby('id','desc')
        ->paginate(40);
    		$total = DB::table('pengeluaran_lain')
            ->select(DB::raw('SUM(jumlah) as totalnya'))
            ->where('kategori','=','013')
            ->get();

    	return view('pajak/tampil',['data'=>$data,'title'=>$setting,'total'=>$total]);
    }
    public function create()
    {
        $setting = DB::table('setting')->limit(1)->get();
        $datkatbarakutansi = DB::table('tb_kategoriakutansi')->where('kode','=','012')->get();
        return view('pajak/create',['kate'=>$datkatbarakutansi,'title'=>$setting]);
    }
        public function store(Request $request)
    {
        $idc=Session::get('cabang');
         if($request->hasFile('gambar')){
            $namagambar=$request->file('gambar')->
            getClientOriginalname();
            $lower_file_name=strtolower($namagambar);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $namagambar=time().'-'.$replace_space;
            $destination=base_path('../public_html/img/nota');
            $request->file('gambar')->move($destination,$namagambar);
            
            DB::table('pengeluaran_lain')
            ->insert([
                'admin'=>$request->admin,
                'kategori'=>'013',
                'keterangan'=>$request->keterangan,
                'jumlah'=>$request->jumlah,
                // 'tgl'=>date('Y-m-d'),
                'gambar'=>$namagambar,
                'tgl'=>$request->tgl,
                'id_cabang'=>$idc
            ]);

        }else{
            DB::table('pengeluaran_lain')
            ->insert([
                'admin'=>$request->admin,
                'kategori'=>'013',
                'keterangan'=>$request->keterangan,
                'jumlah'=>$request->jumlah,
                // 'tgl'=>date('Y-m-d'),
                'tgl'=>$request->tgl,
                'id_cabang'=>$idc
            ]);
        }

        return redirect('/pajak')->with('status','Berhasil Menambah Data');
    }
        public function cetakpajak(){
        $setting = DB::table('setting')->limit(1)->get();
            $data = DB::table('pajak')
            ->where('status','=','bulanan')
            ->get();
            $total = DB::table('pajak')
            ->select(DB::raw('SUM(total) as totalnya'))
            ->where('status','=','bulanan')
            ->get();

        return view('pajak/cetakpajak',['data'=>$data,'title'=>$setting,'total'=>$total]);
    }
}
