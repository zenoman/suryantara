<?php

namespace App\Http\Controllers\Absensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\AbsenModel;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data=1;
            AbsenModel::create([
            'id_karyawan'=>$request->id_karyawan,
            'id_jabatan'=>$request->id_jabatan,
            'tgl'=>$request->tanggal,
            'bln'=>$request->bulan,
            'thn'=>$request->tahun,
            'masuk'=>$data
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        if($request->hasFile('edit_gambar')){
            File::delete('img/'.$request->edit_gambarlama);
            $nameland=$request->file('edit_gambar')->
            getClientOriginalname();
            $lower_file_name=strtolower($nameland);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $finalname=time().'-'.$replace_space;
            $destination=public_path('img');
            $request->file('edit_gambar')->move($destination,$finalname);

            $data = AbsenModel::where('id',$id)
            ->update([
                'nama'=>$request->edit_nama,
                'alamat'=>$request->edit_alamat,
                'notelp'=>$request->edit_notelp,
                'gambar'=>$finalname
            ]);
        }else{
            $data = AbsenModel::where('id',$id)
            ->update([
                'nama'=>$request->edit_nama,
                'alamat'=>$request->edit_alamat,
                'notelp'=>$request->edit_notelp
            ]);
        }
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
        $data = AbsenModel::find($id);
        if($data->gambar !='n'){
            File::delete('img/'.$data->gambar);
        }
        AbsenModel::destroy($id); 

    }
}
