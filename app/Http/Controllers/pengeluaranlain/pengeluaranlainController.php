<?php

namespace App\Http\Controllers\pengeluaranlain;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class pengeluaranlainController extends Controller
{
    public function index()
    {
        $data = DB::table('pengeluaran_lain')
        ->orderby('id','desc')
        ->paginate(40);

        $setting = DB::table('setting')->limit(1)->get();
        return view('pengeluaranlain/index',['title'=>$setting,'data'=>$data]);
    }
    public function create()
    {
        $setting = DB::table('setting')->limit(1)->get();
        return view('pengeluaranlain/create',['title'=>$setting]);
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
                'kategori'=>$request->kategori,
                'keterangan'=>$request->keterangan,
                'jumlah'=>$request->jumlah,
                'tgl'=>date('Y-m-d'),
                'gambar'=>$namagambar,
                'tgl'=>$request->tgl
            ]);

        }else{
            DB::table('pengeluaran_lain')
            ->insert([
                'admin'=>$request->admin,
                'kategori'=>$request->kategori,
                'keterangan'=>$request->keterangan,
                'jumlah'=>$request->jumlah,
                'tgl'=>date('Y-m-d'),
                'tgl'=>$request->tgl
            ]);
        }

        return redirect('/pengeluaranlain')->with('status','Berhasil Menambah Data');
    }
}
