<?php
namespace App\Http\Controllers\backup;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Exports\backupendapatan;
use App\Exports\backuppengeluaran;
use App\Exports\backuppengeluaranlain;
use App\Exports\backupomset;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class backupController extends Controller
{
    public function index(){
    	Session::put('backup_status','n');
    	Session::put('backup_step','1');
    	$webinfo = DB::table('setting')->limit(1)->get();
		return view('backup/index',['title'=>$webinfo]);
    }

    public function tampil(Request $request){

    	
    	$bulan = $request->bulan;
    	$tahun = $request->tahun;
    	$webinfo = DB::table('setting')->limit(1)->get();
    	return view('backup/tampil',['title'=>$webinfo,'bulan'=>$bulan,'tahun'=>$tahun]);
    }
    public function cetakpendapatan(int $bulan,int $tahun){
    	$data = DB::table('resi_pengiriman')
        ->select(DB::raw('tgl,no_resi,no_smu,kode_jalan,admin,nama_barang,pengiriman_via,kota_asal,kode_tujuan,jumlah,berat,dimensi,ukuran_volume,nama_pengirim,telp_pengirim,nama_penerima,telp_penerima,biaya_kirim,biaya_packing,biaya_asuransi,biaya_smu,biaya_karantina,biaya_ppn,total_biaya,metode_bayar,satuan,keterangan'))
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->get();
    	return view('backup/cetakpendapatan',['data'=>$data,'bulan'=>$bulan,'tahun'=>$tahun]);
    }
    
    public function cetakpengeluaran(int $bulan,int $tahun){
    	$data = DB::table('surat_jalan')
       ->select(DB::raw('tgl,kode,tujuan,totalkg,totalkoli,totalcash,totalbt,biaya,alamat_tujuan,admin'))
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->get();
    	return view('backup/cetakpengeluaran',['data'=>$data,'bulan'=>$bulan,'tahun'=>$tahun]);
    }
    public function cetakpengeluaranlain(int $bulan,int $tahun){
    	$data = DB::table('pengeluaran_lain')
       ->select(DB::raw('tgl,kategori,jumlah,keterangan,admin'))
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->get();
    	return view('backup/cetakpengeluaranlain',['data'=>$data,'bulan'=>$bulan,'tahun'=>$tahun]);
    }
    
    public function cetakomset(int $bulan,int $tahun){
        $data = DB::table('omset')
       ->select(DB::raw('bulan,tahun,pemasukan,pengeluaran,pengeluaran_lainya,laba'))
       ->get();
        return view('backup/cetakomset',['data'=>$data,'bulan'=>$bulan,'tahun'=>$tahun]);
    }
    public function exsportpendapatan($bulan, $tahun){
    	$namafile = "backup_pendapatan_bulan_".$bulan."_tahun_".$tahun.".xlsx";
    	return Excel::download(new backupendapatan($bulan,$tahun),$namafile);
    	
    }
    public function exsportpengeluaran($bulan, $tahun){
    	$namafile = "backup_pengeluaran_vendor_bulan_".$bulan."_tahun_".$tahun.".xlsx";
    	return Excel::download(new backuppengeluaran($bulan,$tahun),$namafile);
    }
    public function exsportpengeluaranlain($bulan, $tahun){
    	$namafile = "backup_pengeluaran_lain_bulan_".$bulan."_tahun_".$tahun.".xlsx";
    	return Excel::download(new backuppengeluaranlain($bulan,$tahun),$namafile);
    	
    }
    public function exsportomset($bulan, $tahun){
        $namafile = "backup_omset_bulan_".$bulan."_tahun_".$tahun.".xlsx";
        return Excel::download(new backupomset($bulan,$tahun),$namafile);
    }

    public function hapuspendapatan($bulan, $tahun){
    	$data = DB::table('resi_pengiriman')
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->delete();
    	return back();
    }
    public function hapuspengeluaran($bulan, $tahun){
    	$data = DB::table('surat_jalan')
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->delete();
    	return back();
    }
    public function hapuspengeluaranlain($bulan, $tahun){
        $data = DB::table('pengeluaran_lain')
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->get();
        foreach ($data as $row) {
            if($row->gambar!=''){
                File::delete('img/nota/'.$row->gambar);
            }
        }
        DB::table('pengeluaran_lain')
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->delete();
        return back();
    }
    public function selanjutnya(){
    	$newstep = Session::get('backup_step')+1; 
    	Session::put('backup_step',$newstep);
    	return back();
    }
    public function selesai(){
        return redirect('/dashboard');
    }
}
