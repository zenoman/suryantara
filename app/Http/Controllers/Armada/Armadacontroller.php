<?php

namespace App\Http\Controllers\Armada;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Armadacontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function caripajakunit($id){
        $data = DB::table('pajak_armada')->where('id_armada',$id)->get();

        return response()->json($data);
    }
    //========================================================
    public function hapuspajakunit($id){
    DB::table('pajak_armada')
        ->where('id',$id)
        ->delete();
        return back()->with('status','Data Berhasil Dihapus');
    }
    //=======================================================
    public function tambahpajakunit(Request $request){
        DB::table('pajak_armada')
        ->insert([
            'id_armada'=>$request->idunit,
            'nama_pajak'=>$request->namapajak
        ]);
        return back()->with('status','Data Berhasil Disimpan');
    }
    //=============================================================
    public function editpajakunit(Request $request){
        DB::table('pajak_armada')
        ->where('id',$request->idpajak)
        ->update([
            'nama_pajak'=>$request->namapajak
        ]);
        return back()->with('status','Data Berhasil Di edit');
    }
    //=============================================================
    public function aksibayarpajak(Request $request){
        $idc=Session::get('cabang');
        $bul=date('n');
        $th=date('Y');
        $admin=Session::get('nama');
        $idarm=$request->idarm;
        $tk = date('Y-m-d', strtotime('-7 day', strtotime($request->tglkadaluarsa)));
        // ==================================================================================
        if($request->hasFile('gambar')){
            $namagambar=$request->file('gambar')->
            getClientOriginalname();
            $idarm=$request->idarm;
            $lower_file_name=strtolower($namagambar);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $namagambar=time().'-'.$replace_space;
            //$destination=base_path('../public_html/img/nota');
            $destination=public_path().'/img/nota/';
            $request->file('gambar')->move($destination,$namagambar);
            
            // DB::table('pengeluaran_lain')
            // ->insert([
            //     'admin'=>Session::get('username'),
            //     'kategori'=>'004',
            //     'keterangan'=>$request->keterangan,
            //     'jumlah'=>$request->total,
            //     'tgl'=>$request->tglbayar,
            //     'gambar'=>$namagambar
            // ]);
            // simpan ke pajak kendaraan 
            
            $data=[$idarm,$request->tglbayar,$bul,$th,$request->total,$namagambar,$request->keterangan,$admin,$idc];
            $bpajak=DB::insert('insert into pajak_kendaraan(idarmada,tgl,bulan,tahun,nominal,bukti,keterangan,admin,id_cabang) values(?,?,?,?,?,?,?,?,?)',$data);
            // simpan ke neraca
            $nr=DB::insert('insert into neraca(bulan,tahun,keterangan,kredit,admin,id_cabang) values(?,?,?,?,?,?)',[$bul,$th,$request->keterangan,$request->total,$admin,$idc]);
            // ========================================
            DB::table('pajak_armada')   
            ->where('id',$request->pajak)
            ->update([
                'tgl_bayar'=>$request->tglbayar,
                'tgl_kadaluarsa'=>$request->tglkadaluarsa,
                'tgl_peringatan'=>$tk
            ]);

        }else{
            // DB::table('pengeluaran_lain')
            // ->insert([
            //     'admin'=>Session::get('username'),
            //     'kategori'=>'004',
            //     'keterangan'=>$request->keterangan,
            //     'jumlah'=>$request->total,
            //     'tgl'=>$request->tglbayar
            // ]);
            // ================================================
            $data=[$idarm,$request->tglbayar,$bul,$th,$namagambar,$request->keterangan,$admin,$idc];
            $bpajak=DB::insert('insert into pajak_kendaraan(idarmada,tgl,bulan,tahun,bukti,keterangan,admin,id_cabang) values(?,?,?,?,?,?,?,?)',$data);
            // simpan ke neraca
            $nr=DB::insert('insert into neraca(bulan,tahun,keterangan,kredit,admin,id_cabang) values(?,?,?,?,?,?)',[$bul,$th,$request->keterangan,$request->total,$admin,$idc]);
            // ================================================
            DB::table('armada')
            ->where('id',$request->kodeunit)
            ->update([
                'tgl_bayar'=>$request->tglbayar,
                'tgl_kadaluarsa'=>$request->tglkadaluarsa,
                'tgl_peringatan'=>$tk
            ]);
        }

        return redirect('/armada')->with('status','Berhasil Menambah Data');
    }
    //========================================================
    public function bayarpajak($id){
        $webset = DB::table('setting')->limit(1)->get();
        $data = DB::table('armada')->where('id',$id)->get();
        $datapajak = DB::table('pajak_armada')->where('id_armada',$id)->get();
        return view('Armada/bayarpajak',['title'=>$webset,'armada'=>$data,'datapajak'=>$datapajak]);
    }
    //===========================================================
    public function index(){
    	$webset = DB::table('setting')->limit(1)->get();
    	$data = DB::table('armada')
        ->select(DB::raw('armada.*,cabang.nama as namacabang'))
        ->leftjoin('cabang','cabang.id','=','armada.id_cabang')
        ->orderby('armada.id','desc')->get();
    	return view('Armada/index',['title'=>$webset,'armada'=>$data]);
    }
    //=================================================================
    public function create(){
    	$webset = DB::table('setting')->limit(1)->get();
        $cabang = DB::table('cabang')->get();
    	return view('Armada/create',['title'=>$webset,'cabang'=>$cabang]);
    }
    //=================================================================
    public function store(Request $request){

    	DB::table('armada')
    	->insert([
    		'nama'			=> $request->nama,
    		'nopol'			=> $request->nopol,
    		'nomor_rangka'	=> $request->norangka,
    		'nomor_mesin'	=> $request->nomesin,
    		'warna'			=> $request->warna,
            'id_cabang'     => $request->cabang
    	]);

        $data=$request->pajak;
        for ($i=0; $i < count($data) ; $i++){ 
            if($i == count($data)-1){
                $final = $data[$i];
            }else{
                $final = $data[$i];
            }
        $idarmada = DB::getPdo()->lastInsertId();
        DB::table('pajak_armada')
        ->insert([
            'id_armada' =>$idarmada,
            'nama_pajak' => $final,
            ]);
        }
    	return redirect('armada')->with('status','Data Berhasil Di simpan');
    }
    //====================================================================
    public function edit($id){
    	$data = DB::table('armada')->where('id',$id)->get();
        $datapajak = DB::table('pajak_armada')->where('id_armada',$id)->get();
        $cabang = DB::table('cabang')->get();
    	$webset = DB::table('setting')->limit(1)->get();
    	return view('Armada/edit',['armada'=>$data,'title'=>$webset,'datapajak'=>$datapajak,'cabang'=>$cabang]);
    }
    //==================================================================
    public function update($id, Request $request){
    	$data = DB::table('armada')
    	->where('id',$request->id)
    	->update([
    		'nama'			=> $request->nama,
    		'nopol'			=> $request->nopol,
    		'nomor_rangka'	=> $request->norangka,
    		'nomor_mesin'	=> $request->nomesin,
    		'warna'			=> $request->warna,
            'id_cabang'     => $request->cabang
    	]);

    return redirect('armada')->with('status','Data Berhasil Di edit');
    }
    //=====================================================================
    public function delete($id){
    	DB::table('armada')->where('id',$id)->delete();
        DB::table('pajak_armada')->where('id_armada',$id)->delete();
    	return redirect('armada')->with('status','Data Berhasil Di hapus');
    }

}
