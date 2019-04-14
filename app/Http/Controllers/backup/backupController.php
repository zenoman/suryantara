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
use App\Exports\backupgajikaryawan;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;

class backupController extends Controller
{
    public function index(){
        if (Session::get('level') !='admin') {
            Session::put('backup_status','n');
        Session::put('backup_step','1');
        $webinfo = DB::table('setting')->limit(1)->get();
        return view('backup/index',['title'=>$webinfo]);
        }else{
            return redirect('/dashboard');
        }
    	
    }

    public function tampil(Request $request){

    	
    	$bulan = $request->bulan;
    	$tahun = $request->tahun;
    	$webinfo = DB::table('setting')->limit(1)->get();
    	return view('backup/tampil',['title'=>$webinfo,'bulan'=>$bulan,'tahun'=>$tahun]);
    }
    public function cetakpendapatan(int $bulan,int $tahun){
    	$data = DB::table('resi_pengiriman')
        ->select(DB::raw('tgl,no_resi,no_smu,kode_jalan,admin,nama_barang,pengiriman_via,kota_asal,kode_tujuan,jumlah,berat,dimensi,ukuran_volume,nama_pengirim,telp_pengirim,nama_penerima,telp_penerima,biaya_kirim,biaya_packing,biaya_asuransi,biaya_smu,biaya_karantina,biaya_ppn,total_biaya,metode_bayar,satuan,keterangan,biaya_charge,batal'))
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->get();
    	return view('backup/cetakpendapatan',['data'=>$data,'bulan'=>$bulan,'tahun'=>$tahun]);
    }
    
    public function cetakpengeluaran(int $bulan,int $tahun){
    	$data = DB::table('resi_pengiriman')
            ->select(DB::raw('resi_pengiriman.*,surat_jalan.tujuan,surat_jalan.kode,surat_jalan.biaya'))
            ->leftjoin('surat_jalan','surat_jalan.kode','=','resi_pengiriman.kode_jalan')
            ->where('resi_pengiriman.tgl_bayar','!=',NULL)
            ->whereMonth('tgl_bayar',$bulan)
            ->whereYear('tgl_bayar',$tahun)
            ->orderby('tgl_bayar','desc')
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
    public function cetakgjkw(int $bulan,int $tahun){
        $data = DB::table('gaji_karyawan')
        ->select(DB::raw('
                gaji_karyawan.kode_karyawan,
                gaji_karyawan.nama_karyawan,
                jabatan.jabatan,
                gaji_karyawan.gaji_pokok,
                gaji_karyawan.uang_makan,
                gaji_karyawan.gaji_tambahan,
                gaji_karyawan.total,
                gaji_karyawan.bulan,
                gaji_karyawan.tahun'))
            ->join('jabatan','jabatan.id','=','gaji_karyawan.id_jabatan')
       ->get();
        return view('backup/cetakgjkw',['data'=>$data,'bulan'=>$bulan,'tahun'=>$tahun]);
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
    public function exsporgjkw($bulan, $tahun){
        $namafile = "Backup Gaji Karyawan bulan ".$bulan." tahun ".$tahun.".xlsx";
        return Excel::download(new backupgajikaryawan($bulan,$tahun),$namafile);
    }

    public function hapuspendapatan($bulan, $tahun){
    	$data = DB::table('resi_pengiriman')
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->delete();
    	return back()->with('status','Data Pendapatan Berhasil Dihapus');
    }
    public function hapuspengeluaran($bulan, $tahun){
    	$data = DB::table('surat_jalan')
        ->whereMonth('tgl',$bulan)
        ->whereYear('tgl',$tahun)
        ->delete();
    	return back()->with('status','Data Pengeluaran Vendor Berhasil Dihapus');
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
        return back()->with('status','Data Pengeluaran Lain Berhasil Di hapus');
    }
    public function hapusgjkw($bulan, $tahun){
        $data = DB::table('gaji_karyawan')
        ->where([['gaji_karyawan.bulan','=',$bulan],['gaji_karyawan.tahun','=',$tahun]])
        ->delete();
        return back()->with('status','Data Pengeluaran Gaji Karyawan Berhasil Dihapus');
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
