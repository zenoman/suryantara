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
    public function manualbatal()
    {
        $setting = DB::table('setting')->get();
        $datmanual = DB::table('resi_pengiriman')
        ->select(DB::raw('resi_pengiriman.*,karyawan.nama'))
        ->leftjoin('karyawan','karyawan.id','=','resi_pengiriman.pemegang')
        ->where([['resi_pengiriman.metode_input','manual'],['resi_pengiriman.batal','Y'],['resi_pengiriman.id_cabang','=',Session::get('cabang')]])
        ->orderby('resi_pengiriman.id','desc')
        ->get();
        return view('manual/manualbatal',
            ['manual'=>$datmanual,'title'=>$setting]);
    }
    //==========================================================
    public function index()
    {
        $setting = DB::table('setting')->get();
        $datmanual = DB::table('resi_pengiriman')
        ->select(DB::raw('resi_pengiriman.*,karyawan.nama'))
        ->leftjoin('karyawan','karyawan.id','=','resi_pengiriman.pemegang')
        ->where([['resi_pengiriman.metode_input','manual'],['resi_pengiriman.batal','N'],['resi_pengiriman.id_cabang','=',Session::get('cabang')]])
        ->orderby('resi_pengiriman.id','desc')
        ->paginate(20);
        return view('manual/index',['manual'=>$datmanual,'title'=>$setting]);
    }
    //==============================================================
    public function caridata(Request $request)
    {
        $cari=$request->cari;
        $datmanual = DB::table('resi_pengiriman')
        ->select(DB::raw('resi_pengiriman.*,karyawan.nama'))
        ->leftjoin('karyawan','karyawan.id','=','resi_pengiriman.pemegang')
        ->where([['resi_pengiriman.metode_input','manual'],['resi_pengiriman.no_resi','like','%'.$cari.'%'],['resi_pengiriman.batal','N'],['resi_pengiriman.id_cabang','=',Session::get('cabang')]])
        ->orwhere([['resi_pengiriman.metode_input','manual'],['resi_pengiriman.pengiriman_via','like','%'.$cari.'%'],['resi_pengiriman.batal','N'],['resi_pengiriman.id_cabang','=',Session::get('cabang')]])
        ->orwhere([['resi_pengiriman.metode_input','manual'],['karyawan.nama','like','%'.$cari.'%'],['resi_pengiriman.batal','N'],['resi_pengiriman.id_cabang','=',Session::get('cabang')]])
        ->get();
            $setting = DB::table('setting')->get();
        return view('manual/pencarian', ['manual'=>$datmanual, 'cari'=>$cari,'title'=>$setting]);
    }

    //==============================================================
    public function tampilmanualsmukosong()
    {
        $setting = DB::table('setting')->get();
        $datmanual = DB::table('resi_pengiriman')
        ->select(DB::raw('resi_pengiriman.*,karyawan.nama'))
        ->leftjoin('karyawan','karyawan.id','=','resi_pengiriman.pemegang')
        ->where([['resi_pengiriman.metode_input','manual'],['resi_pengiriman.batal','N'],['resi_pengiriman.id_cabang','=',Session::get('cabang')]])
        ->whereNull('no_smu')
        ->orderby('resi_pengiriman.id','desc')
        ->get();
        return view('manual/manual_smukosong',['manual'=>$datmanual,'title'=>$setting]);
    }

    //==============================================================
    public function carismukosong(Request $request)
    {
        $cari=$request->cari;
        $datmanual = DB::table('resi_pengiriman')
        ->select(DB::raw('resi_pengiriman.*,karyawan.nama'))
        ->leftjoin('karyawan','karyawan.id','=','resi_pengiriman.pemegang')
        ->where([['resi_pengiriman.metode_input','manual'],['resi_pengiriman.no_resi','like','%'.$cari.'%'],['no_smu','=',null],['resi_pengiriman.batal','N'],['resi_pengiriman.id_cabang','=',Session::get('cabang')]])
        ->orwhere([['resi_pengiriman.metode_input','manual'],['karyawan.nama','like','%'.$cari.'%'],['no_smu','=',null],['resi_pengiriman.batal','N'],['resi_pengiriman.id_cabang','=',Session::get('cabang')]])
        ->get();
            $setting = DB::table('setting')->get();
        return view('manual/cari_smukosong', ['manual'=>$datmanual, 'cari'=>$cari,'title'=>$setting]);
    }

    //=========================================================
    public function importexcel(){
        $setting = DB::table('setting')->get();
        return view('manual/importexcel',['title'=>$setting]);
    }

    //=========================================================
    public function downloadtemplate(){
         $file= "file/template resi manual.xlsx";
            $headers = array(
              'Content-Type: application/excel',
            );
    return Response::download($file, 'template resi manual.xlsx', $headers);
    }

    //==============================================================
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

    //==============================================================
    public function create()
    {
        $setting = DB::table('setting')->get();
        $karyawan = DB::table('karyawan')->get();
        return view('manual/create',['title'=>$setting,'karyawan'=>$karyawan]);
    }

    //==============================================================
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
        $caridata = DB::table('resi_pengiriman')->where('no_resi',$final)->count();
        if ($caridata == 0) {
        Manualmodel::create([
            'pemegang' => $request->pemegang,
            'no_resi'  => $final,
            'metode_input'=>'manual'

        ]);
        }
        }
        return redirect('Manual')->with('status','Input Data Sukses');
    }

    //==============================================================
    public function destroy(Request $request)
    {
        $id = $request->aid;
        $data = Manualmodel::find($id);
        $kodejalan = $data->kode_jalan;
        if($data->kode_jalan!=''){
            $datasj = DB::table('surat_jalan')->where('kode',$data->kode_jalan)->get();
            foreach($datasj as $row){
                $biaya = $row->biaya - $data->biaya_suratjalan;
                DB::table('surat_jalan')
                ->where('kode',$data->kode_jalan)
                ->update([
                    'biaya'=>$biaya
                ]);
                }
        }
        $hapusresi=Manualmodel::destroy($id);

        $hitungsj = 
        DB::table('resi_pengiriman')
        ->where('kode_jalan',$kodejalan)
        ->count();
        if($hitungsj == 0 ){
            DB::table('surat_jalan')->where('kode',$kodejalan)->delete();
        }
        
        return back()->with('status','Hapus Data Sukses');
    }

    //==============================================================
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

    //==============================================================
    public function edit($id){
        $karyawan = DB::table('karyawan')->get();
        $webinfo = DB::table('setting')->limit(1)->get();
        $data = DB::table('resi_pengiriman')
        ->select(DB::raw('resi_pengiriman.*,karyawan.nama'))
        ->leftjoin('karyawan','karyawan.id','=','resi_pengiriman.pemegang')
        ->where([['resi_pengiriman.metode_input','manual'],['resi_pengiriman.id','=',$id]])
        ->get();
        $kategori = DB::table('kategori_barang')->get();
        return view('manual/edit',['title'=>$webinfo,'data'=>$data,'karyawan'=>$karyawan,'kategori'=>$kategori]);
    }

    //==============================================================
    public function ubah($id){
        $karyawan = DB::table('karyawan')->get();
        $webinfo = DB::table('setting')->limit(1)->get();
        $data = DB::table('resi_pengiriman')
        ->select(DB::raw('resi_pengiriman.*,karyawan.nama'))
        ->leftjoin('karyawan','karyawan.id','=','resi_pengiriman.pemegang')
        ->where([['resi_pengiriman.metode_input','manual'],['resi_pengiriman.id','=',$id]])
        ->get();
        $kategori = DB::table('kategori_barang')->get();
        return view('manual/ubah',['title'=>$webinfo,'data'=>$data,'karyawan'=>$karyawan,'kategori'=>$kategori]);
    }

    //================================================================
    public function simpandarat(Request $request){
        if($request->status_bayar=='lunas'){
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
                'satuan'        => $request->satuan,
                'metode_bayar'  => $request->metode,
                'biaya_ppn'     => $request->ppn,
                'metode_input'  =>'manual',
                'alamat_pengirim'=>$request->alamat_pengirim,
                'alamat_penerima'=>$request->alamat_penerima,
                'tgl_lunas' => date('Y-m-d'),
                'status' => 'US']);
        }else{
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
                'satuan'        => $request->satuan,
                'metode_bayar'  => $request->metode,
                'biaya_ppn'     => $request->ppn,
                'metode_input'  =>'manual',
                'alamat_pengirim'=>$request->alamat_pengirim,
                'alamat_penerima'=>$request->alamat_penerima]);
        }
        return response()->json($simpan);
    }

//====================================================================
    public function simpanlaut(Request $request){
        if($request->status_bayar=='lunas'){
            $simpan = DB::table('resi_pengiriman')
                ->where('id',$request->idresi)
                ->update([
                    'admin'      => $request->iduser,
                    'nama_barang'   => $request->nama_barang,
                    'pengiriman_via'=> 'laut',
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
                    'satuan'        => $request->satuan,
                    'metode_bayar'  => $request->metode,
                    'biaya_ppn'     => $request->ppn,
                    'metode_input'  =>'manual',
                    'alamat_pengirim'=>$request->alamat_pengirim,
                    'alamat_penerima'=>$request->alamat_penerima,
                    'tgl_lunas' => date('Y-m-d'),
                    'status' => 'US']);
        }else{
            $simpan = DB::table('resi_pengiriman')
                ->where('id',$request->idresi)
                ->update([
                    'admin'      => $request->iduser,
                    'nama_barang'   => $request->nama_barang,
                    'pengiriman_via'=> 'laut',
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
                    'satuan'        => $request->satuan,
                    'metode_bayar'  => $request->metode,
                    'biaya_ppn'     => $request->ppn,
                    'metode_input'  =>'manual',
                    'alamat_pengirim'=>$request->alamat_pengirim,
                    'alamat_penerima'=>$request->alamat_penerima]);
            }
        return response()->json($simpan);
    }
//===================================================================
    public function simpanudara(Request $request){
        if($request->status_bayar=='lunas'){
            $simpan = DB::table('resi_pengiriman')
                ->where('id',$request->idresi)
                ->update([
                'admin'      => $request->iduser,
                'nama_barang'   => $request->nama_barang,
                'pengiriman_via'=> 'udara',
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
                'biaya_smu' => $request->biaya_smu,
                'biaya_karantina' => $request->biaya_karantina,
                'total_biaya'   => $request->total_biaya,
                'satuan'        => $request->satuan,
                'metode_bayar'  => $request->metode,
                'biaya_ppn'     => $request->ppn,
                'no_smu'        => $request->nosmu,
                'biaya_charge'  =>$request->charge,
                'metode_input'  =>'manual',
                'alamat_pengirim'=>$request->alamat_pengirim,
                'alamat_penerima'=>$request->alamat_penerima,
                'tgl_lunas' => date('Y-m-d'),
                'status' => 'US']);
        }else{
            $simpan = DB::table('resi_pengiriman')
                ->where('id',$request->idresi)
                ->update([
                'admin'      => $request->iduser,
                'nama_barang'   => $request->nama_barang,
                'pengiriman_via'=> 'udara',
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
                'biaya_smu' => $request->biaya_smu,
                'biaya_karantina' => $request->biaya_karantina,
                'total_biaya'   => $request->total_biaya,
                'satuan'        => $request->satuan,
                'metode_bayar'  => $request->metode,
                'biaya_ppn'     => $request->ppn,
                'no_smu'        => $request->nosmu,
                'biaya_charge'  =>$request->charge,
                'metode_input'  =>'manual',
                'alamat_pengirim'=>$request->alamat_pengirim,
                'alamat_penerima'=>$request->alamat_penerima]);
        }
        return response()->json($simpan);
    }
    public function simpancity(Request $request){
        if($request->status_bayar=='lunas'){
            $simpan = DB::table('resi_pengiriman')
                ->where('id',$request->idresi)
                ->update([
                'admin'      => $request->iduser,
                'nama_barang'   => $request->nama_barang,
                'pengiriman_via'=> 'city kurier',
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
                'satuan'        => $request->satuan,
                'metode_bayar'  => $request->metode,
                'biaya_ppn'     => $request->ppn,
                'metode_input'  =>'manual',
                'alamat_pengirim'=>$request->alamat_pengirim,
                'alamat_penerima'=>$request->alamat_penerima,
                'tgl_lunas' => date('Y-m-d'),
                'status' => 'US']);
        }else{
            $simpan = DB::table('resi_pengiriman')
                ->where('id',$request->idresi)
                ->update([
                'admin'      => $request->iduser,
                'nama_barang'   => $request->nama_barang,
                'pengiriman_via'=> 'city kurier',
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
                'satuan'        => $request->satuan,
                'metode_bayar'  => $request->metode,
                'biaya_ppn'     => $request->ppn,
                'metode_input'  =>'manual',
                'alamat_pengirim'=>$request->alamat_pengirim,
                'alamat_penerima'=>$request->alamat_penerima]);
        }
        return response()->json($simpan);
    }
}
