<?php
namespace App\Http\Controllers\Labarugi;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\models\Laporakudetnmodel;

use App\Exports\AbsensiharianExport;
use App\Exports\AbsensibulananExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\File;
class LabarugiController extends Controller
{

    public function pilihlapkun()
    {
        $setting = DB::table('setting')->get();
        $kategori = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama,tb_kategoriakutansi.kode'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->groupby('pengeluaran_lain.kategori')
            ->get();
        
        return view('labarugi/pilihlabarugi',['title'=>$setting,'kate'=>$kategori]);
    }

    public function tampilakunlapor(Request $request){
        $rules = [
            'tgl' => 'required',
            'tgl0' => 'required',
            'kategori' => 'required',
                ];
         $customMessages = [
        'required'  => 'Maaf, Bulan Tidak Bokeh Kosong',
         ];
        $this->validate($request,$rules,$customMessages);
        $kate=$request->kategori;
        $tgl = $request->tgl;
        $tgl0 = $request->tgl0;
        $tgll= $tgl. "Sampai" .$tgl0;

            $data = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('pengeluaran_lain.kategori','=',$kate)
            ->paginate(40);
            $totdat= DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('pengeluaran_lain.kategori','=',$kate)
            ->get();

            $data0 =DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('tb_kategoriakutansi.status','=','pendapatan')
            ->paginate(40);
            $totdat0 = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('tb_kategoriakutansi.status','=','pendapatan')
            ->get();
        // dd($tgll);
        // $hass= $data0 - $data;

        $webinfo = DB::table('setting')->limit(1)->get();
    return view('labarugi/laporlabarugi',['tot0'=>$totdat0,'tot'=>$totdat,'data'=>$data,'data0'=>$data0,'title'=>$webinfo,'tgl'=>$tgll]);
    // return view('labarugi/laporlabarugi',['data0'=>$data0,'data'=>$data,'title'=>$webinfo]);
    }

        public function exsportabsensibulanan($tanggal, $jabatan){

            $namafile = "Export absensi bulanan pada bulan ".$tanggal.".xlsx";
        return Excel::download(new AbsensibulananExport($tanggal,$jabatan),$namafile);
    }

        public function cetakabsensibulanan($tanggal,$kodejabatan){
        $bulan = explode('-', $tanggal);
        $thn = $bulan[0];
        $bln = $bulan[1];
        $namajabatan =$kodejabatan;
        
        if($namajabatan=='semua'){
            $idjabatan = 'semua';
            $jabat = 'semua';
            $data = DB::table('absensi')
            ->select(DB::raw('absensi.*,jabatan.jabatan,karyawan.nama,karyawan.kode'))
            ->leftjoin('jabatan','jabatan.id','=','absensi.id_jabatan')
            ->leftjoin('karyawan','karyawan.id','=','absensi.id_karyawan')
            ->whereMonth('absensi.tanggal',$bln)
            ->whereYear('absensi.tanggal',$thn)
            ->paginate(40);
        }else{
        $data = DB::table('absensi')
            ->select(DB::raw('absensi.*,jabatan.jabatan,karyawan.nama,karyawan.kode'))
            ->leftjoin('jabatan','jabatan.id','=','absensi.id_jabatan')
            ->leftjoin('karyawan','karyawan.id','=','absensi.id_karyawan')
            ->whereMonth('absensi.tanggal',$bln)
            ->whereYear('absensi.tanggal',$thn)
            ->where('absensi.id_jabatan','=',$namajabatan)
            ->paginate(20);
        }
        $webinfo = DB::table('setting')->limit(1)->get();
    return view('absensi/cetakaabsensiharian',[
     'data'=>$data,'title'=>$webinfo,'tgl'=>$tanggal,'jabatan'=>$namajabatan
    ]);
    }





}
