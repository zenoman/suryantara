<?php

namespace App\Http\Controllers\modal;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
 
class modalController extends Controller
{
    public function index()
    {
        $data = DB::table('pengeluaran_lain')
        ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
        ->join('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
        ->where('tb_kategoriakutansi.kode','=','012')
        ->orderby('id','desc')
        ->paginate(40);

        $setting = DB::table('setting')->limit(1)->get();
        return view('modal/index',['title'=>$setting,'data'=>$data]);
    }
    public function create()
    {
        $setting = DB::table('setting')->limit(1)->get();
        // $datkatbarakutansi = DB::table('tb_kategoriakutansi')->where('kode','=','012')->get();
        return view('modal/create',['title'=>$setting]);
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

            DB::table('pengeluaran_lain')
            ->insert([
                'admin'=>$request->admin,
                'kategori'=>'012',
                'keterangan'=>$request->keterangan,
                'jumlah'=>$request->jumlah,
                // 'tgl'=>date('Y-m-d'),
                'gambar'=>$namagambar,
                'tgl'=>$request->tgl
            ]);

        }else{
            DB::table('pengeluaran_lain')
            ->insert([
                'admin'=>$request->admin,
                'kategori'=>'012',
                'keterangan'=>$request->keterangan,
                'jumlah'=>$request->jumlah,
                // 'tgl'=>date('Y-m-d'),
                'tgl'=>$request->tgl
            ]);
        }

        return redirect('/modal')->with('status','Berhasil Menambah Data');
    }
}
