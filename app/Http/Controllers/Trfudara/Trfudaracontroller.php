<?php

namespace App\Http\Controllers\Trfudara;

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
         $file= public_path(). "/file/template tarif Udara.xlsx";
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
    return Excel::download(new TrfudaraExport, 'Tarif Udara.xlsx');
    return redirect('trfudara/importexcel');

    }
//-----------------------------------
public function caridata(Request $request)
    {
        $trf_udr = DB::table('tarif_udara')->where('tujuan','like','%'.$request->cari.'%')->get();
            $setting = DB::table('setting')->get();
        return view('trfudara/pencarian', ['trf_udr'=>$trf_udr, 'cari'=>$request->cari,'title'=>$setting]);
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
            'ber_perkg' => 'required|min:1',
            'tarif_perkg' => 'required|min:1',
            'tarif_dokumen' => 'required|min:1',
            'persentase' => 'required|min:1'
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
            'perkg' => $request->ber_perkg
]);
        DB::table('udara_kargo')
        ->insert([
            'kode_udara' => $request->kode,
            'tarif_perkg' => $request->tarif_perkg,
            'tarif_dokumen' => $request->tarif_dokumen,
            'persentase' => $request->persentase
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
        foreach ($trfudara as $row) {
            $kode = $row->kode;

        }
    $setting = DB::table('setting')->get();
        $udara_kargo = DB::table('udara_kargo')->where('kode_udara',$kode)->get();
        return view('trfudara/edit',['trfudara'=>$trfudara,'udaracargo'=>$udara_kargo,'title'=>$setting]); 
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
            'ber_perkg' => 'required|min:1',
            'tarif_perkg' => 'required|min:1',
            'tarif_dokumen' => 'required|min:1',
            'persentase' => 'required|min:1'
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
            'perkg' => $request->ber_perkg
            ]);

        $kode = $request->kode;

        DB::table('udara_kargo')->where('kode_udara',$kode)->update([
            'tarif_perkg' => $request->tarif_perkg,
            'tarif_dokumen' => $request->tarif_dokumen,
            'persentase' => $request->persentase

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
