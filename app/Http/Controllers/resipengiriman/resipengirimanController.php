<?php
namespace App\Http\Controllers\resipengiriman;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class resipengirimanController extends Controller
{
    public function caridataresi(Request $request){
        $cari = $request->cari;
        $datakirim = DB::table('resi_pengiriman')
            ->where('no_resi','like','%'.$cari.'%')
            ->orwhere('tgl','like','%'.$cari.'%')
            ->orwhere('pengiriman_via','like','%'.$cari.'%')
            ->orwhere('kode_tujuan','like','%'.$cari.'%')
            ->orwhere('admin','like','%'.$cari.'%')
            ->get();
        $webinfo = DB::table('setting')->limit(1)->get();
        
        return view('resipengiriman/cari',['datakirim'=>$datakirim,'webinfo'=>$webinfo,'cari'=>$cari]);
    }
    public function tambahnosmu(Request $request){
        DB::table('resi_pengiriman')
        ->where('id',$request->kode)
        ->update([
            'no_smu'=>$request->nosmu
        ]);
        return back()->with('status','No SMU Di Simpan');
    }
    public function resiudara(){
    $webinfo = DB::table('setting')->limit(1)->get();
    $kategori = DB::table('kategori_barang')->get();
    return view('resipengiriman/resiudara',['webinfo'=>$webinfo,'kategori'=>$kategori]);
    }
    public function uangkembali($id){
         $data=DB::table('resi_pengiriman')->where('id',$id)->get();
        foreach ($data as $row) {
            
                if($row->status=='N'){
                    $status = "US";
                }else{
                    $status = "Y";
                }
            

        }
        DB::table('resi_pengiriman')->where('id',$id)
        ->update([
        'status'=>$status
        ]);
        return back()->with('status','Status Berhasil Diubah');
    }
    public function resikembali($id){
        $data=DB::table('resi_pengiriman')->where('id',$id)->get();
        foreach ($data as $row) {
            if($row->metode_bayar=='cash'){
                $status = "Y";
            }else{
                if($row->status=='N'){
                    $status = "RS";
                }else{
                    $status = "Y";
                }
            }

        }
        DB::table('resi_pengiriman')->where('id',$id)
        ->update([
        'status'=>$status
        ]);
        return back()->with('status','Status Berhasil Diubah');
    }
    public function carilistresi($id){
        $data = DB::table('resi_pengiriman')
        ->where('id',$id);
        return response()->json($data);
    }

    public function carikode(){
        $tanggal    = date('dmy');
        $kodeuser = sprintf("%02s",session::get('id'));
        $lastuser = $tanggal."-".$kodeuser;
        $kode = DB::table('resi_pengiriman')
        ->where([['no_resi','like','%'.$lastuser.'-%'],['metode_input','=','otomatis']])
        ->max('no_resi');

        if(!$kode){
            $finalkode = "KDR".$tanggal."-".$kodeuser."-000001";
        }else{
            $newkode    = explode("-", $kode);
            $nomer      = sprintf("%06s",$newkode[2]+1);
            $finalkode  = "KDR".$tanggal."-".$kodeuser."-".$nomer;
        }
        return response()->json($finalkode);
    }

    public function tampil(){
        $webinfo = DB::table('setting')->limit(1)->get();
        $datakirim = DB::table('resi_pengiriman')
        ->where('metode_input','otomatis')
        ->orderby('id','desc')
        ->paginate(50);
        return view('resipengiriman/listpengiriman',['datakirim'=>$datakirim,'webinfo'=>$webinfo]);
    }
    public function residarat()
    {
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('resipengiriman/residarat',['webinfo'=>$webinfo]);
    }
    public function resilaut(){
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('resipengiriman/resilaut',['webinfo'=>$webinfo]);
    }
    public function carikota(Request $request){
        if($request->has('q')){
            $cari = $request->q;
            
            $data = DB::table('tarif_darat')
                    ->select('tujuan','id')
                    ->where('tujuan','like','%'.$cari.'%')
                    ->get();
            
            return response()->json($data);
        }
    }
    public function carihasilkota($id){
        $data = DB::table('tarif_darat')
                    ->select('tujuan','id','tarif')
                    ->where('id',$id)
                    ->get();
            
            return response()->json($data);
    }
    public function carilaut(Request $request){
        if($request->has('q')){
            $cari = $request->q;
            
            $data = DB::table('tarif_laut')
                    ->select('tujuan','id')
                    ->where('tujuan','like','%'.$cari.'%')
                    ->get();
            
            return response()->json($data);
        }
    }
    public function cariudara(Request $request){
       if($request->has('q')){
            $cari = $request->q;
            
            $data = DB::table('tarif_udara')
                    ->select('tujuan','id','airlans')
                    ->where('tujuan','like','%'.$cari.'%')
                    ->get();
            
            return response()->json($data);
        } 
    }
    public function carihasiludara($id){
        $data = DB::table('tarif_udara')
                    ->where('id',$id)
                    ->get();
            
            return response()->json($data);
    }

    public function carihasillaut($id){
         $data = DB::table('tarif_laut')
                    ->select('tujuan','id','tarif')
                    ->where('id',$id)
                    ->get();
            
            return response()->json($data);
    }
    public function store(Request $request)
    {

       $simpan = DB::table('resi_pengiriman')
       ->insert([
        'no_resi'       => $request->noresi,
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
        'biaya_ppn'     => $request->ppn
       ]);
        return response()->json($simpan);
    }

    public function simpanlaut(Request $request)
    {

       $simpan = DB::table('resi_pengiriman')
       ->insert([
        'no_resi'       => $request->noresi,
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
        'keterangan'    => $request->keterangan,
        'satuan'        => $request->satuan,
        'metode_bayar'  => $request->metode,
        'biaya_ppn'     => $request->ppn
       ]);
        return response()->json($simpan);
    }
     public function simpanudara(Request $request)
    {

       $simpan = DB::table('resi_pengiriman')
       ->insert([
        'no_resi'       => $request->noresi,
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
        'keterangan'    => $request->keterangan,
        'satuan'        => $request->satuan,
        'metode_bayar'  => $request->metode,
        'biaya_ppn'     => $request->ppn,
        'no_smu'        => $request->nosmu,
        'biaya_charge'  =>$request->charge
       ]);
        return response()->json($simpan);
    }
}
