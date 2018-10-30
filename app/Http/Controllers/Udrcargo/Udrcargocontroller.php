<?php

namespace App\Http\Controllers\Udrcargo;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use App\models\Udrcargomodel;

class Udrcargocontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $udara = Udrcargomodel::get();
        return view('udaracargo/index',['udr_kargo'=>$udara]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('udaracargo/create');
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
        $rules = [
            'kode_udara' => 'required|min:0',
            'tarif' => 'required|min:3',
            'persentase' => 'required|min:3'
                ];

         $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit'
         ];
        $this->validate($request,$rules);
        Udrcargomodel::create([
            
            'kode_udara' => $request->kode_udara,
            'tarif' => $request->tarif,
            'persentase' => $request->persentase
]);
return redirect('udrkargo');

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
        $tar = Udrcargomodel::find($id);
        return view('udaracargo/edit',['udaracargo'=>$tar]);
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
        $rules = [
            'kode_udara' => 'required|min:0',
            'tarif' => 'required|min:3',
            'persentase' => 'required|min:3'
        ];
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit'
         ];
        $this->validate($request,$rules,$customMessages);
        
        Udrcargomodel::find($id)->update([
            'kode_udara' => $request->kode_udara,
            'tarif' => $request->tarif,
            'persentase' => $request->persentase
            ]);
        return redirect('udrkargo')->with('status','Edit Data Sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Udrcargomodel::destroy($id);
        return redirect('udrkargo')->with('status','Hapus Data Sukses');
        //
    }
}

