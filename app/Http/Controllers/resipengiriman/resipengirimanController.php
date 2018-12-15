<?php

namespace App\Http\Controllers\resipengiriman;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class resipengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

    }
    public function carikode(){
        $kodeuser = sprintf("%02s",session::get('id'));
        $kode = DB::table('resi_pengiriman')
        ->where('no_resi','like','%'.$kodeuser.'%')
        ->max('no_resi');

        $newkode    = explode("-", $kode);
        $nomer      = sprintf("%06s",$newkode[2]+1);
        $tanggal    = date('dmy');
        $finalkode  = $tanggal."-".$kodeuser."-".$nomer;
<<<<<<< HEAD
=======
        }
        


>>>>>>> parent of aa3909b... surat jalan
        return response()->json($finalkode);
    }
    public function tampil(){
        $webinfo = DB::table('setting')->limit(1)->get();
        $datakirim = DB::table('resi_pengiriman')
        ->orderby('id','desc')
        ->get();
        return view('resipengiriman/listpengiriman',['datakirim'=>$datakirim,'webinfo'=>$webinfo]);
    }
    public function residarat()
    {
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('resipengiriman/residarat',['webinfo'=>$webinfo]);
    }
    public function carikota(Request $request){
        if($request->has('q')){
            $cari = $request->q;
            
            $data = DB::table('tarif_darat')
                    ->select('tujuan','kode','tarif')
                    ->where('tujuan','like','%'.$cari.'%')
                    ->get();
            
            return response()->json($data);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $simpan = DB::table('resi_pengiriman')
       ->insert([
        'no_resi'       => $request->noresi,
        'id_admin'      => $request->iduser,
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
        'keterangan'    => $request->keterangan
       ]);
        return response()->json($simpan);
    }

<<<<<<< HEAD
=======
    public function simpanlaut(Request $request)
    {

       $simpan = DB::table('resi_pengiriman')
       ->insert([
        'no_resi'       => $request->noresi,
        'id_admin'      => $request->iduser,
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
        'keterangan'    => $request->keterangan
       ]);
        return response()->json($simpan);
    }
>>>>>>> parent of aa3909b... surat jalan
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
