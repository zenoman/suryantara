<?php

namespace App\Http\Controllers\Kategoriakutansi;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\models\Kategoriakutansi;
use Illuminate\Support\Facades\Session;

class Kategoriakutansicontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // $katbars = Kategoriakutansi::paginate(20);
        $setting = DB::table('setting')->get();
        $datkatbarakutansi = DB::table('tb_kategoriakutansi')->paginate(20);
        // dd($datkatbar);
        return view('kategoriakutansi/index',['kate'=>$datkatbarakutansi,'title'=>$setting]);
    }
    
    public function create()
    {
        $setting = DB::table('setting')->get();
        return view('kategoriakutansi/create',['title'=>$setting]);
    }

    public function store(Request $request)
    {
        Kategoriakutansi::create([
            'kode' => $request->kode,
            'nama'  => $request->nama,
            'status'  => $request->status,
            'aksi'  =>'Y',
            'tempat'=>$request->aks

        ]);
        return redirect('kat_akut')->with('status','Input Data Sukses');
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
        $jab = Kategoriakutansi::find($id);
        $setting = DB::table('setting')->get();
        return view('kategoriakutansi/edit',['kataku'=>$jab,'title'=>$setting]);

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
                    'kode'  => 'required|min:2',
                    'nama'  => 'required|min:2',
                    'status' =>'required'
            ];
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',

         ];
        $this->validate($request,$rules,$customMessages);
        Kategoriakutansi::find($id)->update([
            'kode' => $request->kode,
            'nama'  => $request->nama,
            'status'  => $request->status,
            'tempat' =>$request->aks
            ]);
        return redirect('/kat_akut')->with('status','Edit Data Sukses');
 
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
         Kategoriakutansi::destroy($id);
        return back()->with('status','Hapus Data Sukses');
    }
}
