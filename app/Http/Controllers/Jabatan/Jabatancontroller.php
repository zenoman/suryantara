<?php

namespace App\Http\Controllers\Jabatan;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\models\Jabatanmodel;
use Illuminate\Support\Facades\Session;

class Jabatancontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $Jabatans = Jabatanmodel::paginate(20);
        $setting = DB::table('setting')->get();
        $datJabatan = DB::table('jabatan')->paginate(20);
        // dd($datJabatan);
        return view('Jabatan/index',['jabatan'=>$datJabatan,'title'=>$setting]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $setting = DB::table('setting')->get();
        return view('jabatan/create',['title'=>$setting]);
    }

    public function store(Request $request)
    {
        $rules = [
                    'kate'  =>'required',
                    'jabatan'  =>'required'
                    ];
 
    $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
    ];
        $this->validate($request,$rules,$customMessages);
        //
        $data=$request->jabatan;
        for ($i=0; $i < count($data) ; $i++) { 
            if($i == count($data)-1){
                $pros = $data[$i];
            }else{
                $pros = $data[$i];
            }
        $kat =$request->kate;
        Jabatanmodel::create([
            'kategori' => $kat,
            'jabatan'  => $pros

        ]);
        }
        
        return redirect('jabatan')->with('status','Input Data Sukses');
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
        $jab = Jabatanmodel::find($id);
        $setting = DB::table('setting')->get();
        return view('jabatan/edit',['jabat'=>$jab,'title'=>$setting]);

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
                    'jabatan'  => 'required|min:2',
            ];
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',

         ];
        $this->validate($request,$rules,$customMessages);
        Jabatanmodel::find($id)->update([
            'jabatan'  => $request->jabatan
            ]);
        return redirect('/jabatan')->with('status','Edit Data Sukses');
 
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
         Jabatanmodel::destroy($id);
        // return redirect('Jabatan')->with('status','Hapus Data Sukses');
        return back()->with('status','Hapus Data Sukses');
    }
}
