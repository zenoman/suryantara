<?php
namespace App\Http\Controllers\Karyawan;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\models\Karyawanmodel;
use Illuminate\Support\Facades\File;
use App\Imports\KaryawanImport;
use App\Exports\KaryawanExport;
use App\Exports\JabatanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

class Karyawancontroller extends Controller
{
    public function index(){ 
        $setting = DB::table('setting')->get();
        $datKaryawan = DB::table('karyawan')
                ->select('karyawan.*','jabatan.jabatan','cabang.nama as namacabang')
                ->leftjoin('jabatan', 'jabatan.id', '=', 'karyawan.id_jabatan')
                ->leftjoin('cabang','cabang.id','=','karyawan.id_cabang')
                ->orderby('karyawan.id','desc')
                ->paginate(20);
        return view('karyawan/index',['karyawan'=>$datKaryawan,'title'=>$setting]);
    }

    //==================================================================
   public function importexcel (){
    $setting = DB::table('setting')->get();
        return view('karyawan/importexcel',['title'=>$setting]);
    }
    public function downloadtemplate(){
         $file= "file/template karyawan.xlsx";
            $headers = array(
              'Content-Type: application/excel',
            );
    return Response::download($file, 'template karyawan.xlsx', $headers);
    }

    //==================================================================
    public function downloadtemplatejbt(){
    return Excel::download(new JabatanExport, 'Jabatan.xlsx');
    }

    //==================================================================
    public function prosesimportexcel(Request $request){
        if($request->hasFile('file')){
        Excel::import(new KaryawanImport, request()->file('file'));
        }
        return redirect('karyawan')->with('status','Import excel sukses');
    }

    //==================================================================
    public function exsportexcel(){
    return Excel::download(new KaryawanExport, ' Export data karyawan.xlsx');
    }

    //==================================================================
    public function caridata(Request $request)
    {
        $setting = DB::table('setting')->get();
        $cari=$request->cari;
        
        $datKaryawan = DB::table('karyawan')
        ->select('karyawan.*','jabatan.jabatan','cabang.nama as namacabang')
        ->leftjoin('jabatan','jabatan.id','=','karyawan.id_jabatan')
        ->leftjoin('cabang','cabang.id','=','karyawan.id_cabang')
        ->where('karyawan.nama','like','%'.$cari.'%')
        ->orwhere('jabatan.jabatan','like','%'.$cari.'%')
        ->orderby('karyawan.id','desc')
        ->get();
    
        return view('karyawan/pencarian', ['datKaryawan'=>$datKaryawan, 'cari'=>$cari,'title'=>$setting]);
    }


    //==================================================================
    public function create()
    {
        $cabang = DB::table('cabang')->get();
        $setting = DB::table('setting')->get();
        $jabat = DB::table('jabatan')->get();
        return view('karyawan/create',['cabang'=>$cabang,'title'=>$setting,'jabatan'=>$jabat]);
    }

    //==================================================================
    public function store(Request $request)
    {
        $rules = [
                    'kode'  =>'required',
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

        Karyawanmodel::create([
            'kode'  => $request->kode,
            'nama'  => $request->nama,
            'id_jabatan' =>$request->jabatan,
            'telp'  => $request->telp,
            'alamat'  => $request->alamat,
            'id_cabang'=>$request->cabang

        ]);
        
        return redirect('karyawan')->with('status','Input Data Sukses');
    }

    //==================================================================
    public function edit($id)
    {
       
        $Karyawan = DB::table('karyawan')
                ->join('jabatan', 'jabatan.id', '=', 'karyawan.id_jabatan')
                ->select('karyawan.*','jabatan.jabatan')
                ->where('karyawan.id',$id)->get();
        $jabat = DB::table('jabatan')->get();
        $setting = DB::table('setting')->get();
        $cabang = DB::table('cabang')->get();
        return view('karyawan/edit',['cabang'=>$cabang,'datKaryawan'=>$Karyawan,'title'=>$setting,'jabatan'=>$jabat]);
    }

    //==================================================================
    public function update(Request $request, $id)
    {
                    $rules = [
                    'kodess' =>'required',
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
            'kode' => $request->kodess,
            'nama'  => $request->nama,
            'id_jabatan' =>$request->jabatan,
            'telp'  => $request->telp,
            'alamat'  => $request->alamat,
            'id_cabang' =>$request->cabang
            ]);
        DB::table('gaji_karyawan')
            ->where('id',$id)
            ->update([
                'nama_karyawan'  => $request->nama
            ]);
        return redirect('/karyawan')->with('status','Edit Data Sukses'); 
    }

    //==================================================================
    public function destroy(Request $request)
    {
        $id = $request->aid;
         Karyawanmodel::destroy($id);
        return back()->with('status','Hapus Data Sukses');
    }
}
