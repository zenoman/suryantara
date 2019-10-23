<?php

namespace App\Http\Controllers\pengeluaranlain;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
class pengeluaranlainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $idc=Session::get('cabang');
        $data = DB::table('pengeluaran_lain')
        ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
        ->join('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
        // ->where('tb_kategoriakutansi.aksi','!=','N')        
        ->where('id_cabang',$idc)
        ->orderby('id','desc')
        ->paginate(40);

        $setting = DB::table('setting')->limit(1)->get();
        return view('pengeluaranlain/index',['title'=>$setting,'data'=>$data]);
    }
    public function create()
    {
        $setting = DB::table('setting')->limit(1)->get();
        if(Session::get('cabang')=='1'){
            $datkatbarakutansi = DB::table('tb_kategoriakutansi')
            ->where('tb_kategoriakutansi.status','=','pengeluaran')
            ->get();
        }else{
            $datkatbarakutansi = DB::table('tb_kategoriakutansi')
            ->where('tb_kategoriakutansi.status','=','pengeluaran')
            ->where('tempat','S')
            ->get();
        }
        return view('pengeluaranlain/create',['kate'=>$datkatbarakutansi,'title'=>$setting]);
    }

    public function store(Request $request)
    {
        if($request->hasFile('gambar')){
            $namagambar=$request->file('gambar')->
            getClientOriginalname();
            $lower_file_name=strtolower($namagambar);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $namagambar=time().'-'.$replace_space;
            $destination=base_path('../public_html/img/nota');
            $request->file('gambar')->move($destination,$namagambar);
            // Get cabang
            $idc=Session::get('cabang');

            DB::table('pengeluaran_lain')
            ->insert([
                'admin'=>$request->admin,
                'kategori'=>$request->namkat, 
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
                'kategori'=>$request->namkat,
                'keterangan'=>$request->keterangan,
                'jumlah'=>$request->jumlah,
                // 'tgl'=>date('Y-m-d'),
                'tgl'=>$request->tgl,
                'id_cabang'=>$idc
            ]);
        }

        return redirect('/pengeluaranlain')->with('status','Berhasil Menambah Data');
    }
}
