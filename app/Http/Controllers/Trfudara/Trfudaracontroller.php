<?php

namespace App\Http\Controllers\Trfudara;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use App\models\Trfudaramodel;

class Trfudaracontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $udara = Trfudaramodel::get();
        return view('trfudara/index',['trf_udara'=>$udara]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('trfudara/create');
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
            'kode' => 'required|min:3',
            'tujuan' => 'required|min:3',
            'airlans' => 'required|min:3',
            'gencoKG' => 'required|min:1',
            'minimal' => 'required|min:3'
                ];
         $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit'
         ];
        $this->validate($request,$rules,$customMessages);
        Trfudaramodel::create([
            'kode' => $request->kode,
            'tujuan' => $request->tujuan,
            'airlans' => $request->airlans,
            'gencoKG' => $request->gencoKG,
            'minimal' => $request->minimal
]);
return redirect('trfudara');

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
        $tar = Trfudaramodel::find($id);
        return view('trfudara/edit',['trfudara'=>$tar]);
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
            'kode' => 'required|min:3',
            'tujuan' => 'required|min:3',
            'airlans' => 'required|min:3',
            'gencoKG' => 'required|min:1',
            'minimal' => 'required|min:3'
            ];
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit'
         ];
        $this->validate($request,$rules,$customMessages);
        
        Trfudaramodel::find($id)->update([
            'kode' => $request->kode,
            'tujuan' => $request->tujuan,
            'airlans' => $request->airlans,
            'gencoKG' => $request->gencoKG,
            'minimal' => $request->minimal
            ]);
        return redirect('trfudara')->with('status','Edit Data Sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Trfudaramodel::destroy($id);
        return redirect('trfudara')->with('status','Hapus Data Sukses');
        //
    }
}
