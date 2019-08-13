<?php

namespace App\Http\Controllers\Penyusutan;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\models\Penyusutan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class Penyusutancontroller extends Controller
{
    public function index()
    {
        // $katbars = Kategoriakutansi::paginate(20);
        $setting = DB::table('setting')->get();
        $datkatbarakutansi = DB::table('Penyusutan')->paginate(20);
        // dd($datkatbar);
        return view('penyusutan/index',['sut'=>$datkatbarakutansi,'title'=>$setting]);
    }
    
    public function create()
    {
        $setting = DB::table('setting')->get();
        return view('penyusutan/create',['title'=>$setting]);
    }

    public function store(Request $request)
    {
        $penyusutan = $request->harga / $request->umur;
        Penyusutan::create([
            'nama'  => $request->nama,
            'harga'  => $request->harga,
            'residu' =>$request->residu,
            'umurbln'  => $request->umurbln,
            'umurthn'  => $request->umurthn,
            'penyusutan'  => $penyusutan

        ]);
        return redirect('nyusut')->with('status','Input Data Sukses');
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
        $jab = penyusutan::find($id);
        $setting = DB::table('setting')->get();
        return view('penyusutan/edit',['sut'=>$jab,'title'=>$setting]);

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
                    'nama'  => 'required|min:2',
                    'harga'  => 'required|min:2',
                    
            ];
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',

         ];
        $penyusutan = $request->harga / $request->umurbln;
        $this->validate($request,$rules,$customMessages);
        Penyusutan::find($id)->update([
            'nama'  => $request->nama,
            'harga'  => $request->harga,
            'residu' =>$request->residu,
            'umurbln'  => $request->umurbln,
            'umurthn'  => $request->umurthn,
            'penyusutan'  => $penyusutan
            ]);
        return redirect('/nyusut')->with('status','Edit Data Sukses');
 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->aid;
         penyusutan::destroy($id);
        return back()->with('status','Hapus Data Sukses');
    }
}
