<?php

namespace App\Http\Controllers\penerimaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class penerimaancontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function paketditerima(Request $request){
       $dataresi = DB::table('resi_pengiriman')->where('id',$request->idresi)->get();
        foreach ($dataresi as $row){
            $data = [
            'kode'=>$row->no_resi,
            'status'=>'barang sampai di KLC Cabang '.Session::get('kota'),
            'tgl'=>date('Y-m-d'),
            'jam'=>date('H:i:s'),
            'lokasi'=>Session::get('kota')
            ];

            $data2 = [
                    'no_resi'       => $row->no_resi,
                    'admin'         => $row->admin,
                    'nama_barang'   => $row->nama_barang,
                    'pengiriman_via'=> $row->pengiriman_via,
                    'kota_asal'     => $row->kota_asal,
                    'kode_tujuan'   => $row->kode_tujuan,
                    'tgl'           => $row->tgl,
                    'jumlah'        => $row->jumlah,
                    'berat'         => $row->berat,
                    'dimensi'       => $row->dimensi,
                    'ukuran_volume' => $row->ukuran_volume,
                    'nama_pengirim' => $row->nama_pengirim,
                    'nama_penerima' => $row->nama_penerima,
                    'telp_pengirim' => $row->telp_pengirim,
                    'telp_penerima' => $row->telp_penerima,
                    'biaya_kirim'   => $row->biaya_kirim,
                    'biaya_smu'     => $row->biaya_smu,
                    'biaya_packing' => $row->biaya_packing,
                    'biaya_asuransi'=> $row->biaya_asuransi,
                    'biaya_karantina' => $row->biaya_karantina,
                    'total_biaya'   => $row->total_biaya,
                    'satuan'        => $row->satuan,
                    'metode_bayar'  => $row->metode_bayar,
                    'biaya_ppn'     => $row->biaya_ppn,
                    'no_smu'        => $row->no_smu,
                    'biaya_charge'  =>$row->biaya_charge,
                    'alamat_pengirim'=>$row->alamat_pengirim,
                    'alamat_penerima'=>$row->alamat_penerima,
                    'tgl_lunas' => $row->tgl_lunas,
                    'status' => $row->status,
                    'id_cabang'=>Session::get('cabang'),
                    'status_pengiriman'=>'barang diterima KLC Cabang '.Session::get('kota'),
                    'duplikat'=>'Y'
            ];
            $kodejalanya = $row->kode_jalan;
        }

        DB::table('resi_pengiriman')
        ->insert($data2);
        
        DB::table('resi_pengiriman')
        ->where('id',$request->idresi)
        ->update([
            'duplikat'=>'S'
        ]);

        DB::table('status_pengiriman')
        ->insert($data);

        DB::table('resi_pengiriman')
        ->where('kode_jalan',$request->idresi)
        ->update([
            'status_pengiriman'=>'barang diterima KLC Cabang '.Session::get('kota')
        ]);

         $jumlah = DB::table('resi_pengiriman')
            ->where([['kode_jalan','=',$kodejalanya],['duplikat','=','N']])
            ->count();
            if($jumlah == 0){
                DB::table('surat_jalan')
                ->where('kode',$kodejalanya)
                ->update([
                    'status_pengiriman'=>'Y'
                ]);
            }
        return back()->with('status','Perubahan Disimpan');
    }
    //================================================
    public function cariresi(Request $request){
        if($request->has('q')){
            $cari = $request->q;
            $data = DB::table('resi_pengiriman')
                    ->select('resi_pengiriman.no_resi','resi_pengiriman.id')
                    ->leftjoin('surat_jalan','surat_jalan.kode','=','resi_pengiriman.kode_jalan')
                    ->where([
                        ['resi_pengiriman.no_resi','like','%'.$cari.'%'],
                        ['resi_pengiriman.batal','=','N'],
                        ['resi_pengiriman.duplikat','=','N'],
                        ['surat_jalan.id_cabang_tujuan','=',Session::get('cabang')]
                    ])
                    ->get();
            return response()->json($data);
        }
    }
    //===================================================================
    public function inputpenerimaan(){
          $webinfo = DB::table('setting')->limit(1)->get();
        return view('penerimaan.inputpenerimaan',['webinfo'=>$webinfo]);
    }
    //======================================================================
    public function index(){
    	$webinfo = DB::table('setting')->limit(1)->get();
        $datakirim = DB::table('resi_pengiriman')
        ->where([
            ['id_cabang','=',Session::get('cabang')],
            ['total_biaya','!=','0'],
            ['duplikat','=','Y']
        ])
        ->orderby('id','desc')
        ->paginate(50);
        return view('penerimaan/listpenerimaan',['datakirim'=>$datakirim,'webinfo'=>$webinfo]);
    }
    //========================================================================
    public function terima($kode){
    	$dataresi = DB::table('resi_pengiriman')->where('kode_jalan',$kode)->get();
        foreach ($dataresi as $row) {
            $data[] = [
            'kode'=>$row->no_resi,
            'status'=>'barang sampai di KLC Cabang '.Session::get('kota'),
            'tgl'=>date('Y-m-d'),
            'jam'=>date('H:i:s'),
            'lokasi'=>Session::get('kota')
            ];

            $data2[] = [
            		'no_resi'		=> $row->no_resi,
            		'admin'         => $row->admin,
                    'nama_barang'   => $row->nama_barang,
                    'pengiriman_via'=> $row->pengiriman_via,
                    'kota_asal'     => $row->kota_asal,
                    'kode_tujuan'   => $row->kode_tujuan,
                    'tgl'           => $row->tgl,
                    'jumlah'        => $row->jumlah,
                    'berat'         => $row->berat,
                    'dimensi'       => $row->dimensi,
                    'ukuran_volume' => $row->ukuran_volume,
                    'nama_pengirim' => $row->nama_pengirim,
                    'nama_penerima' => $row->nama_penerima,
                    'telp_pengirim' => $row->telp_pengirim,
                    'telp_penerima' => $row->telp_penerima,
                    'biaya_kirim'   => $row->biaya_kirim,
                    'biaya_smu'     => $row->biaya_smu,
                    'biaya_karantina' => $row->biaya_karantina,
                    'total_biaya'   => $row->total_biaya,
                    'satuan'        => $row->satuan,
                    'metode_bayar'  => $row->metode_bayar,
                    'biaya_ppn'     => $row->biaya_ppn,
                    'no_smu'        => $row->no_smu,
                    'biaya_charge'  =>$row->biaya_charge,
                    'alamat_pengirim'=>$row->alamat_pengirim,
                    'alamat_penerima'=>$row->alamat_penerima,
                    'tgl_lunas' => $row->tgl_lunas,
                    'status' => $row->status,
                    'id_cabang'=>Session::get('cabang'),
                    'status_pengiriman'=>'barang diterima KLC Cabang '.Session::get('kota'),
                    'duplikat'=>'Y'
            ];
        }
        DB::table('resi_pengiriman')
        ->insert($data2);

        DB::table('status_pengiriman')
        ->insert($data);

        DB::table('resi_pengiriman')
        ->where('kode_jalan',$kode)
        ->update([
            'status_pengiriman'=>'barang diterima KLC Cabang '.Session::get('kota')
        ]);

        DB::table('surat_jalan')
        ->where('kode',$kode)
        ->update([
            'status_pengiriman'=>'Y'
        ]);
        return back()->with('status','Perubahan Disimpan');
    }
}
