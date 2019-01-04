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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            $destination=public_path('img/nota');
            $request->file('gambar')->move($destination,$namagambar);
            
            DB::table('pengeluaran_lain')
            ->insert([
                'admin'=>$request->admin,
                'kategori'=>$request->kategori,
                'keterangan'=>$request->keterangan,
                'jumlah'=>$request->jumlah,
                'tgl'=>date('Y-m-d'),
                'gambar'=>$namagambar
            ]);

        }else{
            DB::table('pengeluaran_lain')
            ->insert([
                'admin'=>$request->admin,
                'kategori'=>$request->kategori,
                'keterangan'=>$request->keterangan,
                'jumlah'=>$request->jumlah,
                'tgl'=>date('Y-m-d')
            ]);
        }

        return redirect('/pengeluaranlain')->with('status','Berhasil Menambah Data');
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
