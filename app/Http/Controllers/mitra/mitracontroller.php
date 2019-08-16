<?php

namespace App\Http\Controllers\mitra;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class mitracontroller extends Controller
{
    public function index()
    {
          $vnd=DB::table('mitra')
            ->select(DB::raw('mitra.*,cabang.nama as namacabang'))
            ->leftjoin('cabang','cabang.id','=','mitra.id_cabang')
            ->orderby('mitra.id','desc')
            ->get();
        $setting = DB::table('setting')->get();
        return view('mitra/index',['mitra'=>$vnd,'title'=>$setting]);
        }

        //=========================================================
    public function create()
    {
        $cabang = DB::table('cabang')->get();
        $setting = DB::table('setting')->get();
        return view('mitra/create',['title'=>$setting,'cabang'=>$cabang]);
    }
    //============================================================================
    public function store(Request $request)
    {
        DB::table('mitra')
        ->insert([
        'nama' => $request->nama,
        'notelp' => $request->telp,
        'alamat' => $request->alamat,
        'id_cabang'=>$request->idcabang
        ]);
    return redirect('mitra')->with('status','tambah Data Sukses');
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
