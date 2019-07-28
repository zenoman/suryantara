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
    public function index()
    {
        
        $setting = DB::table('setting')->get();
        $datJabatan = DB::table('jabatan')
        ->select(DB::raw('jabatan.*,cabang.nama as namacabang'))
        ->leftjoin('cabang','cabang.id','=','jabatan.id_cabang')
        ->orderby('jabatan.id','desc')->paginate(20);
        return view('jabatan/index',['jabatan'=>$datJabatan,'title'=>$setting]);
    }
    //==================================================================
    public function create()
    {
        $cabang = DB::table('cabang')->get();
        $setting = DB::table('setting')->get();
        return view('jabatan/create',['cabang'=>$cabang,'title'=>$setting]);
    }
    //==================================================================
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
            'uang_makan'  => $request->uang_makan,
            'id_cabang' => $request->cabang,
            'status' => $request->bm

        ]);
        return redirect('jabatan')->with('status','Input Data Sukses');
        }
    //==================================================================
    
    public function edit($id)
    {
        $cabang = DB::table('cabang')->get();
        $jab = Jabatanmodel::find($id);
        $setting = DB::table('setting')->get();
        return view('jabatan/edit',['cabang'=>$cabang,'jabat'=>$jab,'title'=>$setting]);

    }
    //==================================================================
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
            'uang_makan'  => $request->uang_makan,
            'id_cabang' => $request->cabang,
            'status' => $request->bm
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
    //==================================================================
    public function destroy(Request $request)
    {
        $id = $request->aid;
         Jabatanmodel::destroy($id);
        return back()->with('status','Hapus Data Sukses');
    }
}
