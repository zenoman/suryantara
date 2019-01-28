<?php

namespace App\Http\Controllers\Karyawan;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\models\Karyawanmodel;
use Illuminate\Support\Facades\Session;
class Karyawancontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $Karyawans = Karyawanmodel::paginate(20);
        $setting = DB::table('setting')->get();
        // $datKaryawan = DB::table('karyawan')->paginate(20);
          $datKaryawan = DB::table('karyawan')
                ->join('jabatan', 'jabatan.id', '=', 'karyawan.id_jabatan')
                 ->select('karyawan.*','jabatan.jabatan')
                 ->paginate(20);

        // dd($datKaryawan);
        return view('karyawan/index',['karyawan'=>$datKaryawan,'title'=>$setting]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function caridata(Request $request)
    {
        $setting = DB::table('setting')->get();
        $id=Session::get('id');
        $cari=$request->cari;
        //_______________________________________________
        $datKaryawan = DB::table('karyawan')->where('id','!=',$id)
        ->where(function ($huft) use ($cari){
            $huft->where('nama','like','%'.$cari.'%')
            ->orwhere('kode','like','%'.$cari.'%')
            ->orwhere('alamat','like','%'.$cari.'%');
        })
        ->paginate(20);
    
        return view('karyawan/pencarian', ['datKaryawan'=>$datKaryawan, 'cari'=>$cari,'title'=>$setting]);
    }


    public function create()
    {
        $table="karyawan";
        $tut="kode";
        $q=DB::table($table)->max($tut);
        if(!$q){
            $finalkode = "Karyawan-000001";
        }else{
            $newkode    = explode("-", $q);
            $nomer      = sprintf("%06s",$newkode [1]+1);
            $finalkode  = "Karyawan-".$nomer;
        }
// dd($finalkode);
        $setting = DB::table('setting')->get();
        $jabat = DB::table('jabatan')->get();
        return view('karyawan/create',['title'=>$setting,'kode'=>$finalkode,'jabatan'=>$jabat]);
    }

    public function store(Request $request)
    {
        $rules = [
                    // 'kode'  =>'required',
                    'nama'  => 'required',
                    'jabatan'=>'required',
                    'telp'  => 'required|numeric',
                    'alamat'  => 'required|min:3'
                    ];

    $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',
        'numeric'   => 'Maaf, data harus angka',
        'email'     => 'Maaf, data harus email'
    ];
        $this->validate($request,$rules,$customMessages);
        //
                $table="karyawan";
        $tut="kode";
        $q=DB::table($table)->max($tut);
        if(!$q){
            $finalkode = "Karyawan-000001";
        }else{
            $newkode    = explode("-", $q);
            $nomer      = sprintf("%06s",$newkode [1]+1);
            $finalkode  = "Karyawan-".$nomer;
        }
        //
                    $kode=$request->kode;
                    // dd($kode);
$dtlam= DB::table('karyawan')->where('kode',$kode)->count();
if($dtlam > 0){
    return redirect('karyawan/create')->with('status','Kode Karyawan Yang anda masukan sudah ada!!');
}else{
        Karyawanmodel::create([
            'kode'  => $finalkode,
            'nama'  => $request->nama,
            'id_jabatan' =>$request->jabatan,
            'telp'  => $request->telp,
            'alamat'  => $request->alamat

        ]);
        
        return redirect('karyawan')->with('status','Input Data Sukses');
}
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
        $Karyawan = Karyawanmodel::find($id);
        // $idd=$id;
        $jabat = DB::table('jabatan')->get();
        // $Karyawan = DB::table('karyawan')
        //         ->join('jabatan', 'jabatan.id', '=', 'karyawan.id_jabatan')
        //         ->select('karyawan.*','jabatan.jabatan')
        //         // ->where('karyawan.id',$id);
                 // dd($databarang);
        $setting = DB::table('setting')->get();
        return view('karyawan/edit',['datKaryawan'=>$Karyawan,'title'=>$setting,'jabatan'=>$jabat]);
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
                    'nama'  => 'required',
                    'telp'  => 'required|min:5|numeric',
                    'alamat'  => 'required|min:5',
            ];
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit',
        'numeric'   => 'Maaf, data harus angka',
        'email'     => 'Maaf, data harus email'

         ];
        $this->validate($request,$rules,$customMessages);
        Karyawanmodel::find($id)->update([
            
            'nama'  => $request->nama,
            'id_jabatan' =>$request->jabatan,
            'telp'  => $request->telp,
            'alamat'  => $request->alamat
            ]);
        return redirect('/karyawan')->with('status','Edit Data Sukses'); 
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
         Karyawanmodel::destroy($id);
        // return redirect('karyawan')->with('status','Hapus Data Sukses');
        return back()->with('status','Hapus Data Sukses');
    }
}
