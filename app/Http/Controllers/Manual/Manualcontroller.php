<?php

namespace App\Http\Controllers\Manual;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\models\Manualmodel;
use Illuminate\Support\Facades\Session;

use App\Imports\ManualImport;
use App\Exports\KaryawanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
class Manualcontroller extends Controller
{
    public function index()
    {
        $setting = DB::table('setting')->get();
        $datmanual = DB::table('resi_pengiriman')
        ->select(DB::raw('resi_pengiriman.*,karyawan.nama'))
        ->leftjoin('karyawan','karyawan.id','=','resi_pengiriman.pemegang')
        ->where('resi_pengiriman.metode_input','manual')
        ->paginate(20);
        return view('Manual/index',['manual'=>$datmanual,'title'=>$setting]);
    }
//------------------------------------
    public function caridata(Request $request)
    {
        $cari=$request->cari;
        $manu = DB::table('kode_resimanual')->where('faktur','like','%'.$cari.'%')->get();
            $setting = DB::table('setting')->get();
        return view('Manual/pencarian', ['manual'=>$manu, 'cari'=>$cari,'title'=>$setting]);
    }
    //=========================================================
    public function importexcel(){
        $setting = DB::table('setting')->get();
        return view('Manual/importexcel',['title'=>$setting]);
    }
    //=========================================================
    public function downloadtemplate(){
         $file= "file/template resi manual.xlsx";
            $headers = array(
              'Content-Type: application/excel',
            );
    return Response::download($file, 'template resi manual.xlsx', $headers);
    }
    public function dowloadkaryawan(){
        return Excel::download(new KaryawanExport, 'karyawan.xlsx');
    }
    //========================================================
    public function prosesimportexcel(Request $request){
        if($request->hasFile('file')){
        Excel::import(new ManualImport, request()->file('file'));
        }
        return redirect('Manual')->with('status','Import excel sukses');
    }

    public function create()
    {
        $setting = DB::table('setting')->get();
        $karyawan = DB::table('karyawan')->get();
        return view('Manual/create',['title'=>$setting,'karyawan'=>$karyawan]);
    }

    public function store(Request $request)
    {
        $rules = ['kode'  =>'required'];
 
        $customMessages = [
        'required'  => 'Maaf, :attribute harus di isi'];

        $this->validate($request,$rules,$customMessages);
        
        $data=$request->kode;
        for ($i=0; $i < count($data) ; $i++){ 
            if($i == count($data)-1){
                $final = $data[$i];
            }else{
                $final = $data[$i];
            }
        Manualmodel::create([
            'pemegang' => $request->pemegang,
            'no_resi'  => $final,
            'metode_input'=>'manual'

        ]);
        }
        return redirect('Manual')->with('status','Input Data Sukses');
    }
    public function destroy(Request $request)
    {
        $id = $request->aid;
        Manualmodel::destroy($id);
        return back()->with('status','Hapus Data Sukses');
    }
    public function haphapus(Request $request)
    {
        if(!$request->pilihid){
                return back()->with('statuserror','Tidak ada data yang dipilih');
            }else{
        foreach ($request->pilihid as $id) { 
            Manualmodel::destroy($id);
            }
        }
    return back()->with('status','Hapus Data Sukses');
    }
    public function edit($id){
        $karyawan = DB::table('karyawan')->get();
        $webinfo = DB::table('setting')->limit(1)->get();
        $data = DB::table('resi_pengiriman')
        ->select(DB::raw('resi_pengiriman.*,karyawan.nama'))
        ->leftjoin('karyawan','karyawan.id','=','resi_pengiriman.pemegang')
        ->where([['resi_pengiriman.metode_input','manual'],['resi_pengiriman.id','=',$id]])
        ->get();
        
        return view('manual/edit',['title'=>$webinfo,'data'=>$data,'karyawan'=>$karyawan]);
    }
    public function simpandarat(Request $request){
        $simpan = DB::table('resi_pengiriman')
        ->where('id',$request->idresi)
       ->update([
        'admin'      => $request->iduser,
        'nama_barang'   => $request->nama_barang,
        'pengiriman_via'=> 'darat',
        'kota_asal'     => $request->kota_asal,
        'kode_tujuan'   => $request->kota_tujuan,
        'tgl'           =>  date('Y-m-d'),
        'jumlah'        => $request->jumlah,
        'berat'         => $request->berat,
        'dimensi'       => $request->dimensi,
        'ukuran_volume' => $request->ukuran_volume,
        'nama_pengirim' => $request->n_pengirim,
        'nama_penerima' => $request->n_penerima,
        'telp_pengirim' => $request->t_pengirim,
        'telp_penerima' => $request->t_penerima,
        'biaya_kirim'   => $request->biaya_kirim,
        'biaya_packing' => $request->biaya_packing,
        'biaya_asuransi'=> $request->biaya_asu,
        'total_biaya'   => $request->total_biaya,
        'keterangan'    => $request->keterangan,
        'satuan'        => $request->satuan,
        'metode_bayar'  => $request->metode,
        'biaya_ppn'     => $request->ppn,
        'metode_input'  =>'manual'
       ]);
        return response()->json($simpan);
    }
}
