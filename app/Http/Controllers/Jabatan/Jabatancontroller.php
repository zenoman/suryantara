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
        $datJabatan = DB::table('jabatan')->orderby('id','ASC')->paginate(20);
        // dd($datJabatan);
        return view('jabatan/index',['jabatan'=>$datJabatan,'title'=>$setting]);
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
                    
                    'jabatan'  =>'required',
                    'gaji_pokok'  =>'required',
                    'uang_makan'  =>'required'
                    ];
 
    $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
    ];
        $this->validate($request,$rules,$customMessages);
        //
        Jabatanmodel::create([
            'jabatan'  => $request->jabatan,
            'gaji_pokok'  => $request->gaji_pokok,
            'uang_makan'  => $request->uang_makan

        ]);
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
                    'gaji_pokok'  =>'required',
                    'uang_makan'  =>'required'
            ];
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',

         ];
        $this->validate($request,$rules,$customMessages);
        Jabatanmodel::find($id)->update([
            'jabatan'  => $request->jabatan,
            'gaji_pokok'  => $request->gaji_pokok,
            'uang_makan'  => $request->uang_makan
            ]);
        $pros=$request->gaji_pokok + $request->uang_makan;
        DB::table('gaji_karyawan')
            ->where('id_jabatan',$id)
            ->update([
                'gaji_pokok'=>$request->gaji_pokok,
                'uang_makan'=>$request->uang_makan,
                'total'=>$pros
            ]);
        return redirect('/jabatan')->with('status','Edit Data Sukses');
 
    }
    public function destroy(Request $request)
    {
        $id = $request->aid;
         Jabatanmodel::destroy($id);
        // return redirect('Jabatan')->with('status','Hapus Data Sukses');
        return back()->with('status','Hapus Data Sukses');
    }
}
