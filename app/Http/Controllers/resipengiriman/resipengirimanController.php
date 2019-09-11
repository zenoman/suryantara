<?php
namespace App\Http\Controllers\resipengiriman;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class resipengirimanController extends Controller
{
    public function aksiupdatepembayaran(Request $request){
        if($request->statuslunas=='lunas'){
            $data=[
            'tgl_lunas'=>date('Y-m-d'),
            'total_bayar'=>$request->totalbiaya
            ];    
        }else{
            $total = $request->totalbayar + $request->inputbayar;
            $data=[
            'total_bayar'=>$total
            ];    
        }
    DB::table('resi_pengiriman')
    ->where('id',$request->idresi)
    ->update($data);
    return redirect('updatepembayaranresi');
    }

    //======================================================
    public function carinoresibelumlunas(Request $request){
        if($request->has('q')){
            $cari = $request->q;
            
            $data = DB::table('resi_pengiriman')
                    ->select('no_resi','id')
                    ->where([
                        ['no_resi','like','%'.$cari.'%'],
                        ['id_cabang','=',Session::get('cabang')],
                    ])
                    ->whereNull('tgl_lunas')
                    ->get();
            
            return response()->json($data);
        }
    }

    //====================================================
    public function updatepembayaran(){
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('resipengiriman.updatepembayaran',['webinfo'=>$webinfo]);
    }
    //======================================================
    public function simpancity(Request $request){
        if($request->status_bayar == 'lunas'){
            $tglbayar =date('Y-m-d');
            $totalbayar = $request->total_biaya;
        }else{
            $tglbayar =null;
            $totalbayar = $request->dibayar;
        }

       $simpan = DB::table('resi_pengiriman')
        ->where('id',$request->idresi)
       ->update([
        'admin'      => $request->iduser,
        'nama_barang'   => $request->nama_barang,
        'pengiriman_via'=> 'city kurier',
        'kota_asal'     => $request->kota_asal,
        'kode_tujuan'   => $request->kota_tujuan,
        'tgl'           =>  date('Y-m-d'),
        'tgl_lunas'     => $tglbayar,
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
        'total_bayar'   => $totalbayar,
        'satuan'        => $request->satuan,
        'metode_bayar'  => $request->metode,
        'biaya_ppn'     => $request->ppn,
        'alamat_pengirim'=>$request->alamat_pengirim,
        'alamat_penerima'=>$request->alamat_penerima
       ]);
        return response()->json($simpan);
    }

    //==============================================================
    public function resicitykurier(){
          $webinfo = DB::table('setting')->limit(1)->get();
        return view('resipengiriman/resicitykurier',['webinfo'=>$webinfo]);
    }
    //==============================================================
    public function resicitykuriercmp(){
          $webinfo = DB::table('setting')->limit(1)->get();
        return view('resipengiriman/resicitykuriercmp',['webinfo'=>$webinfo]);
    }
    //=============================================================
    public function listpengirimanbatal(){
        $webinfo = DB::table('setting')->limit(1)->get();
        $datakirim = DB::table('resi_pengiriman')
        ->where([['batal','Y'],['id_cabang','=',Session::get('cabang')],['total_biaya','!=','0']])
        ->orderby('id','desc')
        ->get();
        return view('resipengiriman/pengirimanbatal',['datakirim'=>$datakirim,'webinfo'=>$webinfo]);
    }
    //==============================================================
    public function batalpengiriman($id){
        $dataresi = DB::table('resi_pengiriman')->where('id',$id)->get();
        foreach ($dataresi as $row) {
            $biaya = $row->total_biaya*30/100;
            $biayalama = $row->total_biaya;
            $kodejalan = $row->kode_jalan;
            $metode = $row->metode_bayar;
        }

        if($kodejalan!=''){
        DB::table('resi_pengiriman')
        ->where('id',$id)
        ->update([
            'total_biaya'=>$biaya,
            'biaya_cancel'=>$biayalama,
            'batal'=>'Y',
            'admin'=>Session::get('username')]);

        $datasj = 
        DB::table('surat_jalan')
        ->where('kode',$kodejalan)
        ->get();
        
        if($metode=='cash'){
            foreach ($datasj as $row){
            $biayasj = $row->totalcash;
            $newbiayasj = $biayasj - $biayalama + $biaya;}
    
        DB::table('surat_jalan')
        ->where('kode',$kodejalan)
        ->update([
            'totalcash'=>$newbiayasj
        ]);

        }else{
        foreach($datasj as $row){
            $biayasj = $row->totalbt;
            $newbiayasj = $biayasj - $biayalama + $biaya;}
    
        DB::table('surat_jalan')
        ->where('kode',$kodejalan)
        ->update([
            'totalbt'=>$newbiayasj
        ]);
        }
        }else{
        DB::table('resi_pengiriman')
        ->where('id',$id)
        ->update([
            'total_biaya'=>$biaya,
            'biaya_cancel'=>$biayalama,
            'batal'=>'Y',
            'admin'=>Session::get('username')
        ]);
        }
        
        return back()->with('status','resi berhasil dibatalkan');
    }
    //==================================================================
    public function editdataresi($id){
        $data = DB::table('resi_pengiriman')
        ->where('id',$id)
        ->get();
        $kategori = DB::table('kategori_barang')->get();
        $setting = DB::table('setting')->limit(1)->get();
        return view('resipengiriman/edit',['data'=>$data,'title'=>$setting,'kategori'=>$kategori]);
    }
    //====================================================================
    public function caridataresi(Request $request){
        $cari = $request->cari;
        $datakirim = DB::table('resi_pengiriman')
            ->where([
                ['no_resi','like','%'.$cari.'%'],
                ['batal','=','N'],['id_cabang','=',Session::get('cabang')],
                ['total_biaya','!=','0'],
                ['duplikat','!=','Y']])
            ->orwhere([
                ['tgl','like','%'.$cari.'%'],
                ['batal','=','N'],['id_cabang','=',Session::get('cabang')],
                ['total_biaya','!=','0'],
                ['duplikat','!=','Y']])
            ->orwhere([
                ['pengiriman_via','like','%'.$cari.'%'],
                ['batal','=','N'],
                ['id_cabang','=',Session::get('cabang')],
                ['total_biaya','!=','0'],
                ['duplikat','!=','Y']])
            ->orwhere([
                ['kode_tujuan','like','%'.$cari.'%'],
                ['batal','=','N'],
                ['id_cabang','=',Session::get('cabang')],
                ['total_biaya','!=','0'],
                ['duplikat','!=','Y']])
            ->orwhere([
                ['admin','like','%'.$cari.'%'],
                ['batal','=','N'],
                ['id_cabang','=',Session::get('cabang')],
                ['total_biaya','!=','0'],
                ['duplikat','!=','Y']])
            ->get();
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('resipengiriman/cari',['datakirim'=>$datakirim,'webinfo'=>$webinfo,'cari'=>$cari]);
    }
    //================================================================
    public function caridataresi_smukosong(Request $request){
        $cari = $request->cari;
        $datakirim = DB::table('resi_pengiriman')
            ->where([['no_resi','like','%'.$cari.'%'],['no_smu','=',null],['batal','=','N'],['total_biaya','!=','0'],['id_cabang','=',Session::get('cabang')]])
            ->orwhere([['tgl','like','%'.$cari.'%'],['no_smu','=',null],['batal','=','N'],['total_biaya','!=','0'],['id_cabang','=',Session::get('cabang')]])
            ->orwhere([['pengiriman_via','like','%'.$cari.'%'],['no_smu','=',null],['batal','=','N'],['total_biaya','!=','0'],['id_cabang','=',Session::get('cabang')]])
            ->orwhere([['kode_tujuan','like','%'.$cari.'%'],['no_smu','=',null],['batal','=','N'],['total_biaya','!=','0'],['id_cabang','=',Session::get('cabang')]])
            ->orwhere([['admin','like','%'.$cari.'%'],['no_smu','=',null],['batal','=','N'],['total_biaya','!=','0'],['id_cabang','=',Session::get('cabang')]])
            ->get();
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('resipengiriman/cari_smukosong',['datakirim'=>$datakirim,'webinfo'=>$webinfo,'cari'=>$cari]);
    }
    //===================================================================
    public function tambahnosmu(Request $request){
        DB::table('resi_pengiriman')
        ->where('id',$request->kode)
        ->update([
            'no_smu'=>$request->nosmu
        ]);
        return back()->with('status','No SMU Di Simpan');
    }
    //===================================================================
    public function resiudara(){
    $webinfo = DB::table('setting')->limit(1)->get();
    $kategori = DB::table('kategori_barang')->get();
    return view('resipengiriman/resiudara',['webinfo'=>$webinfo,'kategori'=>$kategori]);
    }
    
    //====================================================================
    public function resikembali($id){
        $data=DB::table('resi_pengiriman')->where('id',$id)->get();
        foreach ($data as $row) {
            $noresi=$row->no_resi;
            $statusp=$row->status_pengiriman;
        }

        //-----------------------------------------
        if($statusp!='paket telah diterima'){
            $jumlahstatus = DB::table('status_pengiriman')->where([['kode','$noresi'],['status','paket telah diterima']])->count();
        if($jumlahstatus==0){
           DB::table('status_pengiriman')
            ->insert([
            'kode'=>$noresi,
            'status'=>'paket telah diterima',
            'tgl'=>date('Y-m-d'),
            'jam'=>date('H:i:s'),
            'lokasi'=>Session::get('kota')
            ]); 
        }
        }
        
        //-----------------------------------------
        DB::table('resi_pengiriman')->where('id',$id)
        ->update([
        'status_antar'=>'Y',
        'status'=>'Y',
        'status_pengiriman'=>'paket telah diterima'
        ]);
        return back()->with('status','Status Berhasil Diubah');
    }
    //===================================================================
    public function carilistresi($id){
        $data = DB::table('resi_pengiriman')
        ->where('id',$id);
        return response()->json($data);
    }
    //==================================================================
    public function carikode(){
        $tanggal    = date('dmy');
        $kodeuser = sprintf("%02s",session::get('id'));
        $lastuser = $tanggal."-".$kodeuser;
        $kode = DB::table('resi_pengiriman')
        ->where([['no_resi','like','%'.$lastuser.'-%'],['metode_input','=','otomatis']])
        ->max('no_resi');

        if(!$kode){
            $finalkode = Session::get('koderesi').$tanggal."-".$kodeuser."-000001";
        }else{
            $newkode    = explode("-", $kode);
            $nomer      = sprintf("%06s",$newkode[2]+1);
            $finalkode  = Session::get('koderesi').$tanggal."-".$kodeuser."-".$nomer;
        }
        return response()->json($finalkode);
    }
    //===================================================================
    public function tampil(){
        $webinfo = DB::table('setting')->limit(1)->get();
        $datakirim = DB::table('resi_pengiriman')
        ->where([
            ['batal','N'],
            ['id_cabang','=',Session::get('cabang')],
            ['total_biaya','!=','0'],
            ['duplikat','!=','Y']
        ])
        ->orderby('id','desc')
        ->paginate(50);
        return view('resipengiriman/listpengiriman',['datakirim'=>$datakirim,'webinfo'=>$webinfo]);
    }
    //===================================================================
    public function tampilsmukosong(){
        $webinfo = DB::table('setting')->limit(1)->get();
        $datakirim = DB::table('resi_pengiriman')
        ->where([
            ['batal','N'],
            ['id_cabang','=',Session::get('cabang')],
            ['total_biaya','!=','0'],
            ['duplikat','!=','Y']
        ])
        ->whereNull('no_smu')
        ->orderby('id','desc')
        ->get();
        return view('resipengiriman/listpengiriman_smukosong',['datakirim'=>$datakirim,'webinfo'=>$webinfo]);
    }
    //===================================================================
    public function residarat()
    {
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('resipengiriman/residarat',['webinfo'=>$webinfo]);
    }
    //===================================================================
    public function resilaut(){
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('resipengiriman/resilaut',['webinfo'=>$webinfo]);
    }
    //===================================================================
    public function carikota(Request $request){
        if($request->has('q')){
            $cari = $request->q;
            
            $data = DB::table('tarif_darat')
                    ->select('tujuan','id')
                    ->where([['tujuan','like','%'.$cari.'%'],['id_cabang','=',Session::get('cabang')],['tarif_city','=','N']])
                    ->get();
            
            return response()->json($data);
        }
    }
    //===================================================================
    public function carikotacity(Request $request){
        if($request->has('q')){
            $cari = $request->q;
            
            $data = DB::table('tarif_darat')
                    ->select('tujuan','id')
                    ->where([['tujuan','like','%'.$cari.'%'],['id_cabang','=',Session::get('cabang')],['tarif_city','=','Y'],['company','=','N']])
                    ->get();
            
            return response()->json($data);
        }
    }
    //===================================================================
    public function carikotacitycmd(Request $request){
        if($request->has('q')){
            $cari = $request->q;
            
            $data = DB::table('tarif_darat')
                    ->select('tujuan','id')
                    ->where([['tujuan','like','%'.$cari.'%'],['id_cabang','=',Session::get('cabang')],['tarif_city','=','Y'],['company','=','Y']])
                    ->get();
            
            return response()->json($data);
        }
    }
    //===================================================================
    public function carihasilkota($id){
        $data = DB::table('tarif_darat')
                    ->select('tujuan','id','tarif')
                    ->where('id',$id)
                    ->get();
            
            return response()->json($data);
    }
    //===================================================================
    public function carilaut(Request $request){
        if($request->has('q')){
            $cari = $request->q;
            
            $data = DB::table('tarif_laut')
                    ->select('tujuan','id')
                    ->where([['tujuan','like','%'.$cari.'%'],['id_cabang','=',Session::get('cabang')]])
                    ->get();
            
            return response()->json($data);
        }
    }
    //===================================================================
    public function cariudara(Request $request){
       if($request->has('q')){
            $cari = $request->q;
            $data = DB::table('tarif_udara')
                    ->select('tujuan','id','airlans')
                    ->where([['tujuan','like','%'.$cari.'%'],['id_cabang','=',Session::get('cabang')]])
                    ->get();
            return response()->json($data);
        } 
    }
    //===================================================================
    public function carihasiludara($id){
        $data = DB::table('tarif_udara')
                    ->where('id',$id)
                    ->get();
            
            return response()->json($data);
    }
    //===================================================================
    public function carihasillaut($id){
         $data = DB::table('tarif_laut')
                    ->select('tujuan','id','tarif')
                    ->where('id',$id)
                    ->get();
            
            return response()->json($data);
    }
    //===================================================================
    public function tambahcity(Request $request){
        if($request->status_bayar == 'lunas'){
            $tglbayar =date('Y-m-d');
            $totalbayar = $request->total_biaya;
        }else{
            $tglbayar =null;
            $totalbayar = $request->dibayar;
        }

        $data = [
            'no_resi'           => $request->noresi,
            'admin'             => $request->iduser,
            'nama_barang'       => $request->nama_barang,
            'pengiriman_via'    => 'city kurier',
            'kota_asal'         => $request->kota_asal,
            'kode_tujuan'       => $request->kota_tujuan,
            'tgl'               => date('Y-m-d'),
            'jumlah'            => $request->jumlah,
            'berat'             => $request->berat,
            'dimensi'           => $request->dimensi,
            'ukuran_volume'     => $request->ukuran_volume,
            'nama_pengirim'     => $request->n_pengirim,
            'nama_penerima'     => $request->n_penerima,
            'telp_pengirim'     => $request->t_pengirim,
            'telp_penerima'     => $request->t_penerima,
            'biaya_kirim'       => $request->biaya_kirim,
            'biaya_packing'     => $request->biaya_packing,
            'biaya_asuransi'    => $request->biaya_asu,
            'total_biaya'       => $request->total_biaya,
            'total_bayar'       => $totalbayar,
            'satuan'            => $request->satuan,
            'metode_bayar'      => $request->metode,
            'biaya_ppn'         => $request->ppn,
            'alamat_pengirim'   => $request->alamat_pengirim,
            'alamat_penerima'   => $request->alamat_penerima,
            'tgl_lunas'         => $tglbayar,
            'id_cabang'         => Session::get('cabang'),
            'status_pengiriman' => 'barang diterima KLC Cabang '.Session::get('kota')
        ];

        $jumlah = DB::table('resi_pengiriman')
        ->where('no_resi',$request->noresi)
        ->count();
        
        if($jumlah > 0){
            $simpan = DB::table('resi_pengiriman')
            ->where('no_resi',$request->noresi)
            ->update($data);
        }else{
            $simpan = DB::table('resi_pengiriman')
            ->insert($data);
        }

        DB::table('status_pengiriman')
        ->insert([
            'kode'      =>$request->noresi,
            'status'    =>'barang diterima KLC Cabang '.Session::get('kota'),
            'tgl'       =>date('Y-m-d'),
            'jam'       =>date('H:i:s'),
            'lokasi'    =>Session::get('kota')
        ]);
        return response()->json($simpan);   
    }
    //===================================================================
    public function tambahcitycmp(Request $request){
        if($request->status_bayar == 'lunas'){
            $tglbayar =date('Y-m-d');
            $totalbayar = $request->total_biaya;
        }else{
            $tglbayar =null;
            $totalbayar = $request->dibayar;
        }

        $data = [
            'no_resi'           => $request->noresi,
            'admin'             => $request->iduser,
            'nama_barang'       => $request->nama_barang,
            'pengiriman_via'    => 'city kurier',
            'kota_asal'         => $request->kota_asal,
            'kode_tujuan'       => $request->kota_tujuan,
            'tgl'               => date('Y-m-d'),
            'jumlah'            => $request->jumlah,
            'berat'             => $request->berat,
            'dimensi'           => $request->dimensi,
            'ukuran_volume'     => $request->ukuran_volume,
            'nama_pengirim'     => $request->n_pengirim,
            'nama_penerima'     => $request->n_penerima,
            'telp_pengirim'     => $request->t_pengirim,
            'telp_penerima'     => $request->t_penerima,
            'biaya_kirim'       => $request->biaya_kirim,
            'biaya_packing'     => $request->biaya_packing,
            'biaya_asuransi'    => $request->biaya_asu,
            'total_biaya'       => $request->total_biaya,
            'total_bayar'       => $totalbayar,
            'satuan'            => $request->satuan,
            'metode_bayar'      => $request->metode,
            'biaya_ppn'         => $request->ppn,
            'alamat_pengirim'   => $request->alamat_pengirim,
            'alamat_penerima'   => $request->alamat_penerima,
            'tgl_lunas'         => $tglbayar,
            'id_cabang'         => Session::get('cabang'),
            'status_company'	=> 'Y',
            'status_pengiriman' => 'barang diterima KLC Cabang '.Session::get('kota')
        ];

        $jumlah = DB::table('resi_pengiriman')
        ->where('no_resi',$request->noresi)
        ->count();
        
        if($jumlah > 0){
            $simpan = DB::table('resi_pengiriman')
            ->where('no_resi',$request->noresi)
            ->update($data);
        }else{
            $simpan = DB::table('resi_pengiriman')
            ->insert($data);
        }
        
        DB::table('status_pengiriman')
        ->insert([
            'kode'=>$request->noresi,
            'status'=>'barang diterima KLC Cabang '.Session::get('kota'),
            'tgl'=>date('Y-m-d'),
            'jam'=>date('H:i:s'),
            'lokasi'=>Session::get('kota')
        ]);
        return response()->json($simpan);   
    }
    //===================================================================
    public function store(Request $request)
    {
        if($request->status_bayar == 'lunas'){
            $tglbayar =date('Y-m-d');
            $totalbayar = $request->total_biaya;
        }else{
            $tglbayar =null;
            $totalbayar = $request->dibayar;
        }
        $data = [
            'no_resi'       => $request->noresi,
            'admin'         => $request->iduser,
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
            'total_bayar'   => $totalbayar,
            'satuan'        => $request->satuan,
            'metode_bayar'  => $request->metode,
            'biaya_ppn'     => $request->ppn,
            'alamat_pengirim'=>$request->alamat_pengirim,
            'alamat_penerima'=>$request->alamat_penerima,
            'tgl_lunas' => $tglbayar,
            'id_cabang'=>Session::get('cabang'),
            'status_pengiriman'=>'barang diterima KLC Cabang '.Session::get('kota')
        ];

        $jumlah = DB::table('resi_pengiriman')
        ->where('no_resi',$request->noresi)
        ->count();
        
        if($jumlah > 0){
            $simpan = DB::table('resi_pengiriman')
            ->where('no_resi',$request->noresi)
            ->update($data);
        }else{
            $simpan = DB::table('resi_pengiriman')
            ->insert($data);
        }

        DB::table('status_pengiriman')
        ->insert([
            'kode'=>$request->noresi,
            'status'=>'barang diterima KLC Cabang '.Session::get('kota'),
            'tgl'=>date('Y-m-d'),
            'jam'=>date('H:i:s'),
            'lokasi'=>Session::get('kota')
        ]);

        return response()->json($simpan);
    }
    //===================================================================
    public function simpanlaut(Request $request)
    {
        if($request->status_bayar == 'lunas'){
            $tglbayar =date('Y-m-d');
            $totalbayar = $request->total_biaya;
        }else{
            $tglbayar =null;
            $totalbayar = $request->dibayar;
        }
        
        $data = [
            'no_resi'       => $request->noresi,
            'admin'         => $request->iduser,
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
            'total_bayar'   => $totalbayar,
            'satuan'        => $request->satuan,
            'metode_bayar'  => $request->metode,
            'biaya_ppn'     => $request->ppn,
            'alamat_pengirim'=>$request->alamat_pengirim,
            'alamat_penerima'=>$request->alamat_penerima,
            'tgl_lunas' => $tglbayar,
            'id_cabang'=>Session::get('cabang'),
            'status_pengiriman'=>'barang diterima KLC Cabang '.Session::get('kota')
        ];

        $jumlah = DB::table('resi_pengiriman')
        ->where('no_resi',$request->noresi)
        ->count();

        if ($jumlah > 0) {
            $simpan = DB::table('resi_pengiriman')
            ->where('no_resi',$request->noresi)
            ->update($data);
        }else{
                $simpan = DB::table('resi_pengiriman')
                ->insert($data);
        }

        DB::table('status_pengiriman')
        ->insert([
            'kode'=>$request->noresi,
            'status'=>'barang diterima KLC Cabang '.Session::get('kota'),
            'tgl'=>date('Y-m-d'),
            'jam'=>date('H:i:s'),
            'lokasi'=>Session::get('kota')
        ]);
        return response()->json($simpan);
    }
    //===================================================================
     public function simpanudara(Request $request)
    {
        if($request->status_bayar == 'lunas'){
            $tglbayar =date('Y-m-d');
            $totalbayar = $request->total_biaya;
        }else{
            $tglbayar =null;
            $totalbayar = $request->dibayar;
        }
        
        $data = [
            'no_resi'       => $request->noresi,
            'admin'         => $request->iduser,
            'nama_barang'   => $request->nama_barang,
            'pengiriman_via'=> 'udara',
            'kota_asal'     => $request->kota_asal,
            'kode_tujuan'   => $request->kota_tujuan,
            'tgl'           =>  date('Y-m-d'),
            'jumlah'        => $request->jumlah,
            'total_berat_udara'  => $request->berat,
            'berat'  => $request->subberat,
            'maskapai_udara'    => $request->maskapai,
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
            'total_bayar'   => $totalbayar,
            'satuan'        => $request->satuan,
            'metode_bayar'  => $request->metode,
            'biaya_ppn'     => $request->ppn,
            'alamat_pengirim'=>$request->alamat_pengirim,
            'alamat_penerima'=>$request->alamat_penerima,
            'tgl_lunas' => $tglbayar,
            'id_cabang'=>Session::get('cabang'),
            'status_pengiriman'=>'barang diterima KLC Cabang '.Session::get('kota')
        ];

        $jumlah = DB::table('resi_pengiriman')
        ->where('no_resi',$request->noresi)
        ->count();
        
        if ($jumlah > 0) {
            $simpan = DB::table('resi_pengiriman')
            ->where('no_resi',$request->noresi)
            ->update($data);
        }else{
            $simpan = DB::table('resi_pengiriman')
            ->insert($data); 
        }

        DB::table('status_pengiriman')
        ->insert([
            'kode'=>$request->noresi,
            'status'=>'barang diterima KLC Cabang '.Session::get('kota'),
            'tgl'=>date('Y-m-d'),
            'jam'=>date('H:i:s'),
            'lokasi'=>Session::get('kota')
        ]);
        return response()->json($simpan);
    }
    //===================================================================
    public function simpanubahlaut(Request $request){
        if($request->status_bayar == 'lunas'){
            $tglbayar =date('Y-m-d');
            $totalbayar = $request->total_biaya;
        }else{
            $tglbayar =null;
            $totalbayar = $request->dibayar;
        }
        $simpan = DB::table('resi_pengiriman')
        ->where('id',$request->idresi)
       ->update([
        'admin'      => $request->iduser,
        'nama_barang'   => $request->nama_barang,
        'pengiriman_via'=> 'laut',
        'kota_asal'     => $request->kota_asal,
        'kode_tujuan'   => $request->kota_tujuan,
        'tgl'           =>  date('Y-m-d'),
        'tgl_lunas'     =>  $tglbayar,
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
        'total_bayar'   => $totalbayar,
        'satuan'        => $request->satuan,
        'metode_bayar'  => $request->metode,
        'biaya_ppn'     => $request->ppn,
        'alamat_pengirim'=>$request->alamat_pengirim,
        'alamat_penerima'=>$request->alamat_penerima
       ]);
        return response()->json($simpan);
    }

    public function simpanubahdarat(Request $request){
        if($request->status_bayar == 'lunas'){
            $tglbayar =date('Y-m-d');
            $totalbayar = $request->total_biaya;
        }else{
            $tglbayar =null;
            $totalbayar = $request->dibayar;
        }
        $simpan = DB::table('resi_pengiriman')
        ->where('id',$request->idresi)
       ->update([
        'admin'      => $request->iduser,
        'nama_barang'   => $request->nama_barang,
        'pengiriman_via'=> 'darat',
        'kota_asal'     => $request->kota_asal,
        'kode_tujuan'   => $request->kota_tujuan,
        'tgl'           =>  date('Y-m-d'),
        'tgl_lunas'     => $tglbayar,
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
        'total_bayar'   => $totalbayar,
        'satuan'        => $request->satuan,
        'metode_bayar'  => $request->metode,
        'biaya_ppn'     => $request->ppn,
        'alamat_pengirim'=>$request->alamat_pengirim,
        'alamat_penerima'=>$request->alamat_penerima
       ]);
        return response()->json($simpan);
    }
    public function simpanubahudara(Request $request){
        if($request->status_bayar == 'lunas'){
            $tglbayar =date('Y-m-d');
            $totalbayar = $request->total_biaya;
        }else{
            $tglbayar =null;
            $totalbayar = $request->dibayar;
        }
        $simpan = DB::table('resi_pengiriman')
       ->where('id',$request->idresi)
       ->update([
        'admin'      => $request->iduser,
        'nama_barang'   => $request->nama_barang,
        'pengiriman_via'=> 'udara',
        'kota_asal'     => $request->kota_asal,
        'kode_tujuan'   => $request->kota_tujuan,
        'tgl'           =>  date('Y-m-d'),
        'tgl_lunas'     => $tglbayar,
        'jumlah'        => $request->jumlah,
        'berat'         => $request->subberat,
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
        'total_bayar'   => $totalbayar,
        'satuan'        => $request->satuan,
        'metode_bayar'  => $request->metode,
        'biaya_ppn'     => $request->ppn,
        'no_smu'        => $request->nosmu,
        'biaya_charge'  =>$request->charge,
        'alamat_pengirim'=>$request->alamat_pengirim,
        'alamat_penerima'=>$request->alamat_penerima,
        'maskapai_udara'=>$request->maskapai,
        'total_berat_udara'=>$request->berat
       ]);
        return response()->json($simpan);
    }
}
