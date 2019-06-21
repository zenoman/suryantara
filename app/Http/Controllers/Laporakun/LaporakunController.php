<?php
namespace App\Http\Controllers\Laporakun;
ini_set('max_execution_time', 180);
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\models\Laporakunmodel;

use App\Exports\AbsensiharianExport;
use App\Exports\AbsensibulananExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\File;
class LaporakunController extends Controller
{

    public function pilihlapkun()
    {
        $setting = DB::table('setting')->get();
        
        return view('laporakun/pilihlapkun',['title'=>$setting]);
    }

    public function tampilakunlapor(Request $request){
        $rules = [
            'tgl' => 'required',
            'tgl0' => 'required',
                ];
         $customMessages = [
        'required'  => 'Maaf, Bulan Tidak Bokeh Kosong',
         ];
        $this->validate($request,$rules,$customMessages);
        $kate=$request->kategori;
        $tgl = $request->tgl;
        $tgl0 = $request->tgl0;

        if($kate=='pendapatan'){
            $kat = 'pendapatan';
            $data = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('tb_kategoriakutansi.status','=','pendapatan')
            ->groupby('pengeluaran_lain.tgl')
            ->paginate(40);
            foreach ($data as $ros) {
                # code...
            $total[] = DB::table('pengeluaran_lain')
            ->select(DB::raw('SUM(jumlah) as totalnya'))
            ->where('pengeluaran_lain.tgl','=',$ros->tgl)
            ->get();
            }
            $totsemua = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('tb_kategoriakutansi.status','=','pendapatan')
            // ->groupby('pengeluaran_lain.tgl')
            ->get();
        }else{
        $data = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('tb_kategoriakutansi.status','=','pengeluaran')
            ->groupby('pengeluaran_lain.tgl')
            ->paginate(40);
            foreach ($data as $ros) {
                # code...
            $total[] = DB::table('pengeluaran_lain')
            ->select(DB::raw('SUM(jumlah) as totalnya'))
            ->where([['pengeluaran_lain.tgl','=',$ros->tgl],['kategori','=',$ros->kategori]])
            ->get();
            
            } 
            $totsemua = DB::table('pengeluaran_lain')
            ->select(DB::raw('pengeluaran_lain.*,tb_kategoriakutansi.nama'))
            ->select(DB::raw('SUM(pengeluaran_lain.jumlah) as toto'))
            ->leftjoin('tb_kategoriakutansi','tb_kategoriakutansi.kode','=','pengeluaran_lain.kategori')
            ->whereBetween('pengeluaran_lain.tgl',[$tgl,$tgl0])
            ->where('tb_kategoriakutansi.status','=','pengeluaran')
            // ->groupby('pengeluaran_lain.tgl')
            ->get();
        }

        // dd($total);
        $webinfo = DB::table('setting')->limit(1)->get();
    return view('laporakun/laporharianakun',['tose'=>$totsemua,'tot'=>$total,'data'=>$data,'title'=>$webinfo]);
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
