<?php

namespace App\Http\Controllers\Trfudara;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use App\models\Trfudaramodel;

use App\Imports\TrfudaraImport;
use App\Exports\TrfudaraExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
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
    $setting = DB::table('setting')->get();
        return view('trfudara/index',['trf_udara'=>$udara,'title'=>$setting]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //------------------------------------
   public function importexcel (){
        $setting = DB::table('setting')->get();
        return view('trfudara/importexcel',['title'=>$setting]);
    }

    public function downloadtemplate(){
         $file= base_path()."/../public_html/file/template tarif Udara.xlsx";
            $headers = array(
              'Content-Type: application/excel',
            );
    return Response::download($file, 'template tarif Udara.xlsx', $headers);
    return redirect('trfudara/importexcel');
    }


        public function prosesimportexcel(Request $request){
        if($request->hasFile('file')){
        Excel::import(new TrfudaraImport, request()->file('file'));
        }
        return redirect('trfudara')->with('status','Import excel sukses');
    }

    public function exsportexcel(){
    return Excel::download(new TrfudaraExport, 'Export Tarif Udara.xlsx');
    return redirect('trfudara/importexcel');

    }
//-----------------------------------
public function caridata(Request $request)
    {
        $cari=$request->cari;
        $trf_udr = DB::table('tarif_udara')->where('tujuan','like','%'.$cari.'%')->orwhere('kode','like','%'.$cari.'%')->get();
            $setting = DB::table('setting')->get();
        return view('trfudara/pencarian', ['trf_udr'=>$trf_udr, 'cari'=>$cari,'title'=>$setting]);
    }
    public function create()
    {
            $setting = DB::table('setting')->get();
        return view('trfudara/create',['title'=>$setting]);
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
            'biaya_perkg' => 'required|min:1',
            'minimal_heavy' => 'required|min:1',
            'biaya_dokumen' => 'required|min:1',
                ];
         $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi',
        'min'       => 'Maaf, data yang anda masukan terlalu sedikit'
         ];
        $this->validate($request,$rules,$customMessages);
$dtlam= DB::table('tarif_udara')->where('kode',$request->kode)->count();
if($dtlam > 0){
    return redirect('trfudara/create')->with('status','Kode tujuan tarif udara yang anda masukan sudah ada!! ');
}else{
        Trfudaramodel::create([
            'kode' => $request->kode,
            'tujuan' => $request->tujuan,
            'airlans' => $request->airlans,
            'perkg' => $request->biaya_perkg,
            'minimal_heavy' => $request->minimal_heavy,
            'biaya_dokumen' => $request->biaya_dokumen
]);
return redirect('trfudara')->with('status','tambah Data Sukses');
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
        //
        $trfudara = DB::table('tarif_udara')->where('id',$id)->get();
    $setting = DB::table('setting')->get();
        return view('trfudara/edit',['trfudara'=>$trfudara,'title'=>$setting]); 
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
            'biaya_perkg' => 'required|min:1',
            'minimal_heavy' => 'required|min:1',
            'biaya_dokumen' => 'required|min:1',
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
            'perkg' => $request->biaya_perkg,
            'minimal_heavy' => $request->minimal_heavy,
            'biaya_dokumen' => $request->biaya_dokumen
            ]);
        

        return redirect('trfudara')->with('status','Edit Data Sukses');
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
        Trfudaramodel::destroy($id);
        return back()->with('status','Hapus Data Sukses');
        //
    }
public function haphapus(Request $request)
    {
        // dd($request->pilihid);
            if(!$request->pilihid){
                return back()->with('statuserror','Tidak ada data yang dipilih');
            }else{
        foreach ($request->pilihid as $id) { 
            Trfudaramodel::destroy($id);
            }
        }
return back()->with('status','Hapus Data Sukses');
}
}
